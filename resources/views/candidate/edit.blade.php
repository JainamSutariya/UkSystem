<!--<style>-->
<!--button.cust-margin-4.btn.btn-danger.w-md.remove_education_data_no, button.cust-margin-4.btn.btn-primary.w-md.add_education_data_for_no {-->
<!--    margin-top: 19px !important;-->
<!--}-->
<!--    span.number {-->
<!--        background-color: #fff !important;-->
<!--        border-color: #fff !important;-->
<!--        color: #2a3042 !important;-->
<!--        font-weight:600 !important;-->
<!--        font-size:22px !important;-->
<!--    }-->

<!--a#basic-example-t-0 {-->
<!--    background-color: #2a3042;-->
<!--    color: #fff;-->
<!--    letter-spacing: 1;-->
<!--}-->
<!--a#basic-example-t-1 {-->
<!--    background-color: #242c44a1;-->
<!--    color: #fff;-->
<!--    letter-spacing: 1;-->
<!--}-->
<!--a#basic-example-t-2 {-->
<!--    background-color: #242c44a1;-->
<!--   color: #fff;-->
<!--   letter-spacing: 1;-->
<!--}-->

<!--li.mobile-view.current {-->
<!--    background: #556ee63b;-->
<!--}-->

<!--li.mobile-view-2.current {-->
<!--    background: #556ee63b;-->
<!--}-->
<!--li.second.disabled {-->
<!--    margin: 0px 4px;-->
<!--}-->

<!--h4.card-title {-->
<!--    font-size: 23px;-->
<!--}-->
<!--.mb-3 label{-->
<!--    font-size: 20px !important;-->
<!--    color: #2a3042;-->
<!--}-->
<!--.error {-->
<!--    color: #f46a6a !important;-->
<!--}-->
<!--select#country, select#prefix, select#branch_id {-->
<!--    color: #74788d !important-->
<!--}-->
<!--select#position, select#employment_type, select#branch_id, select#prefix, input#first_name, input#last_name, input#post_code, select#country, input#email, input#mobile_number, input#telephone_no, input#dob, input#emergency_first_name, input#emergency_last_name, input#emergency_mobile, input#emergency_contact_relation, textarea#street_address {-->
<!--    font-size: 16px !important;-->
<!--}-->
<!--h5.font-size-14.mb-4 {-->
<!--    font-size: 18px !important;-->
<!--}-->
<!--li.first.current, a#basic-example-t-1, a#basic-example-t-2 {-->
<!--    font-size: 22px;-->
<!--}-->
<!--label.form-check-label {-->
<!--    font-size: 20px !important;-->
<!--}-->
<!--h4.mb-sm-0.font-size-18 {-->
<!--    font-size: 23px !important;-->
<!--}-->
<!--input#stepone {-->
<!--    background-color: #2a3042;-->
<!--    font-size: 20px;-->
<!--    border:none;-->
<!--}-->
<!--input#steptwo {-->
<!--    background-color: #2a3042;-->
<!--    font-size: 20px;-->
<!--    border: none;-->
<!--}-->
<!--input#previous1 {-->
<!--    background-color: #2a3042;-->
<!--    font-size: 20px;-->
<!--    border: none;-->
<!--}-->
<!--input#previous2 {-->
<!--    background-color: #2a3042;-->
<!--    font-size: 20px;-->
<!--    border: none;-->
<!--}-->
<!--.page-title-right {-->
<!--    font-size: 22px;-->
<!--}-->
<!--.mb-3.cust-margin {-->
<!--    margin-top: 16px !important;-->
<!--}-->

<!--.cust-margin-2 {-->
<!--    margin-top: 30px;-->
<!--}-->

<!--.cust-margin-3 {-->
<!--    margin-top: 20px !important;-->
<!--}-->
<!--.cust-margin-4 {-->
<!--    margin-top: 50px !important;-->
<!--}-->
<!--.cust-size {-->
<!--    font-size: 20px !important;-->
<!--}-->
<!--@media only screen and (max-width: 600px) {-->
<!-- .mobile-view {-->
<!--    margin: 10px 0;-->
<!--}-->
<!--.mobile-view-2 {-->
<!--    margin-left: 1px !important;-->
<!--}-->
<!--.cust-margin-4 {-->
<!--    margin-top: -22px !important;-->
<!--}-->
<!--.cust-margin-3 {-->
<!--    margin-top: -20px !important;-->
<!--}-->
<!--.cust-width {-->
<!--    width: 50% !important;-->
<!--}-->
<!--}-->
<!--</style>-->


@extends('layouts.master')

@section('title') Candidate Details @endsection

@section('content')

