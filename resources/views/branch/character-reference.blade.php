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
            border: 1px solid black;
        }
    </style>

@extends('layouts.master')

@section('title') Character Reference @endsection

@section('content')

@component('components.breadcrumb')
@slot('li_1') Forms @endslot
@slot('title') Character Reference @endslot
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
                <form method="post" action="{{route('storeCharacterReference', ['id' => $candidate->id, 'reference_index' => $reference_index])}}" enctype="multipart/form-data">
                @csrf
                <div class="container CONFIDENTIAL">
                        <div>
                            <div>
                                <h4>PRIVATE & CONFIDENTIAL</h4>
                                <h5>Character Referencee</h5>
                                <span>To : {{$referenceName ?? ''}}</span>
                            </div>
                        </div>

                        <div>
                            <h5>Request for Reference</h5>
                             <hr class="border-full"/>
                            <span><b>Candidate Name : </b>{{$candidate->prefix ?? ''}} {{$candidate->first_name ?? ''}} {{$candidate->last_name ?? ''}}<br>has applied to NDH Care for employment as a Health Care Assistant. has given
                                your name as a referee.</span>
                            <p class="mt-2">The above-mentioned Candidate has given permission to contact you in order to obtain information about
                                their personal attributes / their educational background. I would appreciate it if you could have a look at the
                                accompanying Job Description for this position and comment on their suitability for this position by
                                responding to this reference request.
                            </p>
                            <p class="mt-2">To meet with the requirements of the Care Quality Commission's criteria, we only hire social care staff after
                                receiving satisfactory references. Please complete the included reference form and return it in the enclosed
                                envelope, stamping the reference with a company/business stamp or attaching headed paper or a compliment
                                slip if possible. Please return by <b>Email</b> or <b>Post</b> using the contact information provided below.</p>

                            <p>
                                Any information that you provide will be treated in the strictest confidence, in line with <b>General Data Protection Regulations</b> and will be delighted to assist you with any future requests.
                            </p>
                            <p>
                                If you need any further information about our company then contact us, contact details as below.
                            </p>
                            <div class="row">
                                <div class="col-4">
                                    <span>Tel:  0121 448 05681</span>
                                </div>
                                <div class="col-4">
                                    <span>Email: reference@ndhcare.co.uk</span>
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
                            <span><b>Candidate Name : </b> {{$candidate->prefix ?? ''}} {{$candidate->first_name ?? ''}} {{$candidate->last_name ?? ''}}</span><br>
                            <span><b>Date of Birth : </b> {{$candidate->dob ?? ''}}</span><br>
                            <span><b>Relation with Candidate : </b> <input type="text" class="form-control" name="ralation_with_candidate" value="{{ $characterReference ? $characterReference->ralation_with_candidate : '' }}"></span><br>
                            <span><b>How long have you known the candidate? </b><input type="text" class="form-control" name="know_the_candidate" value="{{ $characterReference ? $characterReference->know_the_candidate : '' }}"></span><br>
                            <h4><b>Please confirm the following information:</b><h4>
                            <div>
                                <table border="1">
                                    <tr>
                                        <td>Are there any reasons you feel the applicant is not suitable to work in health and social care?</td>
                                    </tr>
                                    <tr>
                                        <td><input type="text" class="border-0 form-control" name="social_care" value="{{ $characterReference ? $characterReference->social_care : '' }}"></td>
                                    </tr>
                                    <tr>
                                        <td>What characteristics and attributes do you feel this person could bring to the health and social care
                                            industry?
                                            </td>
                                    </tr>
                                    <tr>
                                        <td><input type="text" class="border-0 form-control" name="health_care_industry" value="{{ $characterReference ? $characterReference->health_care_industry : '' }}"></td>
                                    </tr>
                                    <tr>
                                        <td>Is there any further information that you feel is relevant to the applicants’ suitability to work in this
                                            capacity?
                                             </td>
                                    </tr>
                                    <tr>
                                        <td><input type="text" class="border-0 form-control" name="suitability_capacity" value="{{ $characterReference ? $characterReference->suitability_capacity : '' }}"></td>
                                    </tr>
                                    <tr>
                                        <td>Please provide any comments about candidates’ attitude / Behaviour.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><input type="text" class="border-0 form-control" name="candidates_attitude" value="{{ $characterReference ? $characterReference->candidates_attitude : '' }}"></td>
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
                                        <td><input type="checkbox" class="border-0" name="dignity_respect_1" @if($characterReference && $characterReference->dignity_respect_1 == 'on') checked @endif></td>
                                        <td><input type="checkbox" class="border-0" name="dignity_respect_2" @if($characterReference && $characterReference->dignity_respect_2 == 'on') checked @endif></td>
                                        <td><input type="checkbox" class="border-0" name="dignity_respect_3" @if($characterReference && $characterReference->dignity_respect_3 == 'on') checked @endif></td>
                                        <td><input type="text" class="border-0 form-control" name="dignity_respect" value="{{ $characterReference ? $characterReference->dignity_respect : '' }}"></td>
                                    </tr>
                                    <tr>
                                        <td>Compassion, empathy, ability to empower others</td>
                                        <td><input type="checkbox" class="border-0" name="empower_others_1" @if($characterReference && $characterReference->empower_others_1 == 'on') checked @endif></td>
                                        <td><input type="checkbox" class="border-0" name="empower_others_2" @if($characterReference && $characterReference->empower_others_2 == 'on') checked @endif></td>
                                        <td><input type="checkbox" class="border-0" name="empower_others_3" @if($characterReference && $characterReference->empower_others_3 == 'on') checked @endif></td>
                                        <td><input type="text" class="border-0 form-control" name="empower_others" value="{{ $characterReference ? $characterReference->empower_others : '' }}"></td>
                                    </tr>
                                    <tr>
                                        <td>Motivation, commitment and attitude to work</td>
                                        <td><input type="checkbox" class="border-0" name="commitment_work_1" @if($characterReference && $characterReference->commitment_work_1 == 'on') checked @endif></td>
                                        <td><input type="checkbox" class="border-0" name="commitment_work_2" @if($characterReference && $characterReference->commitment_work_2 == 'on') checked @endif></td>
                                        <td><input type="checkbox" class="border-0" name="commitment_work_3" @if($characterReference && $characterReference->commitment_work_3 == 'on') checked @endif></td>
                                        <td><input type="text" class="border-0 form-control" name="commitment_work" value="{{ $characterReference ? $characterReference->commitment_work : '' }}"></td>
                                    </tr>
                                    <tr>
                                        <td>Learning and development interest</td>
                                        <td><input type="checkbox" class="border-0" name="development_interest_1" @if($characterReference && $characterReference->development_interest_1 == 'on') checked @endif></td>
                                        <td><input type="checkbox" class="border-0" name="development_interest_2" @if($characterReference && $characterReference->development_interest_2 == 'on') checked @endif></td>
                                        <td><input type="checkbox" class="border-0" name="development_interest_3" @if($characterReference && $characterReference->development_interest_3 == 'on') checked @endif></td>
                                        <td><input type="text" class="border-0 form-control" name="development_interest" value="{{ $characterReference ? $characterReference->development_interest : '' }}"></td>
                                    </tr>
                                    <tr>
                                        <td>Team working ability</td>
                                        <td><input type="checkbox" class="border-0" name="working_ability_1" @if($characterReference && $characterReference->working_ability_1 == 'on') checked @endif></td>
                                        <td><input type="checkbox" class="border-0" name="working_ability_2" @if($characterReference && $characterReference->working_ability_2 == 'on') checked @endif></td>
                                        <td><input type="checkbox" class="border-0" name="working_ability_3" @if($characterReference && $characterReference->working_ability_3 == 'on') checked @endif></td>
                                        <td><input type="text" class="border-0 form-control" name="working_ability" value="{{ $characterReference ? $characterReference->working_ability : '' }}"></td>
                                    </tr>
                                    <tr>
                                        <td>Ability to work on own initiative</td>
                                        <td><input type="checkbox" class="border-0" name="work_initiative_1" @if($characterReference && $characterReference->work_initiative_1 == 'on') checked @endif></td>
                                        <td><input type="checkbox" class="border-0" name="work_initiative_2" @if($characterReference && $characterReference->work_initiative_2 == 'on') checked @endif></td>
                                        <td><input type="checkbox" class="border-0" name="work_initiative_3" @if($characterReference && $characterReference->work_initiative_3 == 'on') checked @endif></td>
                                        <td><input type="text" class="border-0 form-control" name="work_initiative" value="{{ $characterReference ? $characterReference->work_initiative : '' }}"></td>
                                    </tr>
                                    <tr>
                                        <td>Reliability</td>
                                        <td><input type="checkbox" class="border-0" name="reliability_1" @if($characterReference && $characterReference->reliability_1 == 'on') checked @endif></td>
                                        <td><input type="checkbox" class="border-0" name="reliability_2" @if($characterReference && $characterReference->reliability_2 == 'on') checked @endif></td>
                                        <td><input type="checkbox" class="border-0" name="reliability_3" @if($characterReference && $characterReference->reliability_3 == 'on') checked @endif></td>
                                        <td><input type="text" class="border-0 form-control" name="reliability" value="{{ $characterReference ? $characterReference->reliability : '' }}"></td>
                                    </tr>
                                    <tr>
                                        <td>Employee Conduct in the Workplace</td>
                                        <td><input type="checkbox" class="border-0" name="employee_conduct_1" @if($characterReference && $characterReference->employee_conduct_1 == 'on') checked @endif></td>
                                        <td><input type="checkbox" class="border-0" name="employee_conduct_2" @if($characterReference && $characterReference->employee_conduct_2 == 'on') checked @endif></td>
                                        <td><input type="checkbox" class="border-0" name="employee_conduct_3" @if($characterReference && $characterReference->employee_conduct_3 == 'on') checked @endif></td>
                                        <td><input type="text" class="border-0 form-control" name="employee_conduct" value="{{ $characterReference ? $characterReference->employee_conduct : '' }}"></td>
                                    </tr>
                                    <tr>
                                        <td>Time punctuality</td>
                                        <td><input type="checkbox" class="border-0" name="time_punctuality_1" @if($characterReference && $characterReference->time_punctuality_1 == 'on') checked @endif></td>
                                        <td><input type="checkbox" class="border-0" name="time_punctuality_2" @if($characterReference && $characterReference->time_punctuality_2 == 'on') checked @endif></td>
                                        <td><input type="checkbox" class="border-0" name="time_punctuality_3" @if($characterReference && $characterReference->time_punctuality_3 == 'on') checked @endif></td>
                                        <td><input type="text" class="border-0 form-control" name="time_punctuality" value="{{ $characterReference ? $characterReference->time_punctuality : '' }}"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">Did you find the applicant honest and trustworthy? (Yes / No)</td>
                                        <td><input type="text" class="border-0 form-control" name="honest_trustworthy" value="{{ $characterReference ? $characterReference->honest_trustworthy : '' }}"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">Did you find the candidate to be reliable in carrying out his / her duties? (Yes / No)</td>
                                        <td><input type="text" class="border-0 form-control" name="reliable_carrying" value="{{ $characterReference ? $characterReference->reliable_carrying : '' }}"></td>
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
                                        <td><input type="text" class="border-0 form-control" name="reference_name" value="{{ $characterReference ? $characterReference->reference_name : '' }}"></td>
                                    </tr>
                                    <tr>
                                        <td>Position: </td>
                                        <td><input type="text" class="border-0 form-control" name="position" value="{{ $characterReference ? $characterReference->position : '' }}"></td>
                                    </tr>
                                    <tr>
                                        <td>Company Name:</td>
                                        <td><input type="text" class="border-0 form-control" name="company_name" value="{{ $characterReference ? $characterReference->company_name : '' }}"></td>
                                    </tr>
                                    <tr>
                                        <td>Telephone Number: </td>
                                        <td><input type="number" min="0" class="border-0 form-control" name="telephone_number" value="{{ $characterReference ? $characterReference->telephone_number : '' }}"></td>
                                    </tr>
                                    <tr>
                                        <td>Email Address: </td>
                                        <td><input type="email" class="border-0 form-control" name="email_address" value="{{ $characterReference ? $characterReference->email_address : '' }}"></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <div class="col-2">Date:</div>
                                                <div class="col-10"><input type="date" class="border-0 form-control" name="reference_date" value="{{ $characterReference ? $characterReference->reference_date : '' }}"></div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col-10"><div class="text">Signature: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="btn btn-secondary waves-effect waves-light" id="clear2">Clear</span></div>
                                                    <div class="sign signbox">
                                                        <div id="signImage-signature" style="width: 450px;height:160px;@if(!$characterReference || $characterReference->signature == null) display:none; @else display:block; @endif">
                                                        <img src="{{$characterReference->signature ?? ''}}" alt="Customer Signature">
                                                        </div>
                                                        <canvas id="serviceNowSign" width="450" height="150" style="@if(!$characterReference || $characterReference->signature == null) display:block; @else display:none; @endif"></canvas>
                                                        <textarea id="signature" name="signature" style="display: none"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                </table>
                            </div>
                        </div>
                        @if ($is_public)
                        <br>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Document Type</label>
                                    <select class="form-control form-select" name="document_type" id="document_type">
                                        <option value="Office Id Card" {{ $characterReference && $characterReference->document_type == 'Office Id Card' ? 'selected' : '' }}>Office Id Card</option>
                                        <option value="Pay Slip" {{ $characterReference && $characterReference->document_type == 'Pay Slip' ? 'selected' : '' }}>Pay Slip</option>
                                        <option value="Other" {{ $characterReference && $characterReference->document_type == 'Other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="document_name_row" style="@if ($characterReference && $characterReference->document_type == 'Other') display:block; @else display:none; @endif">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Document Name</label>
                                    <input type="text" class="form-control" name="document_name" value="{{$characterReference->document_name ?? ''}}">
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
                        @if ($characterReference && $characterReference->document_path)
                            <div class="file-item">
                                <i class="fas fa-file-pdf"></i>
                                <a href="{{ $characterReference->document_path }}" target="_blank">{{ basename($characterReference->document_path) }}</a>
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
