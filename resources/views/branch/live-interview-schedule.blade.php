<style>
        .heading h6 {
            display: inline;
            margin-right: 10px;
        }
        .cust-input{
            border: 1px solid #000 !important;
            width: 80%;
        }
        .cust-input-100{
            border: none;
            width: 100%;
        }
        .border-1{
            border: 1px solid #000 !important;
        }
        .k_table table{
            width: 100%;
        }
        .k_table th{
            padding: 10px;
            border: 1px solid #000;
        }
        .k_table tr{
            padding: 10px;
            border: 1px solid #000;
        }
        .k_table td{
            padding: 10px;
            border: 1px solid #000;
        }
        .k_set{
            font-size:18px;
        }
        .heading h6{
            font-size:18px;
        }
        .k_set table{
            font-size:18px;
        }
        .k_set textarea{
            border:none;
        }
        #serviceNowSign{
            background: #FBFAE2;
            border: 1px solid black;
        }
        #signImage{
            width: 100% !important;
            height: 44px;
            border: 1px solid black;
        }
        #signImage-signature {
            width: 100% !important;
            height: 44px;
            border: 0px solid black;
        }
    </style>

@extends('layouts.master')

@section('title') Live Interview Question @endsection

@section('content')

@component('components.breadcrumb')
@slot('li_1') Forms @endslot
@slot('title') Live Interview Question @endslot
@endcomponent
@section('css')
<link href="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="{{ URL::asset('/assets/libs/datepicker/datepicker.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.signature.css') }}" rel="stylesheet">
<style>
    .white-bg {
        margin-bottom: 20px;
        padding: 18px;
        background: #fff;
        border-radius: 5px;
    }
    .white-bg .col-4 {
        align-items: center;
        display: grid;
    }
    p.contact {
        margin: 0;
        text-align: end;
    }
</style>
@endsection
<div>
    <div class="white-bg">
       <div class="row">
           <div class="col-4">
               <img src="https://job.ndhcare.co.uk/assets/images/NDH-care-1.png" alt="" height="45" class="advance-logo">
           </div>
           <div class="col-4">
               <h4 class="site-heading" style="font-size: 2rem"><b>NDH CARE LDT</b></h4>
           </div>
           <div class="col-4">
               <p class="contact">Suite 06, Elite House, 70 Warwick Street, Birmingham, B12 0NL</p>
               <p class="contact">Ph: 0121 448 0568</p>
               <p class="contact">Website: www.ndhcare.co.uk</p>
               <p class="contact">Email: info@ndhcare.co.uk</p>
           </div>
       </div>
    </div>
