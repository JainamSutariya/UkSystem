@extends('layouts.master')
@section('title') Candidate Interview Screening @endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') Forms @endslot
@slot('title') Candidate Interview Screening @endslot
@endcomponent
@section('css')
<link href="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="{{ URL::asset('/assets/libs/datepicker/datepicker.min.css') }}">
<style>
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
        width: 50% !important;
        height: 44px;
        border: 0px solid black;
    }
    h4.site-heading {
        font-size: 27px;
        font-weight: bold;
        color: #292f42;
        text-align: center;
        margin: 0;
    }
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
               <h4 class="site-heading">NDH CARE LTD</h4>
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
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form method="post" action="{{route('candidateTelePhonic')}}" id="candidateInterviewScreeningForm">
                    @csrf
                    <h4 class="card-title">Candidate Information</h4>
                    <br>
                    @php
                    $name = $candidate->prefix . ' ' . $candidate->first_name . ' ' . $candidate->last_name
                    @endphp
                    <input type="hidden" name="candidate_id" id="candidate_id" value="{{$candidate->id}}">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="mb-3">
                                <label for="basicpill-firstname-input" style="margin-bottom: 1.4rem;">Name</label>
                                <input type="text" name="name" class="form-control" id="name" value="{{$name}}" disabled>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label for="basicpill-firstname-input" style="margin-bottom: 1.4rem;">Date</label>
                                <input type="date" name="form_date" value="{{ $telephonicData->form_date ?? ($telephonicData->sign_current_date ?? date('Y-m-d')) }}" class="form-control" id="form_date">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="mb-3">
                                <label for="basicpill-firstname-input" style="margin-bottom: 1.4rem;">Address</label>
                                <textarea name="address" class="form-control" disabled>{{$candidate->street_address ?? ''}}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label for="basicpill-firstname-input" style="margin-bottom: 1.4rem;">Postcode</label>
                                <input type="text" name="postcode" value="{{$candidate->post_code ?? ''}}" class="form-control" id="postcode" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="basicpill-firstname-input" style="margin-bottom: 1.4rem;">Contact Number</label>
                                <input type="text" name="contact_number" value="{{$candidate->mobile_number ?? ''}}" class="form-control" id="contact_number" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="basicpill-firstname-input" style="margin-bottom: 1.4rem;">Email</label>
                                <input type="text" name="email" value="{{$candidate->email ?? ''}}" class="form-control" id="email" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="basicpill-firstname-input">Position applied for<span>*</span></label>
                                <select class="form-control form-select" name="position" id="position" required>
                                <option value="Health Care Assistant" @if(optional($telephonicData)->position == 'Health Care Assistant') selected @endif>Health Care Assistant</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="basicpill-firstname-input">Preferred Type<span>*</span></label>
                                <select class="form-control form-select" name="employment_type" id="employment_type" required>
                                    <option value="Part Time" @if(optional($telephonicData)->employment_type == 'Part Time') selected @endif>Part Time</option>
                                    <option value="Full Time" @if(optional($telephonicData)->employment_type == 'Full Time') selected @endif>Full Time</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="basicpill-firstname-input">Where did you find out about the vacancy?</label>
                                <input type="text" name="find_out_vacancy" class="form-control" id="find_out_vacancy" value="{{$telephonicData->find_out_vacancy ?? ''}}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mt-4">
                                <h5 class="font-size-14 mb-4">Do you drive:<span>*</span></h5>
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="radio" value="Yes" name="do_you_drive" id="do_you_drive" {{ old('do_you_drive', optional($telephonicData)->do_you_drive) == 'Yes' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="formRadios1">
                                Yes
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="No" name="do_you_drive" id="do_you_drive" {{ old('do_you_drive', optional($telephonicData)->do_you_drive) == 'No' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="formRadios2">
                                No
                                </label>
                            </div>
                        </div>
                    </div>
                    <label for="do_you_drive" class="error"></label>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mt-4">
                                <h5 class="font-size-14 mb-4">Do you have full the Driving License?<span>*</span></h5>
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="radio" value="Yes" name="driving_license" id="driving_license_yes" {{ old('driving_license', optional($telephonicData)->driving_license) == 'Yes' ? 'checked' : '' }}>
                                <label class="form-check-label" for="formRadios1">
                                Yes
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="No" name="driving_license" id="driving_license_no" {{ old('driving_license', optional($telephonicData)->driving_license) == 'No' ? 'checked' : '' }}>
                                <label class="form-check-label" for="formRadios2">
                                No
                                </label>
                            </div>
                        </div>
                    </div>
                    <label for="driving_license" class="error"></label>
                    <div class="row" id="driving_license_type_show" style="@if(optional($telephonicData)->driving_license == 'Yes') display: block; @else display: none; @endif">
                        <div class="col-lg-6">
                            <div class="mt-4">
                                <h5 class="font-size-14 mb-4"></h5>
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="radio" value="Full UK Driving License" name="driving_license_type" id="driving_license_type_full_uk" {{ old('driving_license_type', optional($telephonicData)->driving_license_type) == 'Full UK Driving License' ? 'checked' : '' }}>
                                <label class="form-check-label" for="formRadios1">
                                Full UK Driving License
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="International Driving License" name="driving_license_type" id="driving_license_type_international" {{ old('driving_license_type', optional($telephonicData)->driving_license_type) == 'International Driving License' ? 'checked' : '' }}>
                                <label class="form-check-label" for="formRadios2">
                                International Driving License
                                </label>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row" id="driving_license_share_code" style="@if(optional($telephonicData)->driving_license_type == 'Full UK Driving License') display: block; @else display: none; @endif">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="basicpill-firstname-input">Share Code</label>
                                <input type="text" name="driving_share_code" class="form-control" id="driving_share_code" placeholder="Enter Share Code" value="{{$telephonicData->driving_share_code ?? ''}}">
                            </div>
                        </div>
                    </div>
                    <div class="row" id="driving_license_details" style="@if(optional($telephonicData)->driving_license_type == 'International Driving License') display: block; @else display: none; @endif">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="basicpill-firstname-input">Driving License Number</label>
                                <input type="text" name="driving_license_number" class="form-control" id="driving_license_number" placeholder="Enter Driving License Number" value="{{$telephonicData->driving_license_number ?? ''}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="basicpill-firstname-input">Do you have any Underlying Health condition?</label>
                                <input type="text" name="underlying_health_condition" class="form-control" id="underlying_health_condition" value="{{$telephonicData->underlying_health_condition ?? ''}}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="basicpill-firstname-input">Are you taking any medication?</label>
                                <input type="text" name="taking_any_medication" class="form-control" id="taking_any_medication" value="{{$telephonicData->taking_any_medication ?? ''}}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="basicpill-firstname-input">Did you receive shielding letter from NHS?</label>
                                <input type="text" name="receive_shielding_nhs" class="form-control" id="receive_shielding_nhs" value="{{$telephonicData->receive_shielding_nhs ?? ''}}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="basicpill-firstname-input">Current job status</label>
                                <select class="form-control form-select" name="current_job" id="current_job" required>
                                    <option value="Part Time">Part Time</option>
                                    <option value="Full Time">Full Time</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="basicpill-firstname-input">What languages can you Speak?</label>
                                <input type="text" name="languages_speak" class="form-control" id="languages_speak" value="{{$telephonicData->languages_speak ?? ''}}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="basicpill-firstname-input">Do you have any work experience in health and social care sector?</label>
                                <textarea name="work_experience_health" class="form-control" required>{{$telephonicData->work_experience_health ?? ''}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="basicpill-firstname-input">Details of previous / current work experience:</label>
                                <textarea name="previous_work_experience" class="form-control" required>{{$telephonicData->previous_work_experience ?? ''}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="basicpill-firstname-input">Please provide any additional comments here:</label>
                                <textarea name="additional_comments" class="form-control" required>{{$telephonicData->additional_comments ?? ''}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mt-4">
                                <h5 class="font-size-14 mb-4">Do you have a current DBS in place?<span>*</span></h5>
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="radio" value="Yes" name="current_dbs" id="current_dbs" {{ old('current_dbs', optional($telephonicData)->current_dbs) == 'Yes' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="formRadios1">
                                Yes
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="No" name="current_dbs" id="current_dbs" {{ old('current_dbs', optional($telephonicData)->current_dbs) == 'No' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="formRadios2">
                                No
                                </label>
                            </div>
                        </div>
                    </div>
                    <label for="current_dbs" class="error"></label>
                    <div class="row" id="registered_on_update_service_yes" style="display: none;">
                        <div class="col-lg-6">
                            <div class="mt-4">
                                <h5 class="font-size-14 mb-4">If yes, are you registered on the Update Service?<span>*</span></h5>
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="radio" value="Yes" name="registered_update_service" id="registered_update_service_yes" {{ old('registered_update_service', optional($telephonicData)->registered_update_service) == 'Yes' ? 'checked' : '' }}>
                                <label class="form-check-label" for="formRadios1">
                                Yes
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="No" name="registered_update_service" id="registered_update_service_no" {{ old('registered_update_service', optional($telephonicData)->registered_update_service) == 'No' ? 'checked' : '' }}>
                                <label class="form-check-label" for="formRadios2">
                                No
                                </label>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="mb-3">
                                <label for="basicpill-firstname-input" style="margin-bottom: 1.4rem;">Reference number</label>
                                <input type="text" name="reference_number" class="form-control" id="reference_number" value="{{$telephonicData->reference_number ?? ''}}" required>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label for="basicpill-firstname-input" style="margin-bottom: 1.4rem;">Date</label>
                                <input type="date" name="today_date" value="{{$telephonicData->today_date ?? date('Y-m-d')}}" class="form-control" id="today_date">
                            </div>
                        </div>
                    </div>
                    <h4 class="card-title">Availability</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <table id="datatable" class="table table-bordered dt-responsive nowrap w-100 dataTable no-footer dtr-inline">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Monday</th>
                                        <th>Tuesday</th>
                                        <th>Wednesday</th>
                                        <th>Thursday</th>
                                        <th>Friday</th>
                                        <th>Saturday</th>
                                        <th>Sunday</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Morning<br>(06:00-15:00)</td>
                                        <td><input type="text" class="form-control" name="morning_monday" autocomplete="off" value="{{$telephonicData->morning_monday ?? ''}}"></td>
                                        <td><input type="text" class="form-control" name="morning_tuesday" autocomplete="off" value="{{$telephonicData->morning_tuesday ?? ''}}"></td>
                                        <td><input type="text" class="form-control" name="morning_wednesday" autocomplete="off" value="{{$telephonicData->morning_wednesday ?? ''}}"></td>
                                        <td><input type="text" class="form-control" name="morning_thursday" autocomplete="off" value="{{$telephonicData->morning_thursday ?? ''}}"></td>
                                        <td><input type="text" class="form-control" name="morning_friday" autocomplete="off" value="{{$telephonicData->morning_friday ?? ''}}"></td>
                                        <td><input type="text" class="form-control" name="morning_saturday" autocomplete="off" value="{{$telephonicData->morning_saturday ?? ''}}"></td>
                                        <td><input type="text" class="form-control" name="morning_sunday" autocomplete="off" value="{{$telephonicData->morning_sunday ?? ''}}"></td>
                                    </tr>
                                    <tr>
                                        <td>Late<br>(15:00-22:00)</td>
                                        <td><input type="text" class="form-control" name="late_monday" autocomplete="off" value="{{$telephonicData->late_monday ?? ''}}"></td>
                                        <td><input type="text" class="form-control" name="late_tuesday" autocomplete="off" value="{{$telephonicData->late_tuesday ?? ''}}"></td>
                                        <td><input type="text" class="form-control" name="late_wednesday" autocomplete="off" value="{{$telephonicData->late_wednesday ?? ''}}"></td>
                                        <td><input type="text" class="form-control" name="late_thursday" autocomplete="off" value="{{$telephonicData->late_thursday ?? ''}}"></td>
                                        <td><input type="text" class="form-control" name="late_friday" autocomplete="off" value="{{$telephonicData->late_friday ?? ''}}"></td>
                                        <td><input type="text" class="form-control" name="late_saturday" autocomplete="off" value="{{$telephonicData->late_saturday ?? ''}}"></td>
                                        <td><input type="text" class="form-control" name="late_sunday" autocomplete="off" value="{{$telephonicData->late_sunday ?? ''}}"></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="basicpill-firstname-input">Comments:</label>
                                <textarea name="comments" class="form-control">{{$telephonicData->comments ?? ''}}</textarea>
                            </div>
                        </div>
                    </div>
                    <h4 class="card-title">Progress detail</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mt-4">
                                <h5 class="font-size-14 mb-4">Progress to interview?<span>*</span></h5>
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="radio" value="Yes" name="progress_interview" id="progress_interview" {{ old('progress_interview', optional($telephonicData)->progress_interview) == 'Yes' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="formRadios1">
                                Yes
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="No" name="progress_interview" id="progress_interview" {{ old('progress_interview', optional($telephonicData)->progress_interview) == 'No' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="formRadios2">
                                No
                                </label>
                            </div>
                        </div>
                    </div>
                    <label for="progress_interview" class="error"></label>
                    <br>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="basicpill-firstname-input">Any other relevant comments (Inform not suitable, giving reasons. Record reasons in box. Keep this record):</label>
                                <textarea name="relevant_comments" class="form-control" required>{{$telephonicData->relevant_comments ?? ''}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="basicpill-firstname-input" style="margin-bottom: 1.4rem;">Staff Name</label>
                                <input type="text" name="staff_name" class="form-control" id="staff_name" value="{{$telephonicData->staff_name ?? ''}}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="basicpill-firstname-input" style="margin-bottom: 1.4rem;">Position</label>
                                <input type="text" name="position" class="form-control" id="position" value="{{$telephonicData->position ?? ''}}" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="basicpill-firstname-input" style="margin-bottom: 1.4rem;">Date</label>
                                <input type="date" name="sign_current_date" value="{{$telephonicData->sign_current_date ?? date('Y-m-d')}}" class="form-control" id="sign_current_date">
                            </div>
                        </div>
                        <!--<div class="col-lg-4">
                            <div class="mb-3">
                                <label for="basicpill-firstname-input" style="margin-bottom: 1.4rem;">Sign</label>
                                <input type="text" name="sign" class="form-control" id="sign"  value="{{$telephonicData->sign ?? ''}}">
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
                                        <img width="450" height="160" src="{{ $userData->signature }}" alt="Customer Signature">
                                    </div>
                                @else
                                    <div id="noSignatureMessage" style="color: red;">
                                        No signature available
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label for="example-password-input" class="col-md-2 col-form-label"></label>
                        <div style="display: flex;justify-content: center;align-items: center;">
                            <button type="submit" class="btn btn-primary w-md saveInterviewScreeningForm">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
   <!-- end col -->
</div>
@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script src="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/datepicker/datepicker.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('input[name="driving_license"]').change(function() {
            if ($(this).val() === 'Yes') {
              $('#driving_license_type_show').show();
              $('#driving_license_share_code').hide();
              $('#driving_license_details').hide();
            } else {
              $('#driving_license_type_show').hide();
              $('#driving_license_share_code').hide();
              $('#driving_license_details').hide();
            }
        });
        $('input[name="driving_license_type"]').change(function() {
            var drivingLicenseType = $(this).val();

            if (drivingLicenseType === 'Full UK Driving License') {
              $('#driving_license_share_code').show();
              $('#driving_license_details').hide();
              $('#driving_license_details input').attr('disabled', true);
            } else if (drivingLicenseType === 'International Driving License') {
              $('#driving_license_share_code').hide();
              $('#driving_license_details').show();
              $('#driving_license_details input').attr('disabled', false);
            } else {
              $('#driving_license_share_code').hide();
              $('#driving_license_details').hide();
              $('#driving_license_details input').attr('disabled', true);
            }
        });
        $('input[name="current_dbs"]').change(function() {
            if ($(this).val() === 'Yes') {
              $('#registered_on_update_service_yes').show();
            } else {
              $('#registered_on_update_service_yes').hide();
            }
        });
    });
    $(document).on('click', '.saveInterviewScreeningForm', function() {
        if ($('#candidateInterviewScreeningForm').validate()) {
            $('#candidateInterviewScreeningForm').submit();
        }
    });
</script>
@endsection