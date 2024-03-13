<style>
        .CONFIDENTIAL table{
            width: 100%;
        }

        .CONFIDENTIAL tr, td, th{
            border: 1px solid #000;
            padding: 10px;
        }
        .CONFIDENTIAL .border-0{
            border: 1px solid #000 !important;
            width: 100%;
        }
        .padding-0 tr, td, th{
            padding: 10px;
        }
        .CONFIDENTIAL td{
            border: 1px solid;
        }
        .CONFIDENTIAL th{
            border: 1px solid;
        }
         .CONFIDENTIAL h5 {
            font-size: 20px;
            font-weight: 700;
        }
        .CONFIDENTIAL hr.border-full {
            border: 1px solid;
        }
        .CONFIDENTIAL p {
            font-size: 18px;
            font-weight: 300;
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

@section('title') Professional Reference @endsection

@section('content')

@component('components.breadcrumb')
@slot('li_1') Forms @endslot
@slot('title') Professional Reference @endslot
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
                <form method="post" action="{{route('storeProfessionalReference', ['id' => $candidate->id, 'reference_index' => $reference_index])}}" enctype="multipart/form-data">
                @csrf
                <div class="container CONFIDENTIAL">
                        <div>
                            <div>
                                <h4>PRIVATE & CONFIDENTIAL</h4>
                                <h5>Professional Reference</h5>
                                <span>To : {{$referenceName ?? ''}} </span>
                            </div>
                        </div>

                        <div>
                            <h5>Request for Reference</h5>
                            <hr class="border-full"/>
                            <span><b>Candidate Name : </b>{{$candidate->prefix ?? ''}} {{$candidate->first_name ?? ''}} {{$candidate->last_name ?? ''}}<br>has applied to NDH Care for employment as a Health Care
                                Assistant. has given
                                your name as a referee.</span>
                            <p class="mt-2">The above-mentioned Candidate has given permission to contact you in order to obtain
                                information about
                                their present or prior employment, as well as their educational background. I would appreciate it if you
                                could have a look at the accompanying Job Description for this position and comment on their suitability
                                for this position by responding to this reference request.
                            </p>
                            <p class="mt-2">To meet with the requirements of the Care Quality Commission's criteria, we only hire social
                                care staff after
                                receiving satisfactory references. Please complete the included reference form and return it in the
                                enclosed
                                envelope, stamping the reference with a company/business stamp or attaching headed paper or a compliment
                                slip if possible. Please return by <b>Email</b> or <b>Post</b> using the contact information provided
                                below.</p>

                            <p>
                                Any information that you provide will be treated in the strictest confidence, in line with <b>General Data Protection Regulations</b> and will be delighted to assist you with any future requests.
                            </p>
                            <p>
                                If you need any further information about our company then contact us, contact details as below.
                            </p>
                            <div class="row">
                                <div class="col-4">
                                    <span>Tel: 0116 30 90 111</span>
                                </div>
                                <div class="col-4">
                                    <span>Email: hr@ndhcare.co.uk</span>
                                </div>
                                <div class="col-4">
                                    <span>website: www.ndhcare.co.uk</span>
                                </div>
                            </div>
                            <br/>
                            <div class="row">
                                <div class="col-4">

                                </div>
                                <div class="col-4">

                                </div>
                                <div class="col-4 text-end">
                                    <span>Yours sincerely,</span><br/>
                                    <span>NDH Care Ltd</span><br/>
                                    <span>Recruitment Team</span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-3">
                            <h5>Candidate Details</h5>
                            <div>
                                <table border="1">
                                    <tr>
                                        <td>Candidate Name:</td>
                                        <td><input type="text" class="border-0 form-control" name="candidate_name" value="{{ $professionalReference ? $professionalReference->candidate_name : '' }}"></td>
                                    </tr>
                                    <tr>
                                        <td>Date of Birth: </td>
                                        <td><input type="date" class="border-0 form-control" name="date_of_birth" value="{{ $professionalReference ? $professionalReference->date_of_birth : '' }}"></td>
                                    </tr>
                                    <tr>
                                        <td>Currently working:</td>
                                        <td><input type="text" class="border-0 form-control" name="currently_working" value="{{ $professionalReference ? $professionalReference->currently_working : '' }}"></td>
                                    </tr>
                                    <tr>
                                        <td>Employment start date: </td>
                                        <td><input type="date" class="border-0 form-control" name="employment_start_date" value="{{ $professionalReference ? $professionalReference->employment_start_date : '' }}"></td>
                                    </tr>
                                    <tr>
                                        <td>Employment end date: </td>
                                        <td><input type="date" class="border-0 form-control" name="employment_end_date" value="{{ $professionalReference ? $professionalReference->employment_end_date : '' }}"></td>
                                    </tr>
                                    <tr>
                                        <td>Position held and duties: </td>
                                        <td><input type="text" class="border-0 form-control" name="position_held_duties" value="{{ $professionalReference ? $professionalReference->position_held_duties : '' }}"></td>
                                    </tr>
                                    <tr>
                                        <td>Reason for leaving job?</td>
                                        <td><input type="text" class="border-0 form-control" name="reason_for_leaving" value="{{ $professionalReference ? $professionalReference->reason_for_leaving : '' }}"></td>
                                    </tr>
                                    <tr>
                                        <td>How long have you known the candidate? </td>
                                        <td><input type="date" class="border-0 form-control" name="known_candidate" value="{{ $professionalReference ? $professionalReference->known_candidate : '' }}"></td>
                                    </tr>
                                    <tr>
                                        <td>Number of days absent in the last 12 months: </td>
                                        <td><input type="text" class="border-0 form-control" name="days_absent" value="{{ $professionalReference ? $professionalReference->days_absent : '' }}"></td>
                                    </tr>
                                    <tr>
                                        <td>Would you re-employ? </td>
                                        <td><input type="text" class="border-0 form-control" name="re_employ" value="{{ $professionalReference ? $professionalReference->re_employ : '' }}"></td>
                                    </tr>
                                    <tr>
                                        <td>Would you consider the applicant suitable for the position? </td>
                                        <td><input type="text" class="border-0 form-control" name="consider_applicant" value="{{ $professionalReference ? $professionalReference->consider_applicant : '' }}"></td>
                                    </tr>
                                    <tr>
                                        <td>Reason: </td>
                                        <td><input type="text" class="border-0 form-control" name="reason" value="{{ $professionalReference ? $professionalReference->reason : '' }}"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Is there any reason why the applicant should not be employed by NDH Care Ltd?  </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><textarea class="border-0 form-control" name="applicant_not_employed">{{ $professionalReference ? $professionalReference->applicant_not_employed : '' }}</textarea></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Any other comments? </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><textarea class="border-0 form-control" name="other_comment">{{ $professionalReference ? $professionalReference->other_comment : '' }}</textarea></td>
                                    </tr>
                                </table>
                            </div>


                            <br/>
                            <div>
                                <table border="1" class="padding-0">
                                    <tr>
                                        <th>Criteria:<br/> Assign X to the applicant performance</th>
                                        <th><img src="{{asset('assets/images/1.png')}}"/></th>
                                        <th><img src="{{asset('assets/images/2.png')}}"/></th>
                                        <th><img src="{{asset('assets/images/3.png')}}"/></th>
                                        <th>Unable to
                                            comment</th>
                                    </tr>
                                    <tr>
                                        <td>Dignity and respect</td>
                                        <td><input type="checkbox" class="border-0" name="dignity_respect_1" @if($professionalReference && $professionalReference->dignity_respect_1 == 'on') checked @endif></td>
                                        <td><input type="checkbox" class="border-0" name="dignity_respect_2" @if($professionalReference && $professionalReference->dignity_respect_2 == 'on') checked @endif></td>
                                        <td><input type="checkbox" class="border-0" name="dignity_respect_3" @if($professionalReference && $professionalReference->dignity_respect_3 == 'on') checked @endif></td>
                                        <td><input type="text" class="border-0 form-control" name="dignity_respect" value="{{ $professionalReference ? $professionalReference->dignity_respect : '' }}"></td>
                                    </tr>
                                    <tr>
                                        <td>Compassion, empathy, ability to empower others</td>
                                        <td><input type="checkbox" class="border-0" name="empathy_ability_1" @if($professionalReference && $professionalReference->empathy_ability_1 == 'on') checked @endif></td>
                                        <td><input type="checkbox" class="border-0" name="empathy_ability_2" @if($professionalReference && $professionalReference->empathy_ability_2 == 'on') checked @endif></td>
                                        <td><input type="checkbox" class="border-0" name="empathy_ability_3" @if($professionalReference && $professionalReference->empathy_ability_3 == 'on') checked @endif></td>
                                        <td><input type="text" class="border-0 form-control" name="empathy_ability" value="{{ $professionalReference ? $professionalReference->empathy_ability : '' }}"></td>
                                    </tr>
                                    <tr>
                                        <td>Motivation, commitment and attitude to work</td>
                                        <td><input type="checkbox" class="border-0" name="commitment_attitude_1" @if($professionalReference && $professionalReference->commitment_attitude_1 == 'on') checked @endif></td>
                                        <td><input type="checkbox" class="border-0" name="commitment_attitude_2" @if($professionalReference && $professionalReference->commitment_attitude_2 == 'on') checked @endif></td>
                                        <td><input type="checkbox" class="border-0" name="commitment_attitude_3" @if($professionalReference && $professionalReference->commitment_attitude_3 == 'on') checked @endif></td>
                                        <td><input type="text" class="border-0 form-control" name="commitment_attitude" value="{{ $professionalReference ? $professionalReference->commitment_attitude : '' }}"></td>
                                    </tr>
                                    <tr>
                                        <td>Learning and development interest</td>
                                        <td><input type="checkbox" class="border-0" name="development_interest_1" @if($professionalReference && $professionalReference->development_interest_1 == 'on') checked @endif></td>
                                        <td><input type="checkbox" class="border-0" name="development_interest_2" @if($professionalReference && $professionalReference->development_interest_2 == 'on') checked @endif></td>
                                        <td><input type="checkbox" class="border-0" name="development_interest_3" @if($professionalReference && $professionalReference->development_interest_3 == 'on') checked @endif></td>
                                        <td><input type="text" class="border-0 form-control" name="development_interest" value="{{ $professionalReference ? $professionalReference->development_interest : '' }}"></td>
                                    </tr>
                                    <tr>
                                        <td>Team working ability</td>
                                        <td><input type="checkbox" class="border-0" name="team_working_1" @if($professionalReference && $professionalReference->team_working_1 == 'on') checked @endif></td>
                                        <td><input type="checkbox" class="border-0" name="team_working_2" @if($professionalReference && $professionalReference->team_working_2 == 'on') checked @endif></td>
                                        <td><input type="checkbox" class="border-0" name="team_working_3" @if($professionalReference && $professionalReference->team_working_3 == 'on') checked @endif></td>
                                        <td><input type="text" class="border-0 form-control" name="team_working" value="{{ $professionalReference ? $professionalReference->team_working : '' }}"></td>
                                    </tr>
                                    <tr>
                                        <td>Ability to work on own initiative</td>
                                        <td><input type="checkbox" class="border-0" name="work_initiative_1" @if($professionalReference && $professionalReference->work_initiative_1 == 'on') checked @endif></td>
                                        <td><input type="checkbox" class="border-0" name="work_initiative_2" @if($professionalReference && $professionalReference->work_initiative_2 == 'on') checked @endif></td>
                                        <td><input type="checkbox" class="border-0" name="work_initiative_3" @if($professionalReference && $professionalReference->work_initiative_3 == 'on') checked @endif></td>
                                        <td><input type="text" class="border-0 form-control" name="work_initiative" value="{{ $professionalReference ? $professionalReference->work_initiative : '' }}"></td>
                                    </tr>
                                    <tr>
                                        <td>Reliability</td>
                                        <td><input type="checkbox" class="border-0" name="reliability_1" @if($professionalReference && $professionalReference->reliability_1 == 'on') checked @endif></td>
                                        <td><input type="checkbox" class="border-0" name="reliability_2" @if($professionalReference && $professionalReference->reliability_2 == 'on') checked @endif></td>
                                        <td><input type="checkbox" class="border-0" name="reliability_3" @if($professionalReference && $professionalReference->reliability_3 == 'on') checked @endif></td>
                                        <td><input type="text" class="border-0 form-control" name="reliability" value="{{ $professionalReference ? $professionalReference->reliability : '' }}"></td>
                                    </tr>
                                    <tr>
                                        <td>Employee Conduct in the Workplace</td>
                                        <td><input type="checkbox" class="border-0" name="conduct_workplace_1" @if($professionalReference && $professionalReference->conduct_workplace_1 == 'on') checked @endif></td>
                                        <td><input type="checkbox" class="border-0" name="conduct_workplace_2" @if($professionalReference && $professionalReference->conduct_workplace_2 == 'on') checked @endif></td>
                                        <td><input type="checkbox" class="border-0" name="conduct_workplace_3" @if($professionalReference && $professionalReference->conduct_workplace_3 == 'on') checked @endif></td>
                                        <td><input type="text" class="border-0 form-control" name="conduct_workplace" value="{{ $professionalReference ? $professionalReference->conduct_workplace : '' }}"></td>
                                    </tr>
                                    <tr>
                                        <td>Time punctuality</td>
                                        <td><input type="checkbox" class="border-0" name="punctuality_1" @if($professionalReference && $professionalReference->punctuality_1 == 'on') checked @endif></td>
                                        <td><input type="checkbox" class="border-0" name="punctuality_2" @if($professionalReference && $professionalReference->punctuality_2 == 'on') checked @endif></td>
                                        <td><input type="checkbox" class="border-0" name="punctuality_3" @if($professionalReference && $professionalReference->punctuality_3 == 'on') checked @endif></td>
                                        <td><input type="text" class="border-0 form-control" name="punctuality" value="{{ $professionalReference ? $professionalReference->punctuality : '' }}"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">Did you find the applicant honest and trustworthy? (Yes / No)</td>
                                        <td><input type="text" class="border-0 form-control" name="trustworthy" value="{{ $professionalReference ? $professionalReference->trustworthy : '' }}"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">Did you find the candidate to be reliable in carrying out his / her duties? (Yes / No)</td>
                                        <td><input type="text" class="border-0 form-control" name="reliable_carrying" value="{{ $professionalReference ? $professionalReference->reliable_carrying : '' }}"></td>
                                    </tr>
                                </table>
                            </div>
                        </div>


                        <div class="mt-3">
                            <h5>Referee (your) details</h5>
                            <div>
                                <table border="1">
                                    <tr>
                                        <td>Referee Name:</td>
                                        <td><input type="text" class="border-0 form-control" name="reference_name" value="{{ $professionalReference ? $professionalReference->reference_name : '' }}"></td>
                                    </tr>
                                    <tr>
                                        <td>Position: </td>
                                        <td><input type="text" class="border-0 form-control" name="position" value="{{ $professionalReference ? $professionalReference->position : '' }}"></td>
                                    </tr>
                                    <tr>
                                        <td>Company Name:</td>
                                        <td><input type="text" class="border-0 form-control" name="company_name" value="{{ $professionalReference ? $professionalReference->company_name : '' }}"></td>
                                    </tr>
                                    <tr>
                                        <td>Telephone Number: </td>
                                        <td><input type="number" min="0" class="border-0 form-control" name="telephone_number" value="{{ $professionalReference ? $professionalReference->telephone_number : '' }}"></td>
                                    </tr>
                                    <tr>
                                        <td>Email Address: </td>
                                        <td><input type="email" class="border-0 form-control" name="email_address" value="{{ $professionalReference ? $professionalReference->email_address : '' }}"></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <div class="col-2">Date:</div>
                                                <div class="col-10"><input type="date" class="border-0 form-control" name="reference_date" value="{{ $professionalReference ? $professionalReference->reference_date : '' }}"></div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col-10"><div class="text">Signature: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="btn btn-secondary waves-effect waves-light" id="clear2">Clear</span></div>
                                                    <div class="sign signbox">
                                                        <div id="signImage-signature" style="width: 450px;height:160px;@if(!$professionalReference || $professionalReference->signature == null) display:none; @else display:block; @endif">
                                                        <img width="450" height="160" src="{{$professionalReference->signature ?? ''}}" alt="Customer Signature">
                                                        </div>
                                                        <canvas id="serviceNowSign" width="450" height="150" style="@if(!$professionalReference || $professionalReference->signature == null) display:block; @else display:none; @endif"></canvas>
                                                        <textarea id="signature" name="signature" style="display: none"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        @if($is_public)
                        <br>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Document Type</label>
                                    <select class="form-control form-select" name="document_type" id="document_type">
                                        <option value="Office Id Card" {{ $professionalReference && $professionalReference->document_type == 'Office Id Card' ? 'selected' : '' }}>Office Id Card</option>
                                        <option value="Pay Slip" {{ $professionalReference && $professionalReference->document_type == 'Pay Slip' ? 'selected' : '' }}>Pay Slip</option>
                                        <option value="Other" {{ $professionalReference && $professionalReference->document_type == 'Other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="document_name_row" style="@if ($professionalReference && $professionalReference->document_type == 'Other') display:block; @else display:none; @endif">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Document Name</label>
                                    <input type="text" class="form-control" name="document_name" value="{{$professionalReference->document_name ?? ''}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mt-3">
                                    <label for="formFile" class="form-label">File Upload</label>
                                    <input class="form-control" name="document_path" type="file" id="document_path" accept=".pdf,.jpg,.jpeg,.png,.doc" required>
                                </div>
                            </div>
                        </div>
                        @if ($professionalReference && $professionalReference->document_path)
                            <div class="file-item">
                                <i class="fas fa-file-pdf"></i>
                                <a href="{{ $professionalReference->document_path }}" target="_blank">{{ basename($professionalReference->document_path) }}</a>
                            </div>
                            <br>
                        @endif
                        @endif
                        <div class="mt-3">
                            <span><b>Important : </b> If you are submitting this form via personal email (such as
                                Gmail, Yahoo, Outlook, Hotmail, etc.), please ensure that the reference
                                is stamped with a company/business stamp or that you attach a headed
                                paper, experience letter, ID card, visiting card, or a compliment slip, if
                                possible. This will help to verify your submission.
                            </span>
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
    $(document).ready(function() {
        $('#document_type').on('change', function () {
            if ($(this).val() === 'Other') {
                $('#document_name_row').show();
            } else {
                $('#document_name_row').hide();
            }
        });
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
