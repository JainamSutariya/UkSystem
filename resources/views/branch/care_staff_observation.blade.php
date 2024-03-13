<style>
.container{

}
        .border-1 {
            border: 1px solid #000;
            padding: 20px;
        }

        .border-bottom input {
    border: 1px solid!important;
    border-top: transparent !important;
    border-left: transparent !important;
    border-right: transparent !important;
}
        .table-t {
            width: 100%;
        }

        tr,
        td {
            border: 1px solid #000 !important;
            padding: 5px !important;
        }

        th {
            border: 1px solid #000 !important;
            padding: 10px!important;
        }
        .text-width{
            width: 100%;
        }
        .border-q{
            border-bottom: 1px solid #000 !important;
                margin-bottom: 18px;
    padding-bottom: 10px;
        }
        .font h6 {
    font-size: 18px;
}
.font p {
    font-size: 17px;
}
ul, li {
    font-size: 17px;
}
#payNowSign{
    /*width: 100% !important;*/
    /*height: 44px;*/
    background: #FBFAE2;
    border: 1px solid black;
}
#carerNowSign{
    /*width: 100% !important;*/
    /*height: 44px;*/
    background: #FBFAE2;
    border: 1px solid black;
}
#signImage{
    width: 100% !important;
    height: 44px;
    border: 1px solid black;
}
#signImage-signature {
    height: 44px;
    border: 0px solid black;
}


@media only screen and (max-width: 600px) {
  .margin_left {
    margin-left: 0;
}
input[type="text"] {
    width: 100%;
}
input[type="checkbox"] {
    margin-top: 8px;
}
.size-set img {
    width: 100%;
}
.col-2.clo-sm-6 {
    width: 50%;
}
.col-6.mobile-set {
    width: 100%;
}
.col-6.mobile-set img {
    width: 100%;
}
.col-6.border-bottom {
    width: 100%;
}
div#signImage {
    margin-top: 10px;
}
canvas#payNowSign {
    width: 100%;
    margin-top: 12px;
}
canvas#carerNowSign {
    width: 100%;
    margin-bottom: 13px;
}
}



    </style>

@extends('layouts.master')

@section('title') Care Staff Observation @endsection

@section('content')

