<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Candidate;
use App\Models\CharacterReference;
use App\Models\ProfessionalReference;
use App\Models\NotificationLog;
use App\Models\ReferenceEmailLog;
use App\Models\ReferenceList;
use PHPMailer\PHPMailer\PHPMailer;
use Exception;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class ReferenceController extends Controller
{
    public function characterReference($id, $reference_index) {
        $candidate = Candidate::find($id);
        $characterReference = CharacterReference::where('candidate_id',$id)->where('reference_number', $reference_index)->first();
        $referenceData = ReferenceList::where('candidate_id',$id)->first();
        $referenceName = '';
        $is_public = false;
        if ($referenceData) {
            $reference1Json = json_decode($referenceData->reference_1_json, true);
            $referenceName = $reference1Json[$reference_index - 1]['name_1'];
            if ($this->isNormalEmail($reference1Json[$reference_index - 1]['email_1'])) {
                $is_public = true;
            }
        }
        return view('branch.character-reference', compact('candidate', 'characterReference', 'is_public', 'reference_index', 'referenceName'));
    }

    public function storeCharacterReference(Request $request, $id, $referenceIndex) {
        $requestData = $request->all();
        $characterReference = CharacterReference::where('candidate_id',$id)->first();
        $requestData['signature'] = $characterReference ? $characterReference->signature : null;
        $requestData['document_path'] = $characterReference ? $characterReference->document_path : null;
        if (isset($request->signature) && !empty($request->signature)) {
            $image_parts = explode(";base64,", $request->signature);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signFileName = time() . '_' . uniqid() . '.' . $image_type;
            $destinationPath = public_path('/user_document/reference');
            $file = $destinationPath . '/' . $signFileName;
            file_put_contents($file, $image_base64);
            $requestData['signature'] = asset('user_document/reference/' . $signFileName);
        }
        if ($request->hasFile('document_path')) {
            $image = $request->file('document_path');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/user_document/document_path');
            $image->move($destinationPath, $name);
            $requestData['document_path'] = asset('user_document/document_path/' . $name);
        }
        $requestData['dignity_respect_1'] = $request->has('dignity_respect_1') ? 'on' : 0;
        $requestData['dignity_respect_2'] = $request->has('dignity_respect_2') ? 'on' : 0;
        $requestData['dignity_respect_3'] = $request->has('dignity_respect_3') ? 'on' : 0;

        $requestData['empower_others_1'] = $request->has('empower_others_1') ? 'on' : 0;
        $requestData['empower_others_2'] = $request->has('empower_others_2') ? 'on' : 0;
        $requestData['empower_others_3'] = $request->has('empower_others_3') ? 'on' : 0;

        $requestData['commitment_work_1'] = $request->has('commitment_work_1') ? 'on' : 0;
        $requestData['commitment_work_2'] = $request->has('commitment_work_2') ? 'on' : 0;
        $requestData['commitment_work_3'] = $request->has('commitment_work_3') ? 'on' : 0;

        $requestData['development_interest_1'] = $request->has('development_interest_1') ? 'on' : 0;
        $requestData['development_interest_2'] = $request->has('development_interest_2') ? 'on' : 0;
        $requestData['development_interest_3'] = $request->has('development_interest_3') ? 'on' : 0;

        $requestData['work_initiative_1'] = $request->has('work_initiative_1') ? 'on' : 0;
        $requestData['work_initiative_2'] = $request->has('work_initiative_2') ? 'on' : 0;
        $requestData['work_initiative_3'] = $request->has('work_initiative_3') ? 'on' : 0;

        $requestData['working_ability_1'] = $request->has('working_ability_1') ? 'on' : 0;
        $requestData['working_ability_2'] = $request->has('working_ability_2') ? 'on' : 0;
        $requestData['working_ability_3'] = $request->has('working_ability_3') ? 'on' : 0;

        $requestData['reliability_1'] = $request->has('reliability_1') ? 'on' : 0;
        $requestData['reliability_2'] = $request->has('reliability_2') ? 'on' : 0;
        $requestData['reliability_3'] = $request->has('reliability_3') ? 'on' : 0;

        $requestData['employee_conduct_1'] = $request->has('employee_conduct_1') ? 'on' : 0;
        $requestData['employee_conduct_2'] = $request->has('employee_conduct_2') ? 'on' : 0;
        $requestData['employee_conduct_3'] = $request->has('employee_conduct_3') ? 'on' : 0;

        $requestData['time_punctuality_1'] = $request->has('time_punctuality_1') ? 'on' : 0;
        $requestData['time_punctuality_2'] = $request->has('time_punctuality_2') ? 'on' : 0;
        $requestData['time_punctuality_3'] = $request->has('time_punctuality_3') ? 'on' : 0;

        $requestData['reference_number'] = $referenceIndex;
        $referenceList = ReferenceList::where('candidate_id', $id)->first();
        if ($referenceList) {
            $referenceData = json_decode($referenceList->reference_1_json, true);
            foreach ($referenceData as $key => $value) {
                if ($key == $referenceIndex - 1) {
                    $value['character_email_complete'] = 'Yes';
                }
                $referenceDataNew[] = $value;
            }
            ReferenceList::where('candidate_id', $id)->update(['reference_1_json' => json_encode($referenceDataNew)]);
        }
        // ReferenceList::where('candidate_id', $id)->update(['character_email_complete' => 'Yes']);
        CharacterReference::updateOrCreate(['candidate_id' => $id, 'reference_number' => $referenceIndex], $requestData);
        return view('branch.thank-you');
    }

    public function professionalReference($id, $reference_index) {
        $candidate = Candidate::find($id);
        $professionalReference = ProfessionalReference::where('candidate_id',$id)->where('reference_number', $reference_index)->first();
        $referenceData = ReferenceList::where('candidate_id',$id)->first();
        $referenceName = '';
        $is_public = false;
        if ($referenceData) {
            $reference1Json = json_decode($referenceData->reference_2_json, true);
            $referenceName = $reference1Json[$reference_index - 1]['name_2'];
            if ($this->isNormalEmail($reference1Json[$reference_index - 1]['email_2'])) {
                $is_public = true;
            }
        }
        return view('branch.professional-reference', compact('candidate', 'professionalReference', 'is_public', 'reference_index', 'referenceName'));
    }

    public function storeProfessionalReference(Request $request, $id, $referenceIndex) {
        $requestData = $request->all();
        $professionalReference = ProfessionalReference::where('candidate_id',$id)->first();
        $requestData['signature'] = $professionalReference ? $professionalReference->signature : null;
        $requestData['document_path'] = $professionalReference ? $professionalReference->document_path : null;
        if (isset($request->signature) && !empty($request->signature)) {
            $image_parts = explode(";base64,", $request->signature);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signFileName = time() . '_' . uniqid() . '.' . $image_type;
            $destinationPath = public_path('/user_document/reference');
            $file = $destinationPath . '/' . $signFileName;
            file_put_contents($file, $image_base64);
            $requestData['signature'] = asset('user_document/reference/' . $signFileName);
        }
        if ($request->hasFile('document_path')) {
            $image = $request->file('document_path');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/user_document/document_path');
            $image->move($destinationPath, $name);
            $requestData['document_path'] = asset('user_document/document_path/' . $name);
        }
        $requestData['dignity_respect_1'] = $request->has('dignity_respect_1') ? 'on' : 0;
        $requestData['dignity_respect_2'] = $request->has('dignity_respect_2') ? 'on' : 0;
        $requestData['dignity_respect_3'] = $request->has('dignity_respect_3') ? 'on' : 0;

        $requestData['empathy_ability_1'] = $request->has('empathy_ability_1') ? 'on' : 0;
        $requestData['empathy_ability_2'] = $request->has('empathy_ability_2') ? 'on' : 0;
        $requestData['empathy_ability_3'] = $request->has('empathy_ability_3') ? 'on' : 0;

        $requestData['commitment_attitude_1'] = $request->has('commitment_attitude_1') ? 'on' : 0;
        $requestData['commitment_attitude_2'] = $request->has('commitment_attitude_2') ? 'on' : 0;
        $requestData['commitment_attitude_3'] = $request->has('commitment_attitude_3') ? 'on' : 0;

        $requestData['development_interest_1'] = $request->has('development_interest_1') ? 'on' : 0;
        $requestData['development_interest_2'] = $request->has('development_interest_2') ? 'on' : 0;
        $requestData['development_interest_3'] = $request->has('development_interest_3') ? 'on' : 0;

        $requestData['team_working_1'] = $request->has('team_working_1') ? 'on' : 0;
        $requestData['team_working_2'] = $request->has('team_working_2') ? 'on' : 0;
        $requestData['team_working_3'] = $request->has('team_working_3') ? 'on' : 0;

        $requestData['work_initiative_1'] = $request->has('work_initiative_1') ? 'on' : 0;
        $requestData['work_initiative_2'] = $request->has('work_initiative_2') ? 'on' : 0;
        $requestData['work_initiative_3'] = $request->has('work_initiative_3') ? 'on' : 0;

        $requestData['reliability_1'] = $request->has('reliability_1') ? 'on' : 0;
        $requestData['reliability_2'] = $request->has('reliability_2') ? 'on' : 0;
        $requestData['reliability_3'] = $request->has('reliability_3') ? 'on' : 0;

        $requestData['conduct_workplace_1'] = $request->has('conduct_workplace_1') ? 'on' : 0;
        $requestData['conduct_workplace_1'] = $request->has('conduct_workplace_2') ? 'on' : 0;
        $requestData['conduct_workplace_3'] = $request->has('conduct_workplace_3') ? 'on' : 0;

        $requestData['punctuality_1'] = $request->has('punctuality_1') ? 'on' : 0;
        $requestData['punctuality_2'] = $request->has('punctuality_2') ? 'on' : 0;
        $requestData['punctuality_3'] = $request->has('punctuality_3') ? 'on' : 0;
        // ReferenceList::where('candidate_id', $id)->update(['professional_email_complete' => 'Yes']);
        $requestData['reference_number'] = $referenceIndex;
        $referenceList = ReferenceList::where('candidate_id', $id)->first();
        if ($referenceList) {
            $professionalData = json_decode($referenceList->reference_2_json, true);
            foreach ($professionalData as $key => $value) {
                if ($key == $referenceIndex - 1) {
                    $value['professional_email_complete'] = 'Yes';
                }
                $professionalDataNew[] = $value;
            }
            ReferenceList::where('candidate_id', $id)->update(['reference_2_json' => json_encode($professionalDataNew)]);
        }
        ProfessionalReference::updateOrCreate(['candidate_id' => $id, 'reference_number' => $referenceIndex], $requestData);
        return view('branch.thank-you');
    }

    public function referenceEmail(Request $request, $id) {
        $candidateData = Candidate::find($id);
        // ReferenceList::where('candidate_id', $id)->update(['is_email_send' => 'Yes']);

        // Send Email and set email count
        $referenceList = ReferenceList::where('candidate_id', $id)->first();
        if ($referenceList) {
            $referenceData = json_decode($referenceList->reference_1_json, true);
            foreach ($referenceData as $key => $value) {
                if ($value['email_1'] != null && (isset($value['character_email_complete']) && $value['character_email_complete'] == 'No' || !isset($value['character_email_complete']))) {
                    if (isset($value['email_day_count'])) {
                        $value['email_day_count'] = $value['email_day_count'] ?? 0;
                    } else {
                        $value['email_day_count'] = 0;
                    }
                    if (!isset($value['character_email_complete'])) {
                        $value['character_email_complete'] = 'No';
                        if ($candidateData->branch_id == 3) {
                            $body = "Dear " . $value['name_1'] . ",<br><br> The above-named applicant has given your name as a referee. <br><br>Please complete the attached application form provided as soon as you are able to.<br><br>Please click on this link to fill form: " . route('characterReference', ['id' => $candidateData->id, 'reference_index' => $key + 1]) . "<br><br>Thank you,<br><br>Heena Patel";
                            $this->sendMail($value['email_1'], $value['name_1'], 'Character Reference', $body, $candidateData->id, $candidateData->branch_id);
                        } else {
                            $body = "Dear " . $value['name_1'] . ",<br><br> The above-named applicant has given your name as a referee. <br><br>Please complete the attached application form provided as soon as you are able to.<br><br>Please click on this link to fill form: " . route('characterReference', ['id' => $candidateData->id, 'reference_index' => $key + 1]) . "<br><br>Thank you,<br><br>Recruitment Team";
                            $this->sendMail($value['email_1'], $value['name_1'], 'Character Reference', $body, $candidateData->id, $candidateData->branch_id);
                        }

                        $emailRequest = [
                            'body' => $body,
                            'reference_name' => $candidateData->referenceList->name_1,
                            'reference_email' => $candidateData->referenceList->email_1,
                        ];
                        ReferenceEmailLog::create([
                            "candidate_id" => $candidateData->id,
                            "reference_id" => $candidateData->referenceList->id,
                            "reference_type" => "Character",
                            "request" => json_encode($emailRequest),
                        ]);
                    } else {
                        if ($value['character_email_complete'] == 'No') {
                            if ($candidateData->branch_id == 3) {
                                $body = "Dear " . $value['name_1'] . ",<br><br> The above-named applicant has given your name as a referee. <br><br>Please complete the attached application form provided as soon as you are able to.<br><br>Please click on this link to fill form: " . route('characterReference', ['id' => $candidateData->id, 'reference_index' => $key + 1]) . "<br><br>Thank you,<br><br>Heena Patel";
                                $this->sendMail($value['email_1'], $value['name_1'], 'Character Reference', $body, $candidateData->id, $candidateData->branch_id);
                            } else {
                                $body = "Dear " . $value['name_1'] . ",<br><br> The above-named applicant has given your name as a referee. <br><br>Please complete the attached application form provided as soon as you are able to.<br><br>Please click on this link to fill form: " . route('characterReference', ['id' => $candidateData->id, 'reference_index' => $key + 1]) . "<br><br>Thank you,<br><br>Recruitment Team";
                                $this->sendMail($value['email_1'], $value['name_1'], 'Character Reference', $body, $candidateData->id, $candidateData->branch_id);
                            }

                            $emailRequest = [
                                'body' => $body,
                                'reference_name' => $candidateData->referenceList->name_1,
                                'reference_email' => $candidateData->referenceList->email_1,
                            ];
                            ReferenceEmailLog::create([
                                "candidate_id" => $candidateData->id,
                                "reference_id" => $candidateData->referenceList->id,
                                "reference_type" => "Character",
                                "request" => json_encode($emailRequest),
                            ]);
                        }
                    }
                }
                $referenceDataNew[] = $value;
            }

            $professionalData = json_decode($referenceList->reference_2_json, true);
            foreach ($professionalData as $key => $value) {
                if ($value['email_2'] != null && (isset($value['professional_email_complete']) && $value['professional_email_complete'] == 'No' || !isset($value['professional_email_complete']))) {
                    if (isset($value['email_day_count'])) {
                        $value['email_day_count'] = $value['email_day_count'] ?? 0;
                    } else {
                        $value['email_day_count'] = 0;
                    }
                    if (!isset($value['professional_email_complete'])) {
                        $value['professional_email_complete'] = 'No';
                        if ($candidateData->branch_id == 3) {
                            $body1 = "Dear ". $value['name_2'] . ",<br><br> The above-named applicant has given your name as a referee. <br><br>Please complete the attached application form provided as soon as you are able to.<br><br>Please click on this link to fill form: ". route('professionalReference', ['id' => $candidateData->id, 'reference_index' => $key + 1]) ."<br><br>Thank you,<br><br>Heena Patel";
                            $this->sendMail($value['email_2'], $value['name_2'], 'Professional Reference', $body1, $candidateData->id, $candidateData->branch_id);
                        } else {
                            $body1 = "Dear ". $value['name_2'] . ",<br><br> The above-named applicant has given your name as a referee. <br><br>Please complete the attached application form provided as soon as you are able to.<br><br>Please click on this link to fill form: ". route('professionalReference', ['id' => $candidateData->id, 'reference_index' => $key + 1]) ."<br><br>Thank you,<br><br>Recruitment Team";
                            $this->sendMail($value['email_2'], $value['name_2'], 'Professional Reference', $body1, $candidateData->id, $candidateData->branch_id);
                        }

                        $emailRequest = [
                            'body' => $body1,
                            'reference_name' => $candidateData->referenceList->name_2,
                            'reference_email' => $candidateData->referenceList->email_2,
                        ];
                        ReferenceEmailLog::create([
                            "candidate_id" => $candidateData->id,
                            "reference_id" => $candidateData->referenceList->id,
                            "reference_type" => "Professional",
                            "request" => json_encode($emailRequest),
                        ]);
                    } else {
                        if ($value['professional_email_complete'] == 'No') {
                            if ($candidateData->branch_id == 3) {
                                $body1 = "Dear ". $value['name_2'] . ",<br><br> The above-named applicant has given your name as a referee. <br><br>Please complete the attached application form provided as soon as you are able to.<br><br>Please click on this link to fill form: ". route('professionalReference', ['id' => $candidateData->id, 'reference_index' => $key + 1]) ."<br><br>Thank you,<br><br>Heena Patel";
                                $response = $this->sendMail($value['email_2'], $value['name_2'], 'Professional Reference', $body1, $candidateData->id, $candidateData->branch_id);
                                dd($response);
                            } else {
                                $body1 = "Dear ". $value['name_2'] . ",<br><br> The above-named applicant has given your name as a referee. <br><br>Please complete the attached application form provided as soon as you are able to.<br><br>Please click on this link to fill form: ". route('professionalReference', ['id' => $candidateData->id, 'reference_index' => $key + 1]) ."<br><br>Thank you,<br><br>Recruitment Team";
                                $this->sendMail($value['email_2'], $value['name_2'], 'Professional Reference', $body1, $candidateData->id, $candidateData->branch_id);
                            }

                            $emailRequest = [
                                'body' => $body1,
                                'reference_name' => $candidateData->referenceList->name_2,
                                'reference_email' => $candidateData->referenceList->email_2,
                            ];
                            ReferenceEmailLog::create([
                                "candidate_id" => $candidateData->id,
                                "reference_id" => $candidateData->referenceList->id,
                                "reference_type" => "Professional",
                                "request" => json_encode($emailRequest),
                            ]);
                        }
                    }
                }
                $professionalDataNew[] = $value;
            }
            ReferenceList::where('candidate_id', $id)->update([
                'reference_1_json' => json_encode($referenceDataNew),
                'reference_2_json' => json_encode($professionalDataNew),
            ]);
        }
        return redirect()->route('referenceList');
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

    public function cronForReferenceEmail() {
        try {
            $currentDay = Carbon::now()->dayOfWeek;
            if ($currentDay >= 1 && $currentDay <= 5) {
                if (!$this->isBankHoliday()) {
                    $referenceList = ReferenceList::where('is_email_send', 'Yes')->get();
                    foreach($referenceList as $val) {
                        $candidateData = Candidate::find($val->candidate_id);
                        $referenceData = json_decode($val->reference_1_json, true);
                        $reference_1_json = [];
                        foreach ($referenceData as $key => $value) {
                            if ($value['email_1'] != null && isset($value['email_day_count']) && $value['email_day_count'] < 5 && $value['character_email_complete'] == 'No') {
                                if ($candidateData->branch_id == 3) {
                                    $body = "Dear " . $value['name_1'] . ",<br><br> The above-named applicant has given your name as a referee. <br><br>Please complete the attached application form provided as soon as you are able to.<br><br>Please click on this link to fill form: " . route('characterReference', ['id' => $val->candidate_id, 'reference_index' => $key + 1]) . "<br><br>Thank you,<br><br>Heena Patel";
                                    $this->sendMail($value['email_1'], $value['name_1'], 'Character Reference', $body, $val->candidate_id, $candidateData->branch_id);
                                } else {
                                    $body = "Dear " . $value['name_1'] . ",<br><br> The above-named applicant has given your name as a referee. <br><br>Please complete the attached application form provided as soon as you are able to.<br><br>Please click on this link to fill form: " . route('characterReference', ['id' => $val->candidate_id, 'reference_index' => $key + 1]) . "<br><br>Thank you,<br><br>Recruitment Team";
                                    $this->sendMail($value['email_1'], $value['name_1'], 'Character Reference', $body, $val->candidate_id, $candidateData->branch_id);
                                }

                                $emailRequest = [
                                    'body' => $body,
                                    'reference_name' => $value['name_1'],
                                    'reference_email' => $value['email_1'],
                                ];
                                ReferenceEmailLog::create([
                                    "candidate_id" => $val->candidate_id,
                                    "reference_id" => $val->id,
                                    "reference_type" => "Character",
                                    "request" => json_encode($emailRequest),
                                ]);
                                $value['email_day_count'] = $value['email_day_count'] + 1;
                            }
                            $reference_1_json[] = $value;
                        }
                        $professionalData = json_decode($val->reference_2_json, true);
                        $reference_2_json = [];
                        foreach ($professionalData as $key => $value) {
                            if ($value['name_2'] != null && isset($value['email_day_count']) && $value['email_day_count'] < 5 && $value['professional_email_complete'] == 'No') {
                                if ($candidateData->branch_id == 3) {
                                    $body1 = "Dear ". $value['name_2'] . ",<br><br> The above-named applicant has given your name as a referee. <br><br>Please complete the attached application form provided as soon as you are able to.<br><br>Please click on this link to fill form: ". route('professionalReference', ['id' => $val->candidate_id, 'reference_index' => $key + 1]) ."<br><br>Thank you,<br><br>Heena Patel";
                                    $this->sendMail($value['email_2'], $value['name_2'], 'Professional Reference', $body1, $val->candidate_id, $candidateData->branch_id);
                                } else {
                                    $body1 = "Dear ". $value['name_2'] . ",<br><br> The above-named applicant has given your name as a referee. <br><br>Please complete the attached application form provided as soon as you are able to.<br><br>Please click on this link to fill form: ". route('professionalReference', ['id' => $val->candidate_id, 'reference_index' => $key + 1]) ."<br><br>Thank you,<br><br>Recruitment Team";
                                    $this->sendMail($value['email_2'], $value['name_2'], 'Professional Reference', $body1, $val->candidate_id, $candidateData->branch_id);

                                }

                                $emailRequest = [
                                    'body' => $body1,
                                    'reference_name' => $val['name_2'],
                                    'reference_email' => $value['email_2'],
                                ];
                                ReferenceEmailLog::create([
                                    "candidate_id" => $val->candidate_id,
                                    "reference_id" => $val->id,
                                    "reference_type" => "Professional",
                                    "request" => json_encode($emailRequest),
                                ]);
                                $value['email_day_count'] = $value['email_day_count'] + 1;
                            }
                            $reference_2_json[] = $value;
                        }
                        $val->reference_1_json = json_encode($reference_1_json);
                        $val->reference_2_json = json_encode($reference_2_json);
                        $val->save();
                    }
                } else {
                    Log::info('Skipping emails due to bank holiday in the UK.');
                }
            }
            return "Success";
        } catch (Exception $e) {
            Log::error('Cron job failed: ' . $e->getMessage());
            return $e->getMessage();
        }
    }

    public function isNormalEmail($email)
    {
        $allowedDomains = [
            'gmail.com', 'yahoo.com', 'yahoo.in', 'hotmail.com', 'aol.com', 'icloud.com', 'outlook.com',
            'protonmail.com', 'zoho.com', 'mail.com', 'gmx.com', 'yandex.com', // Add more allowed domains as needed
        ];

        $emailParts = explode('@', $email);
        $domain = strtolower(end($emailParts));
        return in_array($domain, $allowedDomains);
    }

    public function isBankHoliday()
    {
        $currentYear = Carbon::now()->year;
        $apiUrl = "https://date.nager.at/api/v2/PublicHolidays/$currentYear/gb";

        $response = file_get_contents($apiUrl);
        $holidays = json_decode($response, true);
        $today = Carbon::now()->toDateString();
        foreach ($holidays as $holiday) {
            if ($holiday['date'] === $today) {
                return true;
            }
        }

        return false;
    }
}