@component('components.breadcrumb')
@slot('li_1') Forms @endslot
@slot('title') Edit Candidate @endslot
@endcomponent
@section('css')
<link href="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="{{ URL::asset('/assets/libs/datepicker/datepicker.min.css') }}">
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
                <div id="basic-example" role="application" class="wizard clearfix">
                    <div class="steps clearfix"><ul role="tablist">
                        <li role="tab" class="first current mobile-view" aria-disabled="false" aria-selected="true">
                            <a id="basic-example-t-0" href="#" aria-controls="basic-example-p-0" class="cust-size">
                                <span class="number">1.</span> Personal Details
                            </a>
                        </li>
                        <li role="tab" class="second disabled mobile-view-2" aria-disabled="true">
                            <a id="basic-example-t-1" href="#" aria-controls="basic-example-p-1" class="cust-size">
                                <span class="number">2.</span> Employment Details
                            </a>
                        </li>
                        <li role="tab" class="third disabled mobile-view" aria-disabled="true">
                            <a id="basic-example-t-2" href="#" aria-controls="basic-example-p-2" class="cust-size">
                                <span class="number">3.</span> Reference & Policy Details
                            </a>
                        </li>
                    </div>
                </div>
                <br>
                <form method="post" action="{{ route('candidate.update', $candidate->id) }}" id="editCandidateForm" enctype="multipart/form-data">
                    @csrf
                    {{ method_field('PUT') }}
                    <fieldset id="step1">
                        <h4 class="card-title">Position Applied</h4>
                        <br>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Position<span>*</span></label>
                                    <select class="form-control form-select" name="position" id="position" required @if($candidate->is_submit == 'Yes') disabled @endif>
                                        <option value="Health Care Assistant">Health Care Assistant</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Preferred Employment Type<span>*</span></label>
                                    <select class="form-control form-select" name="employment_type" id="employment_type" required @if($candidate->is_submit == 'Yes') disabled @endif>
                                        <option value="Part Time">Part Time</option>
                                        <option value="Full Time">Full Time</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Location you are applying for?<span>*</span></label>
                                    <select class="form-control form-select" name="branch_id" id="branch_id" required @if($candidate->is_submit == 'Yes') disabled @endif>
                                        <option value="">Enter Select City</option>
                                        @foreach ($branch as $val)
                                            <option value="{{$val->id}}" @if(old('branch_id', $candidate->branch_id) == $val->id) selected @endif>{{$val->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <br>
                        <h4 class="card-title">Personal Information</h4>
                        <br>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3 ">
                                    <label for="basicpill-firstname-input">Candidate Name</label>
                                    <select class="form-control form-select" name="prefix" id="prefix" required @if($candidate->is_submit == 'Yes') disabled @endif>
                                        <option value="">Select Prefix</option>
                                        <option value="Dr." @if(old('prefix', $candidate->prefix) == 'Dr.') selected @endif>Dr.</option>
                                        <option value="Miss" @if(old('prefix', $candidate->prefix) == 'Miss') selected @endif>Miss</option>
                                        <option value="Mr." @if(old('prefix', $candidate->prefix) == 'Mr.') selected @endif>Mr.</option>
                                        <option value="Mrs." @if(old('prefix', $candidate->prefix) == 'Mrs.') selected @endif>Mrs.</option>
                                        <option value="Ms." @if(old('prefix', $candidate->prefix) == 'Ms.') selected @endif>Ms.</option>
                                        <option value="Prof." @if(old('prefix', $candidate->prefix) == 'Prof.') selected @endif>Prof.</option>
                                        <option value="Rev." @if(old('prefix', $candidate->prefix) == 'Rev.') selected @endif>Rev.</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3 cust-margin">
                                    <label for="basicpill-firstname-input" style="margin-bottom: 1.4rem;"></label>
                                    <input type="text" name="first_name" value="{{ old('first_name', $candidate->first_name) }}" class="form-control" id="first_name" placeholder="Enter First Name" required @if($candidate->is_submit == 'Yes') disabled @endif>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3 cust-margin">
                                    <label for="basicpill-firstname-input" style="margin-bottom: 1.4rem;"></label>
                                    <input type="text" name="last_name" value="{{ old('last_name', $candidate->last_name)}}" class="form-control" id="last_name" placeholder="Enter Last Name" required @if($candidate->is_submit == 'Yes') disabled @endif>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Address</label>
                                    <textarea name="street_address" id="street_address" class="form-control" rows="3" placeholder="Enter Street Address" spellcheck="false" required @if($candidate->is_submit == 'Yes') disabled @endif>{{ old('street_address', $candidate->street_address) }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Post Code</label>
                                    <input type="text" name="post_code" value="{{ old('post_code', $candidate->post_code) }}" class="form-control" id="post_code" placeholder="Enter Post Code" required @if($candidate->is_submit == 'Yes') disabled @endif>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Country</label>
                                    <select class="form-control form-select" name="country" id="country" required @if($candidate->is_submit == 'Yes') disabled @endif>
                                        <option value="">Enter Select Country</option>
                                        @foreach ($country as $val)
                                            <option value="{{$val->name}}" @if(old('country', $candidate->country) == $val->name) selected @endif>{{$val->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Email</label>
                                    <input type="text" name="email" value="{{ old('email', $candidate->email) }}" class="form-control" id="email" placeholder="Enter Email" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Mobile No.</label>
                                    <input type="number" name="mobile_number" value="{{ old('mobile_number', $candidate->mobile_number) }}" class="form-control" id="mobile_number" placeholder="Enter Mobile Number" required @if($candidate->is_submit == 'Yes') disabled @endif>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Telephone No (Home)</label>
                                    <input type="number" name="telephone_no" value="{{ old('telephone_no', $candidate->telephone_no) }}" class="form-control" id="telephone_no" placeholder="Enter Telephone No" @if($candidate->is_submit == 'Yes') disabled @endif>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3" id="datepicker1">
                                    <label for="basicpill-firstname-input">Date of Birth</label>
                                    <input type="text" name="dob" class="form-control" value="{{ old('dob', $candidate->dob ? \Carbon\Carbon::createFromFormat('Y-m-d', $candidate->dob)->format('d-m-Y') : '') }}" id="dob" placeholder="dd-mm-yyyy" data-date-format="dd-mm-yyyy" data-date-container='#datepicker1' data-provide="datepicker" data-date-autoclose="true" autocomplete="off" required @if($candidate->is_submit == 'Yes') disabled @endif>
                                    <!--<input type="text" name="dob" value="{{$candidate->dob}}" class="form-control" id="dob" placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd" data-date-container='#datepicker1' data-provide="datepicker" data-date-autoclose="true" autocomplete="off" required>-->
                                </div>
                            </div>
                        </div>
                        <h4 class="card-title">Gender<span>*</span></h4>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" value="Male" name="gender" id="gender_male" @if(old('gender', $candidate->gender) == "Male") checked @endif @if($candidate->is_submit == 'Yes') disabled @endif>
                                    <label class="form-check-label" for="formRadios1">
                                        Male
                                    </label>
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" value="Female" name="gender" id="gender_female" @if(old('gender', $candidate->gender) == "Female") checked @endif @if($candidate->is_submit == 'Yes') disabled @endif>
                                    <label class="form-check-label" for="formRadios2">
                                        Female
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="Other" name="gender" id="gender_other" @if(old('gender', $candidate->gender) == "Other") checked @endif @if($candidate->is_submit == 'Yes') disabled @endif>
                                    <label class="form-check-label" for="formRadios2">
                                        Other
                                    </label>
                                </div>
                            </div>
                        </div>
                        <br>

                        <input type="text" name="gender_other_details" class="form-control" value="@if(old('gender', $candidate->gender) == 'Other') {{ old('gender_other_details', $candidate->gender_other_details) }} @endif" id="gender_other_details" style="@if($candidate->gender == "Other")  @else display:none @endif">
                        <br>
                        <label for="gender" class="error"></label>
                        <br>
                        <h4 class="card-title">Emergency Contact Details</h4>
                        <br>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Name</label>
                                    <input type="text" name="emergency_first_name" value="{{ old('emergency_first_name', $candidate->emergency_first_name) }}" class="form-control" id="emergency_first_name" placeholder="Enter First Name" @if($candidate->is_submit == 'Yes') disabled @endif>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3 cust-margin">
                                    <label for="basicpill-firstname-input" style="margin-bottom: 1.4rem;"></label>
                                    <input type="text" name="emergency_last_name" value="{{ old('emergency_last_name', $candidate->emergency_last_name) }}" class="form-control" id="emergency_last_name" placeholder="Enter Last Name" @if($candidate->is_submit == 'Yes') disabled @endif>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Emergency Mobile No</label>
                                    <input type="number" name="emergency_mobile" value="{{ old('emergency_mobile', $candidate->emergency_mobile) }}" class="form-control" id="emergency_mobile" placeholder="Enter Mobile Number" @if($candidate->is_submit == 'Yes') disabled @endif>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Emergency Contact Relation</label>
                                    <input type="text" name="emergency_contact_relation" value="{{ old('emergency_contact_relation', $candidate->emergency_contact_relation) }}" class="form-control" id="emergency_contact_relation" placeholder="Enter Contact Relation" @if($candidate->is_submit == 'Yes') disabled @endif>
                                </div>
                            </div>
                        </div>
                        <br>
                        <h4 class="card-title">Work Eligibility</h4>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mt-4">
                                    <h5 class="font-size-14 mb-4">Are you eligible to work in uk?<span>*</span></h5>
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" value="Yes" name="work_eligible" id="work_eligible_yes" @if(old('work_eligible', $candidate->work_eligible) == "Yes") checked @endif @if($candidate->is_submit == 'Yes') disabled @endif>
                                    <label class="form-check-label" for="formRadios1">
                                        Yes
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="No" name="work_eligible" id="work_eligible_no" @if(old('work_eligible', $candidate->work_eligible) == "No") checked @endif @if($candidate->is_submit == 'Yes') disabled @endif>
                                    <label class="form-check-label" for="formRadios2">
                                        No
                                    </label>
                                </div>
                                <br>
                                <label for="basicpill-firstname-input" id="work_no_message" style="@if(old('work_eligible', $candidate->work_eligible) == "No") display: block; @else display: none; @endif">Sorry we can't proceed for the application.</label>
                            </div>
                        </div>
                        <label for="work_eligible" class="error"></label>
                        <br id="work_yes_message_br" style="display: none;">
                        <div class="row" id="work_yes_message" style="@if($candidate->work_eligible == "Yes") @else display: none @endif">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Nation Insurance Number</label>
                                    <input type="text" name="nation_insurance_number" class="form-control" id="nation_insurance_number" placeholder="Enter Nation Insurance Number" value="{{ old('nation_insurance_number', $candidate->nation_insurance_number) }}" required @if($candidate->is_submit == 'Yes') disabled @endif>
                                </div>
                            </div>
                            <label for="basicpill-firstname-input">Please enter your National Insurance Number. if you don't have the National Insurance Number and only you have the reference number, kindly provide that.</label>
                        </div>
                        <br>
                        <h4 class="card-title">Driving License Details</h4>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mt-4">
                                    <h5 class="font-size-14 mb-4">Do you have full the Driving License?<span>*</span></h5>
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" value="Yes" name="driving_license" id="driving_license_yes" @if(old('driving_license', $candidate->driving_license) == "Yes") checked @endif @if($candidate->is_submit == 'Yes') disabled @endif>
                                    <label class="form-check-label" for="formRadios1">
                                        Yes
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="No" name="driving_license" id="driving_license_no" @if(old('driving_license', $candidate->driving_license) == "No") checked @endif @if($candidate->is_submit == 'Yes') disabled @endif>
                                    <label class="form-check-label" for="formRadios2">
                                        No
                                    </label>
                                </div>
                            </div>
                        </div>
                        <label for="driving_license" class="error"></label>
                        @if($candidate->driving_license == "Yes")
                        <div class="row" id="driving_license_type_show">
                            <div class="col-lg-6">
                                <div class="mt-4">
                                    <h5 class="font-size-14 mb-4"></h5>
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" value="Full UK Driving License" name="driving_license_type" id="driving_license_type_full_uk" @if(old('driving_license_type', $candidate->driving_license_type) == "Full UK Driving License") checked @endif @if($candidate->is_submit == 'Yes') disabled @endif>
                                    <label class="form-check-label" for="formRadios1">
                                        Full UK Driving License
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="International Driving License" name="driving_license_type" id="driving_license_type_international" @if(old('driving_license_type', $candidate->driving_license_type) == "International Driving License") checked @endif @if($candidate->is_submit == 'Yes') disabled @endif>
                                    <label class="form-check-label" for="formRadios2">
                                        International Driving License
                                    </label>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="row" id="driving_license_type_show" style="display:none;">
                            <div class="col-lg-6">
                                <div class="mt-4">
                                    <h5 class="font-size-14 mb-4"></h5>
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" value="Full UK Driving License" name="driving_license_type" id="driving_license_type_full_uk" @if(old('driving_license_type', $candidate->driving_license_type) == "Full UK Driving License") checked @endif @if($candidate->is_submit == 'Yes') disabled @endif>
                                    <label class="form-check-label" for="formRadios1">
                                        Full UK Driving License
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="International Driving License" name="driving_license_type" id="driving_license_type_international" @if(old('driving_license_type', $candidate->driving_license_type) == "International Driving License") checked @endif @if($candidate->is_submit == 'Yes') disabled @endif>
                                    <label class="form-check-label" for="formRadios2">
                                        International Driving License
                                    </label>
                                </div>
                            </div>
                        </div>
                        @endif
                        <br>
                        <div class="row" id="driving_license_share_code" style="@if($candidate->driving_license_type == "Full UK Driving License") @else display: none @endif">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Share Code</label>
                                    <input type="text" name="driving_share_code" class="form-control" id="driving_share_code" placeholder="Enter Share Code" value="{{ old('driving_share_code', $candidate->driving_share_code ?? '') }}" @if($candidate->is_submit == 'Yes') disabled @endif>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="driving_license_details" style="@if($candidate->driving_license_type == "International Driving License") @else display: none @endif">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Driving License Number</label>
                                    <input type="text" name="driving_license_number" class="form-control" id="driving_license_number" placeholder="Enter Driving License Number" value="{{ old('driving_license_number', $candidate->driving_license_number ?? '') }}" @if($candidate->is_submit == 'Yes') disabled @endif>
                                </div>
                            </div>
                        </div>
                        <br>
                        <h4 class="card-title">Equality Act 2010</h4>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mt-4">
                                    <h5 class="font-size-14 mb-4">Under the Equality Act 2010 the definition of disability is if you have a physical or mental impairment that has a "substantial" and "long term adverse effect" on your ability to carry out normal day-to-day activities. Further information regarding the definition of disability can be found at: http://www.gov.uk/definition-of-disability-under-equality-act-2010/ For the purpose of this application and the interview stage only, is there anything you would like us to be aware of so that we can make reasonable adjustments during the process?<span>*</span></h5>
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" value="Yes" type="radio" name="equality_act" id="equality_act_yes" @if(old('equality_act', $candidate->equality_act) == "Yes") checked @endif @if($candidate->is_submit == 'Yes') disabled @endif>
                                    <label class="form-check-label" for="formRadios1">
                                        Yes
                                    </label>
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" value="No" type="radio" name="equality_act" id="equality_act_no" @if(old('equality_act', $candidate->equality_act) == "No") checked @endif @if($candidate->is_submit == 'Yes') disabled @endif>
                                    <label class="form-check-label" for="formRadios2">
                                        No
                                    </label>
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" value="Prefer not to be discuss" type="radio" name="equality_act" id="equality_act_prefer" @if(old('equality_act', $candidate->equality_act) == "Prefer not to be discuss") checked @endif @if($candidate->is_submit == 'Yes') disabled @endif>
                                    <label class="form-check-label" for="formRadios2">
                                        Prefer not to be discuss
                                    </label>
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" value="Other" name="equality_act" id="other_equality_act" @if(old('equality_act', $candidate->equality_act) == "Other") checked @endif @if($candidate->is_submit == 'Yes') disabled @endif>
                                    <label class="form-check-label" for="formRadios2">
                                        Other
                                    </label>
                                    <br>
                                    <br>
                                    <input type="text" name="other_equality_act_text" class="form-control" value="@if(old('equality_act', $candidate->equality_act) == "Other") {{$candidate->other_equality_act_text}} @endif"  id="other_equality_act_text" style="@if(old('equality_act', $candidate->equality_act) == "Other") @else display: none @endif" @if($candidate->is_submit == 'Yes') disabled @endif>
                                </div>
                            </div>
                        </div>
                        <label for="equality_act" class="error"></label>
                        <br>
                        <h4 class="card-title">Education Details</h4>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mt-4">
                                    <h5 class="font-size-14 mb-4">Are you currently studying?<span>*</span></h5>
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" value="Yes" name="currently_studying" id="currently_studying_yes" @if(old('currently_studying', $candidate->currently_studying) == "Yes") checked @endif @if($candidate->is_submit == 'Yes') disabled @endif>
                                    <label class="form-check-label" for="formRadios1">
                                        Yes
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="No" name="currently_studying" id="currently_studying_no" @if(old('currently_studying', $candidate->currently_studying) == "No") checked @endif @if($candidate->is_submit == 'Yes') disabled @endif>
                                    <label class="form-check-label" for="formRadios2">
                                        No
                                    </label>
                                </div>
                            </div>
                        </div>
                        <br>
                        <label for="currently_studying" class="error"></label>
                        <!--<div class="row" id="currently_studying_form" style="@if($candidate->currently_studying == "Yes") @else display: none; @endif">-->
                        <!--    <div class="col-lg-4">-->
                        <!--        <div class="mb-3">-->
                        <!--            <label for="basicpill-firstname-input">Date of Completion (Expected Date)</label>-->
                        <!--            <input type="date" name="date_of_comletion" class="form-control" id="date_of_comletion" placeholder="Enter Date" value="{{$candidate->date_of_comletion ?? ''}}">-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--    <div class="col-lg-4">-->
                        <!--        <div class="mb-3">-->
                        <!--            <label for="basicpill-firstname-input">Current Education School / College / University</label>-->
                        <!--            <input type="text" name="current_education_school" class="form-control" id="current_education_school" value="{{$candidate->current_education_school ?? ''}}">-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--    <div class="col-lg-4">-->
                        <!--        <div class="mb-3">-->
                        <!--            <label for="basicpill-firstname-input">Current Education Qualification you Enrolled in</label>-->
                        <!--            <input type="text" name="current_education_enrolled" class="form-control" id="current_education_enrolled" value="{{$candidate->current_education_enrolled ?? ''}}">-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</div>-->
                        @php $currently_studying_details = json_decode($candidate->currently_studying_details, true) @endphp
                        @if (!empty($currently_studying_details) && count($currently_studying_details) > 0)
                        <div class="education_details" id="currently_studying_form" style="@if($candidate->currently_studying == "Yes") @else display: none; @endif">
                            @foreach($currently_studying_details as $i => $val)
                            @if ($i == 0)
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="mb-3" id="datepicker2">
                                        <label for="basicpill-firstname-input">Date of Completion (Expected Date)</label>
                                        <input type="text" name="date_of_comletion[]" value="{{ old('date_of_comletion.' . $i, $val['date_of_comletion'] ?? '') }}" class="form-control" id="date_of_comletion" placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd" data-date-container='#datepicker2' data-provide="datepicker" data-date-autoclose="true" autocomplete="off" @if($candidate->is_submit == 'Yes') disabled @endif>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input">Current Education School / College / University</label>
                                        <input type="text" name="current_education_school[]" class="form-control" id="current_education_school" value="{{ old('current_education_school.' . $i, $val['current_education_school'] ?? '') }}" @if($candidate->is_submit == 'Yes') disabled @endif>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input">Current Education Qualification you Enrolled in</label>
                                        <input type="text" name="current_education_enrolled[]" class="form-control" id="current_education_enrolled" value="{{ old('current_education_enrolled.' . $i, $val['current_education_enrolled'] ?? '') }}" @if($candidate->is_submit == 'Yes') disabled @endif>
                                    </div>
                                </div>
                                <div class="col-lg-1">
                                    <br>
                                    <button type="button" class="btn btn-primary w-md add_education_data" data-id="1" style="margin-top: 8px;min-width:70px;" @if($candidate->is_submit == 'Yes') disabled @endif>+</button>
                                </div>
                            </div>
                            @else
                            <div class="row" id="remove_studying_data_{{$i + 1}}">
                                <div class="col-lg-3" id="datepicker2">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input">Date of Completion (Expected Date)</label>
                                        <input type="text" name="date_of_comletion[]" value="{{ old('date_of_completion.' . $i, $val['date_of_comletion'] ?? '') }}" class="form-control" id="date_of_comletion" placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd" data-date-container='#datepicker2' data-provide="datepicker" data-date-autoclose="true" autocomplete="off" @if($candidate->is_submit == 'Yes') disabled @endif>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input">Current Education School / College / University</label>
                                        <input type="text" name="current_education_school[]" class="form-control" id="current_education_school" value="{{ old('current_education_school.' . $i, $val['current_education_school'] ?? '') }}" @if($candidate->is_submit == 'Yes') disabled @endif>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input">Current Education Qualification you Enrolled in</label>
                                        <input type="text" name="current_education_enrolled[]" class="form-control" id="current_education_enrolled" value="{{ old('current_education_enrolled.' . $i, $val['current_education_enrolled'] ?? '') }}" @if($candidate->is_submit == 'Yes') disabled @endif>
                                    </div>
                                </div>
                                <div class="col-lg-1">
                                    <br>
                                    <button type="button" class="btn btn-danger w-md remove_education_data" data-id="{{$i + 1}}" style="margin-top: 8px;min-width:70px;" @if($candidate->is_submit == 'Yes') disabled @endif>+</button>
                                </div>
                            </div>
                            @endif
                            @endforeach
                        </div>
                        @else
                        <div class="education_details" id="currently_studying_form" style="@if($candidate->currently_studying == "Yes") @else display: none; @endif">
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="mb-3" id="datepicker2">
                                        <label for="basicpill-firstname-input">Date of Completion (Expected Date)</label>
                                        <input type="text" name="date_of_comletion[]" value="{{ old('date_of_comletion.0', $candidate->date_of_comletion ?? '') }}" class="form-control" id="date_of_comletion" placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd" data-date-container='#datepicker2' data-provide="datepicker" data-date-autoclose="true" autocomplete="off" @if($candidate->is_submit == 'Yes') disabled @endif>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input">Current Education School / College / University</label>
                                        <input type="text" name="current_education_school[]" class="form-control" id="current_education_school" value="{{old('current_education_school.0', $candidate->current_education_school ?? '')}}" @if($candidate->is_submit == 'Yes') disabled @endif>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input">Current Education Qualification you Enrolled in</label>
                                        <input type="text" name="current_education_enrolled[]" class="form-control" id="current_education_enrolled" value="{{old('current_education_enrolled.0', $candidate->current_education_enrolled ?? '')}}" @if($candidate->is_submit == 'Yes') disabled @endif>
                                    </div>
                                </div>
                                <div class="col-lg-1">
                                    <br>
                                    <button type="button" class="btn btn-primary w-md add_education_data" data-id="1" style="margin-top: 8px;min-width:70px;" @if($candidate->is_submit == 'Yes') disabled @endif>+</button>
                                </div>
                            </div>
                        </div>
                        @endif
                        <br>
                        <div class="old_studying" style="@if($candidate->currently_studying == "No") @else display: none @endif">
                        <h4 class="card-title">Please give your previous education details</h4>
                        <br>
                        @php $old_emp_details = json_decode($candidate->old_emp_details, true) @endphp
                        @if (!empty($old_emp_details) && count($old_emp_details) > 0)
                        <div class="education_details_no" id="currently_studying_form_no" style="@if($candidate->currently_studying == "No") @else display: none; @endif">
                            @foreach($old_emp_details as $i => $val)
                            @if ($i == 0)
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="mb-3 " id="datepicker3">
                                        <label for="basicpill-firstname-input">Date of Completion</label>
                                        <input type="text" name="old_date_comletion[]" value="{{ old('old_date_comletion.' . $i, $val['old_date_comletion'] ?? '') }}" class="cust-margin-2 form-control old_date_comletion" id="old_date_comletion" placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd" data-date-container='#datepicker3' data-provide="datepicker" data-date-autoclose="true" autocomplete="off" @if($candidate->is_submit == 'Yes') disabled @endif>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input">Education School / College / University</label>
                                        <input type="text" name="old_education_school[]" class="form-control" id="old_education_school" value="{{ old('old_education_school.' . $i, $val['old_education_school'] ?? '') }}" @if($candidate->is_submit == 'Yes') disabled @endif>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input">Education Qualification you achieved</label>
                                        <input type="text" name="old_education_enrolled[]" class="form-control" id="old_education_enrolled" value="{{ old('old_education_enrolled.' . $i, $val['old_education_enrolled'] ?? '') }}" @if($candidate->is_submit == 'Yes') disabled @endif>
                                    </div>
                                </div>
                                <div class="col-lg-1">
                                    <br>
                                    <button type="button" class="cust-margin-4 btn btn-primary w-md add_education_data_for_no" data-id="1" style="margin-top: 8px;min-width:70px;" @if($candidate->is_submit == 'Yes') disabled @endif>+</button>
                                </div>
                            </div>
                            @else
                            <div class="row" id="remove_studying_data_no_{{$i + 1}}">
                                <div class="col-lg-3">
                                    <div class="mb-3" id="datepicker3">
                                        <label for="basicpill-firstname-input">Date of Completion</label>
                                        <input type="text" name="old_date_comletion[]" value="{{ old('old_date_comletion.' . $i, $val['old_date_comletion'] ?? '') }}" class="cust-margin-2 form-control old_date_comletion" id="old_date_comletion" placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd" data-date-container='#datepicker3' data-provide="datepicker" data-date-autoclose="true" autocomplete="off" @if($candidate->is_submit == 'Yes') disabled @endif>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input">Education School / College / University</label>
                                        <input type="text" name="old_education_school[]" class="form-control" id="old_education_school" value="{{ old('old_education_school.' . $i, $val['old_education_school'] ?? '') }}" @if($candidate->is_submit == 'Yes') disabled @endif>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input">Education Qualification you achieved</label>
                                        <input type="text" name="old_education_enrolled[]" class="form-control" id="old_education_enrolled" value="{{ old('old_education_enrolled.' . $i, $val['old_education_enrolled'] ?? '') }}" @if($candidate->is_submit == 'Yes') disabled @endif>
                                    </div>
                                </div>
                                <div class="col-lg-1">
                                    <br>
                                    <button type="button" class="cust-margin-4 btn btn-danger w-md remove_education_data_no" data-id="{{$i + 1}}" style="margin-top: 8px;min-width:70px;" @if($candidate->is_submit == 'Yes') disabled @endif>-</button>
                                </div>
                            </div>
                            @endif
                            @endforeach
                        </div>
                        @else
                        <div class="education_details_no" id="currently_studying_form_no" style="@if($candidate->currently_studying == "No") @else display: none; @endif">
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="mb-3" id="datepicker3">
                                        <label for="basicpill-firstname-input">Date of Completion</label>
                                        <input type="text" name="old_date_comletion[]" value="{{$old_emp_details[0]['old_date_comletion'] ?? ''}}" class="cust-margin-2 form-control old_date_comletion" id="old_date_comletion" placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd" data-date-container='#datepicker3' data-provide="datepicker" data-date-autoclose="true" autocomplete="off" @if($candidate->is_submit == 'Yes') disabled @endif>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input">Education School / College / University</label>
                                        <input type="text" name="old_education_school[]" class="form-control" id="old_education_school" value="{{$old_emp_details[0]['old_education_school'] ?? ''}}" @if($candidate->is_submit == 'Yes') disabled @endif>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input">Education Qualification you achieved</label>
                                        <input type="text" name="old_education_enrolled[]" class="form-control" id="old_education_enrolled" value="{{$old_emp_details[0]['old_education_enrolled'] ?? ''}}" @if($candidate->is_submit == 'Yes') disabled @endif>
                                    </div>
                                </div>
                                <div class="col-lg-1">
                                    <br>
                                    <button type="button" class="cust-margin-4 btn btn-primary w-md add_education_data_for_no" data-id="1" style="margin-top: 8px;min-width:70px;" @if($candidate->is_submit == 'Yes') disabled @endif>+</button>
                                </div>
                            </div>
                        </div>
                        @endif
                        <!--<div class="row">-->
                        <!--    <div class="col-lg-4">-->
                        <!--        <div class="mb-3" id="datepicker3">-->
                        <!--            <label for="basicpill-firstname-input">Date of Completion</label>-->
                        <!--            <input type="text" name="old_date_comletion[]" value="{{$old_emp_details[1]['old_date_comletion'] ?? ''}}" class="form-control" id="old_date_comletion" placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd" data-date-container='#datepicker3' data-provide="datepicker" data-date-autoclose="true" autocomplete="off">-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--    <div class="col-lg-4">-->
                        <!--        <div class="mb-3">-->
                        <!--            <label for="basicpill-firstname-input">Education School / College / University</label>-->
                        <!--            <input type="text" name="old_education_school[]" class="form-control" id="old_education_school" value="{{$old_emp_details[1]['old_education_school'] ?? ''}}">-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--    <div class="col-lg-4">-->
                        <!--        <div class="mb-3">-->
                        <!--            <label for="basicpill-firstname-input">Education Qualification you achieved</label>-->
                        <!--            <input type="text" name="old_education_enrolled[]" class="form-control" id="old_education_enrolled" value="{{$old_emp_details[1]['old_education_enrolled'] ?? ''}}">-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</div>-->
                        <!--<div class="row">-->
                        <!--    <div class="col-lg-4">-->
                        <!--        <div class="mb-3" id="datepicker3">-->
                        <!--            <label for="basicpill-firstname-input">Date of Completion</label>-->
                        <!--            <input type="text" name="old_date_comletion[]" value="{{$old_emp_details[2]['old_date_comletion'] ?? ''}}" class="form-control" id="old_date_comletion" placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd" data-date-container='#datepicker3' data-provide="datepicker" data-date-autoclose="true" autocomplete="off">-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--    <div class="col-lg-4">-->
                        <!--        <div class="mb-3">-->
                        <!--            <label for="basicpill-firstname-input">Education School / College / University</label>-->
                        <!--            <input type="text" name="old_education_school[]" class="form-control" id="old_education_school" value="{{$old_emp_details[2]['old_education_school'] ?? ''}}">-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--    <div class="col-lg-4">-->
                        <!--        <div class="mb-3">-->
                        <!--            <label for="basicpill-firstname-input">Education Qualification you achieved</label>-->
                        <!--            <input type="text" name="old_education_enrolled[]" class="form-control" id="old_education_enrolled" value="{{$old_emp_details[2]['old_education_enrolled'] ?? ''}}">-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</div>-->
                        </div>
                        <br>
                        <h4 class="card-title">Training Course Details</h4>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mt-4">
                                    <h5 class="font-size-14 mb-4">Have you attended any training courses?<span>*</span></h5>
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" value="Yes" name="training_courses" id="training_courses_yes" @if($candidate->training_courses == "Yes") checked @endif @if($candidate->is_submit == 'Yes') disabled @endif>
                                    <label class="form-check-label" for="formRadios1">
                                        Yes
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="No" name="training_courses" id="training_courses_no" @if($candidate->training_courses == "No") checked @endif @if($candidate->is_submit == 'Yes') disabled @endif>
                                    <label class="form-check-label" for="formRadios2">
                                        No
                                    </label>
                                </div>
                            </div>
                        </div>
                        <br>
                        <label for="training_courses" class="error"></label>
                        @php $training_courses_details = json_decode($candidate->training_courses_details, true) @endphp
                        @if (!empty($training_courses_details) && count($training_courses_details) > 0)
                        <div class="training_courses_show" style="@if($candidate->training_courses == "Yes") @else display: none @endif">
                            @foreach($training_courses_details as $i => $val)
                            @if ($i == 0)
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="mb-3" id="datepicker4">
                                        <label for="basicpill-firstname-input">Date of Completion</label>
                                        <input type="text" name="training_date_comletion[]" value="{{$val['training_date_comletion'] ?? ''}}" class="form-control" id="training_date_comletion_1" placeholder="dd-mm-yyyy" data-date-format="dd-mm-yyyy" data-date-container='#datepicker4' data-provide="datepicker" data-date-autoclose="true" autocomplete="off" @if($candidate->is_submit == 'Yes') disabled @endif>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input">Training Subject</label>
                                        <input type="text" name="training_subject[]" class="form-control" id="training_subject_1" value="{{$val['training_subject'] ?? ''}}" @if($candidate->is_submit == 'Yes') disabled @endif>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input">Training Location / Details</label>
                                        <input type="text" name="training_location[]" class="form-control" id="training_location_1" value="{{$val['training_location'] ?? ''}}" @if($candidate->is_submit == 'Yes') disabled @endif>
                                    </div>
                                </div>
                                <div class="col-lg-1">
                                    <br>
                                    <button type="button" class="cust-margin-3 btn btn-primary w-md add_training_data" data-id="1" style="margin-top: 8px;min-width:70px;" @if($candidate->is_submit == 'Yes') disabled @endif>+</button>
                                </div>
                            </div>
                            @else
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="mb-3" id="datepicker4">
                                        <label for="basicpill-firstname-input">Date of Completion</label>
                                        <input type="text" name="training_date_comletion[]" value="{{$val['training_date_comletion'] ?? ''}}" class="form-control" id="training_date_comletion_1" placeholder="dd-mm-yyyy" data-date-format="dd-mm-yyyy" data-date-container='#datepicker4' data-provide="datepicker" data-date-autoclose="true" autocomplete="off" @if($candidate->is_submit == 'Yes') disabled @endif>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input">Training Subject</label>
                                        <input type="text" name="training_subject[]" class="form-control" id="training_subject_1" value="{{$val['training_subject'] ?? ''}}" @if($candidate->is_submit == 'Yes') disabled @endif>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input">Training Location / Details</label>
                                        <input type="text" name="training_location[]" class="form-control" id="training_location_1" value="{{$val['training_location'] ?? ''}}" @if($candidate->is_submit == 'Yes') disabled @endif>
                                    </div>
                                </div>
                                <div class="col-lg-1">
                                    <br>
                                    <button type="button" class="cust-margin-3 btn btn-danger w-md remove_training_data" data-id="{{$i + 1}}" style="margin-top: 8px;min-width:70px;" @if($candidate->is_submit == 'Yes') disabled @endif>-</button>
                                </div>
                            </div>
                            @endif
                            @endforeach
                        </div>
                        @else
                        <div class="training_courses_show" style="@if($candidate->training_courses == "Yes") @else display: none @endif">
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="mb-3" id="datepicker4">
                                        <label for="basicpill-firstname-input">Date of Completion</label>
                                        <input type="text" name="training_date_comletion[]" value="{{$val['training_date_comletion'] ?? ''}}" class="form-control" id="training_date_comletion_1" placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd" data-date-container='#datepicker4' data-provide="datepicker" data-date-autoclose="true" autocomplete="off" @if($candidate->is_submit == 'Yes') disabled @endif>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input">Training Subject</label>
                                        <input type="text" name="training_subject[]" class="form-control" id="training_subject_1" @if($candidate->is_submit == 'Yes') disabled @endif>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input">Training Location / Details</label>
                                        <input type="text" name="training_location[]" class="form-control" id="training_location_1" @if($candidate->is_submit == 'Yes') disabled @endif>
                                    </div>
                                </div>
                                <div class="col-lg-1">
                                    <br>
                                    <button type="button" class="btn btn-primary w-md add_training_data" data-id="1" style="margin-top: 8px;min-width:70px;" @if($candidate->is_submit == 'Yes') disabled @endif>+</button>
                                </div>
                            </div>
                        </div>
                        @endif
                        <!--<div class="row">-->
                        <!--    <div class="col-lg-4">-->
                        <!--        <div class="mb-3">-->
                        <!--            <label for="basicpill-firstname-input">Date of Completion</label>-->
                        <!--            <input type="date" name="training_date_comletion[]" class="form-control" id="training_date_comletion_2" placeholder="Enter Date" value="{{$training_courses_details[1]['training_date_comletion'] ?? ''}}">-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--    <div class="col-lg-4">-->
                        <!--        <div class="mb-3">-->
                        <!--            <label for="basicpill-firstname-input">Training Subject</label>-->
                        <!--            <input type="text" name="training_subject[]" class="form-control" id="training_subject_2" value="{{$training_courses_details[1]['training_subject'] ?? ''}}">-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--    <div class="col-lg-4">-->
                        <!--        <div class="mb-3">-->
                        <!--            <label for="basicpill-firstname-input">Training Location / Details</label>-->
                        <!--            <input type="text" name="training_location[]" class="form-control" id="training_location_2" value="{{$training_courses_details[1]['training_location'] ?? ''}}">-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</div>-->
                        <!--<div class="row">-->
                        <!--    <div class="col-lg-4">-->
                        <!--        <div class="mb-3">-->
                        <!--            <label for="basicpill-firstname-input">Date of Completion</label>-->
                        <!--            <input type="date" name="training_date_comletion[]" class="form-control" id="training_date_comletion_3" placeholder="Enter Date" value="{{$training_courses_details[2]['training_date_comletion'] ?? ''}}">-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--    <div class="col-lg-4">-->
                        <!--        <div class="mb-3">-->
                        <!--            <label for="basicpill-firstname-input">Training Subject</label>-->
                        <!--            <input type="text" name="training_subject[]" class="form-control" id="training_subject_3" value="{{$training_courses_details[2]['training_subject'] ?? ''}}">-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--    <div class="col-lg-4">-->
                        <!--        <div class="mb-3">-->
                        <!--            <label for="basicpill-firstname-input">Training Location / Details</label>-->
                        <!--            <input type="text" name="training_location[]" class="form-control" id="training_location_3" value="{{$training_courses_details[2]['training_location'] ?? ''}}">-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</div>-->
                        <!--<div class="row">-->
                        <!--    <div class="col-lg-4">-->
                        <!--        <div class="mb-3">-->
                        <!--            <label for="basicpill-firstname-input">Date of Completion</label>-->
                        <!--            <input type="date" name="training_date_comletion[]" class="form-control" id="training_date_comletion_4" placeholder="Enter Date" value="{{$training_courses_details[3]['training_date_comletion'] ?? ''}}">-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--    <div class="col-lg-4">-->
                        <!--        <div class="mb-3">-->
                        <!--            <label for="basicpill-firstname-input">Training Subject</label>-->
                        <!--            <input type="text" name="training_subject[]" class="form-control" id="training_subject_4" value="{{$training_courses_details[3]['training_subject'] ?? ''}}">-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--    <div class="col-lg-4">-->
                        <!--        <div class="mb-3">-->
                        <!--            <label for="basicpill-firstname-input">Training Location / Details</label>-->
                        <!--            <input type="text" name="training_location[]" class="form-control" id="training_location_4" value="{{$training_courses_details[3]['training_location'] ?? ''}}">-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</div>-->
                        <!--<div class="row">-->
                        <!--    <div class="col-lg-4">-->
                        <!--        <div class="mb-3">-->
                        <!--            <label for="basicpill-firstname-input">Date of Completion</label>-->
                        <!--            <input type="date" name="training_date_comletion[]" class="form-control" id="training_date_comletion_5" placeholder="Enter Date" value="{{$training_courses_details[4]['training_date_comletion'] ?? ''}}">-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--    <div class="col-lg-4">-->
                        <!--        <div class="mb-3">-->
                        <!--            <label for="basicpill-firstname-input">Training Subject</label>-->
                        <!--            <input type="text" name="training_subject[]" class="form-control" id="training_subject_5" value="{{$training_courses_details[4]['training_subject'] ?? ''}}">-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--    <div class="col-lg-4">-->
                        <!--        <div class="mb-3">-->
                        <!--            <label for="basicpill-firstname-input">Training Location / Details</label>-->
                        <!--            <input type="text" name="training_location[]" class="form-control" id="training_location_5" value="{{$training_courses_details[4]['training_location'] ?? ''}}">-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</div>-->
                        <!--</div>-->
                        <input style="float:right;" type="button" id="stepone" name="next" class="next btn btn-primary waves-effect waves-light" @if($candidate->work_eligible == "No") disabled @endif value="Next"/>
                    </fieldset>
                    <fieldset id="step2" style="display: none;">
                        <h4 class="card-title">Employment History</h4>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mt-4">
                                    <h5 class="font-size-14 mb-4">Are you currently employed?<span>*</span></h5>
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" value="Yes" name="currently_emp" id="currently_emp_yes" @if($candidate->currently_emp == "Yes") checked @endif @if($candidate->is_submit == 'Yes') disabled @endif>
                                    <label class="form-check-label" for="formRadios1">
                                        Yes
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="No" name="currently_emp" id="currently_emp_no" @if($candidate->currently_emp == "No") checked @endif @if($candidate->is_submit == 'Yes') disabled @endif>
                                    <label class="form-check-label" for="formRadios2">
                                        No
                                    </label>
                                </div>
                            </div>
                        </div>
                        <br>
                        <label for="currently_emp" class="error"></label>
                        <br>
                        <div class="current_emp_data" style="@if($candidate->currently_emp == "Yes") @else display: none @endif">
                            <h4 class="card-title">Current Employment Details</h4>
                            <br>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input">Name of Company<span>*</span></label>
                                        <input type="text" name="current_name_company" class="form-control" id="current_name_company" value="{{$candidate->current_name_company ?? ''}}" @if($candidate->is_submit == 'Yes') disabled @endif>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input">Address of Current Employer</label>
                                        <input type="text" name="address_current_company" class="form-control" id="address_current_company" value="{{$candidate->current_name_company ?? ''}}" @if($candidate->is_submit == 'Yes') disabled @endif>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input">Employer Email Address<span>*</span></label>
                                        <input type="email" name="current_employer_email" class="form-control" id="current_employer_email" value="{{$candidate->current_employer_email ?? ''}}" @if($candidate->is_submit == 'Yes') disabled @endif>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input">Employer Phone</label>
                                        <input type="number" name="current_employer_phone" class="form-control" id="current_employer_phone" value="{{$candidate->current_employer_phone ?? ''}}" @if($candidate->is_submit == 'Yes') disabled @endif>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input">Joining Date</label>
                                        <input type="date" name="current_joining_date" class="form-control" id="joining_date" value="{{$candidate->current_joining_date ?? ''}}" @if($candidate->is_submit == 'Yes') disabled @endif>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input">Nature of Business</label>
                                        <input type="text" name="current_nature_business" class="form-control" id="current_nature_business" value="{{$candidate->current_nature_business ?? ''}}" @if($candidate->is_submit == 'Yes') disabled @endif>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input">Position You Held</label>
                                        <input type="text" name="current_postion_held" class="form-control" id="current_postion_held" value="{{$candidate->current_postion_held ?? ''}}" @if($candidate->is_submit == 'Yes') disabled @endif>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input">Reason for Leaving</label>
                                        <textarea name="current_reason_for_leaving" id="current_reason_for_leaving" class="form-control" rows="5" spellcheck="false" @if($candidate->is_submit == 'Yes') disabled @endif>{{$candidate->current_reason_for_leaving ?? ''}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--<br>-->
                        <!--<h4 class="card-title">Other Employment</h4>-->
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mt-4">
                                    <h5 class="font-size-14 mb-4">Do you have any other employment?</h5>
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" value="Yes" name="other_emp" id="other_emp_yes" @if($candidate->other_emp == 'Yes') checked @endif @if($candidate->is_submit == 'Yes') disabled @endif>
                                    <label class="form-check-label" for="formRadios1">
                                        Yes
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="No" name="other_emp" id="other_emp_no" @if($candidate->other_emp == 'No') checked @endif @if($candidate->is_submit == 'Yes') disabled @endif>
                                    <label class="form-check-label" for="formRadios2">
                                        No
                                    </label>
                                </div>
                            </div>
                        </div>
                        <br>
                        <label for="other_emp" class="error"></label>
                        <br>
                        <div class="other_emp_data" style="@if($candidate->other_emp == 'Yes') @else display: none @endif">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input">Name of Company<span>*</span></label>
                                        <input type="text" name="other_name_company" class="form-control" id="other_name_company" value="{{$candidate->other_name_company ?? ''}}" @if($candidate->is_submit == 'Yes') disabled @endif>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input">Address of Company</label>
                                        <input type="text" name="other_address_company" class="form-control" id="other_address_company" value="{{$candidate->other_address_company ?? ''}}" @if($candidate->is_submit == 'Yes') disabled @endif>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input">Employer Email Address</label>
                                        <input type="email" name="other_emp_email" class="form-control" id="other_emp_email" value="{{$candidate->other_emp_email ?? ''}}" @if($candidate->is_submit == 'Yes') disabled @endif>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input">phone</label>
                                        <input type="number" name="other_phone" class="form-control" id="other_phone" value="{{$candidate->other_phone ?? ''}}" @if($candidate->is_submit == 'Yes') disabled @endif>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input">Joining Date</label>
                                        <input type="date" name="other_joining_date" class="form-control" id="other_joining_date" value="{{$candidate->other_joining_date ?? ''}}" @if($candidate->is_submit == 'Yes') disabled @endif>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input">Relieving Date</label>
                                        <input type="date" name="other_relieving_date" class="form-control" id="other_relieving_date" value="{{$candidate->other_relieving_date ?? ''}}" @if($candidate->is_submit == 'Yes') disabled @endif>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input">Nature of Business</label>
                                        <input type="text" name="other_nature_business" class="form-control" id="other_nature_business" value="{{$candidate->other_nature_business ?? ''}}" @if($candidate->is_submit == 'Yes') disabled @endif>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input">Reason for Leaving</label>
                                        <input type="text" name="other_reason_for_leaving" id="other_reason_for_leaving" class="form-control" spellcheck="false" value="{{$candidate->other_reason_for_leaving ?? ''}}" @if($candidate->is_submit == 'Yes') disabled @endif>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <h4 class="card-title">Last 10 Years History</h4>
                        <div class="mb-3">
                            <label for="basicpill-firstname-input">Kindly write the history of your last 10 years. Education, Housewife, Health Issue, Look after family members, Unemployed, etc.</label>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mt-4">
                                    <h5 class="font-size-14 mb-4">Details of last 10 years</h5>
                                </div>
                            </div>
                        </div>
                        @php $ten_year_history = json_decode($candidate->ten_year_history, true); @endphp
                        @if (!empty($ten_year_history) && count($ten_year_history) > 0)
                        <div class="ten_year_details">
                        @foreach($ten_year_history as $i => $val)
                            @if ($i == 0)
                            <div class="row">
                                <div class="col-lg-5">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input">From Date - To Date (mm/yy)</label>
                                        <input type="text" name="history_from_date_to_date[]" class="form-control" id="history_from_date_to_date" value="{{$val['history_from_date_to_date'] ?? ''}}" @if($candidate->is_submit == 'Yes') disabled @endif>
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input">Description</label>
                                        <input type="text" name="history_desc[]" class="form-control" id="history_desc" value="{{$val['history_desc'] ?? ''}}" @if($candidate->is_submit == 'Yes') disabled @endif>
                                    </div>
                                </div>
                                <div class="col-lg-1">
                                    <br>
                                    <button type="button" class="cust-margin-3 btn btn-primary w-md add_10_year_data" data-id="{{count($ten_year_history)}}" style="margin-top: 8px;" @if($candidate->is_submit == 'Yes') disabled @endif>+</button>
                                </div>
                            </div>
                            @else
                            <div class="row" id="remove_data_{{$i+1}}">
                                <div class="col-lg-5">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input">From Date - To Date (mm/yy)</label>
                                        <input type="text" name="history_from_date_to_date[]" class="form-control" id="history_from_date_to_date" value="{{$val['history_from_date_to_date'] ?? ''}}" @if($candidate->is_submit == 'Yes') disabled @endif>
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input">Description</label>
                                        <input type="text" name="history_desc[]" class="form-control" id="history_desc" value="{{$val['history_desc'] ?? ''}}" @if($candidate->is_submit == 'Yes') disabled @endif>
                                    </div>
                                </div>
                                <div class="col-lg-1">
                                    <br>
                                    <button type="button" class="cust-margin-3 btn btn-danger w-md remove_10_year_data" data-id="{{$i + 1}}" style="margin-top: 8px;" @if($candidate->is_submit == 'Yes') disabled @endif>-</button>
                                </div>
                            </div>
                            @endif
                        @endforeach
                        </div>
                        @else
                        <div class="ten_year_details">
                            <div class="row">
                                <div class="col-lg-5">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input">From Date - To Date (mm/yy)</label>
                                        <input type="text" name="history_from_date_to_date[]" class="form-control" id="history_from_date_to_date" @if($candidate->is_submit == 'Yes') disabled @endif>
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input">Description</label>
                                        <input type="text" name="history_desc[]" class="form-control" id="history_desc" @if($candidate->is_submit == 'Yes') disabled @endif>
                                    </div>
                                </div>
                                <div class="col-lg-1">
                                    <br>
                                    <button type="button" class="btn btn-primary w-md add_10_year_data" data-id="1" style="margin-top: 8px;" @if($candidate->is_submit == 'Yes') disabled @endif>+</button>
                                </div>
                            </div>
                        </div>
                        @endif
                        <br>
                        <h4 class="card-title">Supporting Statement</h4>
                        <div class="mb-3">
                            <label for="basicpill-firstname-input">Please add here your reason for applying. You should refer to the job description and person specification to guide you. It would also be of value to describe particular strength and talents that set you apart from others as well as including skills gained from work, home and other activities.</label>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Description</label>
                                    <textarea name="supporting_desc" id="supporting_desc" class="form-control" rows="5" spellcheck="false" @if($candidate->is_submit == 'Yes') disabled @endif>{{$candidate->supporting_desc ?? ''}}</textarea>
                                </div>
                            </div>
                        </div>
                        <input type="button" name="previous" id="previous1" class="previous btn btn-primary waves-effect waves-light" value="Previous"/>
                        <input style="float:right;" type="button" id="steptwo" name="next" class="next btn btn-primary waves-effect waves-light" value="Next" />
                    </fieldset>
                    <fieldset id="step3" style="display: none;">
                        <h4 class="card-title">Reference Details</h4>
                        <br>
                        <div class="add_character_reference">
                        @php
                            $referenceList1 = [];
                            if ($candidate->referenceList && $candidate->referenceList->reference_1_json) {
                                $referenceList1 = json_decode($candidate->referenceList->reference_1_json, true);
                            }
                        @endphp
                        @if (count($referenceList1) > 0)
                        @foreach ($referenceList1 as $i => $reference)
                        @if ($i == 0)
                        <div class="row">
                            <div class="col-lg-4">
                                <h4 class="card-title">Character Reference</h4>
                            </div>
                            <div class="col-lg-6"></div>
                            <div class="col-lg-2" style=""><button type="button" class="btn btn-primary w-md add_more_character_data"  data-id="1" style="margin-top: 8px;min-width:70px;float:right;" @if($candidate->is_submit == 'Yes') disabled @endif>+</button></div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Reference Name</label>
                                    <input type="text" name="reference_name_1[]" value="{{$reference['name_1'] ?? ''}}" class="form-control" id="reference_name_1" required @if($candidate->is_submit == 'Yes') disabled @endif>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Name of Company</label>
                                    <input type="text" name="reference_place_work_1[]" class="form-control" id="reference_place_work_1" value="{{$reference['reference_place_work_1'] ?? ''}}" required @if($candidate->is_submit == 'Yes') disabled @endif>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Job Title</label>
                                    <input type="text" name="reference_job_title_1[]" class="form-control" id="reference_job_title_1" value="{{$reference['reference_job_title_1'] ?? ''}}" required @if($candidate->is_submit == 'Yes') disabled @endif>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Phone Number</label>
                                    <input type="number" name="reference_number_1[]" value="{{$reference['number_1'] ?? ''}}" class="form-control" id="reference_number_1" required @if($candidate->is_submit == 'Yes') disabled @endif>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Email Address</label>
                                    <input type="email" name="reference_email_1[]" value="{{$reference['email_1'] ?? ''}}" class="form-control" id="reference_email_1" required @if($candidate->is_submit == 'Yes') disabled @endif>
                                </div>
                            </div>
                        </div>
                        @else
                        <div id="remove_more_character_data_{{$i + 1}}">
                        <div class="row">
                            <div class="col-lg-4">
                                <h4 class="card-title">Character Reference</h4>
                            </div>
                            <div class="col-lg-6"></div>
                            <div class="col-lg-2" style=""><button type="button" class="btn btn-danger w-md remove_more_character_data"  data-id="{{$i + 1}}" style="margin-top: 8px;min-width:70px;float:right;" @if($candidate->is_submit == 'Yes') disabled @endif>-</button></div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Reference Name</label>
                                    <input type="text" name="reference_name_1[]" value="{{$reference['name_1'] ?? ''}}" class="form-control" id="reference_name_1" @if($candidate->is_submit == 'Yes') disabled @endif>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Name of Company</label>
                                    <input type="text" name="reference_place_work_1[]" class="form-control" id="reference_place_work_1" value="{{$reference['reference_place_work_1'] ?? ''}}" @if($candidate->is_submit == 'Yes') disabled @endif>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Job Title</label>
                                    <input type="text" name="reference_job_title_1[]" class="form-control" id="reference_job_title_1" value="{{$reference['reference_job_title_1'] ?? ''}}" @if($candidate->is_submit == 'Yes') disabled @endif>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Phone Number</label>
                                    <input type="number" name="reference_number_1[]" value="{{$reference['number_1'] ?? ''}}" class="form-control" id="reference_number_1" @if($candidate->is_submit == 'Yes') disabled @endif>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Email Address</label>
                                    <input type="email" name="reference_email_1[]" value="{{$reference['email_1'] ?? ''}}" class="form-control" id="reference_email_1" @if($candidate->is_submit == 'Yes') disabled @endif>
                                </div>
                            </div>
                        </div>
                        </div>
                        @endif
                        @endforeach
                        @else
                        <div class="row">
                            <div class="col-lg-4">
                                <h4 class="card-title">Character Reference</h4>
                            </div>
                            <div class="col-lg-6"></div>
                            <div class="col-lg-2" style=""><button type="button" class="btn btn-primary w-md add_more_character_data"  data-id="1" style="margin-top: 8px;min-width:70px;float:right;" @if($candidate->is_submit == 'Yes') disabled @endif>+</button></div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Reference Name</label>
                                    <input type="text" name="reference_name_1[]"  class="form-control" id="reference_name_1" required @if($candidate->is_submit == 'Yes') disabled @endif>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Name of Company</label>
                                    <input type="text" name="reference_place_work_1[]" class="form-control" id="reference_place_work_1" required @if($candidate->is_submit == 'Yes') disabled @endif>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Job Title</label>
                                    <input type="text" name="reference_job_title_1[]" class="form-control" id="reference_job_title_1" required @if($candidate->is_submit == 'Yes') disabled @endif>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Phone Number</label>
                                    <input type="number" name="reference_number_1[]" class="form-control" id="reference_number_1" required @if($candidate->is_submit == 'Yes') disabled @endif>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Email Address</label>
                                    <input type="email" name="reference_email_1[]" class="form-control" id="reference_email_1" required @if($candidate->is_submit == 'Yes') disabled @endif>
                                </div>
                            </div>
                        </div>
                        @endif
                        </div>
                        <br>
                        <div class="add_professional_reference">
                        @php
                            $referenceList2 = [];
                            if ($candidate->referenceList && $candidate->referenceList->reference_2_json) {
                                $referenceList2 = json_decode($candidate->referenceList->reference_2_json, true);
                            }
                        @endphp
                        @if (count($referenceList2) > 0)
                        @foreach ($referenceList2 as $i => $reference)
                        @if ($i == 0)
                        <div class="row">
                            <div class="col-lg-4">
                                <h4 class="card-title">Professional Reference</h4>
                            </div>
                            <div class="col-lg-6"></div>
                            <div class="col-lg-2" style=""><button type="button" class="btn btn-primary w-md add_more_professional_data"  data-id="1" style="margin-top: 8px;min-width:70px;float:right;" @if($candidate->is_submit == 'Yes') disabled @endif>+</button></div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Reference Name</label>
                                    <input type="text" name="reference_name_2[]" value="{{$reference['name_2'] ?? ''}}" class="form-control" id="reference_name_2" required @if($candidate->is_submit == 'Yes') disabled @endif>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Name of Company</label>
                                    <input type="text" name="reference_place_work_2[]" class="form-control" id="reference_place_work_2" value="{{$reference['reference_place_work_2'] ?? ''}}" required @if($candidate->is_submit == 'Yes') disabled @endif>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Job Title</label>
                                    <input type="text" name="reference_job_title_2[]" class="form-control" id="reference_job_title_2" value="{{$reference['reference_job_title_2'] ?? ''}}" required @if($candidate->is_submit == 'Yes') disabled @endif>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Phone Number</label>
                                    <input type="number" name="reference_number_2[]" value="{{$reference['number_2'] ?? ''}}" class="form-control" id="reference_number_2" required @if($candidate->is_submit == 'Yes') disabled @endif>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Email Address</label>
                                    <input type="email" name="reference_email_2[]" value="{{$reference['email_2'] ?? ''}}" class="form-control" id="reference_email_2" required @if($candidate->is_submit == 'Yes') disabled @endif>
                                </div>
                            </div>
                        </div>
                        @else
                        <div id="remove_more_professional_data_{{$i + 1}}">
                        <div class="row">
                            <div class="col-lg-4">
                                <h4 class="card-title">Professional Reference</h4>
                            </div>
                            <div class="col-lg-6"></div>
                            <div class="col-lg-2" style=""><button type="button" class="btn btn-danger w-md remove_more_professional_data"  data-id="1" style="margin-top: 8px;min-width:70px;float:right;" @if($candidate->is_submit == 'Yes') disabled @endif>-</button></div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Reference Name</label>
                                    <input type="text" name="reference_name_2[]" value="{{$reference['name_2'] ?? ''}}" class="form-control" id="reference_name_2" @if($candidate->is_submit == 'Yes') disabled @endif>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Name of Company</label>
                                    <input type="text" name="reference_place_work_2[]" class="form-control" id="reference_place_work_2" value="{{$reference['reference_place_work_2'] ?? ''}}" @if($candidate->is_submit == 'Yes') disabled @endif>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Job Title</label>
                                    <input type="text" name="reference_job_title_2[]" class="form-control" id="reference_job_title_2" value="{{$reference['reference_job_title_2'] ?? ''}}" @if($candidate->is_submit == 'Yes') disabled @endif>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Phone Number</label>
                                    <input type="number" name="reference_number_2[]" value="{{$reference['number_2'] ?? ''}}" class="form-control" id="reference_number_2" @if($candidate->is_submit == 'Yes') disabled @endif>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Email Address</label>
                                    <input type="email" name="reference_email_2[]" value="{{$reference['email_2'] ?? ''}}" class="form-control" id="reference_email_2" @if($candidate->is_submit == 'Yes') disabled @endif>
                                </div>
                            </div>
                        </div>
                        </div>
                        @endif
                        @endforeach
                        @else
                        <div class="row">
                            <div class="col-lg-4">
                                <h4 class="card-title">Professional Reference</h4>
                            </div>
                            <div class="col-lg-6"></div>
                            <div class="col-lg-2" style=""><button type="button" class="btn btn-primary w-md add_more_professional_data"  data-id="1" style="margin-top: 8px;min-width:70px;float:right;" @if($candidate->is_submit == 'Yes') disabled @endif>+</button></div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Reference Name</label>
                                    <input type="text" name="reference_name_2[]" class="form-control" id="reference_name_2" required @if($candidate->is_submit == 'Yes') disabled @endif>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Name of Company</label>
                                    <input type="text" name="reference_place_work_2[]" class="form-control" id="reference_place_work_2" required @if($candidate->is_submit == 'Yes') disabled @endif>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Job Title</label>
                                    <input type="text" name="reference_job_title_2[]" class="form-control" id="reference_job_title_2" required @if($candidate->is_submit == 'Yes') disabled @endif>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Phone Number</label>
                                    <input type="number" name="reference_number_2[]" class="form-control" id="reference_number_2" required @if($candidate->is_submit == 'Yes') disabled @endif>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Email Address</label>
                                    <input type="email" name="reference_email_2[]" class="form-control" id="reference_email_2" required @if($candidate->is_submit == 'Yes') disabled @endif>
                                </div>
                            </div>
                        </div>
                        @endif
                        </div>
                        <br>
                        <h4 class="card-title">Safeguarding</h4>
                        <br>
                        <div class="mb-3">
                            <label for="basicpill-firstname-input">Please note this section will only be seen by those involved in the recruitment process and will be treated with the strictest of confidence.</label>
                        </div>
                        <div class="mb-3">
                            <label for="basicpill-firstname-input">NDH Care Ltd aims to promote equality of opportunities and is committed to treating all applications fairly regardless of ethnicity, disability, age. gender or gender re-assignment, religion or belief, sexual orientation, pregnancy or maternity and marriage or civil partnership. NDH Care Ltd undertakes not to discriminate unfairly against applicants on the basis of a criminal convocation or other information declared. Answering YES to the question below will not necessarily prevent your employment. This will depend on the relevance of the information you provide in respect of the nature of the position and the particular circumstances.</label>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mt-4">
                                    <h5 class="font-size-14 mb-4">Are you currently bound over or do you have currently UNSPENT convictions that have been issued by a Court or Court-Martial in the United Kingdom or in any other country?</h5>
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" value="Yes" name="court_martial" id="court_martial_yes" @if(old('court_martial', $candidate->court_martial) == 'Yes') checked @endif @if($candidate->is_submit == 'Yes') disabled @endif>
                                    <label class="form-check-label" for="formRadios1">
                                        Yes
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="No" name="court_martial" id="court_martial_no" @if(old('court_martial', $candidate->court_martial) == 'No') checked @endif @if($candidate->is_submit == 'Yes') disabled @endif>
                                    <label class="form-check-label" for="formRadios2">
                                        No
                                    </label>
                                </div>
                            </div>
                        </div>
                        <br>
                        <label for="court_martial" class="error"></label>
                        <div class="row" id="court_martial_no_details_option" style="@if($candidate->court_martial == "Yes") @else display: none @endif">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Please Give Details</label>
                                    <textarea name="court_martial_no_details" id="court_martial_no_details" class="form-control" rows="5" spellcheck="false" @if($candidate->is_submit == 'Yes') disabled @endif>{{ old('court_martial_no_details', $candidate->court_martial_no_details) }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mt-4">
                                    <h5 class="font-size-14 mb-4">Do you have any current UNSPENT police cautions, reprimands or final warnings in the United Kingdom or in any other country?</h5>
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" value="Yes" name="police_cautions" id="police_cautions_yes" @if(old('police_cautions', $candidate->police_cautions) == 'Yes') checked @endif @if($candidate->is_submit == 'Yes') disabled @endif>
                                    <label class="form-check-label" for="formRadios1">
                                        Yes
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="No" name="police_cautions" id="police_cautions_no" @if(old('police_cautions', $candidate->police_cautions) == 'No') checked @endif @if($candidate->is_submit == 'Yes') disabled @endif>
                                    <label class="form-check-label" for="formRadios2">
                                        No
                                    </label>
                                </div>
                            </div>
                        </div>
                        <br>
                        <label for="police_cautions" class="error"></label>
                        <div class="row" id="police_cautions_no_details_option"  style="@if($candidate->court_martial == "Yes") @else display: none @endif">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Please Give Details</label>
                                    <textarea name="police_cautions_no_details" id="police_cautions_no_details" class="form-control" rows="5" spellcheck="false" @if($candidate->is_submit == 'Yes') disabled @endif>{{ old('police_cautions_no_details', $candidate->police_cautions_no_details) }}</textarea>
                                </div>
                            </div>
                        </div>
                        <br>
                        <h4 class="card-title">Privacy Policy</h4>
                        <br>
                        <div class="mb-3">
                            <label for="basicpill-firstname-input">This information in this application form is true and complete. I agree that any deliberate omission, falsification or misrepresentation in the application form will be grounds for rejecting this application or subsequent dismissal if employed by NDH Care Ltd. When applicable, I consent that NDH Care Ltd can seek clarification regarding professional registration details.</label>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <input class="form-check-input" type="checkbox" name="privacy_policy" id="privacy_policy_check" @if(old('privacy_policy', $candidate->privacy_policy) == 'on') checked @endif @if($candidate->is_submit == 'Yes') disabled @endif>
                                <label class="form-check-label" for="formRadios1">
                                    I agree to the privacy policy.
                                </label>
                            </div>
                        </div>
                        <label for="privacy_policy" class="error"></label>
                        <br>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <textarea name="supporting_desc" id="supporting_desc" class="form-control" rows="5" spellcheck="false" disabled>NDH Care Ltd will only collect data for specified, explicit and legitimate use in relation to the recruitment process. By signing this application form, you consent NDH Care Ltd holding the information contained within this application form. If successfully shortlisted, data will also include shortlisting scoring and interview records. We would like to keep this data until the vacancy is filled. (We cannot estimate the exact time period, but we will consider this period over when a candidate accepts our job offer for the position for which we are considering you). When that period is over, we will either delete your data or inform you that we would like to keep it in our database for future roles. We have privacy policies that you can request for further information. Please be assured that your data will be securely stored by the registered manager and only used for the purpose of recruiting for this vacant post. You have right for your data to be forgotten, to rectify or access data to restrict processing to withdraw consent and to be kept informed about the processing of your data. If you would like to discus further or withdraw your consent at any time, please contact Registered Manager or Data Protection Officer on 0121 448 0568.</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="basicpill-firstname-input">Identity Proof Type</label>
                                <select class="form-control form-select" name="identity_proof_type" id="identity_proof_type" required @if($candidate->is_submit == 'Yes') disabled @endif>
                                    <option value="Passport" {{ $identityProofData['type'] == 'Passport' ? 'selected' : '' }}>Passport</option>
                                    <option value="BRP" {{ $identityProofData['type'] == 'BRP' ? 'selected' : '' }}>BRP</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mt-3">
                                    <label for="formFile" class="form-label">File Upload</label>
                                    <input class="form-control" name="identity_proof" type="file" id="identityFile" accept=".pdf,.jpg,.jpeg,.png,.doc">
                                </div>
                            </div>
                        </div>
                        <br>
                        @if ($identityProofData['file'])
                            <div class="file-item">
                                <i class="fas fa-file-pdf"></i>
                                <a href="{{ $identityProofData['file'] }}" target="_blank">{{ basename($identityProofData['file']) }}</a>
                            </div>
                            <br>
                        @endif
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="basicpill-firstname-input">Address Proof Type</label>
                                <select class="form-control form-select" name="address_proof_type" id="address_proof_type" required @if($candidate->is_submit == 'Yes') disabled @endif>
                                    <option value="Passport" {{ $addressProofData['type'] == 'Passport' ? 'selected' : '' }}>Passport</option>
                                    <option value="Bank Statement" {{ $addressProofData['type'] == 'Bank Statement' ? 'selected' : '' }}>Bank Statement</option>
                                    <option value="Utility Bill" {{ $addressProofData['type'] == 'Utility Bill' ? 'selected' : '' }}>Utility Bill</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mt-3">
                                    <label for="formFile" class="form-label">File Upload</label>
                                    <input class="form-control" name="address_proof" type="file" id="addressFile" accept=".pdf,.jpg,.jpeg,.png,.doc">
                                </div>
                            </div>
                        </div>
                        <br>
                        @if ($addressProofData['file'])
                            <div class="file-item">
                                <i class="fas fa-file-pdf"></i>
                                <a href="{{ $addressProofData['file'] }}" target="_blank">{{ basename($addressProofData['file']) }}</a>
                            </div>
                            <br>
                        @endif
                        <div class="row">
                            <div class="col-lg-5 cust-width">
                            <input type="button" name="previous" id="previous2" class="previous btn btn-primary waves-effect waves-light " value="Previous"/>
                            </div>
                            <div class="col-lg-2 cust-width"><button type="submit" class="btn btn-primary w-md saveCustomer" @if($candidate->is_submit == 'Yes') disabled @endif>Submit</button></div>
                            <div class="col-lg-5"></div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div> <!-- end col -->
</div>
@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script src="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/datepicker/datepicker.min.js') }}"></script>
<script>
    // $("#editCandidateForm").validate({
    //     rules: {
    //         mobile_number: {
    //             required: true,
    //             minlength: 10,
    //             maxlength: 10
    //         },
    //         emergency_mobile: {
    //             minlength: 10,
    //             maxlength: 10
    //         },
    //         reference_number_1: {
    //             required: true,
    //             minlength: 10,
    //             maxlength: 10
    //         },
    //         reference_number_2: {
    //             required: true,
    //             minlength: 10,
    //             maxlength: 10
    //         }
    //     },
    //     submitHandler: function(form) {
    //         form.submit();
    //     }
    // });
    var v = jQuery("#editCandidateForm").validate({
        rules: {
            position: "required",
            branch_id: "required",
            prefix: "required",
            first_name: "required",
            last_name: "required",
            street_address: "required",
            post_code: "required",
            country: "required",
            email: "required",
            mobile_number: {
                required: true,
                minlength: 11,
                maxlength: 11
            },
            dob: "required",
            gender: "required",
            work_eligible: "required",
            driving_license: "required",
            equality_act: "required",
            currently_studying: "required",
            training_courses: "required",
            emergency_mobile: {
                minlength: 10,
                maxlength: 10
            },
            currently_emp: "required",
            supporting_desc: "required",
            other_emp: "required",
            reference_name_1: "required",
            reference_number_1: "required",
            reference_email_1: "required",
            reference_name_2: "required",
            reference_number_2: "required",
            reference_email_2: "required",
            court_martial: "required",
            police_cautions: "required",
            privacy_policy: "required",
        },
        submitHandler: function(form)
        {
            form.submit();
        }
    });
    $(document).ready(function () {
        $("#stepone").click(function() {
            if (v.form()) {
                $('#step1').hide();
                $('#step2').show();
                $('.first').removeClass('current');
                $('.first').addClass('disabled');
                $('.second').removeClass('disabled');
                $('.second').addClass('current');
            }
        });

        $("#previous1").click(function() {
            $('#step2').hide();
			$('#step1').show();
            $('.second').removeClass('current');
            $('.second').addClass('disabled');
            $('.first').removeClass('disabled');
            $('.first').addClass('current');
        });
        $("#previous2").click(function() {
            $('#step2').show();
			$('#step3').hide();
            $('.third').removeClass('current');
            $('.third').addClass('disabled');
            $('.second').removeClass('disabled');
            $('.second').addClass('current');
        });

        $("#steptwo").click(function() {
            if (v.form()) {
                $('#step2').hide();
                $('#step3').show();
                $('.second').removeClass('current');
                $('.second').addClass('disabled');
                $('.third').removeClass('disabled');
                $('.third').addClass('current');
            }
        });
        $("#step3").click(function() {
            if (v.form()) {

            }
        });

        $('#gender_male').click(function () {
            $('#gender_other_details').hide();
        });
        $('#gender_female').click(function () {
            $('#gender_other_details').hide();
        });
        $('#gender_other').click(function () {
            $('#gender_other_details').show();
        });

        $('#work_eligible_yes').click(function () {
            var work = $("#work_eligible_yes").val();
            if (work == 'Yes') {
                $("#work_yes_message_br").show();
                $("#work_yes_message").show();
                $("#work_no_message").hide();
                $('#stepone').prop('disabled', false);
            }
        })
        $('#work_eligible_no').click(function () {
            var workNo = $("#work_eligible_no").val();
            if (workNo == 'No') {
                $("#work_yes_message_br").hide();
                $("#work_yes_message").hide();
                $("#work_no_message").show();
                $('#stepone').prop('disabled', true);
            }
        });

        $('#driving_license_yes').click(function () {
            var work = $("#driving_license_yes").val();
            if (work == 'Yes') {
                $("#driving_license_details_br").show();
                $("#driving_license_details").show();
            }
        })
        $('#driving_license_no').click(function () {
            var workNo = $("#driving_license_no").val();
            if (workNo == 'No') {
                $("#driving_license_details_br").hide();
                $("#driving_license_details").hide();
            }
        });

        $('#court_martial_yes').click(function () {
            var work = $("#court_martial_yes").val();
            if (work == 'Yes') {
                $('#court_martial_no_details_option').show();
            }
        });
        $('#court_martial_no').click(function () {
            var work = $("#court_martial_no").val();
            if (work == 'No') {
                $('#court_martial_no_details_option').hide();
            }
        });
        $('#police_cautions_yes').click(function () {
            var work = $("#police_cautions_yes").val();
            if (work == 'Yes') {
                $('#police_cautions_no_details_option').show();
            }
        });
        $('#police_cautions_no').click(function () {
            var work = $("#police_cautions_no").val();
            if (work == 'No') {
                $('#police_cautions_no_details_option').hide();
            }
        });

        $('#equality_act_yes').click(function () {
            $('#other_equality_act_text').hide();
        });
        $('#equality_act_no').click(function () {
            $('#other_equality_act_text').hide();
        });
        $('#equality_act_prefer').click(function () {
            $('#other_equality_act_text').hide();
        });
        $('#other_equality_act').click(function () {
            var act_other = $("#other_equality_act").val();
            if (act_other == 'Other') {
                $('#other_equality_act_text').show();
            }
        });
        $('#currently_studying_yes').click(function () {
            var current_study = $("#currently_studying_yes").val();
            if (current_study == 'Yes') {
                $("#currently_studying_form").show();
                $("#currently_studying_form_no").hide();
                $(".old_studying").hide();
            }
        });
        $('#currently_studying_no').click(function () {
            var current_study = $("#currently_studying_no").val();
            if (current_study == 'No') {
                $("#currently_studying_form").hide();
                $("#currently_studying_form_no").show();
                $(".old_studying").show();
            }
        });
        $('#training_courses_yes').click(function () {
            var current_study = $("#training_courses_yes").val();
            if (current_study == 'Yes') {
                $(".training_courses_show").show();
            }
        });
        $('#training_courses_no').click(function () {
            var current_study = $("#training_courses_no").val();
            if (current_study == 'No') {
                $(".training_courses_show").hide();
            }
        });
        $('#currently_emp_yes').click(function () {
            var current_emp = $("#currently_emp_yes").val();
            if (current_emp == 'Yes') {
                $(".current_emp_data").show();
            }
        });
        $('#currently_emp_no').click(function () {
            var current_emp = $("#currently_emp_no").val();
            if (current_emp == 'No') {
                $(".current_emp_data").hide();
            }
        });
        $('#other_emp_yes').click(function () {
            var other_emp = $("#other_emp_yes").val();
            if (other_emp == 'Yes') {
                $(".other_emp_data").show();
            }
        });
        $('#other_emp_no').click(function () {
            var other_emp = $("#other_emp_no").val();
            if (other_emp == 'No') {
                $(".other_emp_data").hide();
            }
        });
        $(document).on("click", ".add_10_year_data", function() {
            var id = $(this).attr('data-id');
            var newId = parseInt(id) + 1;
            $(this).attr('data-id', newId);
            var addField = '<div class="row" id="remove_data_'+newId+'">' +
                                '<div class="col-lg-5">' +
                                    '<div class="mb-3">' +
                                        '<label for="basicpill-firstname-input">From Date - To Date (mm/yy)</label>' +
                                        '<input type="text" name="history_from_date_to_date[]" class="form-control" id="history_from_date_to_date">' +
                                    '</div>' +
                                '</div>' +
                                '<div class="col-lg-5">' +
                                    '<div class="mb-3">' +
                                        '<label for="basicpill-firstname-input">Description</label>' +
                                        '<input type="text" name="history_desc[]" class="form-control" id="history_desc">' +
                                    '</div>' +
                                '</div>' +
                                '<div class="col-lg-1">' +
                                    '<br>' +
                                    '<button type="button" class="btn btn-danger w-md remove_10_year_data" data-id="'+ newId +'" style="margin-top: 8px;">-</button>' +
                                '</div>' +
                            '</div>';
            $(".ten_year_details").append(addField);
        });
        $(document).on("click", ".remove_10_year_data", function() {
            var id = $(this).attr('data-id');
            var newId = parseInt(id);
            $('#remove_data_'+ newId).remove();
        });
        $(document).on("click", ".add_education_data", function() {
            var id = $(this).attr('data-id');
            var newId = parseInt(id) + 1;
            $(this).attr('data-id', newId);
            var addField = '<div class="row" id="remove_studying_data_'+newId+'">' +
                                '<div class="col-lg-3">' +
                                    '<div class="mb-3" id="datepicker2">' +
                                        '<label for="basicpill-firstname-input">Date of Completion (Expected Date)</label>' +
                                        '<input type="text" name="date_of_comletion[]" class="form-control" id="date_of_comletion" placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd" data-date-container="#datepicker2" data-provide="datepicker" data-date-autoclose="true" autocomplete="off">' +
                                    '</div>' +
                                '</div>' +
                                '<div class="col-lg-4">' +
                                    '<div class="mb-3">' +
                                        '<label for="basicpill-firstname-input">Current Education School / College / University</label>' +
                                        '<input type="text" name="current_education_school[]" class="form-control" id="current_education_school">' +
                                    '</div>' +
                                '</div>' +
                                '<div class="col-lg-4">' +
                                    '<div class="mb-3">' +
                                        '<label for="basicpill-firstname-input">Current Education Qualification you Enrolled in</label>' +
                                        '<input type="text" name="current_education_enrolled[]" class="form-control" id="current_education_enrolled">' +
                                    '</div>' +
                                '</div>' +
                                '<div class="col-lg-1">' +
                                    '<br>' +
                                    '<button type="button" class="btn btn-danger w-md remove_education_data" data-id="'+ newId +'" style="margin-top: 8px;min-width:70px;">-</button>' +
                                '</div>' +
                            '</div>';
            $(".education_details").append(addField);
        });

        $(document).on("click", ".add_education_data_for_no", function() {
            var id = $(this).attr('data-id');
            var newId = parseInt(id) + 1;
            $(this).attr('data-id', newId);
            var addField = '<div class="row" id="remove_studying_data_no_'+newId+'">' +
                                '<div class="col-lg-3">' +
                                    '<div class="mb-3" id="datepicker3">' +
                                        '<label for="basicpill-firstname-input">Date of Completion</label>' +
                                        '<input type="text" name="old_date_comletion[]" class="form-control old_date_comletion" id="old_date_comletion" placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd" data-date-container="#datepicker3" data-provide="datepicker" data-date-autoclose="true" autocomplete="off">' +
                                    '</div>' +
                                '</div>' +
                                '<div class="col-lg-4">' +
                                    '<div class="mb-3">' +
                                        '<label for="basicpill-firstname-input">Education School / College / University</label>' +
                                        '<input type="text" name="old_education_school[]" class="form-control" id="old_education_school">' +
                                    '</div>' +
                                '</div>' +
                                '<div class="col-lg-4">' +
                                    '<div class="mb-3">' +
                                        '<label for="basicpill-firstname-input">Education Qualification you achieved</label>' +
                                        '<input type="text" name="old_education_enrolled[]" class="form-control" id="old_education_enrolled">' +
                                    '</div>' +
                                '</div>' +
                                '<div class="col-lg-1">' +
                                    '<br>' +
                                    '<button type="button" class="cust-margin-3 btn btn-danger w-md remove_education_data_no" data-id="'+ newId +'" style="margin-top: 8px;min-width:70px;">-</button>' +
                                '</div>' +
                            '</div>';
            $(".education_details_no").append(addField);
        });


        $(document).on("click", ".remove_education_data", function() {
            var id = $(this).attr('data-id');
            var newId = parseInt(id);
            $('#remove_studying_data_'+ newId).remove();
        });

        $(document).on("click", ".remove_education_data_no", function() {
            var id = $(this).attr('data-id');
            var newId = parseInt(id);
            $('#remove_studying_data_no_'+ newId).remove();
        });

        $(document).on("click", ".add_training_data", function() {
            var id = $(this).attr('data-id');
            var newId = parseInt(id) + 1;
            $(this).attr('data-id', newId);
            var addField = '<div class="row" id="remove_training_data_'+newId+'">' +
                                '<div class="col-lg-3">' +
                                    '<div class="mb-3" id="datepicker4">' +
                                        '<label for="basicpill-firstname-input">Date of Completion</label>' +
                                        '<input type="text" name="training_date_comletion[]" class="form-control" id="training_date_comletion_1" placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd" data-date-container="#datepicker4" data-provide="datepicker" data-date-autoclose="true" autocomplete="off">' +
                                    '</div>' +
                                '</div>' +
                                '<div class="col-lg-4">' +
                                    '<div class="mb-3">' +
                                        '<label for="basicpill-firstname-input">Training Subject</label>' +
                                        '<input type="text" name="training_subject[]" class="form-control" id="training_subject_1">' +
                                    '</div>' +
                                '</div>' +
                                '<div class="col-lg-4">' +
                                    '<div class="mb-3">' +
                                        '<label for="basicpill-firstname-input">Training Location / Details</label>' +
                                        '<input type="text" name="training_location[]" class="form-control" id="training_location_1">' +
                                    '</div>' +
                                '</div>' +
                                '<div class="col-lg-1">' +
                                    '<br>' +
                                    '<button type="button" class="btn btn-danger w-md remove_training_data" data-id="'+ newId +'" style="margin-top: 8px;min-width:70px;">-</button>' +
                                '</div>' +
                            '</div>';
            $(".training_courses_show").append(addField);
        });
        $(document).on("click", ".remove_training_data", function() {
            var id = $(this).attr('data-id');
            var newId = parseInt(id);
            $('#remove_training_data_'+ newId).remove();
        });
        $(document).on("click", ".add_more_character_data", function() {
            var id = $(this).attr('data-id');
            var newId = parseInt(id) + 1;
            $(this).attr('data-id', newId);
            var addField = '<div id="remove_more_character_data_'+newId+'"><div class="row">' +
                            '<div class="col-lg-4">' +
                                '<h4 class="card-title">Character Reference</h4>' +
                            '</div>' +
                            '<div class="col-lg-6"></div>' +
                            '<div class="col-lg-2" style=""><button type="button" class="btn btn-danger w-md remove_more_character_data" data-id="'+ newId +'" style="margin-top: 8px;min-width:70px;float:right;">-</button></div>' +
                        '</div>' +
                        '<br>' +
                        '<input type="hidden" name="reference_id[]">' +
                        '<div class="row">' +
                            '<div class="col-lg-4">' +
                                '<div class="mb-3">' +
                                    '<label for="basicpill-firstname-input">Reference Name</label>' +
                                    '<input type="text" name="reference_name_1[]" class="form-control" id="reference_name_1">' +
                                '</div>' +
                            '</div>' +
                            '<div class="col-lg-4">' +
                                '<div class="mb-3">' +
                                    '<label for="basicpill-firstname-input">Name of Company</label>' +
                                    '<input type="text" name="reference_place_work_1[]" class="form-control" id="reference_place_work_1">' +
                                '</div>' +
                            '</div>' +
                            '<div class="col-lg-4">' +
                                '<div class="mb-3">' +
                                    '<label for="basicpill-firstname-input">Job Title</label>' +
                                    '<input type="text" name="reference_job_title_1[]" class="form-control" id="reference_job_title_1">' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                        '<div class="row">' +
                            '<div class="col-lg-6">' +
                                '<div class="mb-3">' +
                                    '<label for="basicpill-firstname-input">Phone Number</label>' +
                                    '<input type="number" name="reference_number_1[]" class="form-control" id="reference_number_1">' +
                                '</div>' +
                            '</div>' +
                            '<div class="col-lg-6">' +
                                '<div class="mb-3">' +
                                    '<label for="basicpill-firstname-input">Email Address</label>' +
                                    '<input type="email" name="reference_email_1[]" class="form-control" id="reference_email_1">' +
                                '</div>' +
                            '</div>' +
                        '</div></div>';
            $(".add_character_reference").append(addField);
        });
        $(document).on("click", ".remove_more_character_data", function() {
            var id = $(this).attr('data-id');
            var newId = parseInt(id);
            $('#remove_more_character_data_'+ newId).remove();
        });

        $(document).on("click", ".add_more_professional_data", function() {
            var id = $(this).attr('data-id');
            var newId = parseInt(id) + 1;
            $(this).attr('data-id', newId);
            var addField = '<div id="remove_more_professional_data_'+newId+'">'+
                            '<div class="row">' +
                            '<div class="col-lg-4">' +
                                '<h4 class="card-title">Professional Reference</h4>' +
                            '</div>' +
                            '<div class="col-lg-6"></div>' +
                            '<div class="col-lg-2" style=""><button type="button" class="btn btn-danger w-md remove_more_professional_data"  data-id="'+ newId +'" style="margin-top: 8px;min-width:70px;float:right;">-</button></div>' +
                        '</div>' +
                        '<br>' +
                        '<input type="hidden" name="reference_professional_id[]">' +
                        '<div class="row">' +
                            '<div class="col-lg-4">' +
                                '<div class="mb-3">' +
                                    '<label for="basicpill-firstname-input">Reference Name</label>' +
                                    '<input type="text" name="reference_name_2[]" class="form-control" id="reference_name_2">' +
                                '</div>' +
                            '</div>' +
                            '<div class="col-lg-4">' +
                                '<div class="mb-3">' +
                                    '<label for="basicpill-firstname-input">Name of Company</label>' +
                                    '<input type="text" name="reference_place_work_2[]" class="form-control" id="reference_place_work_2">' +
                                '</div>' +
                            '</div>' +
                            '<div class="col-lg-4">' +
                                '<div class="mb-3">' +
                                    '<label for="basicpill-firstname-input">Job Title</label>' +
                                    '<input type="text" name="reference_job_title_2[]" class="form-control" id="reference_job_title_2">' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                        '<div class="row">' +
                            '<div class="col-lg-6">' +
                                '<div class="mb-3">' +
                                    '<label for="basicpill-firstname-input">Phone Number</label>' +
                                    '<input type="number" name="reference_number_2[]" class="form-control" id="reference_number_2">' +
                                '</div>' +
                            '</div>' +
                            '<div class="col-lg-6">' +
                                '<div class="mb-3">' +
                                    '<label for="basicpill-firstname-input">Email Address</label>' +
                                    '<input type="email" name="reference_email_2[]" class="form-control" id="reference_email_2">' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                        '</div>';
            $(".add_professional_reference").append(addField);
        });
        $(document).on("click", ".remove_more_professional_data", function() {
            var id = $(this).attr('data-id');
            var newId = parseInt(id);
            $('#remove_more_professional_data_'+ newId).remove();
        });
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
    });
</script>
@endsection