<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\CharacterReference;
use App\Models\Country;
use App\Models\TelephonicInterview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use App\Models\User;
use App\Models\LiveInterviewSchedule;
use App\Models\NotificationLog;
use App\Models\ProfessionalReference;
use App\Models\ReferenceList;
use App\Models\TrainingRunning;
use App\Models\TrainingSchedule;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Models\ReferenceEmailLog;
use DateTime;

class CandidateController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->role == 'Admin') {
            return view('candidate.index');
        }
        return redirect()->route('candidate.create');
    }

    public function candidateList() {
        return view('candidate.index');
    }

    public function getCandidate(Request $request)
    {
        if ($request->ajax()) {
            $data = [];
            if (Auth::user()->role == 'Branch') {
                $data = Candidate::select('candidate.*', 'users.name as branch_name')
                    ->leftJoin('users', 'candidate.branch_id', '=', 'users.id')
                    ->where('candidate.status', 'Pending')
                    ->where('candidate.branch_id', Auth::user()->id)
                    ->orderBy('candidate.created_at', 'desc')->get();
            } else if (Auth::user()->role == 'Admin') {
                $data = Candidate::select('candidate.*', 'users.name as branch_name')
                    ->leftJoin('users', 'candidate.branch_id', '=', 'users.id')
                    ->where('candidate.status', 'Pending')
                    ->has('candidateTelephonic','=', 0)
                    ->orderBy('candidate.created_at', 'desc')->get();
            }
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<a class="btn btn-primary" href="candidate/'. $row->id .'">View Profile</a>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->role == 'Branch') {
            return redirect()->route('branchCandidateList');
        }
        if (Auth::user()->role == 'Admin') {
            return redirect()->route('candidate.index');
        }
        $userId = Auth::user()->id;
        $candidateData = Candidate::where('user_id', $userId)->first();
        $branch = User::where('role', 'Branch')->where('id', '!=', 2)->get();
        if ($candidateData) {
            return redirect()->route('candidate.edit', $candidateData->id);
        }
        $country = Country::all();
        return view('candidate.create', compact('country', 'branch'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'prefix' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'street_address' => 'required',
            'post_code' => 'required',
            'country' => 'required',
            'email' => 'required',
            'mobile_number' => 'required',
            'reference_name_1' => 'required',
            'reference_number_1' => 'required',
            'reference_email_1' => 'required',
            'reference_name_2' => 'required',
            'reference_number_2' => 'required',
            'reference_email_2' => 'required',
        ]);
        $requestData = $request->all();
        $old_emp_details = [];
        if ($requestData['currently_studying'] == 'No') {
            foreach ($requestData['old_date_comletion'] as $key => $value) {
                $old_emp_details[] = ['old_date_comletion' => $value, 'old_education_school' => $requestData['old_education_school'][$key], 'old_education_enrolled' => $requestData['old_education_enrolled'][$key]];
            }
        }
        $training_courses_details = [];
        if ($requestData['training_courses'] == 'Yes') {
            foreach ($requestData['training_date_comletion'] as $key => $value) {
                $training_courses_details[] = ['training_date_comletion' => $value, 'training_subject' => $requestData['training_subject'][$key], 'training_location' => $requestData['training_location'][$key]];
            }
        }
        $ten_year_history = [];
        foreach ($requestData['history_from_date_to_date'] as $key => $value) {
            $ten_year_history[] = ['history_from_date_to_date' => $value, 'history_desc' => $requestData['history_desc'][$key]];
        }
        $requestData['dob'] = Carbon::createFromFormat('d-m-Y', $requestData['dob'])->format('Y-m-d');
        $requestData['old_emp_details'] = json_encode($old_emp_details);
        $requestData['training_courses_details'] = json_encode($training_courses_details);
        $requestData['ten_year_history'] = json_encode($ten_year_history);
        $requestData['user_id'] = Auth::user()->id;
        $requestData['is_submit'] = 'Yes';
        $candidateNew = Candidate::create($requestData);
        ReferenceList::create([
            'name_1' => $requestData['reference_name_1'],
            'email_1' => $requestData['reference_email_1'],
            'number_1' => $requestData['reference_number_1'],
            'reference_place_work_1' => $requestData['reference_place_work_1'],
            'reference_job_title_1' => $requestData['reference_job_title_1'],
            'name_2' => $requestData['reference_name_2'],
            'email_2' => $requestData['reference_email_2'],
            'number_2' => $requestData['reference_number_2'],
            'reference_place_work_2' => $requestData['reference_place_work_2'],
            'reference_job_title_2' => $requestData['reference_job_title_2'],
            'candidate_id' => $candidateNew->id,
        ]);
        return redirect()->route('candidate.edit');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Auth::user()->role == 'Admin' || Auth::user()->role == 'Branch') {
            $country = Country::all();
            $candidate = Candidate::find($id);
            $candidate->is_read = 'Yes';
            $candidate->save();
            $branch = User::where('role', 'Branch')->where('id', '!=', 2)->get();
            if ($candidate->identity_proof) {
                $identityProofData = json_decode($candidate->identity_proof, true);
            } else {
                $identityProofData = ['type' => null, 'file' => null];
            }
            if ($candidate->address_proof) {
                $addressProofData = json_decode($candidate->address_proof, true);
            } else {
                $addressProofData = ['type' => null, 'file' => null];
            }
            return view('candidate.show', compact('candidate', 'country', 'branch', 'identityProofData', 'addressProofData'));
        }
        return redirect()->route('candidate.create');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->role == 'Branch') {
            return redirect()->route('branchCandidateList');
        }
        if (Auth::user()->role == 'Admin') {
            return redirect()->route('candidate.index');
        }
        $country = Country::all();
        $candidate = Candidate::find($id);
        if ($candidate->identity_proof) {
            $identityProofData = json_decode($candidate->identity_proof, true);
        } else {
            $identityProofData = ['type' => null, 'file' => null];
        }
        if ($candidate->address_proof) {
            $addressProofData = json_decode($candidate->address_proof, true);
        } else {
            $addressProofData = ['type' => null, 'file' => null];
        }
        $branch = User::where('role', 'Branch')->where('id', '!=', 2)->get();
        return view('candidate.edit', compact('candidate', 'country', 'branch', 'identityProofData', 'addressProofData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!isset($request->view_page)) {
            $request->validate([
                'prefix' => 'required',
                'first_name' => 'required',
                'last_name' => 'required',
                'street_address' => 'required',
                'post_code' => 'required',
                'country' => 'required',
                'email' => 'required',
                'mobile_number' => 'required',
                'reference_name_1' => 'required',
                'reference_number_1' => 'required',
                'reference_email_1' => 'required',
                'reference_name_2' => 'required',
                'reference_number_2' => 'required',
                'reference_email_2' => 'required',
            ]);
        }

        $requestData = $request->all();
        $currently_studying_details = [];
        if (isset($requestData['currently_studying']) && $requestData['currently_studying'] == 'Yes') {
            foreach ($requestData['date_of_comletion'] as $key => $value) {
                $currently_studying_details[] = ['date_of_comletion' => $value, 'current_education_school' => $requestData['current_education_school'][$key], 'current_education_enrolled' => $requestData['current_education_enrolled'][$key]];
            }
        }
        $old_emp_details = [];
        if (isset($requestData['currently_studying']) && $requestData['currently_studying'] == 'No') {
            foreach ($requestData['old_date_comletion'] as $key => $value) {
                $old_emp_details[] = ['old_date_comletion' => $value, 'old_education_school' => $requestData['old_education_school'][$key], 'old_education_enrolled' => $requestData['old_education_enrolled'][$key]];
            }
        }
        $training_courses_details = [];
        if (isset($requestData['training_courses']) && $requestData['training_courses'] == 'Yes') {
            foreach ($requestData['training_date_comletion'] as $key => $value) {
                $training_courses_details[] = ['training_date_comletion' => $value, 'training_subject' => $requestData['training_subject'][$key], 'training_location' => $requestData['training_location'][$key]];
            }
        }
        $ten_year_history = [];
        if (isset($requestData['history_from_date_to_date'])) {
            foreach ($requestData['history_from_date_to_date'] as $key => $value) {
                $ten_year_history[] = ['history_from_date_to_date' => $value, 'history_desc' => $requestData['history_desc'][$key]];
            }
        }
        $requestData['dob'] = Carbon::createFromFormat('d-m-Y', $requestData['dob'])->format('Y-m-d');
        $requestData['currently_studying_details'] = json_encode($currently_studying_details);
        $requestData['old_emp_details'] = json_encode($old_emp_details);
        $requestData['training_courses_details'] = json_encode($training_courses_details);
        $requestData['ten_year_history'] = json_encode($ten_year_history);
        $requestData['is_submit'] = 'Yes';

        $identityProofData = [];
        if ($request->hasFile('identity_proof')) {
            $image = $request->file('identity_proof');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/user_document/identity_proof');
            $image->move($destinationPath, $name);
            $requestData['identity_proof'] = asset('user_document/identity_proof/' . $name);

            $identityProofData = [
                'type' => $request->input('identity_proof_type'),
                'file' => $requestData['identity_proof']
            ];
            $requestData['identity_proof'] = json_encode($identityProofData);
        } else {
            $candidateData = Candidate::find($id);
            $identityProofJson = json_decode($candidateData->identity_proof, true);
            if ($identityProofJson && is_array($identityProofJson)) {
                $file = isset($identityProofJson['file']) ? $identityProofJson['file'] : null;
            } else {
                $file = null;
            }
            $identityProofData = [
                'type' => $request->input('identity_proof_type'),
                'file' => $file
            ];
            $requestData['identity_proof'] = json_encode($identityProofData);
        }

        $addressProofData = [];
        if ($request->hasFile('address_proof')) {
            $image = $request->file('address_proof');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/user_document/address_proof');
            $image->move($destinationPath, $name);
            $requestData['address_proof'] = asset('user_document/address_proof/' . $name);

            $addressProofData = [
                'type' => $request->input('address_proof_type'),
                'file' => $requestData['address_proof']
            ];
            $requestData['address_proof'] = json_encode($addressProofData);
        } else {
            $candidateData = Candidate::find($id);
            $addressProofJson = json_decode($candidateData->address_proof, true);
            if ($addressProofJson && is_array($addressProofJson)) {
                $file = isset($addressProofJson['file']) ? $addressProofJson['file'] : null;
            } else {
                $file = null;
            }
            $addressProofData = [
                'type' => $request->input('address_proof_type'),
                'file' => $file
            ];
            $requestData['address_proof'] = json_encode($addressProofData);
        }

        Candidate::find($id)->update($requestData);
        $getReference = ReferenceList::where('candidate_id', $id)->first();
        $reference_1_json = [];
        if (isset($requestData['reference_name_1'])) {
            if ($getReference && $getReference->reference_1_json) {
                $referenceData = json_decode($getReference->reference_1_json, true);
            } else {
                $referenceData = [];
            }
            foreach ($requestData['reference_name_1'] as $key => $value) {
                $reference_1_item = [
                    'name_1' => $value,
                    'email_1' => $requestData['reference_email_1'][$key],
                    'number_1' => $requestData['reference_number_1'][$key],
                    'reference_place_work_1' => $requestData['reference_place_work_1'][$key],
                    'reference_job_title_1' => $requestData['reference_job_title_1'][$key],
                ];
                if (count($referenceData) > 0) {
                    if (isset($referenceData[$key]['character_email_complete'])) {
                        $reference_1_item['character_email_complete'] = $referenceData[$key]['character_email_complete'];
                    } else {
                        $reference_1_item['character_email_complete'] = 'No';
                    }
                    if (isset($referenceData[$key]['email_day_count'])) {
                        $reference_1_item['email_day_count'] = $referenceData[$key]['email_day_count'];
                    } else {
                        $reference_1_item['email_day_count'] = 0;
                    }
                    if (isset($referenceData[$key]['status_1'])) {
                        $reference_1_item['status_1'] = $referenceData[$key]['status_1'];
                    } else {
                        $reference_1_item['status_1'] = '';
                    }
                }
                $reference_1_json[] = $reference_1_item;
            }
        }
        $reference_2_json = [];
        if (isset($requestData['reference_name_2'])) {
            if ($getReference && $getReference->reference_2_json) {
                $professionalData = json_decode($getReference->reference_2_json, true);
            } else {
                $professionalData = [];
            }
            foreach ($requestData['reference_name_2'] as $key => $value) {
                $reference_2_item = [
                    'name_2' => $value,
                    'email_2' => $requestData['reference_email_2'][$key],
                    'number_2' => $requestData['reference_number_2'][$key],
                    'reference_place_work_2' => $requestData['reference_place_work_2'][$key],
                    'reference_job_title_2' => $requestData['reference_job_title_2'][$key]
                ];
                if (count($professionalData) > 0) {
                    if (isset($professionalData[$key]['professional_email_complete'])) {
                        $reference_2_item['professional_email_complete'] = $professionalData[$key]['professional_email_complete'];
                    } else {
                        $reference_2_item['character_email_complete'] = 'No';
                    }
                    if (isset($professionalData[$key]['email_day_count'])) {
                        $reference_2_item['email_day_count'] = $professionalData[$key]['email_day_count'];
                    } else {
                        $reference_2_item['email_day_count'] = 0;
                    }
                    if (isset($professionalData[$key]['status_2'])) {
                        $reference_2_item['status_2'] = $professionalData[$key]['status_2'];
                    } else {
                        $reference_2_item['status_2'] = '';
                    }
                }
                $reference_2_json[] = $reference_2_item;
            }
        }
        if ($getReference) {
            $referenceData = json_decode($getReference->reference_1_json, true);
            if (count($referenceData) > 0) {
                foreach ($referenceData as $key => $value) {
                    if ($requestData['reference_email_1'][$key] != $value['email_1']) {
                        $emailRequest = [
                            "old_name" => $value['name_1'],
                            "old_email" => $value['email_1'],
                            "new_name" => $requestData['reference_name_1'][$key],
                            "new_email" => $requestData['reference_email_1'][$key],
                        ];
                        ReferenceEmailLog::create([
                            "candidate_id" => $id,
                            "reference_id" => $getReference->id,
                            "reference_type" => "Character",
                            "request" => json_encode($emailRequest),
                        ]);
                    }
                }
            }
            $professionalData = json_decode($getReference->reference_2_json, true);
            if (count($professionalData) > 0) {
                foreach ($professionalData as $key => $value) {
                    if ($requestData['reference_email_2'][$key] != $value['email_2']) {
                        $emailRequest = [
                            "old_name" => $value['name_2'],
                            "old_email" => $value['email_2'],
                            "new_name" => $requestData['reference_name_2'][$key],
                            "new_email" => $requestData['reference_email_2'][$key],
                        ];
                        ReferenceEmailLog::create([
                            "candidate_id" => $id,
                            "reference_id" => $getReference->id,
                            "reference_type" => "Professional",
                            "request" => json_encode($emailRequest),
                        ]);
                    }
                }
            }
            ReferenceList::where('candidate_id', $id)->update([
                'reference_1_json' => json_encode($reference_1_json),
                'reference_2_json' => json_encode($reference_2_json),
                'name_1' => $requestData['reference_name_1'][0],
                'email_1' => $requestData['reference_email_1'][0],
                'number_1' => $requestData['reference_number_1'][0],
                'reference_place_work_1' => $requestData['reference_place_work_1'][0],
                'reference_job_title_1' => $requestData['reference_job_title_1'][0],
                'name_2' => $requestData['reference_name_2'][0],
                'email_2' => $requestData['reference_email_2'][0],
                'number_2' => $requestData['reference_number_2'][0],
                'reference_place_work_2' => $requestData['reference_place_work_2'][0],
                'reference_job_title_2' => $requestData['reference_job_title_2'][0],
            ]);
        } else {
            ReferenceList::create([
                'reference_1_json' => json_encode($reference_1_json),
                'reference_2_json' => json_encode($reference_2_json),
                'name_1' => $requestData['reference_name_1'][0],
                'email_1' => $requestData['reference_email_1'][0],
                'number_1' => $requestData['reference_number_1'][0],
                'reference_place_work_1' => $requestData['reference_place_work_1'][0],
                'reference_job_title_1' => $requestData['reference_job_title_1'][0],
                'name_2' => $requestData['reference_name_2'][0],
                'email_2' => $requestData['reference_email_2'][0],
                'number_2' => $requestData['reference_number_2'][0],
                'reference_place_work_2' => $requestData['reference_place_work_2'][0],
                'reference_job_title_2' => $requestData['reference_job_title_2'][0],
                'candidate_id' => $id,
            ]);
        }
        // if ($getReference->isNotEmpty()) {
        //     foreach ($getReference as $index => $reference) {
        //         if ($requestData['reference_id'][$index] == $reference->id || $requestData['reference_professional_id'][$index] == $reference->id) {
        //             $reference->update([
        //                 'name_1' => $requestData['reference_name_1'][$index],
        //                 'email_1' => $requestData['reference_email_1'][$index],
        //                 'number_1' => $requestData['reference_number_1'][$index],
        //                 'reference_place_work_1' => $requestData['reference_place_work_1'][$index],
        //                 'reference_job_title_1' => $requestData['reference_job_title_1'][$index],
        //                 'name_2' => $requestData['reference_name_2'][$index],
        //                 'email_2' => $requestData['reference_email_2'][$index],
        //                 'number_2' => $requestData['reference_number_2'][$index],
        //                 'reference_place_work_2' => $requestData['reference_place_work_2'][$index],
        //                 'reference_job_title_2' => $requestData['reference_job_title_2'][$index],
        //             ]);
        //         }
        //     }
        // } else {
        //     // Create new records for each reference
        //     for ($i = 0; $i < count($requestData['reference_name_1']); $i++) {
        //         ReferenceList::create([
        //             'name_1' => $requestData['reference_name_1'][$i] ?? null,
        //             'email_1' => $requestData['reference_email_1'][$i] ?? null,
        //             'number_1' => $requestData['reference_number_1'][$i] ?? null,
        //             'reference_place_work_1' => $requestData['reference_place_work_1'][$i] ?? null,
        //             'reference_job_title_1' => $requestData['reference_job_title_1'][$i] ?? null,
        //             'name_2' => $requestData['reference_name_2'][$i] ?? null,
        //             'email_2' => $requestData['reference_email_2'][$i] ?? null,
        //             'number_2' => $requestData['reference_number_2'][$i] ?? null,
        //             'reference_place_work_2' => $requestData['reference_place_work_2'][$i] ?? null,
        //             'reference_job_title_2' => $requestData['reference_job_title_2'][$i] ?? null,
        //             'candidate_id' => $id,
        //         ]);
        //     }
        // }
        $candidateData = Candidate::find($id);
        // $body = "Dear ". $candidateData->first_name . ",<br><br> Thank you for submitting the application form. We will review the form and contact you as soon as possible.<br><br>If you have any concerns, you can send an email to jobs@ndhcarec.o.uk or feel free to contact 0121 448 0568.<br><br>Best Regards,<br><br>Recruitment Team<br>NDH Care Ltd";
        // $this->sendMail($candidateData->email, $candidateData->first_name, 'Application Submit Successfully!', $body, $id, $candidateData->branch_id);
        return redirect()->route('candidate.edit', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function assignToBranch(Request $request) {
        $request->validate([
            'candidate_id' => 'required',
            'branch_id' => 'required'
        ]);
        $candidateId = $request->candidate_id;
        Candidate::find($candidateId)->update([
            'branch_id' => $request->branch_id
        ]);
        return redirect()->route('candidate.index');
    }

    public function candidateHistory() {
        $candidate = Candidate::where('user_id', Auth::user()->id)
                ->withCount(['candidateTelephonic', 'candidateLiveSchedule'])
                ->first();

        return view('candidate.history', compact('candidate'));
    }

    public function candidateTelePhonic(Request $request) {
        $request->validate([
            'candidate_id' => 'required',
            // 'date' => 'required',
            // 'note' => 'required'
        ]);
        if (Auth::user()->role == 'Branch') {
            $telephonicInterview = TelephonicInterview::where('candidate_id',$request->candidate_id)->first();
            if ($telephonicInterview) {
                // $telephonicInterview->candidate_id = $request->candidate_id;
                // $telephonicInterview->date = Carbon::parse($request->date)->format('Y-m-d H:i');
                // $telephonicInterview->note = $request->note;
                // $telephonicInterview->save();
                $data = $request->except(['_token']);
                TelephonicInterview::where('candidate_id',$request->candidate_id)->update($data);
            } else {
                $requestData = $request->all();
                if (isset($request->date)) {
                    $requestData['date'] = Carbon::parse($request->date)->format('Y-m-d H:i');
                }
                TelephonicInterview::create($requestData);
                $candidateData = Candidate::find($request->candidate_id);
                $attachmentPaths = [
                    public_path('attachments/equal opprtunity form.docx'),
                    public_path('attachments/health and fitness questionaries.docx'),
                    public_path('attachments/JOB DESCRIPTION.docx'),
                ];
                // $body = "Dear ". $candidateData->first_name . ",<br><br> Thank you for applying for the post of Health Care Assistant at NDH Care Ltd.<br><br>You have been successful on your Telephone screening stage.<br><br>We would like to invite you to the office for a face-to-face interview. Details are as below.<br><br><b>Date : ". date('d-m-Y') ."</b><br><br><b>Date : ". date('H:i') ."</b><br><br><b>Venue:</b> Suite 05 Elite House, 70 Warwick Street, Birmingham, B12 0NL,<br><br>-Evidence of your National Insurance Number: Any one document (Example: N.I card, P60, payslip or Any HMRC letter to show your name and NI number.<br><br>-Right to work documentation: Any one document (Passport or Birth certificate, BRP card, etc)<br><br>-Either a passport, driving license or other form of photographic identification in addition to the above: <br><br>-Proof of address, such as an original recent utility bill, a credit card bill, bank statement, or council tax This must include your name and be no older than 3 months<br><br>-Originals of any training or education certificates which are relevant to your application.<br><br>-Any relevant certificates or registration evidence that support your application for this role.<br><br>- COVID vaccine card<br><br>If you are unable to take the interview, please call us on this number 0121 448 0568 and we will reschedule your interview.<br><br>Thank you,<br>Heena Patel";
                // $this->sendMail($candidateData->email, $candidateData->first_name, 'Schedule Telephonic Interview', $body, $candidateData->id, $candidateData->branch_id, $attachmentPaths);
            }
            Candidate::find($request->candidate_id)->update(['status' => 'Telephonic']);
            return redirect()->route('telephonicList');
        }
        return redirect()->route('candidate.index');
    }

    public function candidateLiveInterview(Request $request) {
        $request->validate([
            'candidate_id' => 'required',
            'date' => 'required',
            'note' => 'required'
        ]);
        if (Auth::user()->role == 'Branch') {
            $liveInterview = LiveInterviewSchedule::where('candidate_id',$request->candidate_id)->first();
            if ($liveInterview) {
                $liveInterview->candidate_id = $request->candidate_id;
                $liveInterview->date = Carbon::parse($request->date)->format('Y-m-d H:i');
                $liveInterview->note = $request->note;
                // if ($request->hasFile('pdf_upload')) {
                //     $image = $request->file('pdf_upload');
                //     $name = time() . '.' . $image->getClientOriginalExtension();
                //     $destinationPath = public_path('/user_document/live_interview_schedule_file/pdf_upload');
                //     $image->move($destinationPath, $name);
                //     $pdf_upload = asset('user_document/live_interview_schedule_file/pdf_upload/' . $name);
                //     $liveInterview->pdf_upload = $pdf_upload;
                // }
                $liveInterview->save();
            } else {
                $requestData = $request->all();
                $requestData['date'] = Carbon::parse($request->date)->format('Y-m-d H:i');
                // if ($request->hasFile('pdf_upload')) {
                //     $image = $request->file('pdf_upload');
                //     $name = time() . '.' . $image->getClientOriginalExtension();
                //     $destinationPath = public_path('/user_document/live_interview_schedule_file/pdf_upload');
                //     $image->move($destinationPath, $name);
                //     $requestData['pdf_upload'] = asset('user_document/live_interview_schedule_file/pdf_upload/' . $name);
                // }
                LiveInterviewSchedule::create($requestData);
                // $candidateData = Candidate::find($request->candidate_id);
                // $body = "Dear ". $candidateData->first_name . ", <br><br>I am very pleased to inform you that you were successful in your interview. We would like to provisionally offer you: The post of Health care Assistant.<br><br>If you have question do not hesitate contact recruitment team.<br></br>Please find the attachment.<br><br>Thank you,<br><br>Heena Patel,<br><br>Recruitment<br><br>NDH Care Ltd.<br>0121 448 0568";
                // $this->sendMail($candidateData->email, $candidateData->first_name, 'Schedule Live Interview', $body, $candidateData->id, $candidateData->branch_id);
            }
            $dateString = $request->input('date');
            $date = Carbon::parse($dateString);
            $formattedDate = $date->format('d/m/Y');
            $formattedTime = $date->format('h:i A');
            $candidateData = Candidate::find($request->candidate_id);
            $attachmentPaths = [
                public_path('attachments/equal opprtunity form.docx'),
                public_path('attachments/health and fitness questionaries.docx'),
                public_path('attachments/JOB DESCRIPTION.docx'),
            ];
            if ($candidateData->branch_id == 3) {
                $body = "Dear ". $candidateData->first_name . ",<br><br> Thank you for applying for the post of Health Care Assistant at NDH Care Ltd.<br><br>You have been successful on your Telephone screening stage.<br><br>We would like to invite you to the office for a face-to-face interview. Details are as below.<br><br><b>Date : ". $formattedDate ."</b><br><br><b>Time : ". $formattedTime ."</b><br><br><b>Venue:</b> Suite 05 Elite House, 70 Warwick Street, Birmingham, B12 0NL,<br><br>-Evidence of your National Insurance Number: Any one document (Example: N.I card, P60, payslip or Any HMRC letter to show your name and NI number.<br><br>-Right to work documentation: Any one document (Passport or Birth certificate, BRP card, etc)<br><br>-Either a passport, driving license or other form of photographic identification in addition to the above: <br><br>-Proof of address, such as an original recent utility bill, a credit card bill, bank statement, or council tax This must include your name and be no older than 3 months<br><br>-Originals of any training or education certificates which are relevant to your application.<br><br>-Any relevant certificates or registration evidence that support your application for this role.<br><br>- COVID vaccine card<br><br>If you are unable to take the interview, please call us on this number 0121 448 0568 and we will reschedule your interview.<br><br>Thank you,<br>Heena Patel";
                $this->sendMail($candidateData->email, $candidateData->first_name, 'Interview Invitation Mail', $body, $candidateData->id, $candidateData->branch_id, $attachmentPaths);
            } else {
                $body = "Dear ". $candidateData->first_name . ",<br><br> Thank you for applying for the post of Health Care Assistant at NDH Care Ltd.<br><br>You have been successful on your Telephone screening stage.<br><br>We would like to invite you to the office for a face-to-face interview. Details are as below.<br><br><b>Date : ". $formattedDate ."</b><br><br><b>Time : ". $formattedTime ."</b><br><br><b>Venue:</b> 13 Loughborough Rd, Leicester LE4 5LJ,<br><br>-Evidence of your National Insurance Number: Any one document (Example: N.I card, P60, payslip or Any HMRC letter to show your name and NI number.<br><br>-Right to work documentation: Any one document (Passport or Birth certificate, BRP card, etc)<br><br>-Either a passport, driving license or other form of photographic identification in addition to the above: <br><br>-Proof of address, such as an original recent utility bill, a credit card bill, bank statement, or council tax This must include your name and be no older than 3 months<br><br>-Originals of any training or education certificates which are relevant to your application.<br><br>-Any relevant certificates or registration evidence that support your application for this role.<br><br>- COVID vaccine card<br><br>If you are unable to take the interview, please call us on this number 0116 309 0111 and we will reschedule your interview.<br><br>Thank you,<br>Heena Patel";
                $this->sendMail($candidateData->email, $candidateData->first_name, 'Interview Invitation Mail', $body, $candidateData->id, $candidateData->branch_id, $attachmentPaths);
            }
            Candidate::find($request->candidate_id)->update(['status' => 'Pending Interview']);
            return redirect()->route('liveScheduleList');
        }
        return redirect()->route('candidate.index');
    }

    public function candidateLiveInterviewNote(Request $request) {
        $request->validate([
            'candidate_id' => 'required',
            'status_date' => 'required',
            'note_status' => 'required',
            'status_note' => 'required'
        ]);

        if (Auth::user()->role == 'Branch') {
            $liveInterview = LiveInterviewSchedule::where('candidate_id',$request->candidate_id)->first();
            if ($liveInterview) {
                $liveInterview->candidate_id = $request->candidate_id;
                $liveInterview->status = $request->note_status;
                $liveInterview->status_date = Carbon::parse($request->status_date)->format('Y-m-d H:i');
                $liveInterview->status_note = $request->status_note;
                if ($request->hasFile('pdf_upload')) {
                    $image = $request->file('pdf_upload');
                    $name = time() . '.' . $image->getClientOriginalExtension();
                    $destinationPath = public_path('/user_document/live_interview_schedule_file/pdf_upload');
                    $image->move($destinationPath, $name);
                    $pdf_upload = asset('user_document/live_interview_schedule_file/pdf_upload/' . $name);
                    $liveInterview->pdf_upload = $pdf_upload;
                }
                $liveInterview->save();
                $candidateData = Candidate::find($request->candidate_id);
                // $body = "Dear ". $candidateData->first_name . ", <br><br>Your Live Inteview Note is " . $request->status_note. "<br><br>Thank you,<br><br>Heena Patel,<br><br>Recruitment<br><br>NDH Care Ltd.<br>0121 448 0568";
                if ($candidateData->branch_id == 3) {
                    $body = "Dear ". $candidateData->first_name . ", <br><br>I am very pleased to inform you that you were successful in your interview.<br><br>We would like to provisionally offer you: The post of Health care Assistant.<br><br>If you have question do not hesitate contact recruitment team.<br><br>Thank you,<br><br>Heena Patel,<br><br>Recruitment<br><br>NDH Care Ltd.<br>0121 448 0568";
                    $this->sendMail($candidateData->email, $candidateData->first_name, 'Your Live Interview Note', $body, $candidateData->id, $candidateData->branch_id);
                } else {
                    $body = "Dear ". $candidateData->first_name . ", <br><br>I am very pleased to inform you that you were successful in your interview.<br><br>We would like to provisionally offer you: The post of Health care Assistant.<br><br>If you have question do not hesitate contact recruitment team.<br><br>Thank you,<br><br>Heena Patel,<br><br>Recruitment<br><br>NDH Care Ltd.<br>0116 309 0111";
                    $this->sendMail($candidateData->email, $candidateData->first_name, 'Your Live Interview Note', $body, $candidateData->id, $candidateData->branch_id);
                }
            }
            if ($request->note_status == 'Selected') {
                Candidate::find($request->candidate_id)->update(['status' => 'Selected Interview']);
                // $candidateData = Candidate::find($request->candidate_id);
                // $body = "Dear ". $candidateData->first_name . ", <br><br>I am very pleased to inform you that you were successful in your interview.<br><br>We would like to provisionally offer you: The post of Health care Assistant.<br><br>If you have question do not hesitate contact recruitment team.<br><br>Thank you,<br><br>Heena Patel,<br><br>Recruitment<br><br>NDH Care Ltd.<br>0121 448 0568";
                // $this->sendMail($candidateData->email, $candidateData->first_name, 'Conditional offer of Employment', $body, $candidateData->id, $candidateData->branch_id);
            } else {
                Candidate::find($request->candidate_id)->update(['status' => 'Rejected Interview']);
            }

            return redirect()->route('liveScheduleNote');
        }
        return redirect()->route('candidate.index');
    }

    public function candidateReferenceNote(Request $request) {
        $request->validate([
            'candidate_id' => 'required',
            // 'note_1' => 'required',
            // 'note_2' => 'required',
            // 'status_1' => 'required',
            // 'status_2' => 'required'
        ]);
        if (Auth::user()->role == 'Branch') {
            $referenceList = ReferenceList::where('candidate_id',$request->candidate_id)->first();
            if ($referenceList) {
                $pdf_upload1 = null;
                $pdf_upload2 = null;
                if ($request->hasFile('pdf_upload_1')) {
                    $image = $request->file('pdf_upload_1');
                    $name = time() . '.' . $image->getClientOriginalExtension();
                    $destinationPath = public_path('/user_document/reference');
                    $image->move($destinationPath, $name);
                    $pdf_upload1 = asset('user_document/reference/' . $name);
                }
                if ($request->hasFile('pdf_upload_2')) {
                    $image = $request->file('pdf_upload_2');
                    $name = time() . '.' . $image->getClientOriginalExtension();
                    $destinationPath = public_path('/user_document/reference');
                    $image->move($destinationPath, $name);
                    $pdf_upload2 = asset('user_document/reference/' . $name);
                }
                if ($referenceList) {
                    $referenceData = json_decode($referenceList->reference_1_json, true);
                    foreach ($referenceData as $key => $value) {
                        $value['status_1'] = $request->json_1_status[$key] ?? '';
                        $referenceDataNew[] = $value;
                    }
                    $professionalData = json_decode($referenceList->reference_2_json, true);
                    foreach ($professionalData as $key => $value) {
                        $value['status_2'] = $request->json_2_status[$key] ?? '';
                        $professionalDataNew[] = $value;
                    }
                }

                ReferenceList::where('candidate_id', $request->candidate_id)->update([
                    'note_1' => $request->note_1,
                    'note_2' => $request->note_2,
                    'status_1' => $request->json_1_status[0] ?? null,
                    'status_2' => $request->json_2_status[0] ?? null,
                    'pdf_upload_1' => $pdf_upload1,
                    'pdf_upload_2' => $pdf_upload2,
                    'reference_1_json' => json_encode($referenceDataNew),
                    'reference_2_json' => json_encode($professionalDataNew),
                ]);
                $candidateData = Candidate::find($request->candidate_id);
                if ($request->status_1 == 'Approved') {
                    if ($candidateData->branch_id == 3) {
                        $body = "Dear ". $candidateData->first_name . ", <br><br>Your First Reference Was Approved<br><br>Thank you,<br><br>Heena Patel,<br><br>Recruitment<br><br>NDH Care Ltd.<br>0121 448 0568";
                        $this->sendMail($candidateData->email, $candidateData->first_name, 'Your First Reference Was Approved', $body, $candidateData->id, $candidateData->branch_id);
                    } else {
                        $body = "Dear ". $candidateData->first_name . ", <br><br>Your First Reference Was Approved<br><br>Thank you,<br><br>Heena Patel,<br><br>Recruitment<br><br>NDH Care Ltd.<br>0116 309 0111";
                        $this->sendMail($candidateData->email, $candidateData->first_name, 'Your First Reference Was Approved', $body, $candidateData->id, $candidateData->branch_id);
                    }
                }
                if ($request->status_2 == 'Approved') {
                    if ($candidateData->branch_id == 3) {
                        $body = "Dear ". $candidateData->first_name . ", <br><br>Your Second Reference Was Approved<br><br>Thank you,<br><br>Heena Patel,<br><br>Recruitment<br><br>NDH Care Ltd.<br>0121 448 0568";
                        $this->sendMail($candidateData->email, $candidateData->first_name, 'Your Second Reference Was Approved', $body, $candidateData->id, $candidateData->branch_id);
                    } else {
                        $body = "Dear ". $candidateData->first_name . ", <br><br>Your Second Reference Was Approved<br><br>Thank you,<br><br>Heena Patel,<br><br>Recruitment<br><br>NDH Care Ltd.<br>0116 309 0111";
                        $this->sendMail($candidateData->email, $candidateData->first_name, 'Your Second Reference Was Approved', $body, $candidateData->id, $candidateData->branch_id);
                    }
                }
            }
            return redirect()->route('referenceList');
        }
        return redirect()->route('candidate.index');
    }

    public function candidateTrainingSchedule(Request $request) {
        $request->validate([
            'candidate_id' => 'required',
            'training_date' => 'required',
            'training_note' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
        if (Auth::user()->role == 'Branch') {
            $trainingList = TrainingSchedule::where('candidate_id',$request->candidate_id)->first();
            if ($trainingList) {
                TrainingSchedule::where('candidate_id', $request->candidate_id)->update([
                    'date' => Carbon::parse($request->training_date)->format('Y-m-d H:i'),
                    'note' => $request->training_note,
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date,
                ]);
            } else {
                TrainingSchedule::create([
                    'date' => Carbon::parse($request->training_date)->format('Y-m-d H:i'),
                    'note' => $request->training_note,
                    'candidate_id' => $request->candidate_id,
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date,
                ]);
                $start_date = Carbon::parse($request->start_date);
                $end_date = Carbon::parse($request->end_date);
                $dateValue = '';
                while ($start_date <= $end_date) {
                    $dateValue .= "- ". $start_date->format('l - d/m/Y') . "<br><br>";
                    // echo $start_date->format('l - d-m-Y') . "\n";
                    $start_date->addDay();
                }
                $candidateData = Candidate::find($request->candidate_id);
                if ($candidateData->branch_id == 3) {
                    $body = "Good Morning, <br><br>You have been booked for five days of training, please see details below:<br><br><b>Dates:</b><br><br>" . $dateValue . "<br><br><b>Time:</b><br><br>10:00 to 15:00 PM <br><br><b>Venue:</b><br><br>NDH Care LTD,<br>Elite House, Suite 06,<br>70 Warwick Street,<br>Birmingham,<br>B12 0NL<br><br>You must attend training as it is mandatory. If you have any concerns or are unable to attend, call 0121 448 0568 as soon as possible or drop the email.<br><br>Please CONFIRM if you will be attending.<br><br>Thank you";
                    $this->sendMail($candidateData->email, $candidateData->first_name, 'Your Training Schedule', $body, $candidateData->id, $candidateData->branch_id);
                } else {
                    $body = "Good Morning, <br><br>You have been booked for five days of training, please see details below:<br><br><b>Dates:</b><br><br>" . $dateValue . "<br><br><b>Time:</b><br><br>10:00 to 15:00 PM <br><br><b>Venue:</b><br><br>NDH Care LTD,<br>13 Loughborough Rd,<br>Leicester LE4 5LJ<br><br>You must attend training as it is mandatory. If you have any concerns or are unable to attend, call 0116 309 0111 as soon as possible or drop the email.<br><br>Please CONFIRM if you will be attending.<br><br>Thank you";
                    $this->sendMail($candidateData->email, $candidateData->first_name, 'Your Training Schedule', $body, $candidateData->id, $candidateData->branch_id);
                }
            }
            return redirect()->route('trainingScheduleList');
        }
        return redirect()->route('candidate.index');
    }

    public function branchList(Request $request) {
        if (Auth::user()->role == 'Admin') {
            return view('branch.index');
        }
        if (Auth::user()->role == 'Branch') {
            return redirect()->route('branchCandidateList');
        }
        if (Auth::user()->role == 'Candidate') {
            return redirect()->route('candidate.create');
        }
    }

    public function getBranchList(Request $request) {
        if ($request->ajax()) {
            $data = [];
            if (Auth::user()->role == 'Admin') {
                $data = User::where('role', 'Branch')->get();
            }
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->make(true);
        }
    }

    public function telephonicInterview() {
        if (Auth::user()->role == 'Admin') {
            return view('telephonic-interview');
        }
        if (Auth::user()->role == 'Branch') {
            return redirect()->route('branchCandidateList');
        }
        if (Auth::user()->role == 'Candidate') {
            return redirect()->route('candidate.create');
        }
    }

    public function getTelephonicInterview(Request $request) {
        if ($request->ajax()) {
            $data = [];
            if (Auth::user()->role == 'Admin') {
                $data = Candidate::select('candidate.*', 'users.name as branch_name')
                    ->withCount(['candidateTelephonic'])
                    ->leftJoin('users', 'candidate.branch_id', '=', 'users.id')
                    ->has('candidateTelephonic','>', 0)
                    ->get();
            }
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<a class="btn btn-primary candidateTelephone" id="'. $row->id .'">View</a>';
                        return $btn;
                    })
                    ->addColumn('profile', function($row){
                        $btn = '<a class="btn btn-primary" href="candidate/'. $row->id .'">View</a>';
                        return $btn;
                    })
                    ->rawColumns(['action', 'profile'])
                    ->make(true);
        }
    }

    public function telephonicInterviewData(Request $request) {
        if ($request->ajax()) {
            if (isset($request->candidate_id)) {
                $candidateId = $request->candidate_id;
                $data = TelephonicInterview::select('id', 'candidate_id', 'note', DB::raw('DATE_FORMAT(date, "%Y-%m-%d %h:%i %p") AS date'))->where('candidate_id', $candidateId)->first();
                return response()->json($data);
            }
        }
        return response()->json(false);
    }

    public function liveInterviewScheduleData(Request $request) {
        if ($request->ajax()) {
            if (isset($request->candidate_id)) {
                $candidateId = $request->candidate_id;
                $data = LiveInterviewSchedule::select('id', 'note', 'pdf_upload', DB::raw('DATE_FORMAT(date, "%Y-%m-%d %h:%i %p") AS date'))
                        ->where('candidate_id', $candidateId)->first();
                return response()->json($data);
            }
        }
        return response()->json(false);
    }

    public function liveInterviewNoteData(Request $request) {
        if ($request->ajax()) {
            if (isset($request->candidate_id)) {
                $candidateId = $request->candidate_id;
                $data = LiveInterviewSchedule::select('id', 'status', 'status_note', 'pdf_upload', DB::raw('DATE_FORMAT(status_date, "%Y-%m-%d %h:%i %p") AS date'))
                        ->where('candidate_id', $candidateId)->first();
                return response()->json($data);
            }
        }
        return response()->json(false);
    }

    public function referenceData(Request $request) {
        if ($request->ajax()) {
            if (isset($request->candidate_id)) {
                $candidateId = $request->candidate_id;
                $data = ReferenceList::where('candidate_id', $candidateId)->first();
                $referenceData = json_decode($data->reference_1_json, true);
                foreach ($referenceData as $key => &$value) {
                    $isExist = CharacterReference::where('candidate_id', $candidateId)->where('reference_number', $key + 1)->first();
                    if ($isExist) {
                        $value['form_complete'] = 'yes';
                    }
                }
                $referenceData1 = json_decode($data->reference_2_json, true);
                foreach ($referenceData1 as $key => &$value) {
                    $isExist = ProfessionalReference::where('candidate_id', $candidateId)->where('reference_number', $key + 1)->first();
                    if ($isExist) {
                        $value['form_complete'] = 'yes';
                    }
                }
                $data->reference_1_json = json_encode($referenceData);
                $data->reference_2_json = json_encode($referenceData1);
                return response()->json($data);
            }
        }
        return response()->json(false);
    }

    public function trainingScheduleData(Request $request) {
        if ($request->ajax()) {
            if (isset($request->candidate_id)) {
                $candidateId = $request->candidate_id;
                $data = TrainingSchedule::select('id', 'candidate_id', DB::raw('DATE_FORMAT(date, "%Y-%m-%d %h:%i %p") AS date'), 'note', 'status', 'start_date', 'end_date')->where('candidate_id', $candidateId)->first();
                return response()->json($data);
            }
        }
        return response()->json(false);
    }

    public function trainingRunningSave(Request $request) {
        $request->validate([
            'candidate_id' => 'required',
            'in.*' => 'required',
            'out.*' => 'required',
        ],[
            'in.*' => 'The in field is required.',
            'out.*' => 'The out field is required.'
        ]);
        foreach ($request->day as $key =>  $val) {
            $getData = TrainingRunning::where('candidate_id', $request->candidate_id)->where('day', $val)->first();
            if ($getData) {
                TrainingRunning::where('candidate_id', $request->candidate_id)->where('day', $val)->update([
                    'time_in' => date('h:i', strtotime($request->in[$key])),
                    'time_out' => date('h:i', strtotime($request->out[$key])),
                    'date' => date('Y-m-d'),
                ]);
            } else {
                TrainingRunning::create([
                    'candidate_id' => $request->candidate_id,
                    'day' => $val,
                    'time_in' => date('h:i', strtotime($request->in[$key])),
                    'time_out' => date('h:i', strtotime($request->out[$key])),
                    'date' => date('Y-m-d'),
                ]);
            }
        }
        return redirect()->route('trainingRunning');
    }

    public function candidateTrainingComplete($id) {
        // $trainingRunCount = TrainingRunning::where('candidate_id', $id)->count();
        $candidate = Candidate::find($id);
        if ($candidate) {
            $candidate->is_complete = 'Yes';
            $candidate->update();
        }
        if ($candidate->branch_id == 3) {
            $body = "Your Training Complete";
            $this->sendMail($candidate->email, $candidate->first_name, 'Your Training Complete', $body, $candidate->id, $candidate->branch_id);
        } else {
            $body = "Your Training Complete";
            $this->sendMail($candidate->email, $candidate->first_name, 'Your Training Complete', $body, $candidate->id, $candidate->branch_id);
        }
        return redirect()->route('trainingRunning');
    }

    public function sendMail($toEmail, $toName, $subject, $body, $candidateId, $branch, $attachmentPaths = []) {
        $mail = new PHPMailer(true);
        try {
            // Email server settings
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';             //  smtp host
            $mail->SMTPAuth = true;
            $mail->SMTPDebug = 2;
            $mail->Username = 'jobs.ndhcareltd@gmail.com';   //  sender username
            $mail->Password = 'jiarlhwdfjssoeky';       // sender password
            $mail->SMTPSecure = 'ssl';                  // encryption - ssl/tls
            $mail->Port = 465;                          // port - 587/465

            $mail->setFrom('jobs.ndhcareltd@gmail.com', 'Job Portal');
            $mail->addAddress($toEmail, $toName);

            foreach ($attachmentPaths as $attachmentPath) {
                $mail->addAttachment($attachmentPath);
            }
            if ($branch == 3) {
                $mail->addReplyTo('jobs@ndhcare.co.uk', 'Job Portal');
            } else {
                $mail->addReplyTo('hr@ndhcare.co.uk', 'Job Portal');
            }
            $mail->isHTML(true);                // Set email content format to HTML

            $mail->Subject = $subject;
            $mail->Body = $body;

            // $mail->AltBody = plain text version of email body;
            if( !$mail->send() ) {
                NotificationLog::create([
                    "candidate_id" => $candidateId,
                    "subject" => $subject,
                    "request" => '',
                    "status" => 'No',
                    "response" => 'Failed'
                ]);
                return false;
            } else {
                NotificationLog::create([
                    "candidate_id" => $candidateId,
                    "subject" => $subject,
                    "request" => '',
                    "status" => 'Yes',
                    "response" => 'Success'
                ]);
                return true;
            }
        } catch (Exception $e) {
            NotificationLog::create([
                "candidate_id" => $candidateId,
                "subject" => $subject,
                "request" => '',
                "status" => 'No',
                "response" => $e
            ]);
            return false;
        }
    }

    public function completeReference() {
        return view('branch.branch-complete-reference-list');
    }

    public function getCompleteReference(Request $request)
    {
        if ($request->ajax()) {
            $characterReferences = CharacterReference::all();
            $professionalReferences = ProfessionalReference::all();
            $data = [];
            $autoIncrement = 1;
            foreach ($characterReferences as $value) {
                $referenceList = ReferenceList::where('candidate_id', $value->candidate_id)->first();
                $reference1Json = json_decode($referenceList->reference_1_json, true);
                if (is_array($reference1Json) && count($reference1Json) > 0) {
                    if (isset($reference1Json[$value->reference_number - 1])) {
                        $json = [
                            'DT_RowId' => $autoIncrement++,
                            'name' => $reference1Json[$value->reference_number - 1]['name_1'] ?? '-',
                            'email' => $reference1Json[$value->reference_number - 1]['email_1'] ?? '-',
                            'number' => $reference1Json[$value->reference_number - 1]['number_1'] ?? '-',
                            'type' => 'Character',
                            'created_at' => $value->created_at->format('d/m/Y H:i:s'),
                            'candidate_name' => ucfirst($referenceList->candidate->first_name) . ' ' . ucfirst($referenceList->candidate->last_name)
                        ];
                        $data[] = $json;
                    }
                }
            }
            foreach ($professionalReferences as $value) {
                $referenceList = ReferenceList::where('candidate_id', $value->candidate_id)->first();
                $reference2Json = json_decode($referenceList->reference_2_json, true);
                if (is_array($reference2Json) && count($reference2Json) > 0) {
                    if (isset($reference2Json[$value->reference_number - 1])) {
                        $json = [
                            'DT_RowId' => $autoIncrement++,
                            'name' => $reference2Json[$value->reference_number - 1]['name_2'] ?? '-',
                            'email' => $reference2Json[$value->reference_number - 1]['email_2'] ?? '-',
                            'number' => $reference2Json[$value->reference_number - 1]['number_2'] ?? '-',
                            'type' => 'Professional',
                            'created_at' => $value->created_at->format('d/m/Y H:i:s'),
                            'candidate_name' => ucfirst($referenceList->candidate->first_name) . ' ' . ucfirst($referenceList->candidate->last_name)
                        ];
                        $data[] = $json;
                    }
                }
            }
            usort($data, function($a, $b) {
                $dateA = DateTime::createFromFormat('d/m/Y H:i:s', $a['created_at']);
                $dateB = DateTime::createFromFormat('d/m/Y H:i:s', $b['created_at']);

                return $dateB <=> $dateA;
            });
            $autoIncrement = 1;
            $reassignedData = array_map(function ($item) use (&$autoIncrement) {
                $item['DT_RowId'] = $autoIncrement++;
                return $item;
            }, $data);
            return Datatables::of($reassignedData)
                ->addIndexColumn()
                ->make(true);
        }
    }
}