</div>
<div class="row">
    <div class="col-12 skill-Assessment">
        <div class="card">
            <div class="card-body">
                <form method="post" action="{{route('storeLiveInterviewQuestion', $candidate->id)}}" enctype="multipart/form-data">
                    @csrf
                     <div class="container">
                        <div class="k_set">

                            <div class="row mt-3">
                                <div class="col-md-6 heading mb-4">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h6>Candidate Name :</h6>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" class="cust-input form-control" name="candidate_name" value="{{ $liveInterviewData ? $liveInterviewData->candidate_name : '' }}"/>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6 heading">
                                    <div class="row">
                                    <div class="col-md-2">
                                            <h6>Date :</h6>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="date" class="border-1 form-control" name="date" value="{{ $liveInterviewData ? $liveInterviewData->date : '' }}"/>
                                        </div>
                                  </div>
                                </div>
                            </div>
                            <hr/>

                            <div>
                                <div>
                                    <p>Note: score is given in between 1 to 3 points which are mentioned below.</p>
                                    <p><b>1 - Below Level Required / Does Not Demonstrate Achievement</b></p>
                                    <p><b>2 - Meets Essential Requirements*</b></p>
                                    <p><b>3 - Exceeds Requirements</b></p>
                                </div>
                            </div>

                            <div class="k_table">
                                <div  style="overflow-x:auto;">
                                    <table border="1">
                                        <tr>
                                            <th>Q. No</th>
                                            <th>Interview Questions</th>
                                            <th>Score</th>
                                        </tr>
                                        <tr>
                                            <td>1. </td>
                                            <td>Do you have work experience in Health Care Sector? &nbsp; Yes &nbsp;<input type="radio" name="health_sector_radio" value="yes" @if($liveInterviewData && $liveInterviewData->health_sector_radio == 'yes') checked @endif/> &nbsp; No &nbsp;<input type="radio" name="health_sector_radio" value="no" @if($liveInterviewData && $liveInterviewData->health_sector_radio == 'no') checked @endif/></td>
                                            <td><input type="text" class="cust-input form-control" name="health_care_sector" value="{{ $liveInterviewData ? $liveInterviewData->health_care_sector : '' }}" onkeyup="updateSum()"/> </td>
                                        </tr>
                                        <tr><td colspan="3"><input type="text" class="cust-input form-control" name="health_care_sector_other" value="{{ $liveInterviewData ? $liveInterviewData->health_care_sector_other : '' }}"/></td></tr>
                                        <tr>
                                            <td>2. </td>
                                            <td>Tell me about yourself and why did you choose to work in the health care sector?</td>
                                            <td><input type="text" class="cust-input form-control" name="tell_me_about_yourself" value="{{ $liveInterviewData ? $liveInterviewData->tell_me_about_yourself : '' }}" onkeyup="updateSum()"/> </td>
                                        </tr>
                                        <tr><td colspan="3"><input type="text" class="cust-input form-control" name="tell_me_about_yourself_other" value="{{ $liveInterviewData ? $liveInterviewData->tell_me_about_yourself_other : '' }}"/></td></tr>
                                        <tr>
                                            <td>3. </td>
                                            <td>Can you explain which task involve in the domiciliary care work?</td>
                                            <td><input type="text" class="cust-input form-control" name="domiciliary_care_work" value="{{ $liveInterviewData ? $liveInterviewData->domiciliary_care_work : '' }}" onkeyup="updateSum()"/> </td>
                                        </tr>
                                        <tr><td colspan="3"><input type="text" class="cust-input form-control" name="domiciliary_care_work_other" value="{{ $liveInterviewData ? $liveInterviewData->domiciliary_care_work_other : '' }}"/></td></tr>
                                        <tr>
                                            <td>4. </td>
                                            <td>If You are going to provide care in citizen’s/ client’s home, how will you approach
                                                them/ how do you will interact with them.</td>
                                            <td><input type="text" class="cust-input form-control" name="citizen_home" value="{{ $liveInterviewData ? $liveInterviewData->citizen_home : '' }}" onkeyup="updateSum()"/> </td>
                                        </tr>
                                        <tr><td colspan="3"><input type="text" class="cust-input form-control" name="citizen_home_other" value="{{ $liveInterviewData ? $liveInterviewData->citizen_home_other : '' }}"/></td></tr>
                                        <tr>
                                            <td>5. </td>
                                            <td>When going into someone's home, how would you know they are safe and healthy? If
                                                you felt concerned, what would you do?</td>
                                            <td><input type="text" class="cust-input form-control" name="safe_and_healthy" value="{{ $liveInterviewData ? $liveInterviewData->safe_and_healthy : '' }}" onkeyup="updateSum()"/> </td>
                                        </tr>
                                        <tr><td colspan="3"><input type="text" class="cust-input form-control" name="safe_and_healthy_other" value="{{ $liveInterviewData ? $liveInterviewData->safe_and_healthy_other : '' }}"/></td></tr>
                                        <tr>
                                            <td>6. </td>
                                            <td>If you were delivering personal support to someone, how would you maintain their
                                                privacy and dignity?</td>
                                            <td><input type="text" class="cust-input form-control" name="privacy_and_dignity" value="{{ $liveInterviewData ? $liveInterviewData->privacy_and_dignity : '' }}" onkeyup="updateSum()"/> </td>
                                        </tr>
                                        <tr><td colspan="3"><input type="text" class="cust-input form-control" name="privacy_and_dignity_other" value="{{ $liveInterviewData ? $liveInterviewData->privacy_and_dignity_other : '' }}"/></td></tr>
                                        <tr>
                                            <td>7. </td>
                                            <td>Can you explain how you have contributed to effective team working?</td>
                                            <td><input type="text" class="cust-input form-control" name="effective_team_working" value="{{ $liveInterviewData ? $liveInterviewData->effective_team_working : '' }}" onkeyup="updateSum()"/> </td>
                                        </tr>
                                        <tr><td colspan="3"><input type="text" class="cust-input form-control" name="effective_team_working_other" value="{{ $liveInterviewData ? $liveInterviewData->effective_team_working_other : '' }}"/></td></tr>
                                        <tr>
                                            <td>8. </td>
                                            <td>How do you effectively share your skills and knowledge with others / colleagues?</td>
                                            <td><input type="text" class="cust-input form-control" name="knowledge_other" value="{{ $liveInterviewData ? $liveInterviewData->knowledge_other : '' }}" onkeyup="updateSum()"/> </td>
                                        </tr>
                                        <tr><td colspan="3"><input type="text" class="cust-input form-control" name="knowledge_other_other" value="{{ $liveInterviewData ? $liveInterviewData->knowledge_other_other : '' }}"/></td></tr>
                                        <tr>
                                            <td>9. </td>
                                            <td>What is your understanding of data protection?</td>
                                            <td><input type="text" class="cust-input form-control" name="data_protection" value="{{ $liveInterviewData ? $liveInterviewData->data_protection : '' }}" onkeyup="updateSum()"/> </td>
                                        </tr>
                                        <tr><td colspan="3"><input type="text" class="cust-input form-control" name="data_protection_other" value="{{ $liveInterviewData ? $liveInterviewData->data_protection_other : '' }}"/></td></tr>
                                        <tr>
                                            <td>10. </td>
                                            <td>If you are running late for your call, then what you do?</td>
                                            <td><input type="text" class="cust-input form-control" name="running_late" value="{{ $liveInterviewData ? $liveInterviewData->running_late : '' }}" onkeyup="updateSum()"/> </td>
                                        </tr>
                                        <tr><td colspan="3"><input type="text" class="cust-input form-control" name="running_late_other" value="{{ $liveInterviewData ? $liveInterviewData->running_late_other : '' }}"/></td></tr>
                                        <tr>
                                            <td>11. </td>
                                            <td>Scenario: Medication
                                                Mark has 4 calls/visit a day and he depends on carers to prompt medication. You are
                                                going at lunch time, and Mark tells you that the morning carer didn’t give him
                                                medication and asks you to prompt the morning medication instead of the lunch time
                                                medication, what you do in this situation?</td>
                                            <td><input type="text" class="cust-input form-control" name="medication" value="{{ $liveInterviewData ? $liveInterviewData->medication : '' }}" onkeyup="updateSum()"/> </td>
                                        </tr>
                                        <tr><td colspan="3"><input type="text" class="cust-input form-control" name="medication_other" value="{{ $liveInterviewData ? $liveInterviewData->medication_other : '' }}"/></td></tr>
                                        <tr>
                                            <td colspan="3" class="text-center"><b>Total Score</b><br/>(Total score must be equal to or more than 18 for selection/sort list)<br><input type="text" class="cust-input form-control" id="total_score_selection" name="total_score_selection" value="{{ $liveInterviewData ? $liveInterviewData->total_score_selection : '' }}"></div></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <div class="mt-4">
                                <h5>Details provide to candidates :</h5>

                                <div class="k_table"  style="overflow-x:auto;">
                                    <table border="1">
                                        <tr>
                                            <td>DBS : </td><td><input type="text" class="cust-input form-control" name="dbs_text" value="{{ $liveInterviewData ? $liveInterviewData->dbs_text : '' }}"/></td>
                                        </tr>
                                        <tr>
                                            <td>References : </td>
                                            <td><input type="text" class="cust-input form-control" name="reference" value="{{ $liveInterviewData ? $liveInterviewData->reference : '' }}"/></td>
                                        </tr>
                                        <tr>
                                            <td>Induction training and care certificate :</td>
                                            <td><input type="text" class="cust-input form-control" name="care_certificate" value="{{ $liveInterviewData ? $liveInterviewData->care_certificate : '' }}"/></td>
                                        </tr>
                                        <tr>
                                            <td>DBS Working patterns :</td>
                                            <td><input type="text" class="cust-input form-control" name="dbs_working" value="{{ $liveInterviewData ? $liveInterviewData->dbs_working : '' }}"/></td>
                                        </tr>
                                        <tr>
                                            <td>DBSPay period / Rate :</td>
                                            <td><input type="text" class="cust-input form-control" name="dbspay_period" value="{{ $liveInterviewData ? $liveInterviewData->dbspay_period : '' }}"/></td>
                                        </tr>
                                        <tr>
                                            <td>COVID vaccination :</td>
                                            <td><input type="text" class="cust-input form-control" name="covid_vaccination" value="{{ $liveInterviewData ? $liveInterviewData->covid_vaccination : '' }}"/></td>
                                        </tr>
                                        <tr>
                                            <td>COVID regular testing :</td>
                                            <td><input type="text" class="cust-input form-control" name="covid_regular_testing" value="{{ $liveInterviewData ? $liveInterviewData->covid_regular_testing : '' }}"/></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"><b>Additional Comments/Questions:</b><br/>Record here any additional Comments/Questions asked in response to the application, or any information shared to the candidate.
                                                (e.g., Holidays, hours, etc.)<br/>
                                            <textarea name="additional_comment" id="v" cols="120" rows="5" class="mt-3 cust-input form-control">{{ $liveInterviewData ? $liveInterviewData->additional_comment : '' }}</textarea></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <div class="mt-4 mb-5">
                                <div>
                                    <p>Note: score is given in between 1 to 3 points which are mentioned below.</p>
                                    <p><b>1 - Below Level Required / Does Not Demonstrate Achievement</b></p>
                                    <p><b>2 - Meets Essential Requirements*</b></p>
                                    <p><b>3 - Exceeds Requirements</b></p>
                                    <p><b>Questions with * minimum requirement is score 2</b></p>
                                </div>
                                <div class="k_table"  style="overflow-x:auto;">
                                    <table border="1">
                                        <tr>
                                            <th>Specification</th>
                                            <th>Details</th>
                                            <th>Score</th>
                                        </tr>
                                        <tr>
                                            <td rowspan="4">1. Personal Specification</td>
                                        </tr>
                                        <tr>
                                            <td>Attitude / Approach / Behaviour*</td>
                                            <td><input type="text" class="cust-input form-control" name="attitude" value="{{ $liveInterviewData ? $liveInterviewData->attitude : '' }}" onkeyup="questionsSum()"/></td>
                                        </tr>
                                        <tr>
                                            <td>Communication* </td>
                                            <td><input type="text" class="cust-input form-control" name="communication" value="{{ $liveInterviewData ? $liveInterviewData->communication : '' }}" onkeyup="questionsSum()"/></td>
                                        </tr>
                                        <tr>
                                            <td>Willing to work in HSC sector. * </td>
                                            <td><input type="text" class="cust-input form-control" name="willing_to_work" value="{{ $liveInterviewData ? $liveInterviewData->willing_to_work : '' }}" onkeyup="questionsSum()"/></td>
                                        </tr>

                                        <tr>
                                            <td rowspan="4">2. Skills / Knowledge / Experience</td>
                                        </tr>
                                        <tr>
                                            <td>Work Experience</td>
                                            <td><input type="text" class="cust-input form-control" name="work_experience" value="{{ $liveInterviewData ? $liveInterviewData->work_experience : '' }}" onkeyup="questionsSum()"/></td>
                                        </tr>
                                        <tr>
                                            <td>Personal / Professional experience (HSC sector) </td>
                                            <td><input type="text" class="cust-input form-control" name="professional_experience" value="{{ $liveInterviewData ? $liveInterviewData->professional_experience : '' }}" onkeyup="questionsSum()"/></td>
                                        </tr>
                                        <tr>
                                            <td>Education/Qualifications </td>
                                            <td><input type="text" class="cust-input form-control" name="education" value="{{ $liveInterviewData ? $liveInterviewData->education : '' }}" onkeyup="questionsSum()"/></td>
                                        </tr>

                                        <tr>
                                            <td>3. English and Math's skill</td>
                                            <td>English & Math's (Basic skill) *</td>
                                            <td><input type="text" class="cust-input form-control" name="english_math_skill" value="{{ $candidate && $candidate->candidateBasicTest && $candidate->candidateBasicTest->total_score ? $candidate->candidateBasicTest->total_score : '' }}"/></td>
                                        </tr>

                                        <tr>
                                            <td colspan="2">4. Interview Questions*: (1: score <= 18) (2: score >18) * (3: score >=30</td>
                                            <td><input type="text" id="interview_question" class="cust-input form-control" name="interview_question" value="{{ $liveInterviewData ? $liveInterviewData->interview_question : '' }}"/></td>
                                        </tr>

                                        <tr>
                                            <td colspan="2"><b>Total Score:<br/>(score >=10 for selection/sort list)</b></td>
                                            <td><input type="text" class="cust-input form-control" id="total_score" name="total_score" value="{{ $liveInterviewData ? $liveInterviewData->total_score : '' }}"/></td>
                                        </tr>

                                        <tr>
                                            <td  colspan="3">
                                                <div class="row mt-3 ms-0">Decision:
                                                    <div class="col-md-2 col-sm-6">
                                                        Accepted : &nbsp;<input type="radio" name="decision_radio" value="accepted" @if($liveInterviewData && $liveInterviewData->decision_radio == 'accepted') checked @endif/>
                                                    </div>
                                                    <div class="col-md-2 col-sm-6">
                                                        Rejected : &nbsp;<input type="radio" name="decision_radio" value="rejected" @if($liveInterviewData && $liveInterviewData->decision_radio == 'rejected') checked @endif/>
                                                    </div>
                                                </div>
                                                <div class="mt-3">Reason: <textarea name="reason" id="v" cols="120" rows="5" class="mt-3 cust-input form-control">{{ $liveInterviewData ? $liveInterviewData->reason : '' }}</textarea></div>
                                            </td>

                                        </tr>

                                        <tr>
                                            <td colspan="3">Details of the person involved in the decision:<br/>
                                            <div class="mt-3"> Name : <input type="text" class="cust-input form-control" name="person_name" value="{{ $liveInterviewData ? $liveInterviewData->person_name : '' }}"/><br></div>
                                            <div class="row mt-3">
                                                <div class="col-6">
                                                    Date : <input type="date" class="border-1 form-control" name="person_date" value="{{ $liveInterviewData ? $liveInterviewData->person_date : '' }}"/>
                                                </div>
                                                <br><br>
                                                <br><br>
                                                <div class="row">
                                                    <!--<div class="col-10"><div class="text">Signature: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="btn btn-secondary waves-effect waves-light" id="clear2">Clear</span></div>
                                                        <div class="sign signbox">
                                                            <div id="signImage-signature" style="width: 450px;height:160px;@if(!$liveInterviewData || $liveInterviewData->signature == null) display:none; @else display:block; @endif">
                                                            <img src="{{$liveInterviewData->signature ?? ''}}" alt="Customer Signature">
                                                            </div>
                                                            <canvas id="serviceNowSign" width="450" height="150" style="@if(!$liveInterviewData || $liveInterviewData->signature == null) display:block; @else display:none; @endif"></canvas>
                                                            <textarea id="signature" name="signature" style="display: none"></textarea>
                                                        </div>
                                                    </div>-->
                                                    @php
                                                        $userData = Auth::user();
                                                    @endphp
                                                    <div class="col-10">
                                                        <div class="text">Signature:</div>
                                                        <div class="sign signbox">
                                                            @if($userData && $userData->signature)
                                                                <div id="signImage-signature" style="width: 450px; height: 160px;">
                                                                    <img width="450" height="160" src="{{ $userData->signature }}" alt="Candidate Signature">
                                                                </div>
                                                            @else
                                                                <div id="noSignatureMessage" style="color: red;">
                                                                    No signature available
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-5">
                    </div>
                    <div class="col-lg-2"><button type="submit" class="btn btn-primary w-md saveCustomer">Submit</button></div>
                        <div class="col-lg-5"></div>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end col -->
</div>
@endsection
@section('script')
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.5.3/signature_pad.min.js"></script>
<script src="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/datepicker/datepicker.min.js') }}"></script>
<script>
    function questionsSum() {
        var attitude = parseFloat($("input[name='attitude']").val()) || 0;
        var communication = parseFloat($("input[name='communication']").val()) || 0;
        var willing_to_work = parseFloat($("input[name='willing_to_work']").val()) || 0;

        var work_experience = parseFloat($("input[name='work_experience']").val()) || 0;
        var professional_experience = parseFloat($("input[name='professional_experience']").val()) || 0;
        var education = parseFloat($("input[name='education']").val()) || 0;

        var english_math_skill = parseFloat($("input[name='english_math_skill']").val()) || 0;
        var interview_question = parseFloat($("input[name='interview_question']").val()) || 0;

        var sum = attitude + communication + willing_to_work + work_experience + professional_experience + education + english_math_skill + interview_question;
        $("#total_score").val(sum);
    }
    function updateSum() {
        // Get the values from the input fields
        var healthCareSector = parseFloat($("input[name='health_care_sector']").val()) || 0;
        var tellMeAboutYourself = parseFloat($("input[name='tell_me_about_yourself']").val()) || 0;
        var domiciliaryCareWork = parseFloat($("input[name='domiciliary_care_work']").val()) || 0;

        var citizenHome = parseFloat($("input[name='citizen_home']").val()) || 0;
        var safe_and_healthy = parseFloat($("input[name='safe_and_healthy']").val()) || 0;
        var privacy_and_dignity = parseFloat($("input[name='privacy_and_dignity']").val()) || 0;

        var effective_team_working = parseFloat($("input[name='effective_team_working']").val()) || 0;
        var knowledge_other = parseFloat($("input[name='knowledge_other']").val()) || 0;
        var data_protection = parseFloat($("input[name='data_protection']").val()) || 0;

        var running_late = parseFloat($("input[name='running_late']").val()) || 0;
        var medication = parseFloat($("input[name='medication']").val()) || 0;

        // Calculate the sum
        var sum = healthCareSector + tellMeAboutYourself + domiciliaryCareWork + citizenHome + safe_and_healthy + privacy_and_dignity + effective_team_working + knowledge_other + data_protection + running_late + medication;

        // Update the value in the interview_question field
        $("#interview_question").val(sum);
        $('#total_score_selection').val(sum);
    }
    $(document).ready(function() {
        var canvas2 = document.getElementById("serviceNowSign");
        var signaturePad2 = new SignaturePad(canvas2, {
            backgroundColor: "white",
            penColor: "black",
            minWidth: 2,
            maxWidth: 4,
        });

        $('#clear2').click(function(e) {
            e.preventDefault();
            signaturePad2.clear();
            $('#signImage-signature').hide();
            $('#serviceNowSign').show();
        });

        $('form').submit(function(e) {
          e.preventDefault();

          var SignDataUrl = signaturePad2.isEmpty() ? null : signaturePad2.toDataURL();
          $('#signature').val(SignDataUrl);

          this.submit();
        });
    });
</script>
@endsection
