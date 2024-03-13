@extends('layouts.master')

@section('title') Candidate Details @endsection

@section('content')

@component('components.breadcrumb')
@slot('li_1') Forms @endslot
@slot('title') Add Candidate @endslot
@endcomponent
@section('css')
<link href="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="{{ URL::asset('/assets/libs/datepicker/datepicker.min.css') }}">
@endsection
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
                <form method="post" action="{{route('candidate.store')}}" id="createCandidateForm">
                    @csrf
                    <fieldset id="step1">
                        <h4 class="card-title">Position Applied</h4>
                        <br>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Position<span>*</span></label>
                                    <select class="form-control form-select" name="position" id="position" required>
                                        <option value="Health Care Assistant">Health Care Assistant</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Preferred Employment Type<span>*</span></label>
                                    <select class="form-control form-select" name="employment_type" id="employment_type" required>
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
                                    <select class="form-control form-select" name="branch_id" id="branch_id" required>
                                        <option value="">Enter Select City</option>
                                        @foreach ($branch as $val)
                                            <option value="{{$val->id}}">{{$val->name}}</option>
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
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Candidate Name</label>
                                    <select class="form-control form-select" name="prefix" id="prefix" required>
                                        <option value="">Select Prefix</option>
                                        <option value="Dr.">Dr.</option>
                                        <option value="Miss">Miss</option>
                                        <option value="Mr.">Mr.</option>
                                        <option value="Mrs.">Mrs.</option>
                                        <option value="Ms.">Ms.</option>
                                        <option value="Prof.">Prof.</option>
                                        <option value="Rev.">Rev.</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input" style="margin-bottom: 1.4rem;"></label>
                                    <input type="text" name="first_name" class="form-control" id="first_name" placeholder="Enter First Name" required>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input" style="margin-bottom: 1.4rem;"></label>
                                    <input type="text" name="last_name" value="{{$candidate->last_name ?? ''}}" class="form-control" id="last_name" placeholder="Enter Last Name" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Address</label>
                                    <textarea name="street_address" id="street_address" class="form-control" rows="3" placeholder="Enter Street Address" spellcheck="false" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Post Code</label>
                                    <input type="text" name="post_code" class="form-control" id="post_code" placeholder="Enter Post Code" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Country</label>
                                    <select class="form-control form-select" name="country" id="country" required>
                                        <option value="">Enter Select Country</option>
                                        @foreach ($country as $val)
                                            <option value="{{$val->name}}" @if($val->name = 'United Kingdom') selected @endif>{{$val->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Email</label>
                                    <input type="text" name="email" class="form-control" id="email" placeholder="Enter Email" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Mobile No.</label>
                                    <input type="number" name="mobile_number" class="form-control" id="mobile_number" placeholder="Enter Mobile Number" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Telephone No (Home)</label>
                                    <input type="number" name="telephone_no" class="form-control" id="telephone_no" placeholder="Enter Telephone No">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3" id="datepicker1">
                                    <label for="basicpill-firstname-input">Date of Birth</label>
                                    <input type="text" name="dob" class="form-control" id="dob" placeholder="dd-mm-yyyy" data-date-format="dd-mm-yyyy" data-date-container='#datepicker1' data-provide="datepicker" data-date-autoclose="true" autocomplete="off" required>
                                </div>
                            </div>
                        </div>
                        <h4 class="card-title">Gender<span>*</span></h4>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" value="Male" name="gender" id="gender_male">
                                    <label class="form-check-label" for="formRadios1">
                                        Male
                                    </label>
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" value="Female" name="gender" id="gender_female">
                                    <label class="form-check-label" for="formRadios2">
                                        Female
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="Other" name="gender" id="gender_other">
                                    <label class="form-check-label" for="formRadios2">
                                        Other
                                    </label>
                                </div>
                            </div>
                        </div>
                        <br>
                        <input type="text" name="gender_other_details" class="form-control" value="" id="gender_other_details" disabled="">
                        <br>
                        <label for="gender" class="error"></label>
                        <br>
                        <h4 class="card-title">Emergency Contact Details</h4>
                        <br>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Name</label>
                                    <input type="text" name="emergency_first_name" class="form-control" id="emergency_first_name" placeholder="Enter First Name">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input" style="margin-bottom: 1.4rem;"></label>
                                    <input type="text" name="emergency_last_name" class="form-control" id="emergency_last_name" placeholder="Enter Last Name">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Emergency Mobile No</label>
                                    <input type="number" name="emergency_mobile" class="form-control" id="emergency_mobile" placeholder="Enter Mobile Number">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Emergency Contact Relation</label>
                                    <input type="text" name="emergency_contact_relation" class="form-control" id="emergency_contact_relation" placeholder="Enter Contact Relation">
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
                                    <input class="form-check-input" type="radio" value="Yes" name="work_eligible" id="work_eligible_yes">
                                    <label class="form-check-label" for="formRadios1">
                                        Yes
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="No" name="work_eligible" id="work_eligible_no">
                                    <label class="form-check-label" for="formRadios2">
                                        No
                                    </label>
                                </div>
                                <br style="display: none;">
                                <label for="basicpill-firstname-input" id="work_no_message" style="display: none;">Sorry we can't proceed for the application.</label>
                            </div>
                        </div>
                        <br>
                        <label for="work_eligible" class="error"></label>
                        <br id="work_yes_message_br" style="display: none;">
                        <div class="row" id="work_yes_message" style="display: none;">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Nation Insurance Number</label>
                                    <input type="text" name="nation_insurance_number" class="form-control" id="nation_insurance_number" placeholder="Enter Nation Insurance Number">
                                </div>
                            </div>
                            <label for="basicpill-firstname-input">Please enter your National Insurance Number. if you don't have the National Insurance Number and only you have the reference number, kindly provide that.</label>
                        </div>
                        <br>
                        <h4 class="card-title">Driving License Details</h4>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mt-4">
                                    <h5 class="font-size-14 mb-4">Do you have full UK Driving License?<span>*</span></h5>
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" value="Yes" name="driving_license" id="driving_license_yes">
                                    <label class="form-check-label" for="formRadios1">
                                        Yes
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="No" name="driving_license" id="driving_license_no">
                                    <label class="form-check-label" for="formRadios2">
                                        No
                                    </label>
                                </div>
                            </div>
                        </div>
                        <br id="driving_license_details_br" style="display: none;">
                        <div class="row" id="driving_license_details" style="display: none;">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Driving License Number</label>
                                    <input type="text" name="driving_license_number" class="form-control" id="driving_license_number" placeholder="Enter Nation Insurance Number">
                                </div>
                            </div>
                        </div>
                        <br>
                        <br>
                        <label for="driving_license" class="error"></label>
                        <br>
                        <h4 class="card-title">Equality Act 2010</h4>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mt-4">
                                    <h5 class="font-size-14 mb-4">Under the Equality Act 2010 the definition of disability is if you have a physical or mental impairment that has a "substantial" and "long term adverse effect" on your ability to carry out normal day-to-day activities. Further information regarding the definition of disability can be found at: http://www.gov.uk/definition-of-disability-under-equality-act-2010/ For the purpose of this application and the interview stage only, is there anything you would like us to be aware of so that we can make reasonable adjustments during the process?<span>*</span></h5>
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" value="Yes" type="radio" name="equality_act" id="equality_act_yes">
                                    <label class="form-check-label" for="formRadios1">
                                        Yes
                                    </label>
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" value="No" type="radio" name="equality_act" id="equality_act_no">
                                    <label class="form-check-label" for="formRadios2">
                                        No
                                    </label>
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" value="Prefer not to be discuss" type="radio" name="equality_act" id="equality_act_prefer">
                                    <label class="form-check-label" for="formRadios2">
                                        Prefer not to be discuss
                                    </label>
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" value="Other" name="equality_act" id="other_equality_act">
                                    <label class="form-check-label" for="formRadios2">
                                        Other
                                    </label>
                                    <br>
                                    <br>
                                    <input type="text" name="other_equality_act_text" class="form-control" id="other_equality_act_text" placeholder="Other">
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
                                    <input class="form-check-input" type="radio" value="Yes" name="currently_studying" id="currently_studying_yes">
                                    <label class="form-check-label" for="formRadios1">
                                        Yes
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="No" name="currently_studying" id="currently_studying_no">
                                    <label class="form-check-label" for="formRadios2">
                                        No
                                    </label>
                                </div>
                            </div>
                        </div>
                        <br>
                        <label for="currently_studying" class="error"></label>
                        <div class="row" id="currently_studying_form" style="display: none;">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Date of Completion (Expected Date)</label>
                                    <input type="date" name="date_of_comletion" class="form-control" id="date_of_comletion" placeholder="Enter Date">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Current Education School / College / University</label>
                                    <input type="text" name="current_education_school" class="form-control" id="current_education_school">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Current Education Qualification you Enrolled in</label>
                                    <input type="text" name="current_education_enrolled" class="form-control" id="current_education_enrolled">
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="old_studying" style="display: none;">
                        <h4 class="card-title">Please give your previous education details</h4>
                        <br>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Date of Completion</label>
                                    <input type="date" name="old_date_comletion[]" class="form-control" id="old_date_comletion" placeholder="Enter Date">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Education School / College / University</label>
                                    <input type="text" name="old_education_school[]" class="form-control" id="old_education_school">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Education Qualification you achieved</label>
                                    <input type="text" name="old_education_enrolled[]" class="form-control" id="old_education_enrolled">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Date of Completion</label>
                                    <input type="date" name="old_date_comletion[]" class="form-control" id="old_date_comletion" placeholder="Enter Date">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Education School / College / University</label>
                                    <input type="text" name="old_education_school[]" class="form-control" id="old_education_school">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Education Qualification you achieved</label>
                                    <input type="text" name="old_education_enrolled[]" class="form-control" id="old_education_enrolled">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Date of Completion</label>
                                    <input type="date" name="old_date_comletion[]" class="form-control" id="old_date_comletion" placeholder="Enter Date">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Education School / College / University</label>
                                    <input type="text" name="old_education_school[]" class="form-control" id="old_education_school">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Education Qualification you achieved</label>
                                    <input type="text" name="old_education_enrolled[]" class="form-control" id="old_education_enrolled">
                                </div>
                            </div>
                        </div>
                        </div>
                        <br>
                        <h4 class="card-title">Training Course Details</h4>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mt-4">
                                    <h5 class="font-size-14 mb-4">Have you attended any training courses?<span>*</span></h5>
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" value="Yes" name="training_courses" id="training_courses_yes">
                                    <label class="form-check-label" for="formRadios1">
                                        Yes
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="No" name="training_courses" id="training_courses_no">
                                    <label class="form-check-label" for="formRadios2">
                                        No
                                    </label>
                                </div>
                            </div>
                        </div>
                        <br>
                        <label for="training_courses" class="error"></label>
                        <div class="training_courses_show" style="display: none;">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Date of Completion</label>
                                    <input type="date" name="training_date_comletion[]" class="form-control" id="training_date_comletion_1" placeholder="Enter Date">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Training Subject</label>
                                    <input type="text" name="training_subject[]" class="form-control" id="training_subject_1">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Training Location / Details</label>
                                    <input type="text" name="training_location[]" class="form-control" id="training_location_1">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Date of Completion</label>
                                    <input type="date" name="training_date_comletion[]" class="form-control" id="training_date_comletion_2" placeholder="Enter Date">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Training Subject</label>
                                    <input type="text" name="training_subject[]" class="form-control" id="training_subject_2">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Training Location / Details</label>
                                    <input type="text" name="training_location[]" class="form-control" id="training_location_2">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Date of Completion</label>
                                    <input type="date" name="training_date_comletion[]" class="form-control" id="training_date_comletion_3" placeholder="Enter Date">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Training Subject</label>
                                    <input type="text" name="training_subject[]" class="form-control" id="training_subject_3">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Training Location / Details</label>
                                    <input type="text" name="training_location[]" class="form-control" id="training_location_3">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Date of Completion</label>
                                    <input type="date" name="training_date_comletion[]" class="form-control" id="training_date_comletion_4" placeholder="Enter Date">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Training Subject</label>
                                    <input type="text" name="training_subject[]" class="form-control" id="training_subject_4">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Training Location / Details</label>
                                    <input type="text" name="training_location[]" class="form-control" id="training_location_4">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Date of Completion</label>
                                    <input type="date" name="training_date_comletion[]" class="form-control" id="training_date_comletion_5" placeholder="Enter Date">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Training Subject</label>
                                    <input type="text" name="training_subject[]" class="form-control" id="training_subject_5">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Training Location / Details</label>
                                    <input type="text" name="training_location[]" class="form-control" id="training_location_5">
                                </div>
                            </div>
                        </div>
                        </div>
                        <input style="float:right;" type="button" id="stepone" name="next" class="next btn btn-primary waves-effect waves-light" value="Next"/>
                    </fieldset>
                    <fieldset id="step2" style="display: none;">
                        <h4 class="card-title">Employment History</h4>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mt-4">
                                    <h5 class="font-size-14 mb-4">Are you currently employed?<span>*</span></h5>
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" value="Yes" name="currently_emp" id="currently_emp_yes">
                                    <label class="form-check-label" for="formRadios1">
                                        Yes
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="No" name="currently_emp" id="currently_emp_no">
                                    <label class="form-check-label" for="formRadios2">
                                        No
                                    </label>
                                </div>
                            </div>
                        </div>
                        <br>
                        <label for="currently_emp" class="error"></label>
                        <br>
                        <div class="current_emp_data" style="display: none;">
                            <h4 class="card-title">Current Employment Details</h4>
                            <br>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input">Name of Company<span>*</span></label>
                                        <input type="text" name="current_name_company" class="form-control" id="current_name_company">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input">Address of Current Employer</label>
                                        <input type="text" name="address_current_company" class="form-control" id="address_current_company">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input">Employer Email Address<span>*</span></label>
                                        <input type="email" name="current_employer_email" class="form-control" id="current_employer_email">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input">Employer Phone</label>
                                        <input type="number" name="current_employer_phone" class="form-control" id="current_employer_phone">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input">Joining Date</label>
                                        <input type="date" name="current_joining_date" class="form-control" id="joining_date" value="{{$candidate->current_joining_date ?? ''}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input">Nature of Business</label>
                                        <input type="text" name="current_nature_business" class="form-control" id="current_nature_business" value="{{$candidate->current_nature_business ?? ''}}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input">Position You Held</label>
                                        <input type="text" name="current_postion_held" class="form-control" id="current_postion_held" value="{{$candidate->current_postion_held ?? ''}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input">Reason for Leaving</label>
                                        <textarea name="current_reason_for_leaving" id="current_reason_for_leaving" class="form-control" rows="5" spellcheck="false">{{$candidate->current_reason_for_leaving ?? ''}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <h4 class="card-title">Other Employment</h4>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mt-4">
                                    <h5 class="font-size-14 mb-4">Do you have any other employer?</h5>
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" value="Yes" name="other_emp" id="other_emp_yes">
                                    <label class="form-check-label" for="formRadios1">
                                        Yes
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="No" name="other_emp" id="other_emp_no">
                                    <label class="form-check-label" for="formRadios2">
                                        No
                                    </label>
                                </div>
                            </div>
                        </div>
                        <br>
                        <label for="other_emp" class="error"></label>
                        <br>
                        <div class="other_emp_data" style="display: none;">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input">Name of Company<span>*</span></label>
                                        <input type="text" name="other_name_company" class="form-control" id="other_name_company">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input">Address of Company</label>
                                        <input type="text" name="other_address_company" class="form-control" id="other_address_company">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input">Employer Email Address</label>
                                        <input type="email" name="other_emp_email" class="form-control" id="other_emp_email">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input">phone</label>
                                        <input type="number" name="other_phone" class="form-control" id="other_phone">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input">Joining Date</label>
                                        <input type="date" name="other_joining_date" class="form-control" id="other_joining_date">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input">Relieving Date</label>
                                        <input type="date" name="other_relieving_date" class="form-control" id="other_relieving_date">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input">Nature of Business</label>
                                        <input type="text" name="other_nature_business" class="form-control" id="other_nature_business">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input">Reason for Leaving</label>
                                        <input type="text" name="other_reason_for_leaving" id="other_reason_for_leaving" class="form-control" spellcheck="false">
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
                        <div class="ten_year_details">
                            <div class="row">
                                <div class="col-lg-5">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input">From Date - To Date</label>
                                        <input type="text" name="history_from_date_to_date[]" class="form-control" id="history_from_date_to_date">
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input">Description</label>
                                        <input type="text" name="history_desc[]" class="form-control" id="history_desc">
                                    </div>
                                </div>
                                <div class="col-lg-1">
                                    <br>
                                    <button type="button" class="btn btn-primary w-md add_10_year_data" data-id="1" style="margin-top: 8px;">+</button>
                                </div>
                            </div>
                        </div>
                        <br>
                        <h4 class="card-title">Supporting Statement</h4>
                        <div class="mb-3">
                            <label for="basicpill-firstname-input">Please add here your reason for applying. You should refer to the job description and person specification to guide you. It would also be of value to describe particular strength and talents that set you apart from others as well as including skills gained from work, home and other activities.</label>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Description</label>
                                    <textarea name="supporting_desc" id="supporting_desc" class="form-control" rows="5" spellcheck="false"></textarea>
                                </div>
                            </div>
                        </div>
                        <input type="button" name="previous" id="previous1" class="previous btn btn-primary waves-effect waves-light" value="Previous"/>
                        <input style="float:right;" type="button" id="steptwo" name="next" class="next btn btn-primary waves-effect waves-light" value="Next" />
                    </fieldset>
                    <fieldset id="step3" style="display: none;">
                        <h4 class="card-title">Character Reference</h4>
                        <br>
                        <h4 class="card-title">First Reference</h4>
                        <br>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Reference Name</label>
                                    <input type="text" name="reference_name_1" class="form-control" id="reference_name_1">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Name of Company</label>
                                    <input type="text" name="reference_place_work_1" class="form-control" id="reference_place_work_1">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Job Title</label>
                                    <input type="text" name="reference_job_title_1" class="form-control" id="reference_job_title_1">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Phone Number</label>
                                    <input type="number" name="reference_number_1" class="form-control" id="reference_number_1">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Email Address</label>
                                    <input type="email" name="reference_email_1" class="form-control" id="reference_email_1">
                                </div>
                            </div>
                        </div>
                        <br>
                        <h4 class="card-title">Professional Reference</h4>
                        <br>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Reference Name</label>
                                    <input type="text" name="reference_name_2" class="form-control" id="reference_name_1">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Name of Company</label>
                                    <input type="text" name="reference_place_work_2" class="form-control" id="reference_place_work_2">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Job Title</label>
                                    <input type="text" name="reference_job_title_2" class="form-control" id="reference_job_title_2">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Phone Number</label>
                                    <input type="number" name="reference_number_2" class="form-control" id="reference_number_2">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Email Address</label>
                                    <input type="email" name="reference_email_2" class="form-control" id="reference_email_2">
                                </div>
                            </div>
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
                                    <input class="form-check-input" type="radio" value="Yes" name="court_martial" id="court_martial_yes">
                                    <label class="form-check-label" for="formRadios1">
                                        Yes
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="No" name="court_martial" id="court_martial_no">
                                    <label class="form-check-label" for="formRadios2">
                                        No
                                    </label>
                                </div>
                            </div>
                        </div>
                        <br>
                        <label for="court_martial" class="error"></label>
                        <br>
                        <div class="row" id="court_martial_no_details_option" style="display:none;">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Please Give Details</label>
                                    <textarea name="court_martial_no_details" id="court_martial_no_details" class="form-control" rows="5" spellcheck="false"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mt-4">
                                    <h5 class="font-size-14 mb-4">Do you have any current UNSPENT police cautions, reprimands or final warnings in the United Kingdom or in any other country?</h5>
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" value="Yes" name="police_cautions" id="police_cautions_yes">
                                    <label class="form-check-label" for="formRadios1">
                                        Yes
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="No" name="police_cautions" id="police_cautions_no">
                                    <label class="form-check-label" for="formRadios2">
                                        No
                                    </label>
                                </div>
                            </div>
                        </div>
                        <br>
                        <label for="police_cautions" class="error"></label>
                        <br>
                        <br>
                        <h4 class="card-title">Privacy Policy</h4>
                        <br>
                        <div class="mb-3">
                            <label for="basicpill-firstname-input">This information in this application form is true and complete. I agree that any deliberate omission, falsification or misrepresentation in the application form will be grounds for rejecting this application or subsequent dismissal if employed by NDH Care Ltd. When applicable, I consent that NDH Care Ltd can seek clarification regarding professional registration details.</label>
                        </div>
                        <div class="row" id="police_cautions_no_details_option" style="display:none;">
                            <div class="col-lg-12">
                                <input class="form-check-input" type="checkbox" name="privacy_policy" id="privacy_policy_check">
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
                                    <textarea name="supporting_desc" id="supporting_desc" class="form-control" rows="5" spellcheck="false" disabled>NDH Care Ltd will only collect data for specified, explicit and legitimate use in relation to the recruitment process. By signing this application form, you consent NDH Care Ltd holding the information contained within this application form. If successfully shortlisted, data will also include shortlisting scoring and interview records. We would like to keep this data until the vacancy is filled. (We cannot estimate the exact time period, but we will consider this period over when a candidate accepts our job offer for the position for which we are considering you). When that period is over, we will either delete your data or inform you that we would like to keep it in our database for future roles. We have privacy policies that you can request for further information. Please be assured that your data will be securely stored by the registered manager and only used for the purpose of recruiting for this vacant post. You have right for your data to be forgotten, to rectify or access data to restrict processing to withdraw consent and to be kept informed about the processing of your data. If you would like to discus further or withdraw your consent at any time, please contact Registered Manager or Data Protection Officer on 0116 3090 111.</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-5">
                            <input type="button" name="previous" id="previous2" class="previous btn btn-primary waves-effect waves-light" value="Previous"/>
                            </div>
                            <div class="col-lg-2"><button type="submit" class="btn btn-primary w-md saveCustomer">Submit</button></div>
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
    // $("#createCandidateForm").validate({
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
    var v = jQuery("#createCandidateForm").validate({
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
            }
        });

        $("#previous1").click(function() {
            $('#step2').hide();
			$('#step1').show();
        });
        $("#previous2").click(function() {
            $('#step2').show();
			$('#step3').hide();
        });

        $("#steptwo").click(function() {
            if (v.form()) {
                $('#step2').hide();
                $('#step3').show();
            }
        });
        $("#step3").click(function() {
            if (v.form()) {

            }
        });
        
        $('#gender_male').click(function () {
            $('#gender_other_details').prop("disabled", true);
        });
        $('#gender_female').click(function () {
            $('#gender_other_details').prop("disabled", true);
        });
        $('#gender_other').click(function () {
            $('#gender_other_details').prop("disabled", false);
        });

        $('#work_eligible_yes').click(function () {
            var work = $("#work_eligible_yes").val();
            if (work == 'Yes') {
                $("#work_yes_message_br").show();
                $("#work_yes_message").show();
            }
        })
        $('#work_eligible_no').click(function () {
            var workNo = $("#work_eligible_no").val();
            if (workNo == 'No') {
                $("#work_yes_message_br").hide();
                $("#work_yes_message").hide();
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
                $('#court_martial_no_details_option').hide();
            }
        });
        $('#court_martial_no').click(function () {
            var work = $("#court_martial_no").val();
            if (work == 'No') {
                $('#court_martial_no_details_option').show();
            }
        });
        $('#police_cautions_yes').click(function () {
            var work = $("#police_cautions_yes").val();
            if (work == 'Yes') {
                $('#police_cautions_no_details_option').hide();
            }
        });
        $('#police_cautions_no').click(function () {
            var work = $("#police_cautions_no").val();
            if (work == 'No') {
                $('#police_cautions_no_details_option').show();
            }
        });
        $('#equality_act_yes').click(function () {
            $('#other_equality_act_text').prop("disabled", true);
        });
        $('#equality_act_no').click(function () {
            $('#other_equality_act_text').prop("disabled", true);
        });
        $('#equality_act_prefer').click(function () {
            $('#other_equality_act_text').prop("disabled", true);
        });
        $('#other_equality_act').click(function () {
            var act_other = $("#other_equality_act").val();
            if (act_other == 'Other') {
                $('#other_equality_act_text').prop("disabled", false);
            }
        });
        $('#currently_studying_yes').click(function () {
            var current_study = $("#currently_studying_yes").val();
            if (current_study == 'Yes') {
                $("#currently_studying_form").show();
                $(".old_studying").hide();
            }
        });
        $('#currently_studying_no').click(function () {
            var current_study = $("#currently_studying_no").val();
            if (current_study == 'No') {
                $("#currently_studying_form").hide();
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
            var addField = '<div class="row" id="remove_data_'+newId+'">' +
                                '<div class="col-lg-5">' +
                                    '<div class="mb-3">' +
                                        '<label for="basicpill-firstname-input">From Date - To Date</label>' +
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
    });
</script>
@endsection