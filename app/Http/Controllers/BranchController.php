<?php

namespace App\Http\Controllers;

use App\Models\ApplicantIdentityDetails;
use App\Models\AvailabilityForm;
use App\Models\BasicEnglishMathTest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Candidate;
use App\Models\CandidateEmailFile;
use App\Models\TelephonicInterview;
use App\Models\TrainingRunning;
use Yajra\DataTables\DataTables;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\CareStaffForm;
use App\Models\CharacterReference;
use App\Models\ConditionalOffer;
use App\Models\Country;
use App\Models\Covid19;
use App\Models\DBSCheck;
use App\Models\EmpContract;
use App\Models\GDPRAgreement;
use App\Models\ReferenceEmailLog;
use Illuminate\Support\Facades\DB;
use App\Models\LiveInterviewQuestion;
use App\Models\LiveInterviewSchedule;
use App\Models\NotificationLog;
use App\Models\OfferLetter;
use App\Models\ProfessionalReference;
use App\Models\ReferenceList;
use App\Models\RightToWork;
use App\Models\StaffRisk;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use PHPMailer\PHPMailer\PHPMailer;
use ZipArchive;

class BranchController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function branchCandidateList(Request $request) {
        if (Auth::user()->role == 'Branch') {
            return view('candidate.branch-candidate-list');
        }
        return redirect()->route('candidate.create');
    }

    public function getBranchCandidate(Request $request) {
        if ($request->ajax()) {
            $data = [];
            if (Auth::user()->role == 'Branch') {
                $data = Candidate::select('candidate.*', 'users.name as branch_name')
                    ->leftJoin('users', 'candidate.branch_id', '=', 'users.id')
                    ->where('candidate.branch_id', Auth::user()->id)->orderBy('candidate.created_at', 'desc')->get();
            }
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('profile', function($row){
                        $btn = '<a class="btn btn-primary" href="candidate/'. $row->id .'">View</a>';
                        return $btn;
                    })
                    ->addColumn('is_read', function($row){
                        if ($row->is_read == 'Yes') {
                            $btn = '<a class="btn btn-primary" href="#">Yes</a>';
                        } else {
                            $btn = '<a class="btn btn-danger" href="#">No</a>';
                        }
                        return $btn;
                    })
                    ->addColumn('history', function($row){
                        $btn = '<a class="btn btn-success" href="get-candidate-history/'. $row->id .'">History</a>';
                        return $btn;
                    })
                    ->rawColumns(['profile', 'history', 'is_read'])
                    ->make(true);
        }
    }

    public function telephonicList(Request $request) {
        if (Auth::user()->role == 'Admin') {
            return redirect()->route('dashboard');
        }
        if (Auth::user()->role == 'Branch') {
            return view('branch.branch-telephonic-list');
        }
        if (Auth::user()->role == 'Candidate') {
            return redirect()->route('candidate.create');
        }
    }

    public function getTelephonicList(Request $request) {
        if ($request->ajax()) {
            $data = [];
            if (Auth::user()->role == 'Branch') {
                $data = Candidate::select('candidate.*', 'users.name as branch_name')
                    ->withCount(['candidateTelephonic'])
                    ->leftJoin('users', 'candidate.branch_id', '=', 'users.id')
                    ->where('candidate.branch_id', Auth::user()->id)->get();
            }
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        if ($row->candidate_telephonic_count > 0) {
                            $btn = '<a class="btn btn-danger" href="interview-screening/'. $row->id .'" id="'. $row->id .'">Update</a>';
                        } else {
                            $btn = '<a class="btn btn-primary" href="interview-screening/'. $row->id .'" id="'. $row->id .'">View</a>';
                        }
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

    public function interviewScreening($id) {
        $candidate = Candidate::find($id);
        $telephonicData = TelephonicInterview::where('candidate_id',$id)->first();
        if (!$candidate) {
            return redirect()->route('telephonicList');
        }
        return view('branch.branch-interview-screening-form', compact('candidate', 'telephonicData'));
    }

    public function liveScheduleList(Request $request) {
        if (Auth::user()->role == 'Admin') {
            return redirect()->route('dashboard');
        }
        if (Auth::user()->role == 'Branch') {
            return view('branch.branch-live-interview-schedule-list');
        }
        if (Auth::user()->role == 'Candidate') {
            return redirect()->route('candidate.create');
        }
    }

    public function getLiveScheduleList(Request $request) {
        if ($request->ajax()) {
            $data = [];
            if (Auth::user()->role == 'Branch') {
                $data = Candidate::select('candidate.*', 'users.name as branch_name')
                    ->withCount(['candidateLiveSchedule', 'candidateBasicTest'])
                    ->leftJoin('users', 'candidate.branch_id', '=', 'users.id')
                    ->has('candidateTelephonic','>', 0)
                    ->where('candidate.branch_id', Auth::user()->id)->get();
            }
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row) {
                        if ($row->candidate_live_schedule_count > 0) {
                            $btn = '<a class="btn btn-danger candidateLiveInterview" id="'. $row->id .'">Update</a>';
                        } else {
                            $btn = '<a class="btn btn-primary candidateLiveInterview" id="'. $row->id .'">View</a>';
                        }
                        return $btn;
                    })
                    ->addColumn('profile', function($row){
                        $btn = '<a class="btn btn-primary" href="candidate/'. $row->id .'">View</a>';
                        return $btn;
                    })
                    ->addColumn('test_access', function($row){
                        if ($row->is_basic_test == 0) {
                            $btn = '<button class="btn btn-danger" onclick="testAccess('.$row->id.', \'1\')">No</button>';
                        } else {
                            $btn = '<button class="btn btn-success" onclick="testAccess('.$row->id.', \'0\')">Yes</button>';
                            if ($row->candidate_basic_test_count > 0) {
                                $btn = '<button class="btn btn-success" onclick="testAccess('.$row->id.', \'2\')">Give Access Again</button>';
                            }
                        }
                        return $btn;
                    })
                    ->addColumn('show_candidate_test', function($row){
                        if ($row->is_basic_submit == 1) {
                            $btn = '<a class="btn btn-secondary" href="basic-english-test/'. $row->id .'">Show</a>';
                        } else {
                            $btn = '';
                        }
                        return $btn;
                    })
                    ->rawColumns(['action', 'profile', 'test_access', 'show_candidate_test'])
                    ->make(true);
        }
    }

    public function liveScheduleNote(Request $request) {
        if (Auth::user()->role == 'Admin') {
            return redirect()->route('dashboard');
        }
        if (Auth::user()->role == 'Branch') {
            return view('branch.branch-live-interview-note-list');
        }
        if (Auth::user()->role == 'Candidate') {
            return redirect()->route('candidate.create');
        }
    }

    public function getLiveScheduleNote(Request $request) {
        if ($request->ajax()) {
            $data = [];
            if (Auth::user()->role == 'Branch') {
                $data = Candidate::select('candidate.*', 'users.name as branch_name')
                    ->withCount(['candidateLiveSchedule'])
                    ->withCount(['candidateLiveInterviewQuestion'])
                    ->leftJoin('users', 'candidate.branch_id', '=', 'users.id')
                    ->has('candidateLiveSchedule','>', 0)
                    ->where('candidate.branch_id', Auth::user()->id)->get();
            }
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row) {
                        if ($row->candidate_live_interview_question_count > 0) {
                            $btn = '<a class="btn btn-danger" href="live-interview-question/'. $row->id .'" id="'. $row->id .'">Update</a>';
                        } else {
                            $btn = '<a class="btn btn-primary" href="live-interview-question/'. $row->id .'" id="'. $row->id .'">View</a>';
                        }
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

    public function getCandidateHistory($id) {
        if (Auth::user()->role == 'Admin') {
            return redirect()->route('dashboard');
        }
        if (Auth::user()->role == 'Candidate') {
            return redirect()->route('candidate.create');
        }
        $candidate = Candidate::where('id', $id)
                ->withCount(['candidateTelephonic', 'candidateLiveSchedule'])
                ->first();
        if (!$candidate) {
            return redirect()->route('branchCandidateList');
        }
        return view('branch.history', compact('candidate'));
    }

    public function referenceList(Request $request) {
        if (Auth::user()->role == 'Admin') {
            return redirect()->route('dashboard');
        }
        if (Auth::user()->role == 'Branch') {
            return view('branch.branch-reference-list');
        }
        if (Auth::user()->role == 'Candidate') {
            return redirect()->route('candidate.create');
        }
    }

    public function getReferenceList(Request $request) {
        if ($request->ajax()) {
            $data = [];
            if (Auth::user()->role == 'Branch') {
                $data = Candidate::select('candidate.*', 'users.name as branch_name')
                    ->withCount(['candidateReference'])
                    ->leftJoin('users', 'candidate.branch_id', '=', 'users.id')
                    ->leftJoin('live_interview_schedule', 'candidate.id', '=', 'live_interview_schedule.candidate_id')
                    ->has('candidateReference','>', 0)
                    ->where('candidate.branch_id', Auth::user()->id)
                    ->whereNotNull('live_interview_schedule.status')->get();
            }
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row) {
                        $btn = '<a class="btn btn-danger referencevarification" id="'. $row->id .'">Update</a>';
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

    public function trainingScheduleList(Request $request) {
        if (Auth::user()->role == 'Admin') {
            return redirect()->route('dashboard');
        }
        if (Auth::user()->role == 'Branch') {
            return view('branch.branch-training-schedule-list');
        }
        if (Auth::user()->role == 'Candidate') {
            return redirect()->route('candidate.create');
        }
    }

    public function getTrainingScheduleList(Request $request) {
        if ($request->ajax()) {
            $data = [];
            if (Auth::user()->role == 'Branch') {
                $data = Candidate::select('candidate.*', 'users.name as branch_name')
                    ->withCount(['candidateTrainingSchedule'])
                    ->leftJoin('users', 'candidate.branch_id', '=', 'users.id')
                    ->leftJoin('reference_list', 'candidate.id', '=', 'reference_list.candidate_id')
                    // ->where('reference_list.status_1', 'Approved')
                    // ->where('reference_list.status_2', 'Approved')
                    ->where('candidate.branch_id', Auth::user()->id)->get();
            }
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row) {
                        if ($row->candidate_training_schedule_count != 0) {
                            $btn = '<a class="btn btn-danger trainingSchedule " id="'. $row->id .'">Update</a>';
                        } else {
                            $btn = '<a class="btn btn-primary trainingSchedule" id="'. $row->id .'">View</a>';
                        }
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

    public function trainingRunning(Request $request) {
        if (Auth::user()->role == 'Admin') {
            return redirect()->route('dashboard');
        }
        if (Auth::user()->role == 'Branch') {
            return view('branch.branch-training-running-list');
        }
        if (Auth::user()->role == 'Candidate') {
            return redirect()->route('candidate.create');
        }
    }

    public function getTrainingRunningList(Request $request) {
        if ($request->ajax()) {
            $data = [];
            if (Auth::user()->role == 'Branch') {
                $data = Candidate::select('candidate.*', 'users.name as branch_name')
                    ->withCount(['candidateTrainingSchedule'])
                    ->leftJoin('users', 'candidate.branch_id', '=', 'users.id')
                    ->has('candidateTrainingSchedule','>', 0)
                    ->where('candidate.branch_id', Auth::user()->id)->get();
            }
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row) {
                        $btn = '<a href="training-running/'.$row->id.'" class="btn btn-success" id="'. $row->id .'">View</a>';
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

    public function trainingPage($id) {
        if (Auth::user()->role == 'Admin') {
            return redirect()->route('dashboard');
        }
        if (Auth::user()->role == 'Branch') {
            $training = TrainingRunning::where('candidate_id', $id)->get();
            foreach ($training as $value) {
                $value->date = date('d-m-Y', strtotime($value->date));
                $value->time_in = date('h:i A', strtotime($value->time_in));
                $value->time_out = date('h:i A', strtotime($value->time_out));
            }
            return view('branch.branch-training-running-page', compact('training', 'id'));
        }
        if (Auth::user()->role == 'Candidate') {
            return redirect()->route('candidate.create');
        }
    }

    public function trainingComplete(Request $request) {
        if (Auth::user()->role == 'Admin') {
            return redirect()->route('dashboard');
        }
        if (Auth::user()->role == 'Branch') {
            return view('branch.branch-training-complete-list');
        }
        if (Auth::user()->role == 'Candidate') {
            return redirect()->route('candidate.create');
        }
    }

    public function getTrainingCompleteList(Request $request) {
        if ($request->ajax()) {
            $data = [];
            if (Auth::user()->role == 'Branch') {
                $data = Candidate::select('candidate.*', 'users.name as branch_name')
                    ->leftJoin('users', 'candidate.branch_id', '=', 'users.id')
                    ->where('is_complete', 'Yes')
                    ->where('candidate.branch_id', Auth::user()->id)->get();
            }
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('profile', function($row){
                        $btn = '<a class="btn btn-primary" href="candidate/'. $row->id .'">View</a>';
                        return $btn;
                    })
                    ->addColumn('interview_complete_access', function($row){
                        if ($row->is_training_complete == 0) {
                            $btn = '<button class="btn btn-danger" onclick="tainingCompleteAccess('.$row->id.', \'1\')">No</button>';
                        } else {
                            $btn = '<button class="btn btn-success" onclick="tainingCompleteAccess('.$row->id.', \'0\')">Yes</button>';
                        }
                        return $btn;
                    })
                    ->addColumn('how_many_form', function($row){
                        $value = isset($row->how_many_form) ? $row->how_many_form : '';
                        $btn = '<input type="number" min="0" data-id='. $row->id .' id="how_many_form" name="how_many_form" class="form-control" value="' . $value . '">';
                        return $btn;
                    })
                    ->addColumn('show_candidate_form', function($row){
                        $btn = '<a class="btn btn-secondary" href="care-staff/1/'. $row->id .'">Show</a>';
                        return $btn;
                    })
                    ->rawColumns(['profile', 'interview_complete_access', 'show_candidate_form', 'how_many_form'])
                    ->make(true);
        }
    }

    public function guestUser() {
        if (Auth::user()->role == 'Admin') {
            return redirect()->route('dashboard');
        }
        if (Auth::user()->role == 'Branch') {
            return view('branch.branch-user-list');
        }
        if (Auth::user()->role == 'Candidate') {
            return redirect()->route('candidate.create');
        }
    }

    public function getGuestUser(Request $request) {
        if ($request->ajax()) {
            $data = [];
            if (Auth::user()->role == 'Branch') {
                $data = User::where('role', 'Guest')->get();
            }
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row) {
                        $btn = '<ul class="list-unstyled hstack gap-1 mb-0"><li data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><a href="edit-user/'.$row->id.'" class="btn btn-sm btn-soft-info"><i class="mdi mdi-pencil-outline"></i></a></li><li data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Delete" onclick="setDelete('.$row->id.')"><a href="#jobDelete" data-bs-toggle="modal" class="btn btn-sm btn-soft-danger"><i class="mdi mdi-delete-outline"></i></a></li></ul>';
                        return $btn;
                    })
                    ->make(true);
        }
    }

    public function createGuestUser() {
        if (Auth::user()->role == 'Admin') {
            return redirect()->route('dashboard');
        }
        if (Auth::user()->role == 'Branch') {
            return view('branch.branch-user-create');
        }
        if (Auth::user()->role == 'Candidate') {
            return redirect()->route('candidate.create');
        }
    }

    public function storeGuestUser(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'mobile_number' => 'required',
            'password' => 'required|confirmed|min:6'
        ]);

        $data = $request->all();
        $data['role'] = "Guest";
        $data['branch_id'] = Auth::user()->id;
        if (isset($data['password']) && !empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        User::create($data);
        return redirect()->route('guestUser');
    }

    public function editGuestUser(Request $request, $id) {
        if (Auth::user()->role == 'Admin') {
            return redirect()->route('dashboard');
        }
        if (Auth::user()->role == 'Branch') {
            $userData = User::where('id', $id)->where('role', "Guest")->first();
            return view('branch.branch-user-edit', compact('userData'));
        }
        if (Auth::user()->role == 'Candidate') {
            return redirect()->route('candidate.create');
        }
    }

    public function updateGuestUser(Request $request, $id) {
        $request->validate([
            'name' => 'required',
            'mobile_number' => 'required',
            'email' => 'required|email|unique:users,email,'. $id,
        ]);

        $data = $request->all();
        $data['role'] = "Guest";
        $data['branch_id'] = Auth::user()->id;
        if (isset($data['password']) && !empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }
        User::find($id)->update($data);
        return redirect()->route('guestUser');
    }

    public function deleteGuestUser($id) {
        $getUser = User::find($id);
        if ($getUser) {
            User::where('id', $id)->delete();
        }
        return redirect()->route('guestUser');
    }

    public function basicEnglishTest($id) {
        $candidate = Candidate::where('id', $id)->first();
        if (Auth::user()->role == 'Candidate' && $candidate->is_basic_submit == 1) {
            return redirect()->route('candidate.edit', $candidate->id);
        }
        return view('branch.basic_english_test', compact('candidate'));
    }

    public function storeBasicEnglishTest(Request $request) {
        $requestData = $request->all();
        $requestData['third_answer'] = json_encode($request->third_answer);
        $requestData['sixth_answer'] = json_encode($request->sixth_answer);
        $requestData['ten_answer'] = json_encode($request->ten_answer);
        $requestData['fifth_maths_answer'] = json_encode($request->fifth_maths_answer);
        $score = 0;
        if (strtolower($request->first_answer) == '5') {
            $score = $score + 1;
        }
        if (strtolower($request->second_answer) == 'help desk') {
            $score = $score + 1;
        }
        if (strtolower($request->third_answer[0]) == 'f' && strtolower($request->third_answer[1]) == 'g' && strtolower($request->third_answer[2]) == 'h' && strtolower($request->third_answer[3]) == 'i' && strtolower($request->third_answer[4]) == 'k' && strtolower($request->third_answer[5]) == 'm' && strtolower($request->third_answer[6]) == 'n' && strtolower($request->third_answer[7]) == 'o') {
            $score = $score + 2;
        }
        if (strtolower($request->fourth_answer) == 'saturday') {
            $score = $score + 1;
        }
        if (strtolower($request->fifth_answer) == 'medicine or tablets' || strtolower($request->fifth_answer) == 'medicine' || strtolower($request->fifth_answer) == 'tablets') {
            $score = $score + 2;
        }
        if (strtolower($request->sixth_answer[0]) == 'bare' && strtolower($request->sixth_answer[1]) == 'bear' && strtolower($request->sixth_answer[2]) == 'blue' && strtolower($request->sixth_answer[3]) == 'break' && strtolower($request->sixth_answer[4]) == 'build') {
            $score = $score + 2;
        }
        if (strtolower($request->seven_a_answer) == 'but' && strtolower($request->seven_b_answer) == 'also') {
            $score = $score + 2;
        }
        if (strtolower($request->eight_answer) == "communicate") {
            $score = $score + 1;
        }
        if (strtolower($request->nine_answer) == "admissions ward") {
            $score = $score + 1;
        }
        if (strtolower($request->ten_answer[0]) == 'a significant decrease' && strtolower($request->ten_answer[1]) == 'a marked increase' && strtolower($request->ten_answer[2]) == 'reached a peak' && strtolower($request->ten_answer[3]) == 'a significant rise' && strtolower($request->ten_answer[4]) == 'more popular') {
            $score = $score + 2;
        }
        $mathsScore = 0;
        if (strtolower($request->first_maths_answer) == '22nd july' || strtolower($request->first_maths_answer) == 'a') {
            $mathsScore = $mathsScore + 1;
        }
        if (strtolower($request->second_maths_answer) == '30' || strtolower($request->second_maths_answer) == "a") {
            $mathsScore = $mathsScore + 1;
        }
        if (strtolower($request->third_maths_answer) == "10.40am" || strtolower($request->third_maths_answer) == "c") {
            $mathsScore = $mathsScore + 1;
        }
        if (strtolower($request->fourth_maths_answer) == "£9.50" || strtolower($request->fourth_maths_answer) == "b") {
            $mathsScore = $mathsScore + 1;
        }
        if (strtolower($request->fifth_maths_answer[0]) == 'blue' && strtolower($request->fifth_maths_answer[1]) == 'pink' && strtolower($request->fifth_maths_answer[2]) == 'yellow') {
            $mathsScore = $mathsScore + 1;
        }
        if (strtolower($request->sixth_maths_answer == "16:00")) {
            $mathsScore = $mathsScore + 1;
        }
        if (strtolower($request->seven_maths_answer) == "1st clock" || strtolower($request->seven_maths_answer) == "clock 1") {
            $mathsScore = $mathsScore + 1;
        }
        if ($request->eigth_maths_answer == "42" || strtolower($request->eigth_maths_answer) == "b") {
            $mathsScore = $mathsScore + 1;
        }
        if ($request->nine_maths_answer == "£16.80" || strtolower($request->nine_maths_answer) == "c") {
            $mathsScore = $mathsScore + 1;
        }
        if ($request->ten_maths_answer == '27' || strtolower($request->ten_maths_answer) == 'a') {
            $mathsScore = $mathsScore + 1;
        }
        $requestData['learner_total_score'] = $score;
        $requestData['learner_total_score_maths'] = $mathsScore;
        $requestData['english_assessment_score'] = $score;
        $requestData['math_assessment_score'] = $mathsScore;
        $requestData['total_score'] = $score + $mathsScore;
        $requestData['date_assessment'] = date('Y-m-d');
        $candidateTestData = BasicEnglishMathTest::where('candidate_id', $request->candidate_id)->first();
        if ($candidateTestData) {
            unset($requestData['_token']);
            BasicEnglishMathTest::where('candidate_id', $request->candidate_id)->update($requestData);
        } else {
            BasicEnglishMathTest::create($requestData);
            Candidate::find($request->candidate_id)->update([
                'is_basic_submit' => "1"
            ]);
        }
        if (Auth::user()->role == 'Candidate') {
            return redirect()->route('candidate.edit', $request->candidate_id);
        } elseif (Auth::user()->role == 'Admin') {
            return redirect()->route('adminLiveScheduleList');
        } elseif (Auth::user()->role == 'Branch') {
            return redirect()->route('liveScheduleList');
        }
    }

    public function setBasicEnglishTestAccess(Request $request, $id) {
        $candidate = Candidate::find($id);
        if (!$candidate) {
            return response()->json(["status" => false], 404);
        }
        if ($request->access == 2) {
            $candidate->is_basic_test = '1';
            $candidate->is_basic_submit = '0';
            $candidate->save();
            BasicEnglishMathTest::where('candidate_id', $id)->delete();
        } else {
            $candidate = Candidate::find($id)->update([
                'is_basic_test' => $request->access
            ]);
        }
        if ($request->access) {
            if ($candidate->branch_id == 3) {
                $body = "Hi ".$candidate->first_name." <br><br>I hope this email finds you well. I wanted to inform you that a new task has been assigned to you. The details of the task are as follows: <br><br>Task Title: ENGLISH & MATHS BASIC SKILL ASSESSMENT <br><br>Please log in to your account using https://job.ndhcare.co.uk/login this link is where you can review the task details and let me know if you have any questions or need further clarification. Your prompt attention to this matter is appreciated.<br><br>Thank you,<br>Recruitment Team";
                $this->sendMail($candidate->email, $candidate->first_name, 'Your Basic English & Maths Assessment', $body, $candidate->id);
            } else {
                $body = "Hi ".$candidate->first_name." <br><br>I hope this email finds you well. I wanted to inform you that a new task has been assigned to you. The details of the task are as follows: <br><br>Task Title: ENGLISH & MATHS BASIC SKILL ASSESSMENT <br><br>Please log in to your account using https://job.ndhcare.co.uk/login this link is where you can review the task details and let me know if you have any questions or need further clarification. Your prompt attention to this matter is appreciated.<br><br>Thank you,<br>Recruitment Team";
                $this->sendMail($candidate->email, $candidate->first_name, 'Your Basic English & Maths Assessment', $body, $candidate->id);
            }
        }
        return response()->json(['status' => true]);
    }

    public function careStaffObservation($formNumber, $id) {
        $candidate = Candidate::where('id', $id)->first();
        $formData = CareStaffForm::where('candidate_id', $id)
            ->where('form_number', $formNumber)
            ->first();
        if (!empty($formData->data)) {
            $formDataArray = json_decode($formData->data, true);
        } else {
            $formDataArray = [];
        }
        return view('branch.care_staff_observation', compact('candidate', 'formNumber', 'formDataArray'));
    }

    public function storeCareStaff(Request $request)
    {
        $formNumber = $request->input('formNumber');
        $candidateId = $request->input('candidate_id');
        $existingForm = CareStaffForm::where('candidate_id', $candidateId)
            ->where('form_number', $formNumber)
            ->first();
        $carerNowSigned = $existingForm ? json_decode($existingForm->data)->carerNowSigned : null;
        $customerNowSigned = $existingForm ? json_decode($existingForm->data)->customerNowSigned : null;
        if (isset($request->carerNowSigned) && !empty($request->carerNowSigned)) {
            $image_parts = explode(";base64,", $request->carerNowSigned);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signFileName = time() . '_' . uniqid() . '.' . $image_type;
            $destinationPath = public_path('/user_document/carersigned');
            $file = $destinationPath . '/' . $signFileName;
            file_put_contents($file, $image_base64);
            $carerNowSigned = asset('user_document/carersigned/' . $signFileName);
        }
        if (isset($request->customerNowSigned) && !empty($request->customerNowSigned)) {
            $image_parts = explode(";base64,", $request->customerNowSigned);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signFileName = time() . '_' . uniqid() . '.' . $image_type;

            $destinationPath = public_path('/user_document/customerNowSigned');
            $file = $destinationPath . '/' . $signFileName;
            file_put_contents($file, $image_base64);
            $customerNowSigned = asset('user_document/customerNowSigned/' . $signFileName);
        }
        $formData = [
            'form_date' => $request->input('form_date'),
            'citizen_name' => $request->input('citizen_name'),
            'post_code' => $request->input('post_code'),
            '0_checkbox' => $request->input('0_checkbox'),
            '1_checkbox' => $request->input('1_checkbox'),
            '2_checkbox' => $request->input('2_checkbox'),
            '3_checkbox' => $request->input('3_checkbox'),
            '4_checkbox' => $request->input('4_checkbox'),
            '5_checkbox' => $request->input('5_checkbox'),
            '6_checkbox' => $request->input('6_checkbox'),
            'carerNowSigned' => $carerNowSigned,
            'name_of_shadower' => $request->input('name_of_shadower'),
            'job_title' => $request->input('job_title'),
            'uderstand_care' => $request->input('uderstand_care'),
            'read_risk' => $request->input('read_risk'),
            'effective_communication' => $request->input('effective_communication'),
            'aware_about_citizen' => $request->input('aware_about_citizen'),
            'staff_confidence' => $request->input('staff_confidence'),
            'communication_note' => $request->input('communication_note'),
            'aware_about_reporting' => $request->input('aware_about_reporting'),
            'citizen_review' => $request->input('citizen_review'),
            'citizen_review' => $request->input('citizen_review'),
            'staff_name' => $request->input('staff_name'),
            'need_more_shadow_call' => $request->input('need_more_shadow_call'),
            'customerNowSigned' => $customerNowSigned,
            'shadower_comments' => $request->input('shadower_comments'),
        ];

        $jsonData = json_encode($formData);
        if ($existingForm) {
            $existingForm->update([
                'data' => $jsonData,
            ]);
        } else {
            CareStaffForm::create([
                'candidate_id' => $candidateId,
                'form_number' => $formNumber,
                'data' => $jsonData,
            ]);
        }
        return redirect()->route('careStaffObservation', ['formNumber' => $request->input('formNumber'), 'id' => $request->input('candidate_id')]);
    }

    public function setCareStaffObservation(Request $request, $id) {
        $candidate = Candidate::find($id);
        if (!$candidate) {
            return response()->json(["status" => false], 404);
        }
        Candidate::find($id)->update([
            'is_training_complete' => $request->access
        ]);
        return response()->json(['status' => true]);
    }

    public function storeHowManyForm(Request $request) {
        $candidate = Candidate::find($request->candidateId);
        if (!$candidate) {
            return response()->json(["status" => false], 404);
        }
        Candidate::find($request->candidateId)->update([
            'how_many_form' => $request->howManyFormValue
        ]);
        return response()->json(['status' => true]);
    }

    public function referenceLog() {
        return view('branch.email-reference-log');
    }

    public function referenceLogList() {
        $data = ReferenceEmailLog::select('reference_email_log.id', 'reference_email_log.reference_type', 'reference_email_log.reference_id', 'candidate.first_name as candidate_name', DB::raw('DATE_FORMAT(reference_email_log.created_at, "%Y-%m-%d %H:%i:%s") as formatted_created_at'))
            ->leftJoin('candidate', 'reference_email_log.candidate_id', '=', 'candidate.id')
            ->leftJoin('reference_list', 'candidate.id', '=', 'reference_list.candidate_id')
            ->orderBy('reference_email_log.created_at', 'desc')
            ->get();

        return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('request', function($row) {
                        $btn = '<a class="btn btn-primary logRequest" href="reference-log-view/'.$row->id.'">View</a>';
                        return $btn;
                    })
                    ->rawColumns(['request'])
                    ->make(true);
    }

    public function referenceLogView($id) {
        $log = ReferenceEmailLog::where('id', $id)->first();
        return view('branch.email-reference-log-view', compact('log'));
    }

    public function liveInterviewQuestion($id) {
        $candidate = Candidate::find($id);
        $liveInterviewData = LiveInterviewQuestion::where('candidate_id',$id)->first();
        return view('branch.live-interview-schedule', compact('candidate', 'liveInterviewData'));
    }

    public function storeLiveInterviewQuestion(Request $request, $id) {
        $requestData = $request->all();
        $liveInterviewData = LiveInterviewQuestion::where('candidate_id',$id)->first();
        $requestData['signature'] = $liveInterviewData ? $liveInterviewData->signature : null;
        if (isset($request->signature) && !empty($request->signature)) {
            $image_parts = explode(";base64,", $request->signature);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signFileName = time() . '_' . uniqid() . '.' . $image_type;
            $destinationPath = public_path('/user_document/document_path');
            $file = $destinationPath . '/' . $signFileName;
            file_put_contents($file, $image_base64);
            $requestData['signature'] = asset('user_document/document_path/' . $signFileName);
        }
        $requestData['health_sector_radio'] = $request->has('health_sector_radio') ? $request->health_sector_radio : null;
        $requestData['decision_radio'] = $request->has('decision_radio') ? $request->decision_radio : null;
        LiveInterviewQuestion::updateOrCreate(['candidate_id' => $id], $requestData);

        $liveInterview = LiveInterviewSchedule::where('candidate_id',$id)->first();
        if ($liveInterview) {
            $liveInterview->candidate_id = $id;
            if ($request->decision_radio == 'accepted') {
                $status = 'Selected';
            }
            if ($request->decision_radio == 'rejected') {
                $status = 'Rejected';
            }
            $liveInterview->status = $status ?? null;
            $liveInterview->status_date = $request->person_date ? Carbon::parse($request->person_date)->format('Y-m-d H:i') : null;
            $liveInterview->status_note = $request->reason;
            $liveInterview->note = $request->additional_comment;
            $liveInterview->save();
        } else {
            if ($request->decision_radio == 'accepted') {
                $status = 'Selected';
            }
            if ($request->decision_radio == 'rejected') {
                $status = 'Rejected';
            }
            LiveInterviewSchedule::create([
                'status' => $status ?? null,
                'candidate_id' => $id,
                'status_date' => $request->person_date ? Carbon::parse($request->person_date)->format('Y-m-d H:i') : null,
                'status_note' => $request->reason,
                'date' => Carbon::now(),
                'note' => $request->additional_comment
            ]);
        }
        if ($request->decision_radio == 'accepted') {
            Candidate::find($id)->update(['status' => 'Selected Interview']);
        } else {
            Candidate::find($id)->update(['status' => 'Rejected Interview']);
        }
        return redirect()->route('liveScheduleNote');
    }

    public function sendMail($toEmail, $toName, $subject, $body, $candidateId, $attachmentPaths = []) {
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

            $mail->addReplyTo('job@ndhcare.co.uk', 'Job Portal');
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

    public function applicantIdentity(Request $request) {
        return view('branch.branch-applicant-identity-list');
    }

    public function getApplicantIdentityList() {
        $data = Candidate::select('candidate.*', 'users.name as branch_name')
                    ->withCount(['candidateLiveInterviewQuestion'])
                    ->withCount(['candidateApplicantDetails'])
                    ->leftJoin('users', 'candidate.branch_id', '=', 'users.id')
                    ->has('candidateLiveInterviewQuestion','>', 0)
                    ->where('candidate.branch_id', Auth::user()->id)
                    ->get();
        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row) {
                    if ($row->candidate_applicant_details_count > 0) {
                        $btn = '<a class="btn btn-danger" href="application-identity/'. $row->id .'" id="'. $row->id .'">Update</a>';
                    } else {
                        $btn = '<a class="btn btn-primary" href="application-identity/'. $row->id .'" id="'. $row->id .'">View</a>';
                    }
                    return $btn;
                })
                ->addColumn('profile', function($row){
                    $btn = '<a class="btn btn-primary" href="candidate/'. $row->id .'">View</a>';
                    return $btn;
                })
                ->rawColumns(['action', 'profile'])
                ->make(true);
    }

    public function aplicationIdentity($id) {
        $candidateData = Candidate::find($id);
        $applicantDetails = ApplicantIdentityDetails::where('candidate_id',$id)->first();
        return view('branch.application-identity-check-list', compact('candidateData', 'applicantDetails'));
    }

    public function storeApplicationIdentity(Request $request, $id) {
        $requestData = $request->all();
        $applicantDetails = ApplicantIdentityDetails::where('candidate_id',$id)->first();
        $requestData['passport_file'] = $applicantDetails ? $applicantDetails->passport_file : null;
        if ($request->hasFile('passport_file')) {
            $image = $request->file('passport_file');
            $name = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/user_document/applicant_details');
            $image->move($destinationPath, $name);
            $requestData['passport_file'] = asset('user_document/applicant_details/' . $name);
        }
        $requestData['birth_certificate_file'] = $applicantDetails ? $applicantDetails->birth_certificate_file : null;
        if ($request->hasFile('birth_certificate_file')) {
            $image = $request->file('birth_certificate_file');
            $name = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/user_document/applicant_details');
            $image->move($destinationPath, $name);
            $requestData['birth_certificate_file'] = asset('user_document/applicant_details/' . $name);
        }
        $requestData['swiss_passport_file'] = $applicantDetails ? $applicantDetails->swiss_passport_file : null;
        if ($request->hasFile('swiss_passport_file')) {
            $image = $request->file('swiss_passport_file');
            $name = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/user_document/applicant_details');
            $image->move($destinationPath, $name);
            $requestData['swiss_passport_file'] = asset('user_document/applicant_details/' . $name);
        }
        $requestData['identity_card_file'] = $applicantDetails ? $applicantDetails->identity_card_file : null;
        if ($request->hasFile('identity_card_file')) {
            $image = $request->file('identity_card_file');
            $name = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/user_document/applicant_details');
            $image->move($destinationPath, $name);
            $requestData['identity_card_file'] = asset('user_document/applicant_details/' . $name);
        }
        $requestData['other_passport_file'] = $applicantDetails ? $applicantDetails->other_passport_file : null;
        if ($request->hasFile('other_passport_file')) {
            $image = $request->file('other_passport_file');
            $name = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/user_document/applicant_details');
            $image->move($destinationPath, $name);
            $requestData['other_passport_file'] = asset('user_document/applicant_details/' . $name);
        }
        $requestData['visa_card_file'] = $applicantDetails ? $applicantDetails->visa_card_file : null;
        if ($request->hasFile('visa_card_file')) {
            $image = $request->file('visa_card_file');
            $name = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/user_document/applicant_details');
            $image->move($destinationPath, $name);
            $requestData['visa_card_file'] = asset('user_document/applicant_details/' . $name);
        }
        $requestData['right_to_work_file'] = $applicantDetails ? $applicantDetails->right_to_work_file : null;
        if ($request->hasFile('right_to_work_file')) {
            $image = $request->file('right_to_work_file');
            $name = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/user_document/applicant_details');
            $image->move($destinationPath, $name);
            $requestData['right_to_work_file'] = asset('user_document/applicant_details/' . $name);
        }
        $requestData['driving_license_file'] = $applicantDetails ? $applicantDetails->driving_license_file : null;
        if ($request->hasFile('driving_license_file')) {
            $image = $request->file('driving_license_file');
            $name = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/user_document/applicant_details');
            $image->move($destinationPath, $name);
            $requestData['driving_license_file'] = asset('user_document/applicant_details/' . $name);
        }
        $requestData['passport_photo_file'] = $applicantDetails ? $applicantDetails->passport_photo_file : null;
        if ($request->hasFile('passport_photo_file')) {
            $image = $request->file('passport_photo_file');
            $name = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/user_document/applicant_details');
            $image->move($destinationPath, $name);
            $requestData['passport_photo_file'] = asset('user_document/applicant_details/' . $name);
        }
        $requestData['college_id_file'] = $applicantDetails ? $applicantDetails->college_id_file : null;
        if ($request->hasFile('college_id_file')) {
            $image = $request->file('college_id_file');
            $name = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/user_document/applicant_details');
            $image->move($destinationPath, $name);
            $requestData['college_id_file'] = asset('user_document/applicant_details/' . $name);
        }
        $requestData['office_uk_id_file'] = $applicantDetails ? $applicantDetails->office_uk_id_file : null;
        if ($request->hasFile('office_uk_id_file')) {
            $image = $request->file('office_uk_id_file');
            $name = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/user_document/applicant_details');
            $image->move($destinationPath, $name);
            $requestData['office_uk_id_file'] = asset('user_document/applicant_details/' . $name);
        }
        $requestData['other_id_file'] = $applicantDetails ? $applicantDetails->other_id_file : null;
        if ($request->hasFile('other_id_file')) {
            $image = $request->file('other_id_file');
            $name = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/user_document/applicant_details');
            $image->move($destinationPath, $name);
            $requestData['other_id_file'] = asset('user_document/applicant_details/' . $name);
        }
        $requestData['utility_bill_file'] = $applicantDetails ? $applicantDetails->utility_bill_file : null;
        if ($request->hasFile('utility_bill_file')) {
            $image = $request->file('utility_bill_file');
            $name = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/user_document/applicant_details');
            $image->move($destinationPath, $name);
            $requestData['utility_bill_file'] = asset('user_document/applicant_details/' . $name);
        }
        $requestData['proof_driving_file'] = $applicantDetails ? $applicantDetails->proof_driving_file : null;
        if ($request->hasFile('proof_driving_file')) {
            $image = $request->file('proof_driving_file');
            $name = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/user_document/applicant_details');
            $image->move($destinationPath, $name);
            $requestData['proof_driving_file'] = asset('user_document/applicant_details/' . $name);
        }
        $requestData['bank_statement_file'] = $applicantDetails ? $applicantDetails->bank_statement_file : null;
        if ($request->hasFile('bank_statement_file')) {
            $image = $request->file('bank_statement_file');
            $name = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/user_document/applicant_details');
            $image->move($destinationPath, $name);
            $requestData['bank_statement_file'] = asset('user_document/applicant_details/' . $name);
        }
        $requestData['council_tax_file'] = $applicantDetails ? $applicantDetails->council_tax_file : null;
        if ($request->hasFile('council_tax_file')) {
            $image = $request->file('council_tax_file');
            $name = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/user_document/applicant_details');
            $image->move($destinationPath, $name);
            $requestData['council_tax_file'] = asset('user_document/applicant_details/' . $name);
        }
        $requestData['govt_file'] = $applicantDetails ? $applicantDetails->govt_file : null;
        if ($request->hasFile('govt_file')) {
            $image = $request->file('govt_file');
            $name = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/user_document/applicant_details');
            $image->move($destinationPath, $name);
            $requestData['govt_file'] = asset('user_document/applicant_details/' . $name);
        }
        $requestData['other_photo_id_file'] = $applicantDetails ? $applicantDetails->other_photo_id_file : null;
        if ($request->hasFile('other_photo_id_file')) {
            $image = $request->file('other_photo_id_file');
            $name = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/user_document/applicant_details');
            $image->move($destinationPath, $name);
            $requestData['other_photo_id_file'] = asset('user_document/applicant_details/' . $name);
        }

        $requestData['signature'] = $applicantDetails ? $applicantDetails->signature : null;
        if (isset($request->signature) && !empty($request->signature)) {
            $image_parts = explode(";base64,", $request->signature);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signFileName = time() . '_' . uniqid() . '.' . $image_type;
            $destinationPath = public_path('/user_document/applicant_details');
            $file = $destinationPath . '/' . $signFileName;
            file_put_contents($file, $image_base64);
            $requestData['signature'] = asset('user_document/applicant_details/' . $signFileName);
        }
        ApplicantIdentityDetails::updateOrCreate(['candidate_id' => $id], $requestData);
        return redirect()->route('applicantIdentity');
    }

    public function rightToWork(Request $request) {
        return view('branch.branch-right-to-work-list');
    }

    public function getRightToWorkList() {
        $data = Candidate::select('candidate.*', 'users.name as branch_name')
                    ->withCount(['candidateApplicantDetails', 'candidateLiveInterviewQuestion'])
                    ->withCount(['rightToWorkData'])
                    ->leftJoin('users', 'candidate.branch_id', '=', 'users.id')
                    ->has('candidateLiveInterviewQuestion','>', 0)
                    ->where('candidate.branch_id', Auth::user()->id)
                    ->get();
        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row) {
                    if ($row->right_to_work_data_count > 0) {
                        $btn = '<a class="btn btn-success" target="_blank" href="'. $row->rightToWorkData->file_path .'">View File</a>
                            <form action="' . route('deleteFileForRightToWork', $row->rightToWorkData->id) . '" method="post">
                                ' . csrf_field() . '
                                ' . method_field('DELETE') . '
                                <button type="submit" class="btn btn-danger">Delete File</button>
                            </form>';
                    } else {
                        $btn = '<form action="' . route('uploadFileForRightToWork') . '" method="post" enctype="multipart/form-data" class="file-upload-form">
                            ' . csrf_field() . '
                            <input type="hidden" name="candidate_id" value="' . $row->id . '">
                            <input type="file" name="file_path">
                            <button type="submit" class="btn btn-success">Upload File</button>
                        </form>';
                    }
                    return $btn;
                })
                ->addColumn('profile', function($row){
                    $btn = '<a class="btn btn-primary" href="candidate/'. $row->id .'">View</a>';
                    return $btn;
                })
                ->rawColumns(['action', 'profile'])
                ->make(true);
    }

    public function uploadFileForRightToWork(Request $request)
    {
        $request->validate([
            'file_path' => 'required|max:2048',
            'candidate_id' => 'required|exists:candidate,id',
        ]);
        $requestData = $request->all();
        $rightToWorkData = RightToWork::where('candidate_id', $request->candidate_id)->first();
        $requestData['file_path'] = $rightToWorkData ? $rightToWorkData->file_path : null;
        if ($request->hasFile('file_path')) {
            $image = $request->file('file_path');
            $name = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/user_document/right_to_work');
            $image->move($destinationPath, $name);
            $requestData['file_path'] = asset('user_document/right_to_work/' . $name);
        }
        RightToWork::updateOrCreate(['candidate_id' => $request->candidate_id], $requestData);
        return redirect()->back()->with('success', 'File uploaded successfully.');
    }

    public function deleteFileForRightToWork($id)
    {
        $rightToWorkData = RightToWork::findOrFail($id);
        if (Storage::exists($rightToWorkData->file_path)) {
            Storage::delete($rightToWorkData->file_path);
        }
        $rightToWorkData->delete();
        return redirect()->back()->with('success', 'File deleted successfully.');
    }

    public function conditionalOffer(Request $request) {
        return view('branch.branch-conditional-offer-list');
    }

    public function getConditionalOfferList() {
        $data = Candidate::select('candidate.*', 'users.name as branch_name')
                    ->withCount(['rightToWorkData', 'candidateLiveInterviewQuestion'])
                    ->withCount(['conditionalOfferData'])
                    ->leftJoin('users', 'candidate.branch_id', '=', 'users.id')
                    ->has('candidateLiveInterviewQuestion','>', 0)
                    ->where('candidate.branch_id', Auth::user()->id)
                    ->get();
        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row) {
                    if ($row->conditional_offer_data_count > 0) {
                        $btn = '<a class="btn btn-success" target="_blank" href="'. $row->conditionalOfferData->file_path .'">View File</a>
                            <form action="' . route('deleteFileForConditionalOffer', $row->conditionalOfferData->id) . '" method="post">
                                ' . csrf_field() . '
                                ' . method_field('DELETE') . '
                                <button type="submit" class="btn btn-danger">Delete File</button>
                            </form>';
                    } else {
                        $btn = '<form action="' . route('uploadFileForConditionalOffer') . '" method="post" enctype="multipart/form-data" class="file-upload-form">
                            ' . csrf_field() . '
                            <input type="hidden" name="candidate_id" value="' . $row->id . '">
                            <input type="file" name="file_path">
                            <button type="submit" class="btn btn-success">Upload File</button>
                        </form>';
                    }
                    return $btn;
                })
                ->addColumn('profile', function($row){
                    $btn = '<a class="btn btn-primary" href="candidate/'. $row->id .'">View</a>';
                    return $btn;
                })
                ->rawColumns(['action', 'profile'])
                ->make(true);
    }

    public function uploadFileForConditionalOffer(Request $request)
    {
        $request->validate([
            'file_path' => 'required|max:2048',
            'candidate_id' => 'required|exists:candidate,id',
        ]);
        $requestData = $request->all();
        $rightToWorkData = ConditionalOffer::where('candidate_id', $request->candidate_id)->first();
        $requestData['file_path'] = $rightToWorkData ? $rightToWorkData->file_path : null;
        if ($request->hasFile('file_path')) {
            $image = $request->file('file_path');
            $name = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/user_document/conditional_offer');
            $image->move($destinationPath, $name);
            $requestData['file_path'] = asset('user_document/conditional_offer/' . $name);
        }
        ConditionalOffer::updateOrCreate(['candidate_id' => $request->candidate_id], $requestData);
        return redirect()->back()->with('success', 'File uploaded successfully.');
    }

    public function deleteFileForConditionalOffer($id)
    {
        $conditionalOffer = ConditionalOffer::findOrFail($id);
        if (Storage::exists($conditionalOffer->file_path)) {
            Storage::delete($conditionalOffer->file_path);
        }
        $conditionalOffer->delete();
        return redirect()->back()->with('success', 'File deleted successfully.');
    }

    public function dbsCheck(Request $request) {
        return view('branch.branch-dbs-check-list');
    }

    public function getDbsCheckList() {
        $data = Candidate::select('candidate.*', 'users.name as branch_name')
                    ->withCount(['candidateLiveInterviewQuestion'])
                    ->withCount(['dbsCheckData'])
                    ->leftJoin('users', 'candidate.branch_id', '=', 'users.id')
                    ->has('candidateLiveInterviewQuestion','>', 0)
                    ->where('candidate.branch_id', Auth::user()->id)
                    ->get();
        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row) {
                    if ($row->dbs_check_data_count > 0) {
                        $btn = '<a class="btn btn-danger" href="dbs-check/'. $row->id .'" id="'. $row->id .'">Update</a>';
                    } else {
                        $btn = '<a class="btn btn-primary" href="dbs-check/'. $row->id .'" id="'. $row->id .'">View</a>';
                    }
                    return $btn;
                })
                ->addColumn('profile', function($row){
                    $btn = '<a class="btn btn-primary" href="candidate/'. $row->id .'">View</a>';
                    return $btn;
                })
                ->rawColumns(['action', 'profile'])
                ->make(true);
    }

    public function dbsCheckForm($id) {
        $candidateData = Candidate::find($id);
        $dbsData = DBSCheck::where('candidate_id',$id)->first();
        return view('branch.dbs-check-form', compact('candidateData', 'dbsData'));
    }

    public function storeDbsCheckForm(Request $request, $id) {
        $requestData = $request->all();
        $dbsData = DBSCheck::where('candidate_id',$id)->first();
        $requestData['received_signature'] = $dbsData ? $dbsData->received_signature : null;
        if (isset($request->received_signature) && !empty($request->received_signature)) {
            $image_parts = explode(";base64,", $request->received_signature);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signFileName = time() . '_' . uniqid() . '.' . $image_type;
            $destinationPath = public_path('/user_document/dbs_check');
            $file = $destinationPath . '/' . $signFileName;
            file_put_contents($file, $image_base64);
            $requestData['received_signature'] = asset('user_document/dbs_check/' . $signFileName);
        }
        DBSCheck::updateOrCreate(['candidate_id' => $id], $requestData);
        return redirect()->route('dbsCheck');
    }


    public function allDocument(Request $request) {
        if (Auth::user()->role == 'Admin') {
            return redirect()->route('dashboard');
        }
        if (Auth::user()->role == 'Branch') {
            return view('branch.branch-wise-candidate-document');
        }
        if (Auth::user()->role == 'Candidate') {
            return redirect()->route('candidate.create');
        }
    }

    public function getAllDocument(Request $request) {
        if ($request->ajax()) {
            $data = [];
            if (Auth::user()->role == 'Branch') {
                $data = Candidate::select('candidate.*', 'users.name as branch_name')
                    ->leftJoin('users', 'candidate.branch_id', '=', 'users.id')
                    ->where('is_complete', 'Yes')
                    ->where('candidate.branch_id', Auth::user()->id)->get();
            }
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('profile', function($row){
                        $btn = '<a class="btn btn-primary" href="candidate/'. $row->id .'">View</a>';
                        return $btn;
                    })
                    ->addColumn('view_all_form', function($row){
                        $btn = '<a class="btn btn-primary" target="_blank" href="all-form-list/'. $row->id .'">View All Form</a>';
                        return $btn;
                    })
                    ->addColumn('view_all_document', function($row){
                        $btn = '<a class="btn btn-primary" target="_blank" href="candidate-document-list/'. $row->id .'">Document</a>';
                        return $btn;
                    })
                    ->rawColumns(['profile', 'view_all_document', 'view_all_form'])
                    ->make(true);
        }
    }

    public function candidateDocumentList($id) {
        if (!$id) {
            return redirect()->route('allDocument');
        }
        $candidateData = Candidate::find($id);
        if (!$candidateData) {
            return redirect()->route('allDocument');
        }

        $candidateId = $id;
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
        $data->reference_1_json = $referenceData;
        $data->reference_2_json = $referenceData1;
        return view('branch.branch-candidate-wise-document-list', compact('candidateData', 'id', 'data'));
    }

    public function download($id) {
        $applicantList = ApplicantIdentityDetails::where('candidate_id', $id)->first();
        $conditionalOfferData = ConditionalOffer::where('candidate_id', $id)->first();
        $rightToWorkData = RightToWork::where('candidate_id', $id)->first();
        $offerLetterData = OfferLetter::where('candidate_id', $id)->first();
        $gdprData = GDPRAgreement::where('candidate_id', $id)->first();
        $empContractData = EmpContract::where('candidate_id', $id)->first();
        $covid19 = Covid19::where('candidate_id', $id)->first();
        $availabilityForm = AvailabilityForm::where('candidate_id', $id)->first();
        $staffRisk = StaffRisk::where('candidate_id', $id)->first();
        $candidateData = Candidate::find($id);
        $userData = User::where('id', $candidateData->branch_id)->first();

        $zip = new ZipArchive;
        $zipFileName = 'all_document_' . $id . '.zip';
        $zipFilePath = public_path($zipFileName);
        if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
            if (!empty($userData->signature)) {
                $file_path = public_path("candidate/sign/" . basename($userData->signature));
                $file_extension = pathinfo($file_path, PATHINFO_EXTENSION);
                $zip->addFile($file_path, 'signature.' . $file_extension);
            }
            if (!empty($applicantList->signature)) {
                $file_path = public_path("user_document/applicant_details/" . basename($applicantList->signature));
                $file_extension = pathinfo($file_path, PATHINFO_EXTENSION);
                $zip->addFile($file_path, 'signature.' . $file_extension);
                // $zip->addFile(public_path("user_document/applicant_details/" . basename($applicantList->signature)), 'signature.png');
            }
            if (!empty($applicantList->passport_file)) {
                $file_path = public_path("user_document/applicant_details/" . basename($applicantList->passport_file));
                $file_extension = pathinfo($file_path, PATHINFO_EXTENSION);
                $zip->addFile($file_path, 'passport.' . $file_extension);
                // $zip->addFile(public_path("user_document/applicant_details/" . basename($applicantList->passport_file)), 'passport.pdf');
            }
            if (!empty($applicantList->birth_certificate_file)) {
                $file_path = public_path("user_document/applicant_details/" . basename($applicantList->birth_certificate_file));
                $file_extension = pathinfo($file_path, PATHINFO_EXTENSION);
                $zip->addFile($file_path, 'birth_certificate.' . $file_extension);
                // $zip->addFile(public_path("user_document/applicant_details/" . basename($applicantList->birth_certificate_file)), 'birth_certificate.pdf');
            }
            if (!empty($applicantList->swiss_passport_file)) {
                $file_path = public_path("user_document/applicant_details/" . basename($applicantList->swiss_passport_file));
                $file_extension = pathinfo($file_path, PATHINFO_EXTENSION);
                $zip->addFile($file_path, 'swiss_passport.' . $file_extension);
                // $zip->addFile(public_path("user_document/applicant_details/" . basename($applicantList->swiss_passport_file)), 'swiss_passport.pdf');
            }
            if (!empty($applicantList->identity_card_file)) {
                $file_path = public_path("user_document/applicant_details/" . basename($applicantList->identity_card_file));
                $file_extension = pathinfo($file_path, PATHINFO_EXTENSION);
                $zip->addFile($file_path, 'identity_card.' . $file_extension);
                // $zip->addFile(public_path("user_document/applicant_details/" . basename($applicantList->identity_card_file)), 'identity_card.pdf');
            }
            if (!empty($applicantList->other_passport_file)) {
                $file_path = public_path("user_document/applicant_details/" . basename($applicantList->other_passport_file));
                $file_extension = pathinfo($file_path, PATHINFO_EXTENSION);
                $zip->addFile($file_path, 'other_passport.' . $file_extension);
                // $zip->addFile(public_path("user_document/applicant_details/" . basename($applicantList->other_passport_file)), 'other_passport.pdf');
            }
            if (!empty($applicantList->visa_card_file)) {
                $file_path = public_path("user_document/applicant_details/" . basename($applicantList->visa_card_file));
                $file_extension = pathinfo($file_path, PATHINFO_EXTENSION);
                $zip->addFile($file_path, 'visa_card.' . $file_extension);
                // $zip->addFile(public_path("user_document/applicant_details/" . basename($applicantList->visa_card_file)), 'visa_card.pdf');
            }
            if (!empty($applicantList->right_to_work_file)) {
                $file_path = public_path("user_document/applicant_details/" . basename($applicantList->right_to_work_file));
                $file_extension = pathinfo($file_path, PATHINFO_EXTENSION);
                $zip->addFile($file_path, 'right_to_work.' . $file_extension);
                // $zip->addFile(public_path("user_document/applicant_details/" . basename($applicantList->right_to_work_file)), 'right_to_work.pdf');
            }
            if (!empty($applicantList->driving_license_file)) {
                $file_path = public_path("user_document/applicant_details/" . basename($applicantList->driving_license_file));
                $file_extension = pathinfo($file_path, PATHINFO_EXTENSION);
                $zip->addFile($file_path, 'driving_license.' . $file_extension);
                // $zip->addFile(public_path("user_document/applicant_details/" . basename($applicantList->driving_license_file)), 'driving_license.pdf');
            }
            if (!empty($applicantList->passport_photo_file)) {
                $file_path = public_path("user_document/applicant_details/" . basename($applicantList->passport_photo_file));
                $file_extension = pathinfo($file_path, PATHINFO_EXTENSION);
                $zip->addFile($file_path, 'passport_photo.' . $file_extension);
                // $zip->addFile(public_path("user_document/applicant_details/" . basename($applicantList->passport_photo_file)), 'passport_photo.pdf');
            }
            if (!empty($applicantList->college_id_file)) {
                $file_path = public_path("user_document/applicant_details/" . basename($applicantList->college_id_file));
                $file_extension = pathinfo($file_path, PATHINFO_EXTENSION);
                $zip->addFile($file_path, 'college_id.' . $file_extension);
                // $zip->addFile(public_path("user_document/applicant_details/" . basename($applicantList->college_id_file)), 'college_id.pdf');
            }
            if (!empty($applicantList->office_uk_id_file)) {
                $file_path = public_path("user_document/applicant_details/" . basename($applicantList->office_uk_id_file));
                $file_extension = pathinfo($file_path, PATHINFO_EXTENSION);
                $zip->addFile($file_path, 'office_uk_id.' . $file_extension);
                // $zip->addFile(public_path("user_document/applicant_details/" . basename($applicantList->office_uk_id_file)), 'office_uk_id.pdf');
            }
            if (!empty($applicantList->other_id_file)) {
                $file_path = public_path("user_document/applicant_details/" . basename($applicantList->other_id_file));
                $file_extension = pathinfo($file_path, PATHINFO_EXTENSION);
                $zip->addFile($file_path, 'other_id.' . $file_extension);
                // $zip->addFile(public_path("user_document/applicant_details/" . basename($applicantList->other_id_file)), 'other_id.pdf');
            }
            if (!empty($applicantList->utility_bill_file)) {
                $file_path = public_path("user_document/applicant_details/" . basename($applicantList->utility_bill_file));
                $file_extension = pathinfo($file_path, PATHINFO_EXTENSION);
                $zip->addFile($file_path, 'utility_bill.' . $file_extension);
                // $zip->addFile(public_path("user_document/applicant_details/" . basename($applicantList->utility_bill_file)), 'utility_bill.pdf');
            }
            if (!empty($applicantList->proof_driving_file)) {
                $file_path = public_path("user_document/applicant_details/" . basename($applicantList->proof_driving_file));
                $file_extension = pathinfo($file_path, PATHINFO_EXTENSION);
                $zip->addFile($file_path, 'proof_driving.' . $file_extension);
                // $zip->addFile(public_path("user_document/applicant_details/" . basename($applicantList->proof_driving_file)), 'proof_driving.pdf');
            }
            if (!empty($applicantList->bank_statement_file)) {
                $file_path = public_path("user_document/applicant_details/" . basename($applicantList->bank_statement_file));
                $file_extension = pathinfo($file_path, PATHINFO_EXTENSION);
                $zip->addFile($file_path, 'bank_statement.' . $file_extension);
                // $zip->addFile(public_path("user_document/applicant_details/" . basename($applicantList->bank_statement_file)), 'bank_statement.pdf');
            }
            if (!empty($applicantList->council_tax_file)) {
                $file_path = public_path("user_document/applicant_details/" . basename($applicantList->council_tax_file));
                $file_extension = pathinfo($file_path, PATHINFO_EXTENSION);
                $zip->addFile($file_path, 'council_tax.' . $file_extension);
                // $zip->addFile(public_path("user_document/applicant_details/" . basename($applicantList->council_tax_file)), 'council_tax.pdf');
            }
            if (!empty($applicantList->govt_file)) {
                $file_path = public_path("user_document/applicant_details/" . basename($applicantList->govt_file));
                $file_extension = pathinfo($file_path, PATHINFO_EXTENSION);
                $zip->addFile($file_path, 'govt.' . $file_extension);
                // $zip->addFile(public_path("user_document/applicant_details/" . basename($applicantList->govt_file)), 'govt.pdf');
            }
            if (!empty($applicantList->other_photo_id_file)) {
                $file_path = public_path("user_document/applicant_details/" . basename($applicantList->other_photo_id_file));
                $file_extension = pathinfo($file_path, PATHINFO_EXTENSION);
                $zip->addFile($file_path, 'other_photo_id.' . $file_extension);
                // $zip->addFile(public_path("user_document/applicant_details/" . basename($applicantList->other_photo_id_file)), 'other_photo_id.pdf');
            }
            if (!empty($conditionalOfferData->file_path)) {
                $file_path = public_path("user_document/conditional_offer/" . basename($conditionalOfferData->file_path));
                $file_extension = pathinfo($file_path, PATHINFO_EXTENSION);
                $zip->addFile($file_path, 'conditinal_offer.' . $file_extension);
                // $zip->addFile(public_path("user_document/conditional_offer/" . basename($conditionalOfferData->file_path)), 'conditinal_offer.pdf');
            }
            if (!empty($rightToWorkData->file_path)) {
                $file_path = public_path("user_document/right_to_work/" . basename($rightToWorkData->file_path));
                $file_extension = pathinfo($file_path, PATHINFO_EXTENSION);
                $zip->addFile($file_path, 'right_to_work.' . $file_extension);
                // $zip->addFile(public_path("user_document/right_to_work/" . basename($rightToWorkData->file_path)), 'right_to_work.pdf');
            }
            if (!empty($offerLetterData->file_path)) {
                $file_path = public_path("user_document/offer_letter/" . basename($offerLetterData->file_path));
                $file_extension = pathinfo($file_path, PATHINFO_EXTENSION);
                $zip->addFile($file_path, 'offer_letter.' . $file_extension);
                // $zip->addFile(public_path("user_document/offer_letter/" . basename($offerLetterData->file_path)), 'offer_letter.pdf');
            }
            if (!empty($gdprData->file_path)) {
                $file_path = public_path("user_document/gdpr_agreement/" . basename($gdprData->file_path));
                $file_extension = pathinfo($file_path, PATHINFO_EXTENSION);
                $zip->addFile($file_path, 'GDPR_agreement.' . $file_extension);
                // $zip->addFile(public_path("user_document/gdpr_agreement/" . basename($gdprData->file_path)), 'GDPR_agreement.pdf');
            }
            if (!empty($empContractData->file_path)) {
                $file_path = public_path("user_document/emp_contract/" . basename($empContractData->file_path));
                $file_extension = pathinfo($file_path, PATHINFO_EXTENSION);
                $zip->addFile($file_path, 'emp_contract.' . $file_extension);
                // $zip->addFile(public_path("user_document/emp_contract/" . basename($empContractData->file_path)), 'emp_contract.pdf');
            }
            if (!empty($covid19->file_path)) {
                $file_path = public_path("user_document/covid_19/" . basename($covid19->file_path));
                $file_extension = pathinfo($file_path, PATHINFO_EXTENSION);
                $zip->addFile($file_path, 'covid_19.' . $file_extension);
                // $zip->addFile(public_path("user_document/covid_19/" . basename($covid19->file_path)), 'covid_19.pdf');
            }
            if (!empty($availabilityForm->file_path)) {
                $file_path = public_path("user_document/availability_form/" . basename($availabilityForm->file_path));
                $file_extension = pathinfo($file_path, PATHINFO_EXTENSION);
                $zip->addFile($file_path, 'availability_form.' . $file_extension);
                // $zip->addFile(public_path("user_document/availability_form/" . basename($availabilityForm->file_path)), 'availability_form.pdf');
            }
            if (!empty($staffRisk->ra_form)) {
                $file_path = public_path("user_document/staff_risk/ra_from/" . basename($staffRisk->ra_form));
                $file_extension = pathinfo($file_path, PATHINFO_EXTENSION);
                $zip->addFile($file_path, 'ra_form.' . $file_extension);
                // $zip->addFile(public_path("user_document/staff_risk/ra_from/" . basename($staffRisk->ra_form)), 'ra_form.pdf');
            }
            if (!empty($staffRisk->bame_form)) {
                $file_path = public_path("user_document/staff_risk/bame_form/" . basename($staffRisk->bame_form));
                $file_extension = pathinfo($file_path, PATHINFO_EXTENSION);
                $zip->addFile($file_path, 'bame_form.' . $file_extension);
                // $zip->addFile(public_path("user_document/staff_risk/bame_form/" . basename($staffRisk->bame_form)), 'bame_form.pdf');
            }
            if (!empty($staffRisk->covid_vaccination)) {
                $file_path = public_path("user_document/staff_risk/covid_vaccination/" . basename($staffRisk->covid_vaccination));
                $file_extension = pathinfo($file_path, PATHINFO_EXTENSION);
                $zip->addFile($file_path, 'covid_vaccination.' . $file_extension);
                // $zip->addFile(public_path("user_document/staff_risk/covid_vaccination/" . basename($staffRisk->covid_vaccination)), 'covid_vaccination.pdf');
            }
            // if ($zip->numFiles === 0) {
            //     if (file_exists($zipFilePath)) {
            //         unlink($zipFilePath);
            //     }
            //     return redirect()->route('candidateDocumentList', ['id' => $id]);
            // }
        }
        $zip->close();
        return response()->download($zipFilePath)->deleteFileAfterSend();
    }

    public function offerLetter(Request $request) {
        return view('branch.branch-offer-letter-list');
    }

    public function getOfferLetterList() {
        $data = Candidate::select('candidate.*', 'users.name as branch_name')
                    ->withCount(['rightToWorkData', 'candidateLiveInterviewQuestion'])
                    ->withCount(['offerLetterData'])
                    ->leftJoin('users', 'candidate.branch_id', '=', 'users.id')
                    ->has('candidateLiveInterviewQuestion','>', 0)
                    ->where('candidate.branch_id', Auth::user()->id)
                    ->get();
        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row) {
                    if ($row->offer_letter_data_count > 0) {
                        $btn = '<a class="btn btn-success" target="_blank" href="'. $row->offerLetterData->file_path .'">View File</a>
                            <form action="' . route('deleteFileForOfferLetter', $row->offerLetterData->id) . '" method="post">
                                ' . csrf_field() . '
                                ' . method_field('DELETE') . '
                                <button type="submit" class="btn btn-danger">Delete File</button>
                            </form>';
                    } else {
                        $btn = '<form action="' . route('uploadFileForOfferLetter') . '" method="post" enctype="multipart/form-data" class="file-upload-form">
                            ' . csrf_field() . '
                            <input type="hidden" name="candidate_id" value="' . $row->id . '">
                            <input type="file" name="file_path">
                            <button type="submit" class="btn btn-success">Upload File</button>
                        </form>';
                    }
                    return $btn;
                })
                ->addColumn('profile', function($row){
                    $btn = '<a class="btn btn-primary" href="candidate/'. $row->id .'">View</a>';
                    return $btn;
                })
                ->rawColumns(['action', 'profile'])
                ->make(true);
    }

    public function uploadFileForOfferLetter(Request $request)
    {
        $request->validate([
            'file_path' => 'required|max:2048',
            'candidate_id' => 'required|exists:candidate,id',
        ]);
        $requestData = $request->all();
        $rightToWorkData = OfferLetter::where('candidate_id', $request->candidate_id)->first();
        $requestData['file_path'] = $rightToWorkData ? $rightToWorkData->file_path : null;
        if ($request->hasFile('file_path')) {
            $image = $request->file('file_path');
            $name = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/user_document/offer_letter');
            $image->move($destinationPath, $name);
            $requestData['file_path'] = asset('user_document/offer_letter/' . $name);
        }
        OfferLetter::updateOrCreate(['candidate_id' => $request->candidate_id], $requestData);
        return redirect()->back()->with('success', 'File uploaded successfully.');
    }

    public function deleteFileForOfferLetter($id)
    {
        $conditionalOffer = OfferLetter::findOrFail($id);
        if (Storage::exists($conditionalOffer->file_path)) {
            Storage::delete($conditionalOffer->file_path);
        }
        $conditionalOffer->delete();
        return redirect()->back()->with('success', 'File deleted successfully.');
    }

    public function gdprAgreement(Request $request) {
        return view('branch.branch-gdpr-agreement-list');
    }

    public function getGDPRAgreementList() {
        $data = Candidate::select('candidate.*', 'users.name as branch_name')
                    ->withCount(['gdprAgreementData'])
                    ->leftJoin('users', 'candidate.branch_id', '=', 'users.id')
                    ->has('candidateLiveInterviewQuestion','>', 0)
                    ->where('candidate.branch_id', Auth::user()->id)
                    ->get();
        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row) {
                    if ($row->gdpr_agreement_data_count > 0) {
                        $btn = '<a class="btn btn-success" target="_blank" href="'. $row->gdprAgreementData->file_path .'">View File</a>
                            <form action="' . route('deleteFileForGDPRAgreement', $row->gdprAgreementData->id) . '" method="post">
                                ' . csrf_field() . '
                                ' . method_field('DELETE') . '
                                <button type="submit" class="btn btn-danger">Delete File</button>
                            </form>';
                    } else {
                        $btn = '<form action="' . route('uploadFileForGDPRAgreement') . '" method="post" enctype="multipart/form-data" class="file-upload-form">
                            ' . csrf_field() . '
                            <input type="hidden" name="candidate_id" value="' . $row->id . '">
                            <input type="file" name="file_path">
                            <button type="submit" class="btn btn-success">Upload File</button>
                        </form>';
                    }
                    return $btn;
                })
                ->addColumn('profile', function($row){
                    $btn = '<a class="btn btn-primary" href="candidate/'. $row->id .'">View</a>';
                    return $btn;
                })
                ->rawColumns(['action', 'profile'])
                ->make(true);
    }

    public function uploadFileForGDPRAgreement(Request $request)
    {
        $request->validate([
            'file_path' => 'required|max:2048',
            'candidate_id' => 'required|exists:candidate,id',
        ]);
        $requestData = $request->all();
        $gdprAgreement = GDPRAgreement::where('candidate_id', $request->candidate_id)->first();
        $requestData['file_path'] = $gdprAgreement ? $gdprAgreement->file_path : null;
        if ($request->hasFile('file_path')) {
            $image = $request->file('file_path');
            $name = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/user_document/gdpr_agreement');
            $image->move($destinationPath, $name);
            $requestData['file_path'] = asset('user_document/gdpr_agreement/' . $name);
        }
        GDPRAgreement::updateOrCreate(['candidate_id' => $request->candidate_id], $requestData);
        return redirect()->back()->with('success', 'File uploaded successfully.');
    }

    public function deleteFileForGDPRAgreement($id)
    {
        $gdprAgreement = GDPRAgreement::findOrFail($id);
        if (Storage::exists($gdprAgreement->file_path)) {
            Storage::delete($gdprAgreement->file_path);
        }
        $gdprAgreement->delete();
        return redirect()->back()->with('success', 'File deleted successfully.');
    }

    public function empContract(Request $request) {
        return view('branch.branch-emp-contract-list');
    }

    public function getEmpContractList() {
        $data = Candidate::select('candidate.*', 'users.name as branch_name')
                    ->withCount(['empContractData'])
                    ->leftJoin('users', 'candidate.branch_id', '=', 'users.id')
                    ->has('candidateLiveInterviewQuestion','>', 0)
                    ->where('candidate.branch_id', Auth::user()->id)
                    ->get();
        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row) {
                    if ($row->emp_contract_data_count > 0) {
                        $btn = '<a class="btn btn-success" target="_blank" href="'. $row->empContractData->file_path .'">View File</a>
                            <form action="' . route('deleteFileForEmpContract', $row->empContractData->id) . '" method="post">
                                ' . csrf_field() . '
                                ' . method_field('DELETE') . '
                                <button type="submit" class="btn btn-danger">Delete File</button>
                            </form>';
                    } else {
                        $btn = '<form action="' . route('uploadFileForEmpContract') . '" method="post" enctype="multipart/form-data" class="file-upload-form">
                            ' . csrf_field() . '
                            <input type="hidden" name="candidate_id" value="' . $row->id . '">
                            <input type="file" name="file_path">
                            <button type="submit" class="btn btn-success">Upload File</button>
                        </form>';
                    }
                    return $btn;
                })
                ->addColumn('profile', function($row){
                    $btn = '<a class="btn btn-primary" href="candidate/'. $row->id .'">View</a>';
                    return $btn;
                })
                ->rawColumns(['action', 'profile'])
                ->make(true);
    }

    public function uploadFileForEmpContract(Request $request)
    {
        $request->validate([
            'file_path' => 'required|max:2048',
            'candidate_id' => 'required|exists:candidate,id',
        ]);
        $requestData = $request->all();
        $empContract = EmpContract::where('candidate_id', $request->candidate_id)->first();
        $requestData['file_path'] = $empContract ? $empContract->file_path : null;
        if ($request->hasFile('file_path')) {
            $image = $request->file('file_path');
            $name = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/user_document/emp_contract');
            $image->move($destinationPath, $name);
            $requestData['file_path'] = asset('user_document/emp_contract/' . $name);
        }
        EmpContract::updateOrCreate(['candidate_id' => $request->candidate_id], $requestData);
        return redirect()->back()->with('success', 'File uploaded successfully.');
    }

    public function deleteFileForEmpContract($id)
    {
        $empContract = EmpContract::findOrFail($id);
        if (Storage::exists($empContract->file_path)) {
            Storage::delete($empContract->file_path);
        }
        $empContract->delete();
        return redirect()->back()->with('success', 'File deleted successfully.');
    }

    public function covid19Statement(Request $request) {
        return view('branch.branch-covid-19-list');
    }

    public function getCovid19StatementList() {
        $data = Candidate::select('candidate.*', 'users.name as branch_name')
                    ->withCount(['covid19Data'])
                    ->leftJoin('users', 'candidate.branch_id', '=', 'users.id')
                    ->has('candidateLiveInterviewQuestion','>', 0)
                    ->where('candidate.branch_id', Auth::user()->id)
                    ->get();
        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row) {
                    if ($row->covid19_data_count > 0) {
                        $btn = '<a class="btn btn-success" target="_blank" href="'. $row->covid19Data->file_path .'">View File</a>
                            <form action="' . route('deleteFileForCovid19', $row->covid19Data->id) . '" method="post">
                                ' . csrf_field() . '
                                ' . method_field('DELETE') . '
                                <button type="submit" class="btn btn-danger">Delete File</button>
                            </form>';
                    } else {
                        $btn = '<form action="' . route('uploadFileForCovid19') . '" method="post" enctype="multipart/form-data" class="file-upload-form">
                            ' . csrf_field() . '
                            <input type="hidden" name="candidate_id" value="' . $row->id . '">
                            <input type="file" name="file_path">
                            <button type="submit" class="btn btn-success">Upload File</button>
                        </form>';
                    }
                    return $btn;
                })
                ->addColumn('profile', function($row){
                    $btn = '<a class="btn btn-primary" href="candidate/'. $row->id .'">View</a>';
                    return $btn;
                })
                ->rawColumns(['action', 'profile'])
                ->make(true);
    }

    public function uploadFileForCovid19(Request $request)
    {
        $request->validate([
            'file_path' => 'required|max:2048',
            'candidate_id' => 'required|exists:candidate,id',
        ]);
        $requestData = $request->all();
        $covid19 = Covid19::where('candidate_id', $request->candidate_id)->first();
        $requestData['file_path'] = $covid19 ? $covid19->file_path : null;
        if ($request->hasFile('file_path')) {
            $image = $request->file('file_path');
            $name = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/user_document/covid_19');
            $image->move($destinationPath, $name);
            $requestData['file_path'] = asset('user_document/covid_19/' . $name);
        }
        Covid19::updateOrCreate(['candidate_id' => $request->candidate_id], $requestData);
        return redirect()->back()->with('success', 'File uploaded successfully.');
    }

    public function deleteFileForCovid19($id)
    {
        $covid19 = Covid19::findOrFail($id);
        if (Storage::exists($covid19->file_path)) {
            Storage::delete($covid19->file_path);
        }
        $covid19->delete();
        return redirect()->back()->with('success', 'File deleted successfully.');
    }

    public function availabilityForm(Request $request) {
        return view('branch.branch-availability-form-list');
    }

    public function getAvailabilityFormList() {
        $data = Candidate::select('candidate.*', 'users.name as branch_name')
                    ->withCount(['availabilityFormData'])
                    ->leftJoin('users', 'candidate.branch_id', '=', 'users.id')
                    ->has('candidateLiveInterviewQuestion','>', 0)
                    ->where('candidate.branch_id', Auth::user()->id)
                    ->get();
        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row) {
                    if ($row->availability_form_data_count > 0) {
                        $btn = '<a class="btn btn-success" target="_blank" href="'. $row->availabilityFormData->file_path .'">View File</a>
                            <form action="' . route('deleteFileForAvailabilityForm', $row->availabilityFormData->id) . '" method="post">
                                ' . csrf_field() . '
                                ' . method_field('DELETE') . '
                                <button type="submit" class="btn btn-danger">Delete File</button>
                            </form>';
                    } else {
                        $btn = '<form action="' . route('uploadFileForAvailabilityForm') . '" method="post" enctype="multipart/form-data" class="file-upload-form">
                            ' . csrf_field() . '
                            <input type="hidden" name="candidate_id" value="' . $row->id . '">
                            <input type="file" name="file_path">
                            <button type="submit" class="btn btn-success">Upload File</button>
                        </form>';
                    }
                    return $btn;
                })
                ->addColumn('profile', function($row){
                    $btn = '<a class="btn btn-primary" href="candidate/'. $row->id .'">View</a>';
                    return $btn;
                })
                ->rawColumns(['action', 'profile'])
                ->make(true);
    }

    public function uploadFileForAvailabilityForm(Request $request)
    {
        $request->validate([
            'file_path' => 'required|max:2048',
            'candidate_id' => 'required|exists:candidate,id',
        ]);
        $requestData = $request->all();
        $availabilityForm = AvailabilityForm::where('candidate_id', $request->candidate_id)->first();
        $requestData['file_path'] = $availabilityForm ? $availabilityForm->file_path : null;
        if ($request->hasFile('file_path')) {
            $image = $request->file('file_path');
            $name = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/user_document/availability_form');
            $image->move($destinationPath, $name);
            $requestData['file_path'] = asset('user_document/availability_form/' . $name);
        }
        AvailabilityForm::updateOrCreate(['candidate_id' => $request->candidate_id], $requestData);
        return redirect()->back()->with('success', 'File uploaded successfully.');
    }

    public function deleteFileForAvailabilityForm($id)
    {
        $availabilityForm = AvailabilityForm::findOrFail($id);
        if (Storage::exists($availabilityForm->file_path)) {
            Storage::delete($availabilityForm->file_path);
        }
        $availabilityForm->delete();
        return redirect()->back()->with('success', 'File deleted successfully.');
    }

    public function staffRiskAssessment(Request $request) {
        return view('branch.branch-staff-risk-list');
    }

    public function getStaffRiskAssessmentList() {
        $data = Candidate::select('candidate.*', 'users.name as branch_name')
                    ->withCount(['staffRiskData'])
                    ->leftJoin('users', 'candidate.branch_id', '=', 'users.id')
                    ->has('candidateLiveInterviewQuestion','>', 0)
                    ->where('candidate.branch_id', Auth::user()->id)
                    ->get();
        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row) {
                    if ($row->staff_risk_data_count > 0) {
                        if (!empty($row->staffRiskData->ra_form)) {
                            $btn = '<a class="btn btn-success" target="_blank" href="'. $row->staffRiskData->ra_form .'">View File</a>
                            <form action="' . route('deleteFileForStaffRiskAssessment', $row->staffRiskData->id) . '" method="post">
                                ' . csrf_field() . '
                                ' . method_field('DELETE') . '
                                <button type="submit" class="btn btn-danger">Delete File</button>
                            </form>';
                        } else {
                            $btn = '<form action="' . route('uploadFileForStaffRiskAssessment') . '" method="post" enctype="multipart/form-data" class="file-upload-form">
                                ' . csrf_field() . '
                                <input type="hidden" name="candidate_id" value="' . $row->id . '">
                                <input type="file" name="ra_form">
                                <button type="submit" class="btn btn-success">Upload File</button>
                            </form>';
                        }
                    } else {
                        $btn = '<form action="' . route('uploadFileForStaffRiskAssessment') . '" method="post" enctype="multipart/form-data" class="file-upload-form">
                            ' . csrf_field() . '
                            <input type="hidden" name="candidate_id" value="' . $row->id . '">
                            <input type="file" name="ra_form">
                            <button type="submit" class="btn btn-success">Upload File</button>
                        </form>';
                    }
                    return $btn;
                })
                ->addColumn('bame_form', function($row) {
                    if ($row->staff_risk_data_count > 0) {
                        if (!empty($row->staffRiskData->bame_form)) {
                            $btn = '<a class="btn btn-success" target="_blank" href="'. $row->staffRiskData->bame_form .'">View File</a>
                            <form action="' . route('deleteBAMEFormForForStaffRiskAssessment', $row->staffRiskData->id) . '" method="post">
                                ' . csrf_field() . '
                                ' . method_field('DELETE') . '
                                <button type="submit" class="btn btn-danger">Delete File</button>
                            </form>';
                        } else {
                            $btn = '<form action="' . route('uploadBAMEFormForStaffRiskAssessment') . '" method="post" enctype="multipart/form-data" class="file-upload-form">
                                ' . csrf_field() . '
                                <input type="hidden" name="candidate_id" value="' . $row->id . '">
                                <input type="file" name="bame_form">
                                <button type="submit" class="btn btn-success">Upload File</button>
                            </form>';
                        }
                    } else {
                        $btn = '<form action="' . route('uploadBAMEFormForStaffRiskAssessment') . '" method="post" enctype="multipart/form-data" class="file-upload-form">
                            ' . csrf_field() . '
                            <input type="hidden" name="candidate_id" value="' . $row->id . '">
                            <input type="file" name="bame_form">
                            <button type="submit" class="btn btn-success">Upload File</button>
                        </form>';
                    }
                    return $btn;
                })
                ->addColumn('covid_vaccination', function($row) {
                    if ($row->staff_risk_data_count > 0) {
                        if (!empty($row->staffRiskData->covid_vaccination)) {
                            $btn = '<a class="btn btn-success" target="_blank" href="'. $row->staffRiskData->covid_vaccination .'">View File</a>
                            <form action="' . route('deleteCovidVaccinationForStaffRiskAssessment', $row->staffRiskData->id) . '" method="post">
                                ' . csrf_field() . '
                                ' . method_field('DELETE') . '
                                <button type="submit" class="btn btn-danger">Delete File</button>
                            </form>';
                        } else {
                            $btn = '<form action="' . route('uploadCovidVaccinationForStaffRiskAssessment') . '" method="post" enctype="multipart/form-data" class="file-upload-form">
                                ' . csrf_field() . '
                                <input type="hidden" name="candidate_id" value="' . $row->id . '">
                                <input type="file" name="covid_vaccination">
                                <button type="submit" class="btn btn-success">Upload File</button>
                            </form>';
                        }
                    } else {
                        $btn = '<form action="' . route('uploadCovidVaccinationForStaffRiskAssessment') . '" method="post" enctype="multipart/form-data" class="file-upload-form">
                            ' . csrf_field() . '
                            <input type="hidden" name="candidate_id" value="' . $row->id . '">
                            <input type="file" name="covid_vaccination">
                            <button type="submit" class="btn btn-success">Upload File</button>
                        </form>';
                    }
                    return $btn;
                })
                ->addColumn('profile', function($row){
                    $btn = '<a class="btn btn-primary" href="candidate/'. $row->id .'">View</a>';
                    return $btn;
                })
                ->rawColumns(['action', 'profile', 'bame_form', 'covid_vaccination'])
                ->make(true);
    }

    public function uploadFileForStaffRiskAssessment(Request $request)
    {
        $request->validate([
            'ra_form' => 'required|max:2048',
            'candidate_id' => 'required|exists:candidate,id',
        ]);
        $requestData = $request->all();
        $availabilityForm = StaffRisk::where('candidate_id', $request->candidate_id)->first();
        $requestData['ra_form'] = $availabilityForm ? $availabilityForm->ra_form : null;
        if ($request->hasFile('ra_form')) {
            $image = $request->file('ra_form');
            $name = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/user_document/staff_risk/ra_from');
            $image->move($destinationPath, $name);
            $requestData['ra_form'] = asset('user_document/staff_risk/ra_from/' . $name);
        }
        StaffRisk::updateOrCreate(['candidate_id' => $request->candidate_id], $requestData);
        return redirect()->back()->with('success', 'File uploaded successfully.');
    }

    public function deleteFileForStaffRiskAssessment($id)
    {
        $staffRisk = StaffRisk::findOrFail($id);
        if (Storage::exists($staffRisk->ra_form)) {
            Storage::delete($staffRisk->ra_form);
        }
        $staffRisk->ra_form = null;
        $staffRisk->save();
        return redirect()->back()->with('success', 'File deleted successfully.');
    }

    public function uploadBAMEFormForStaffRiskAssessment(Request $request)
    {
        $request->validate([
            'bame_form' => 'required|max:2048',
            'candidate_id' => 'required|exists:candidate,id',
        ]);
        $requestData = $request->all();
        $availabilityForm = StaffRisk::where('candidate_id', $request->candidate_id)->first();
        $requestData['bame_form'] = $availabilityForm ? $availabilityForm->bame_form : null;
        if ($request->hasFile('bame_form')) {
            $image = $request->file('bame_form');
            $name = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/user_document/staff_risk/bame_form');
            $image->move($destinationPath, $name);
            $requestData['bame_form'] = asset('user_document/staff_risk/bame_form/' . $name);
        }
        StaffRisk::updateOrCreate(['candidate_id' => $request->candidate_id], $requestData);
        return redirect()->back()->with('success', 'File uploaded successfully.');
    }

    public function deleteBAMEFormForForStaffRiskAssessment($id)
    {
        $staffRisk = StaffRisk::findOrFail($id);
        if (Storage::exists($staffRisk->bame_form)) {
            Storage::delete($staffRisk->bame_form);
        }
        $staffRisk->bame_form = null;
        $staffRisk->save();
        return redirect()->back()->with('success', 'File deleted successfully.');
    }

    public function uploadCovidVaccinationForStaffRiskAssessment(Request $request)
    {
        $request->validate([
            'covid_vaccination' => 'required|max:2048',
            'candidate_id' => 'required|exists:candidate,id',
        ]);
        $requestData = $request->all();
        $availabilityForm = StaffRisk::where('candidate_id', $request->candidate_id)->first();
        $requestData['covid_vaccination'] = $availabilityForm ? $availabilityForm->covid_vaccination : null;
        if ($request->hasFile('covid_vaccination')) {
            $image = $request->file('covid_vaccination');
            $name = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/user_document/staff_risk/covid_vaccination');
            $image->move($destinationPath, $name);
            $requestData['covid_vaccination'] = asset('user_document/staff_risk/covid_vaccination/' . $name);
        }
        StaffRisk::updateOrCreate(['candidate_id' => $request->candidate_id], $requestData);
        return redirect()->back()->with('success', 'File uploaded successfully.');
    }

    public function deleteCovidVaccinationForStaffRiskAssessment($id)
    {
        $staffRisk = StaffRisk::findOrFail($id);
        if (Storage::exists($staffRisk->covid_vaccination)) {
            Storage::delete($staffRisk->covid_vaccination);
        }
        $staffRisk->covid_vaccination = null;
        $staffRisk->save();
        return redirect()->back()->with('success', 'File deleted successfully.');
    }

    public function submitForm(Request $request)
    {
        $requestData = $request->all();
        $emailList = CandidateEmailFile::where('candidate_id', $request->candidate_id)->first();
        $requestData['email_job_application'] = $emailList ? $emailList->email_job_application : null;
        if ($request->hasFile('email_job_application')) {
            $image = $request->file('email_job_application');
            $name = 'email_job_application_' . time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/user_document/email_pdf');
            $image->move($destinationPath, $name);
            $requestData['email_job_application'] = asset('user_document/email_pdf/' . $name);
        }
        $requestData['email_interview_screening'] = $emailList ? $emailList->email_interview_screening : null;
        if ($request->hasFile('email_interview_screening')) {
            $image = $request->file('email_interview_screening');
            $name = 'email_interview_screening_'. time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/user_document/email_pdf');
            $image->move($destinationPath, $name);
            $requestData['email_interview_screening'] = asset('user_document/email_pdf/' . $name);
        }
        $requestData['email_basic_english_test'] = $emailList ? $emailList->email_basic_english_test : null;
        if ($request->hasFile('email_basic_english_test')) {
            $image = $request->file('email_basic_english_test');
            $name = 'email_basic_english_test_' . time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/user_document/email_pdf');
            $image->move($destinationPath, $name);
            $requestData['email_basic_english_test'] = asset('user_document/email_pdf/' . $name);
        }
        $requestData['email_interview_note'] = $emailList ? $emailList->email_interview_note : null;
        if ($request->hasFile('email_interview_note')) {
            $image = $request->file('email_interview_note');
            $name = 'email_interview_note_' . time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/user_document/email_pdf');
            $image->move($destinationPath, $name);
            $requestData['email_interview_note'] = asset('user_document/email_pdf/' . $name);
        }
        $requestData['email_application_identity'] = $emailList ? $emailList->email_application_identity : null;
        if ($request->hasFile('email_application_identity')) {
            $image = $request->file('email_application_identity');
            $name = 'email_application_identity_' . time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/user_document/email_pdf');
            $image->move($destinationPath, $name);
            $requestData['email_application_identity'] = asset('user_document/email_pdf/' . $name);
        }
        $requestData['email_dbs_check'] = $emailList ? $emailList->email_dbs_check : null;
        if ($request->hasFile('email_dbs_check')) {
            $image = $request->file('email_dbs_check');
            $name = 'email_dbs_check_' . time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/user_document/email_pdf');
            $image->move($destinationPath, $name);
            $requestData['email_dbs_check'] = asset('user_document/email_pdf/' . $name);
        }
        $requestData['training_complete'] = $emailList ? $emailList->training_complete : null;
        if ($request->hasFile('training_complete')) {
            $image = $request->file('training_complete');
            $name = 'training_complete_' . time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/user_document/email_pdf');
            $image->move($destinationPath, $name);
            $requestData['training_complete'] = asset('user_document/email_pdf/' . $name);
        }
        CandidateEmailFile::updateOrCreate(['candidate_id' => $request->candidate_id], $requestData);
        return redirect()->back()->with('success', 'File uploaded successfully.');
    }

    public function allFormList($id) {
        $country = Country::all();
        $candidateData = $candidate = Candidate::find($id);
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
        $telephonicData = TelephonicInterview::where('candidate_id',$id)->first();
        $liveInterviewData = LiveInterviewQuestion::where('candidate_id',$id)->first();
        $applicantDetails = ApplicantIdentityDetails::where('candidate_id',$id)->first();
        $dbsData = DBSCheck::where('candidate_id',$id)->first();
        $training = TrainingRunning::where('candidate_id', $id)->get();
        return view('branch.all_form_list', compact('candidate', 'candidateData', 'country', 'branch', 'identityProofData', 'addressProofData', 'telephonicData', 'liveInterviewData', 'applicantDetails', 'dbsData', 'training'));
    }
}