@component('components.breadcrumb')
@slot('li_1') Forms @endslot
@slot('title') Care Staff Observation @endslot
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
                <form method="post" action="{{route('storeCareStaff')}}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="candidate_id" value="{{$candidate->id}}">
                <input type="hidden" name="formNumber" value="{{$formNumber?? ''}}">
                 <div class=" font container">
                    @if (Auth::user()->role == 'Branch' && !empty($candidate->how_many_form) && $candidate->how_many_form > 0)
                    <div class="row">
                        @for ($i = 1; $i <= $candidate->how_many_form; $i++)
                            <div class="col-2"><a href="{{ route('careStaffObservation', ['formNumber' => $i, 'id' => $candidate->id]) }}" class="btn btn-primary w-md">Shadowing Form {{ $i }}</a></div>
                        @endfor
                    </div>
                    <br>
                    @endif
                    <div>
                        <div class="row flex-end">
                            <div class="col-6">
                                <h6>Carer Name : {{$candidate->first_name}} {{$candidate->last_name}}</h6>
                            </div>
                            <div class="col-6" id="datepicker1">
                                <h6>Date : <input type="text" name="form_date" value="{{ old('form_date', $formDataArray['form_date'] ?? '') }}" placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd" data-date-container='#datepicker1' data-provide="datepicker" autocomplete="off"></h6>
                            </div>
                            <div class="col-6">
                                <h6>Citizen Name : <input type="text" name="citizen_name" value="{{ old('citizen_name', $formDataArray['citizen_name'] ?? '') }}"></h6>
                            </div>
                            <div class="col-6">
                                <h6>Post Code : <input type="text" name="post_code" value="{{ old('post_code', $formDataArray['post_code'] ?? '') }}"></h6>
                            </div>
                        </div>
                    </div>

                    <div class="border-1 mt-4">
                        <div>
                            <div>
                                <p> I , {{$candidate->first_name}} {{$candidate->last_name}}</p>
                                <h5>Have confirmed that :</h5>
                            </div>
                            <div>
                                <ul>
                                    <li>
                                        <div class="row">
                                            <div class="col-8">have completed required training to provide care service.</div>
                                            <div class="col-4"><input type="checkbox" name="0_checkbox" {{ (old('0_checkbox', $formDataArray['0_checkbox'] ?? '') == 'on') ? 'checked' : '' }}></div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="row">
                                            <div class="col-8">I have read and understand care/support plan. </div>
                                            <div class="col-4"><input type="checkbox" name="1_checkbox" {{ (old('1_checkbox', $formDataArray['1_checkbox'] ?? '') == 'on') ? 'checked' : '' }}></div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="row">
                                            <div class="col-8">I have read manual handling risk assessment and able to follow.</div>
                                            <div class="col-4"><input type="checkbox" name="2_checkbox" {{ (old('2_checkbox', $formDataArray['2_checkbox'] ?? '') == 'on') ? 'checked' : '' }}></div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="row">
                                            <div class="col-8">I can communicate with citizen.</div>
                                            <div class="col-4"><input type="checkbox" name="3_checkbox" {{ (old('3_checkbox', $formDataArray['3_checkbox'] ?? '') == 'on') ? 'checked' : '' }}></div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="row">
                                            <div class="col-8">I can understand citizen’s daily needs and choice.</div>
                                            <div class="col-4"><input type="checkbox" name="4_checkbox" {{ (old('4_checkbox', $formDataArray['4_checkbox'] ?? '') == 'on') ? 'checked' : '' }}></div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="row">
                                            <div class="col-8">I can prompt medication from blister pack.</div>
                                            <div class="col-4"><input type="checkbox" name="5_checkbox" {{ (old('5_checkbox', $formDataArray['5_checkbox'] ?? '') == 'on') ? 'checked' : '' }}></div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="row">
                                            <div class="col-8">I can write in daily communication sheet and MAR chart.</div>
                                            <div class="col-4"><input type="checkbox" name="6_checkbox" {{ (old('6_checkbox', $formDataArray['6_checkbox'] ?? '') == 'on') ? 'checked' : '' }}></div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div>
                                <div class="row">
                                    <div class="col-2 clo-sm-6">
                                        <h5>Carer Signature:</h5>
                                    </div>
                                    <div class="col-6 border-bottom">
                                        @if(!isset($formDataArray['carerNowSigned']))
                                        <span class="btn btn-secondary waves-effect waves-light" id="carerNowClear">Clear</span>
                                        @endif
                                        <div class="sign signbox">
                                            @if(isset($formDataArray['carerNowSigned']))
                                            <div id="signImage" style="width: 450px;height:150px;" class="size-set">
                                                <img src="{{ $formDataArray['carerNowSigned'] }}" alt="Customer Signature">
                                            </div>
                                            @else
                                            <canvas id="carerNowSign" width="450" height="150"></canvas>
                                            <textarea id="carerNowSignatureBox" name="carerNowSigned" style="display: none"></textarea>
                                            @endif
                                        </div>
                                    </div>
                                    <!--<div class="col-10 border-bottom">
                                        <div class="text">Signature:</div>
                                        <div class="sign signbox">
                                            @if($candidate && $candidate->signature)
                                                <div id="signImage-signature" style="width: 460px; height: 160px;">
                                                    <img src="{{ $candidate->signature }}" alt="Candidate Signature">
                                                </div>
                                            @else
                                                <div id="noSignatureMessage" style="color: red;">
                                                    No signature available
                                                </div>
                                            @endif
                                        </div>
                                    </div>-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="  mt-4">
                        <div class="row flex-end border-q">
                            <div class="col-6">
                                <h6>Name of Supervisor/Shadower : <input type="text" name="name_of_shadower" value="{{ $formDataArray['name_of_shadower'] ?? '' }}"></h6>
                            </div>
                            <div class="col-6">
                                <h6>Job Title : <input type="text" name="job_title" value="{{ $formDataArray['job_title'] ?? '' }}"></h6>
                            </div>


                        </div>
                        <p>
                                I have confirmed that, I explain to care staff about citizen physical, mental condition, and risk
                                before
                                going to citizen home, I have introduced care staff to citizen, and give enough time to read and
                                understand care plan, risk assessment and other required information.

                            </p>
                    </div>
                    <div class="mt-4">
                        <table border="1" class="table-t">
                            <th>
                                Activity / Topics / Observation
                            </th>
                            <th>
                                Point: 1 - 5 <br />
                                Satisfied: Yes / No
                            </th>

                            <tr>
                                <td>Read and understand care / support plan. (Asking questions and observing
                                    while performing task)
                                </td>
                                <td>
                                    <select name="uderstand_care">
                                        <option value="1-No" {{ (old('uderstand_care', $formDataArray['uderstand_care'] ?? '') == '1-No') ? 'selected' : '' }}>1-No</option>
                                        <option value="2-No" {{ (old('uderstand_care', $formDataArray['uderstand_care'] ?? '') == '2-No') ? 'selected' : '' }}>2-No</option>
                                        <option value="3-Yes" {{ (old('uderstand_care', $formDataArray['uderstand_care'] ?? '') == '3-Yes') ? 'selected' : '' }}>3-Yes</option>
                                        <option value="4-Yes" {{ (old('uderstand_care', $formDataArray['uderstand_care'] ?? '') == '4-Yes') ? 'selected' : '' }}>4-Yes</option>
                                        <option value="5-Yes" {{ (old('uderstand_care', $formDataArray['uderstand_care'] ?? '') == '5-Yes') ? 'selected' : '' }}>5-Yes</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Read risk assessment and able to follow manual handling task safely and
                                    effectively. (Observation to perform task)
                                </td>
                                <td>
                                    <select name="read_risk">
                                        <option value="1-No" {{ (old('read_risk', $formDataArray['read_risk'] ?? '') == '1-No') ? 'selected' : '' }}>1-No</option>
                                        <option value="2-No" {{ (old('read_risk', $formDataArray['read_risk'] ?? '') == '2-No') ? 'selected' : '' }}>2-No</option>
                                        <option value="3-Yes" {{ (old('read_risk', $formDataArray['read_risk'] ?? '') == '3-Yes') ? 'selected' : '' }}>3-Yes</option>
                                        <option value="4-Yes" {{ (old('read_risk', $formDataArray['read_risk'] ?? '') == '4-Yes') ? 'selected' : '' }}>4-Yes</option>
                                        <option value="5-Yes" {{ (old('read_risk', $formDataArray['read_risk'] ?? '') == '5-Yes') ? 'selected' : '' }}>5-Yes</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Effective Communication with citizen. (Observing)
                                </td>
                                <td>
                                    <select name="effective_communication">
                                        <option value="1-No" {{ (old('effective_communication', $formDataArray['effective_communication'] ?? '') == '1-No') ? 'selected' : '' }}>1-No</option>
                                        <option value="2-No" {{ (old('effective_communication', $formDataArray['effective_communication'] ?? '') == '2-No') ? 'selected' : '' }}>2-No</option>
                                        <option value="3-Yes" {{ (old('effective_communication', $formDataArray['effective_communication'] ?? '') == '3-Yes') ? 'selected' : '' }}>3-Yes</option>
                                        <option value="4-Yes" {{ (old('effective_communication', $formDataArray['effective_communication'] ?? '') == '4-Yes') ? 'selected' : '' }}>4-Yes</option>
                                        <option value="5-Yes" {{ (old('effective_communication', $formDataArray['effective_communication'] ?? '') == '5-Yes') ? 'selected' : '' }}>5-Yes</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Aware about citizen needs and choice (Asking questions)
                                </td>
                                <td>
                                    <select name="aware_about_citizen">
                                        <option value="1-No" {{ (old('aware_about_citizen', $formDataArray['aware_about_citizen'] ?? '') == '1-No') ? 'selected' : '' }}>1-No</option>
                                        <option value="2-No" {{ (old('aware_about_citizen', $formDataArray['aware_about_citizen'] ?? '') == '2-No') ? 'selected' : '' }}>2-No</option>
                                        <option value="3-Yes" {{ (old('aware_about_citizen', $formDataArray['aware_about_citizen'] ?? '') == '3-Yes') ? 'selected' : '' }}>3-Yes</option>
                                        <option value="4-Yes" {{ (old('aware_about_citizen', $formDataArray['aware_about_citizen'] ?? '') == '4-Yes') ? 'selected' : '' }}>4-Yes</option>
                                        <option value="5-Yes" {{ (old('aware_about_citizen', $formDataArray['aware_about_citizen'] ?? '') == '5-Yes') ? 'selected' : '' }}>5-Yes</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Staff Confidence (Observation)
                                </td>
                                <td>
                                    <select name="staff_confidence">
                                        <option value="1-No" {{ (old('staff_confidence', $formDataArray['staff_confidence'] ?? '') == '1-No') ? 'selected' : '' }}>1-No</option>
                                        <option value="2-No" {{ (old('staff_confidence', $formDataArray['staff_confidence'] ?? '') == '2-No') ? 'selected' : '' }}>2-No</option>
                                        <option value="3-Yes" {{ (old('staff_confidence', $formDataArray['staff_confidence'] ?? '') == '3-Yes') ? 'selected' : '' }}>3-Yes</option>
                                        <option value="4-Yes" {{ (old('staff_confidence', $formDataArray['staff_confidence'] ?? '') == '4-Yes') ? 'selected' : '' }}>4-Yes</option>
                                        <option value="5-Yes" {{ (old('staff_confidence', $formDataArray['staff_confidence'] ?? '') == '5-Yes') ? 'selected' : '' }}>5-Yes</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Communication notes, MAR Chart recording skills. (Observing, reading
                                    notes and forms)
                                </td>
                                <td>
                                    <select name="communication_note">
                                        <option value="1-No" {{ (old('communication_note', $formDataArray['communication_note'] ?? '') == '1-No') ? 'selected' : '' }}>1-No</option>
                                        <option value="2-No" {{ (old('communication_note', $formDataArray['communication_note'] ?? '') == '2-No') ? 'selected' : '' }}>2-No</option>
                                        <option value="3-Yes" {{ (old('communication_note', $formDataArray['communication_note'] ?? '') == '3-Yes') ? 'selected' : '' }}>3-Yes</option>
                                        <option value="4-Yes" {{ (old('communication_note', $formDataArray['communication_note'] ?? '') == '4-Yes') ? 'selected' : '' }}>4-Yes</option>
                                        <option value="5-Yes" {{ (old('communication_note', $formDataArray['communication_note'] ?? '') == '5-Yes') ? 'selected' : '' }}>5-Yes</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Aware about reporting and recording procedures. (Asking questions)
                                </td>
                                <td>
                                    <select name="aware_about_reporting">
                                        <option value="1-No" {{ (old('aware_about_reporting', $formDataArray['aware_about_reporting'] ?? '') == '1-No') ? 'selected' : '' }}>1-No</option>
                                        <option value="2-No" {{ (old('aware_about_reporting', $formDataArray['aware_about_reporting'] ?? '') == '2-No') ? 'selected' : '' }}>2-No</option>
                                        <option value="3-Yes" {{ (old('aware_about_reporting', $formDataArray['aware_about_reporting'] ?? '') == '3-Yes') ? 'selected' : '' }}>3-Yes</option>
                                        <option value="4-Yes" {{ (old('aware_about_reporting', $formDataArray['aware_about_reporting'] ?? '') == '4-Yes') ? 'selected' : '' }}>4-Yes</option>
                                        <option value="5-Yes" {{ (old('aware_about_reporting', $formDataArray['aware_about_reporting'] ?? '') == '5-Yes') ? 'selected' : '' }}>5-Yes</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Citizen review/feedback about care staff. (Asking questions, observation)
                                </td>
                                <td>
                                    <select name="citizen_review">
                                        <option value="1-No" {{ (old('citizen_review', $formDataArray['citizen_review'] ?? '') == '1-No') ? 'selected' : '' }}>1-No</option>
                                        <option value="2-No" {{ (old('citizen_review', $formDataArray['citizen_review'] ?? '') == '2-No') ? 'selected' : '' }}>2-No</option>
                                        <option value="3-Yes" {{ (old('citizen_review', $formDataArray['citizen_review'] ?? '') == '3-Yes') ? 'selected' : '' }}>3-Yes</option>
                                        <option value="4-Yes" {{ (old('citizen_review', $formDataArray['citizen_review'] ?? '') == '4-Yes') ? 'selected' : '' }}>4-Yes</option>
                                        <option value="5-Yes" {{ (old('citizen_review', $formDataArray['citizen_review'] ?? '') == '5-Yes') ? 'selected' : '' }}>5-Yes</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><b></b>Overall performance</td>b> (Very Poor/Poor/Satisfactory/Good/ Very Good)
                                </td>
                                <td>
                                    <select name="citizen_review">
                                        <option value="1-Very Poor" {{ (old('citizen_review', $formDataArray['citizen_review'] ?? '') == '1-Very Poor') ? 'selected' : '' }}>1-Very Poor</option>
                                        <option value="2-Poor" {{ (old('citizen_review', $formDataArray['citizen_review'] ?? '') == '2-Poor') ? 'selected' : '' }}>2-Poor</option>
                                        <option value="3-Satisfactory" {{ (old('citizen_review', $formDataArray['citizen_review'] ?? '') == '3-Satisfactory') ? 'selected' : '' }}>3-Satisfactory</option>
                                        <option value="4-Good" {{ (old('citizen_review', $formDataArray['citizen_review'] ?? '') == '4-Good') ? 'selected' : '' }}>4-Good</option>
                                        <option value="5-Very Good" {{ (old('citizen_review', $formDataArray['citizen_review'] ?? '') == '5-Very Good') ? 'selected' : '' }}>5-Very Good</option>
                                    </select>
                                </td>
                            </tr>
                        </table>
                        <br/>
                        <p>
                            (Supervisor/Shadower needs to observe and asking questions to make sure that care staff is have
                            knowledge, confidence, verbal and written skills and competence to do work and according to that
                            supervisor/Shadower need to give point)
                        </p>

                    </div>
                    <div class="border-1 mt-4">
                        <label>Supervisor/Shadower Comments:</label><br/>
                        <textarea rows="5" class="text-width" name="shadower_comments">{{ old('shadower_comments', $formDataArray['shadower_comments'] ?? '') }}</textarea><br/><br/>
                        <h6><b>Care Staff need more shadow call / Training?</b> <input type="radio" name="need_more_shadow_call" value="Yes" {{ (isset($formDataArray['need_more_shadow_call']) && $formDataArray['need_more_shadow_call'] == 'Yes') ? 'checked' : '' }}>Yes  <input type="radio" name="need_more_shadow_call" value="No" {{ (isset($formDataArray['need_more_shadow_call']) && $formDataArray['need_more_shadow_call'] == 'No') ? 'checked' : '' }}>No</h6>
                    </div>

                    <div class="mb-4">
                        <div class=" mt-5 row  flex-end border-bottom">
                            <div class="col-6 mobile-set" style="display: flex;align-items: center;">
                                <h6>Shadower / Staff Name : <input type="text" name="staff_name" value="{{ $formDataArray['staff_name'] ?? '' }}"></h6>
                            </div>
                            <div class="col-6 mobile-set">
                                <h6>
                                    <div class="text">Signature &nbsp;@if(!isset($formDataArray['customerNowSigned']))<span class="btn btn-secondary waves-effect waves-light" id="clear">Clear</span>@endif</div>
                                    <div class="sign signbox">
                                        @if(isset($formDataArray['customerNowSigned']))
                                        <div id="signImage" style="width: 450px;height:150px;">
                                            <img src="{{ $formDataArray['customerNowSigned'] }}" alt="Customer Signature">
                                        </div>
                                        @else
                                        <canvas id="payNowSign" width="450" height="150"></canvas>
                                        <textarea id="payNowSignatureBox" name="customerNowSigned" style="display: none"></textarea>
                                        @endif

                                    </div>
                                </h6>
                            </div>
                            <!--<div class="col-6 mobile-set">
                                <div class="text">Signature:</div>
                                <div class="sign signbox">
                                    @if($candidate && $candidate->signature)
                                        <div id="signImage-signature" style="width: 460px; height: 160px;">
                                            <img src="{{ $candidate->signature }}" alt="Candidate Signature">
                                        </div>
                                    @else
                                        <div id="noSignatureMessage" style="color: red;">
                                            No signature available
                                        </div>
                                    @endif
                                </div>
                            </div>-->

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
    $(document).ready(function() {
        var canvas = document.getElementById("payNowSign");

        var signaturePad = new SignaturePad(canvas, {
            backgroundColor: "white",
            penColor: "black",
            minWidth: 2,
            maxWidth: 4,
        });

        $('#clear').click(function(e) {
            e.preventDefault();
            signaturePad.clear();
        });

        var canvas1 = document.getElementById("carerNowSign");

        var signaturePad1 = new SignaturePad(canvas1, {
            backgroundColor: "white",
            penColor: "black",
            minWidth: 2,
            maxWidth: 4,
        });

        $('#carerNowClear').click(function(e) {
            e.preventDefault();
            signaturePad1.clear();
        });

        $('form').submit(function(e) {
            e.preventDefault();
            var payNowSignDataUrl = signaturePad.toDataURL();
            var carerNowSignDataUrl = signaturePad1.toDataURL();
            $('#payNowSignatureBox').val(payNowSignDataUrl);
            $('#carerNowSignatureBox').val(carerNowSignDataUrl);
            this.submit();
        });
        // var sig = $('#payNowSign').signature({syncField: '#payNowSignatureBox', syncFormat: 'PNG'});
        // $('#clear').click(function(e) {
        //     e.preventDefault();
        //     sig.signature('clear');
        //     $("#payNowSignatureBox").val('');
        // });
        // var bookNowSig = $('#carerNowSign').signature({syncField: '#carerNowSignatureBox', syncFormat: 'PNG'});
        // $('#carerNowClear').click(function(e) {
        //     e.preventDefault();
        //     bookNowSig.signature('clear');
        //     $("#carerNowSignatureBox").val('');
        // });
    });
</script>
@endsection
