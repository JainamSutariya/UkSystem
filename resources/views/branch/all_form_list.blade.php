@extends('layouts.master')

@section('title') Candidate Details @endsection

@section('content')

@component('components.breadcrumb')
@slot('li_1') Forms @endslot
@slot('title') Candidate Details @endslot
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
               <h4 class="site-heading" style="font-size: 2rem"><b>NDH CARE LTD</b></h4>
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
            <form method="post" action="{{route('candidate.update', $candidate->id)}}" id="editCandidateForm" enctype="multipart/form-data">
            @csrf
            {{ method_field('PUT') }}
            <h4 class="card-title">Position Applied</h4>
            <br>
            <input type="hidden" name="view_page" value="true">
            <div class="row">
               <div class="col-lg-6">
                  <div class="mb-3">
                     <label for="basicpill-firstname-input">Position<span>*</span></label>
                     <select class="form-control form-select" name="position" id="position">
                        <option value="Health Care Assistant">Health Care Assistant</option>
                     </select>
                  </div>
               </div>
               <div class="col-lg-6">
                  <div class="mb-3">
                     <label for="basicpill-firstname-input">Preferred Employment Type<span>*</span></label>
                     <select class="form-control form-select" name="employment_type" id="employment_type">
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
                     <select class="form-control form-select" name="branch_id" id="branch_id">
                        <option value="">Enter Select City</option>
                        @foreach ($branch as $val)
                        <option value="{{$val->id}}" @if($candidate->branch_id == $val->id) selected @endif>{{$val->name}}</option>
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
                     <select class="form-control form-select" name="prefix" id="prefix" >
                        <option value="">Select Prefix</option>
                        <option value="Dr." @if($candidate->prefix == 'Dr.') selected @endif>Dr.</option>
                        <option value="Miss" @if($candidate->prefix == 'Miss') selected @endif>Miss</option>
                        <option value="Mr." @if($candidate->prefix == 'Mr.') selected @endif>Mr.</option>
                        <option value="Mrs." @if($candidate->prefix == 'Mrs.') selected @endif>Mrs.</option>
                        <option value="Ms." @if($candidate->prefix == 'Ms.') selected @endif>Ms.</option>
                        <option value="Prof." @if($candidate->prefix == 'Prof.') selected @endif>Prof.</option>
                        <option value="Rev." @if($candidate->prefix == 'Rev.') selected @endif>Rev.</option>
                     </select>
                  </div>
               </div>
               <div class="col-lg-4">
                  <div class="mb-3">
                     <label for="basicpill-firstname-input" style="margin-bottom: 1.4rem;"></label>
                     <input type="text" name="first_name" value="{{$candidate->first_name}}" class="form-control" id="first_name" placeholder="Enter First Name" >
                  </div>
               </div>
               <div class="col-lg-4">
                  <div class="mb-3">
                     <label for="basicpill-firstname-input" style="margin-bottom: 1.4rem;"></label>
                     <input type="text" name="last_name" value="{{$candidate->last_name}}" class="form-control" id="last_name" placeholder="Enter Last Name" >
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-lg-12">
                  <div class="mb-3">
                     <label for="basicpill-firstname-input">Address</label>
                     <textarea name="street_address" id="street_address" class="form-control" rows="3" placeholder="Enter Street Address" spellcheck="false" >{{$candidate->street_address}}</textarea>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-lg-6">
                  <div class="mb-3">
                     <label for="basicpill-firstname-input">Post Code</label>
                     <input type="text" name="post_code" value="{{$candidate->post_code}}" class="form-control" id="post_code" placeholder="Enter Post Code" >
                  </div>
               </div>
               <div class="col-lg-6">
                  <div class="mb-3">
                     <label for="basicpill-firstname-input">Country</label>
                     <select class="form-control form-select" name="country" id="country" >
                        <option value="">Enter Select Country</option>
                        @foreach ($country as $val)
                        <option value="{{$val->name}}" @if($candidate->country == $val->name) selected @endif>{{$val->name}}</option>
                        @endforeach
                     </select>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-lg-6">
                  <div class="mb-3">
                     <label for="basicpill-firstname-input">Email</label>
                     <input type="text" name="email" value="{{$candidate->email}}" class="form-control" id="email" placeholder="Enter Email" >
                  </div>
               </div>
               <div class="col-lg-6">
                  <div class="mb-3">
                     <label for="basicpill-firstname-input">Mobile No.</label>
                     <input type="text" name="mobile_number" value="{{$candidate->mobile_number}}" class="form-control" id="mobile_number" placeholder="Enter Mobile Number" >
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-lg-6">
                  <div class="mb-3">
                     <label for="basicpill-firstname-input">Telephone No (Home)</label>
                     <input type="text" name="telephone_no" value="{{$candidate->telephone_no}}" class="form-control" id="telephone_no" placeholder="Enter Telephone No" >
                  </div>
               </div>
               <div class="col-lg-6">
                  <div class="mb-3" id="datepicker1">
                     <label for="basicpill-firstname-input">Date of Birth</label>
                     @if ($candidate->dob)
                        <input type="text" name="dob" class="form-control" value="{{ \Carbon\Carbon::createFromFormat('Y-m-d', $candidate->dob)->format('d-m-Y') }}" id="dob" placeholder="dd-mm-yyyy" data-date-format="dd-mm-yyyy" data-date-container='#datepicker1' data-provide="datepicker" data-date-autoclose="true" autocomplete="off" required>
                     @else
                        <input type="text" name="dob" class="form-control" id="dob" placeholder="dd-mm-yyyy" data-date-format="dd-mm-yyyy" data-date-container='#datepicker1' data-provide="datepicker" data-date-autoclose="true" autocomplete="off" required>
                     @endif
                  </div>
               </div>
            </div>
            <h4 class="card-title">Gender<span>*</span></h4>
            <div class="row">
               <div class="col-lg-6">
                  <div class="form-check mb-3">
                     <input class="form-check-input" type="radio" value="Male" name="gender" id="gender_male"  @if($candidate->gender == "Male") checked @endif>
                     <label class="form-check-label" for="formRadios1">
                        Male
                     </label>
                  </div>
                  <div class="form-check mb-3">
                     <input class="form-check-input" type="radio" value="Female" name="gender" id="gender_female"  @if($candidate->gender == "Female") checked @endif>
                     <label class="form-check-label" for="formRadios2">
                        Female
                     </label>
                  </div>
                  <div class="form-check">
                     <input class="form-check-input" type="radio" value="Other" name="gender" id="gender_other"  @if($candidate->gender == "Other") checked @endif>
                     <label class="form-check-label" for="formRadios2">
                        Other
                     </label>
                  </div>
               </div>
            </div>
            <br>
            <input type="text" name="gender_other_details" class="form-control" value="@if($candidate->gender == "Other") {{$candidate->gender_other_details}} @endif" id="gender_other_details" style="@if($candidate->gender == "Other")  @else display:none @endif">
            <br>
            <h4 class="card-title">Emergency Contact Details</h4>
            <br>
            <div class="row">
               <div class="col-lg-6">
                  <div class="mb-3">
                     <label for="basicpill-firstname-input">Name</label>
                     <input type="text" name="emergency_first_name" value="{{$candidate->emergency_first_name}}" class="form-control" id="emergency_first_name" placeholder="Enter First Name" >
                  </div>
               </div>
               <div class="col-lg-6">
                  <div class="mb-3">
                     <label for="basicpill-firstname-input" style="margin-bottom: 1.4rem;"></label>
                     <input type="text" name="emergency_last_name" value="{{$candidate->emergency_last_name}}" class="form-control" id="emergency_last_name" placeholder="Enter Last Name" >
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-lg-6">
                  <div class="mb-3">
                     <label for="basicpill-firstname-input">Emergency Mobile No</label>
                     <input type="text" name="emergency_mobile" value="{{$candidate->emergency_mobile}}" class="form-control" id="emergency_mobile" placeholder="Enter First Name" >
                  </div>
               </div>
               <div class="col-lg-6">
                  <div class="mb-3">
                     <label for="basicpill-firstname-input">Emergency Contact Relation</label>
                     <input type="text" name="emergency_contact_relation" value="{{$candidate->emergency_contact_relation}}" class="form-control" id="emergency_contact_relation" placeholder="Enter Last Name" >
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
                        <input class="form-check-input" type="radio" value="Yes" name="work_eligible" id="work_eligible_yes"  @if($candidate->work_eligible == "Yes") checked @endif>
                        <label class="form-check-label" for="formRadios1">
                           Yes
                        </label>
                     </div>
                     <div class="form-check">
                        <input class="form-check-input" type="radio" value="No" name="work_eligible" id="work_eligible_no"  @if($candidate->work_eligible == "No") checked @endif>
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
               <div class="row" id="work_yes_message" style="@if($candidate->work_eligible == "Yes") @else display: none @endif">
                  <div class="col-lg-6">
                     <div class="mb-3">
                        <label for="basicpill-firstname-input">Nation Insurance Number</label>
                        <input type="text" name="nation_insurance_number" class="form-control" id="nation_insurance_number" placeholder="Enter Nation Insurance Number" value="{{$candidate->nation_insurance_number}}" >
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
                        <input class="form-check-input" type="radio" value="Yes" name="driving_license" id="driving_license_yes"  @if($candidate->driving_license == "Yes") checked @endif>
                        <label class="form-check-label" for="formRadios1">
                           Yes
                        </label>
                     </div>
                     <div class="form-check">
                        <input class="form-check-input" type="radio" value="No" name="driving_license" id="driving_license_no"  @if($candidate->driving_license == "No") checked @endif>
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
                            <input class="form-check-input" type="radio" value="Full UK Driving License" name="driving_license_type" id="driving_license_type_full_uk" @if($candidate->driving_license_type == "Full UK Driving License") checked @endif>
                            <label class="form-check-label" for="formRadios1">
                                Full UK Driving License
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="International Driving License" name="driving_license_type" id="driving_license_type_international" @if($candidate->driving_license_type == "International Driving License") checked @endif>
                                <label class="form-check-label" for="formRadios2">
                                    International Driving License
                                </label>
                            </div>
                        </div>
                    </div>
                    <br>
                    <br>
                    <br>
                @else
                    <div class="row" id="driving_license_type_show" style="display:none;">
                        <div class="col-lg-6">
                            <div class="mt-4">
                                <h5 class="font-size-14 mb-4"></h5>
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="radio" value="Full UK Driving License" name="driving_license_type" id="driving_license_type_full_uk" @if($candidate->driving_license_type == "FullUK Driving License") checked @endif>
                                <label class="form-check-label" for="formRadios1">
                                        Full UK Driving License
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="International Driving License" name="driving_license_type" id="driving_license_type_international" @if($candidate->driving_license_type == "International Driving License") checked @endif>
                                <label class="form-check-label" for="formRadios2">
                                    International Driving License
                                </label>
                            </div>
                        </div>
                    </div>
                    <br>
                    <br>
                    <br>
                @endif
                <br>
                <br>
                <div class="row" id="driving_license_share_code" style="@if($candidate->driving_license_type == "Full UK Driving License") @else display: none @endif">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="basicpill-firstname-input">Share Code</label>
                                <input type="text" name="driving_share_code" class="form-control" id="driving_share_code" placeholder="Enter Share Code" value="{{$candidate->driving_share_code ?? ''}}">
                        </div>
                    </div>
                </div>
                <div class="row" id="driving_license_details" style="@if($candidate->driving_license_type == "International Driving License") @else display: none @endif">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="basicpill-firstname-input">Driving License Number</label>
                            <input type="text" name="driving_license_number" class="form-control" id="driving_license_number" placeholder="Enter Driving License Number" value="{{$candidate->driving_license_number ?? ''}}">
                        </div>
                    </div>
                </div>
                <div class="row"></div>
               <br>
               <h4 class="card-title">Equality Act 2010</h4>
               <div class="row">
                  <div class="col-lg-12">
                     <div class="mt-4">
                        <h5 class="font-size-14 mb-4">Under the Equality Act 2010 the definition of disability is if you have a physical or mental impairment that has a "substantial" and "long term adverse effect" on your ability to carry out normal day-to-day activities. Further information regarding the definition of disability can be found at: http://www.gov.uk/definition-of-disability-under-equality-act-2010/ For the purpose of this application and the interview stage only, is there anything you would like us to be aware of so that we can make reasonable adjustments during the process?<span>*</span></h5>
                     </div>
                     <div class="form-check mb-3">
                        <input class="form-check-input" value="Yes" type="radio" name="equality_act" id="equality_act_yes"  @if($candidate->equality_act == "Yes") checked @endif>
                        <label class="form-check-label" for="formRadios1">
                           Yes
                        </label>
                     </div>
                     <div class="form-check mb-3">
                        <input class="form-check-input" value="No" type="radio" name="equality_act" id="equality_act_no"  @if($candidate->equality_act == "No") checked @endif>
                        <label class="form-check-label" for="formRadios2">
                           No
                        </label>
                     </div>
                     <div class="form-check mb-3">
                        <input class="form-check-input" value="Prefer not to be discuss" type="radio" name="equality_act"  id="equality_act_prefer" @if($candidate->equality_act == "Prefer not to be discuss") checked @endif>
                        <label class="form-check-label" for="formRadios2">
                           Prefer not to be discuss
                        </label>
                     </div>
                     <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" value="Other" name="equality_act" id="other_equality_act"  @if($candidate->equality_act == "Other") checked @endif>
                        <label class="form-check-label" for="formRadios2">
                           Other
                        </label>
                        <br>
                        <br>
                        <input type="text" name="other_equality_act_text" class="form-control" value="@if($candidate->equality_act == "Other") {{$candidate->other_equality_act_text}} @endif"  id="other_equality_act_text" style="@if($candidate->equality_act == "Other") @else display: none @endif">
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
                        <input class="form-check-input" type="radio" value="Yes" name="currently_studying" id="currently_studying_yes"  @if($candidate->currently_studying == "Yes") checked @endif>
                        <label class="form-check-label" for="formRadios1">
                           Yes
                        </label>
                     </div>
                  <div class="form-check">
                     <input class="form-check-input" type="radio" value="No" name="currently_studying" id="currently_studying_no"  @if($candidate->currently_studying == "No") checked @endif>
                     <label class="form-check-label" for="formRadios2">
                        No
                     </label>
                  </div>
               </div>
            </div>
            <br>
            <label for="currently_studying" class="error"></label>
            @php $currently_studying_details = json_decode($candidate->currently_studying_details, true) @endphp
            @if (!empty($currently_studying_details) && count($currently_studying_details) > 0)
            <div class="education_details" id="currently_studying_form" style="@if($candidate->currently_studying == "Yes") @else display: none; @endif">
               @foreach($currently_studying_details as $i => $val)
               @if ($i == 0)
               <div class="row">
                  <div class="col-lg-3">
                     <div class="mb-3">
                        <label for="basicpill-firstname-input">Date of Completion (Expected Date)</label>
                        <input type="date" name="date_of_comletion[]" class="form-control"  id="date_of_comletion" placeholder="Enter Date" value="{{$val['date_of_comletion'] ?? ''}}">
                     </div>
                  </div>
                  <div class="col-lg-4">
                     <div class="mb-3">
                        <label for="basicpill-firstname-input">Current Education School / College / University</label>
                        <input type="text" name="current_education_school[]" class="form-control"  id="current_education_school" value="{{$val['current_education_school'] ?? ''}}">
                     </div>
                  </div>
                  <div class="col-lg-4">
                     <div class="mb-3">
                        <label for="basicpill-firstname-input">Current Education Qualification you Enrolled in</label>
                        <input type="text" name="current_education_enrolled[]" class="form-control"  id="current_education_enrolled" value="{{$val['current_education_enrolled'] ?? ''}}">
                     </div>
                  </div>
                  <div class="col-lg-1">
                     <br>
                     <button type="button" class="btn btn-primary w-md add_education_data"  data-id="1" style="margin-top: 8px;min-width:70px;">+</button>
                  </div>
               </div>
               @else
               <div class="row">
                  <div class="col-lg-3">
                     <div class="mb-3">
                        <label for="basicpill-firstname-input">Date of Completion (Expected Date)</label>
                        <input type="date" name="date_of_comletion[]" class="form-control"  id="date_of_comletion" placeholder="Enter Date" value="{{$val['date_of_comletion'] ?? ''}}">
                     </div>
                  </div>
                  <div class="col-lg-4">
                     <div class="mb-3">
                        <label for="basicpill-firstname-input">Current Education School / College / University</label>
                        <input type="text" name="current_education_school[]" class="form-control"  id="current_education_school" value="{{$val['current_education_school'] ?? ''}}">
                     </div>
                  </div>
                  <div class="col-lg-4">
                     <div class="mb-2">
                        <label for="basicpill-firstname-input">Current Education Qualification you Enrolled in</label>
                        <input type="text" name="current_education_enrolled[]" class="form-control"  id="current_education_enrolled" value="{{$val['current_education_enrolled'] ?? ''}}">
                     </div>
                  </div>
                  <div class="col-lg-1">
                     <br>
                     <button type="button" class="btn btn-danger w-md remove_education_data"  data-id="{{$i + 1}}" style="margin-top: 8px;min-width:70px;">+</button>
                  </div>
               </div>
            @endif
            @endforeach
            </div>
            @else
            <div class="education_details" id="currently_studying_form" style="@if($candidate->currently_studying == "Yes") @else display: none; @endif">
               <div class="row">
                  <div class="col-lg-3">
                     <div class="mb-3">
                        <label for="basicpill-firstname-input">Date of Completion (Expected Date)</label>
                        <input type="date" name="date_of_comletion[]" class="form-control"  id="date_of_comletion" placeholder="Enter Date" value="{{$candidate->date_of_comletion ?? ''}}">
                     </div>
                  </div>
                  <div class="col-lg-4">
                     <div class="mb-3">
                        <label for="basicpill-firstname-input">Current Education School / College / University</label>
                        <input type="text" name="current_education_school[]" class="form-control"  id="current_education_school" value="{{$candidate->current_education_school ?? ''}}">
                     </div>
                  </div>
                  <div class="col-lg-4">
                     <div class="mb-3">
                        <label for="basicpill-firstname-input">Current Education Qualification you Enrolled in</label>
                        <input type="text" name="current_education_enrolled[]" class="form-control"  id="current_education_enrolled" value="{{$candidate->current_education_enrolled ?? ''}}">
                     </div>
                  </div>
                  <div class="col-lg-1">
                     <br>
                     <button type="button" class="btn btn-primary w-md add_education_data"  data-id="1" style="margin-top: 8px;min-width:70px;">+</button>
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
                                    <div class="mb-3" id="datepicker3">
                                        <label for="basicpill-firstname-input">Date of Completion</label>
                                        <input type="text" name="old_date_comletion[]" value="{{$val['old_date_comletion'] ?? ''}}" class="form-control old_date_comletion" id="old_date_comletion" placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd" data-date-container='#datepicker3' data-provide="datepicker" data-date-autoclose="true" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input">Education School / College / University</label>
                                        <input type="text" name="old_education_school[]" class="form-control" id="old_education_school" value="{{$val['old_education_school'] ?? ''}}">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input">Education Qualification you achieved</label>
                                        <input type="text" name="old_education_enrolled[]" class="form-control" id="old_education_enrolled" value="{{$val['old_education_enrolled'] ?? ''}}">
                                    </div>
                                </div>
                                <div class="col-lg-1">
                                    <br>
                                    <button type="button" class="btn btn-primary w-md add_education_data_for_no" data-id="1" style="margin-top: 8px;min-width:70px;">+</button>
                                </div>
                            </div>
                            @else
                            <div class="row" id="remove_studying_data_no_{{$i + 1}}">
                                <div class="col-lg-3">
                                    <div class="mb-3" id="datepicker3">
                                        <label for="basicpill-firstname-input">Date of Completion</label>
                                        <input type="text" name="old_date_comletion[]" value="{{$val['old_date_comletion'] ?? ''}}" class="form-control old_date_comletion" id="old_date_comletion" placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd" data-date-container='#datepicker3' data-provide="datepicker" data-date-autoclose="true" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input">Education School / College / University</label>
                                        <input type="text" name="old_education_school[]" class="form-control" id="old_education_school" value="{{$val['old_education_school'] ?? ''}}">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input">Education Qualification you achieved</label>
                                        <input type="text" name="old_education_enrolled[]" class="form-control" id="old_education_enrolled" value="{{$val['old_education_enrolled'] ?? ''}}">
                                    </div>
                                </div>
                                <div class="col-lg-1">
                                    <br>
                                    <button type="button" class="btn btn-danger w-md remove_education_data_no" data-id="{{$i + 1}}" style="margin-top: 8px;min-width:70px;">-</button>
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
                                        <input type="text" name="old_date_comletion[]" value="{{$old_emp_details[0]['old_date_comletion'] ?? ''}}" class="form-control old_date_comletion" id="old_date_comletion" placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd" data-date-container='#datepicker3' data-provide="datepicker" data-date-autoclose="true" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input">Education School / College / University</label>
                                        <input type="text" name="old_education_school[]" class="form-control" id="old_education_school" value="{{$old_emp_details[0]['old_education_school'] ?? ''}}">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input">Education Qualification you achieved</label>
                                        <input type="text" name="old_education_enrolled[]" class="form-control" id="old_education_enrolled" value="{{$old_emp_details[0]['old_education_enrolled'] ?? ''}}">
                                    </div>
                                </div>
                                <div class="col-lg-1">
                                    <br>
                                    <button type="button" class="btn btn-primary w-md add_education_data_for_no" data-id="1" style="margin-top: 8px;min-width:70px;">+</button>
                                </div>
                            </div>
                        </div>
                        @endif
               <!--<div class="row">-->
               <!--   <div class="col-lg-4">-->
               <!--      <div class="mb-3">-->
               <!--         <label for="basicpill-firstname-input">Date of Completion</label>-->
               <!--         <input type="date" name="old_date_comletion[]" class="form-control" id="old_date_comletion"  placeholder="Enter Date" value="{{$old_emp_details[1]['old_date_comletion'] ?? ''}}">-->
               <!--      </div>-->
               <!--   </div>-->
               <!--   <div class="col-lg-4">-->
               <!--      <div class="mb-3">-->
               <!--         <label for="basicpill-firstname-input">Education School / College / University</label>-->
               <!--         <input type="text" name="old_education_school[]" class="form-control" id="old_education_school"  value="{{$old_emp_details[1]['old_education_school'] ?? ''}}">-->
               <!--      </div>-->
               <!--   </div>-->
               <!--   <div class="col-lg-4">-->
               <!--      <div class="mb-3">-->
               <!--         <label for="basicpill-firstname-input">Education Qualification you achieved</label>-->
               <!--         <input type="text" name="old_education_enrolled[]" class="form-control" id="old_education_enrolled"  value="{{$old_emp_details[1]['old_education_enrolled'] ?? ''}}">-->
               <!--      </div>-->
               <!--   </div>-->
               <!--</div>-->
               <!--<div class="row">-->
               <!--   <div class="col-lg-4">-->
               <!--      <div class="mb-3">-->
               <!--         <label for="basicpill-firstname-input">Date of Completion</label>-->
               <!--         <input type="date" name="old_date_comletion[]" class="form-control" id="old_date_comletion"  placeholder="Enter Date" value="{{$old_emp_details[2]['old_date_comletion'] ?? ''}}">-->
               <!--      </div>-->
               <!--   </div>-->
               <!--   <div class="col-lg-4">-->
               <!--      <div class="mb-3">-->
               <!--         <label for="basicpill-firstname-input">Education School / College / University</label>-->
               <!--         <input type="text" name="old_education_school[]" class="form-control" id="old_education_school"  value="{{$old_emp_details[2]['old_education_school'] ?? ''}}">-->
               <!--      </div>-->
               <!--   </div>-->
               <!--   <div class="col-lg-4">-->
               <!--      <div class="mb-3">-->
               <!--         <label for="basicpill-firstname-input">Education Qualification you achieved</label>-->
               <!--         <input type="text" name="old_education_enrolled[]" class="form-control" id="old_education_enrolled"  value="{{$old_emp_details[2]['old_education_enrolled'] ?? ''}}">-->
               <!--      </div>-->
               <!--   </div>-->
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
                     <input class="form-check-input" type="radio" value="Yes" name="training_courses" id="training_courses_yes"  @if($candidate->training_courses == "Yes") checked @endif>
                     <label class="form-check-label" for="formRadios1">
                     Yes
                     </label>
                  </div>
                  <div class="form-check">
                     <input class="form-check-input" type="radio" value="No" name="training_courses" id="training_courses_no"  @if($candidate->training_courses == "No") checked @endif>
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
                                <input type="text" name="training_date_comletion[]" value="{{$val['training_date_comletion'] ?? ''}}" class="form-control" id="training_date_comletion_1" placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd" data-date-container='#datepicker4' data-provide="datepicker" data-date-autoclose="true" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label for="basicpill-firstname-input">Training Subject</label>
                                <input type="text" name="training_subject[]" class="form-control" id="training_subject_1" value="{{$val['training_subject'] ?? ''}}">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label for="basicpill-firstname-input">Training Location / Details</label>
                            <input type="text" name="training_location[]" class="form-control" id="training_location_1" value="{{$val['training_location'] ?? ''}}">
                        </div>
                    </div>
                    <div class="col-lg-1">
                        <br>
                        <button type="button" class="btn btn-primary w-md add_training_data" data-id="1" style="margin-top: 8px;min-width:70px;">+</button>
                    </div>
                </div>
            @else
                <div class="row" id="remove_training_data_{{$i+1}}">
                    <div class="col-lg-3">
                        <div class="mb-3" id="datepicker4">
                            <label for="basicpill-firstname-input">Date of Completion</label>
                                <input type="text" name="training_date_comletion[]" value="{{$val['training_date_comletion'] ?? ''}}" class="form-control" id="training_date_comletion_1" placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd" data-date-container='#datepicker4' data-provide="datepicker" data-date-autoclose="true" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label for="basicpill-firstname-input">Training Subject</label>
                                <input type="text" name="training_subject[]" class="form-control" id="training_subject_1" value="{{$val['training_subject'] ?? ''}}">
                        </div>
                    </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label for="basicpill-firstname-input">Training Location / Details</label>
                                <input type="text" name="training_location[]" class="form-control" id="training_location_1" value="{{$val['training_location'] ?? ''}}">
                            </div>
                        </div>
                    <div class="col-lg-1">
                        <br>
                        <button type="button" class="btn btn-danger w-md remove_training_data" data-id="{{$i + 1}}" style="margin-top: 8px;min-width:70px;">-</button>
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
                                <input type="text" name="training_date_comletion[]" value="{{$val['training_date_comletion'] ?? ''}}" class="form-control" id="training_date_comletion_1" placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd" data-date-container='#datepicker4' data-provide="datepicker" data-date-autoclose="true" autocomplete="off">
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
                    <div class="col-lg-1">
                        <br>
                        <button type="button" class="btn btn-primary w-md add_training_data" data-id="1" style="margin-top: 8px;min-width:70px;">+</button>
                        </div>
                    </div>
                </div>
            @endif
            <br>
            <h4 class="card-title">Employment History</h4>
            <div class="row">
               <div class="col-lg-6">
                  <div class="mt-4">
                     <h5 class="font-size-14 mb-4">Are you currently employed?<span>*</span></h5>
                  </div>
                  <div class="form-check mb-3">
                     <input class="form-check-input" type="radio" value="Yes" name="currently_emp" id="currently_emp_yes"  @if($candidate->currently_emp == "Yes") checked @endif>
                     <label class="form-check-label" for="formRadios1">
                     Yes
                     </label>
                  </div>
                  <div class="form-check">
                     <input class="form-check-input" type="radio" value="No" name="currently_emp" id="currently_emp_no"  @if($candidate->currently_emp == "No") checked @endif>
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
                     <input type="text" name="current_name_company" class="form-control" id="current_name_company"  value="{{$candidate->current_name_company ?? ''}}">
                  </div>
               </div>
               <div class="col-lg-6">
                  <div class="mb-3">
                     <label for="basicpill-firstname-input">Address of Current Employer</label>
                     <input type="text" name="address_current_company" class="form-control" id="address_current_company"  value="{{$candidate->current_name_company ?? ''}}">
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-lg-4">
                  <div class="mb-3">
                     <label for="basicpill-firstname-input">Employer Email Address<span>*</span></label>
                     <input type="email" name="current_employer_email" class="form-control" id="current_employer_email"  value="{{$candidate->current_employer_email ?? ''}}">
                  </div>
               </div>
               <div class="col-lg-4">
                  <div class="mb-3">
                     <label for="basicpill-firstname-input">Employer Phone</label>
                     <input type="number" name="current_employer_phone" class="form-control" id="current_employer_phone"  value="{{$candidate->current_employer_phone ?? ''}}">
                  </div>
               </div>
               <div class="col-lg-4">
                  <div class="mb-3">
                     <label for="basicpill-firstname-input">Joining Date</label>
                     <input type="date" name="current_joining_date" class="form-control" id="joining_date"  value="{{$candidate->current_joining_date ?? ''}}">
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-lg-6">
                  <div class="mb-3">
                     <label for="basicpill-firstname-input">Nature of Business</label>
                     <input type="text" name="current_nature_business" class="form-control" id="current_nature_business"  value="{{$candidate->current_nature_business ?? ''}}">
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
                     <textarea name="current_reason_for_leaving" id="current_reason_for_leaving" class="form-control"  rows="5" spellcheck="false">{{$candidate->current_reason_for_leaving ?? ''}}</textarea>
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
                     <input class="form-check-input" type="radio" value="Yes" name="other_emp" id="other_emp_yes"  @if($candidate->other_emp == 'Yes') checked @endif>
                     <label class="form-check-label" for="formRadios1">
                     Yes
                     </label>
                  </div>
                  <div class="form-check">
                     <input class="form-check-input" type="radio" value="No" name="other_emp" id="other_emp_no"  @if($candidate->other_emp == 'No') checked @endif>
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
                        <input type="text" name="other_name_company" class="form-control" id="other_name_company"  value="{{$candidate->other_name_company ?? ''}}">
                     </div>
                  </div>
                  <div class="col-lg-4">
                     <div class="mb-3">
                        <label for="basicpill-firstname-input">Address of Company</label>
                        <input type="text" name="other_address_company" class="form-control" id="other_address_company"  value="{{$candidate->other_address_company ?? ''}}">
                     </div>
                  </div>
                  <div class="col-lg-4">
                     <div class="mb-3">
                        <label for="basicpill-firstname-input">Employer Email Address</label>
                        <input type="email" name="other_emp_email" class="form-control" id="other_emp_email"  value="{{$candidate->other_emp_email ?? ''}}">
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-lg-4">
                     <div class="mb-3">
                        <label for="basicpill-firstname-input">phone</label>
                        <input type="number" name="other_phone" class="form-control" id="other_phone"  value="{{$candidate->other_phone ?? ''}}">
                     </div>
                  </div>
                  <div class="col-lg-4">
                     <div class="mb-3">
                        <label for="basicpill-firstname-input">Joining Date</label>
                        <input type="date" name="other_joining_date" class="form-control" id="other_joining_date"  value="{{$candidate->other_joining_date ?? ''}}">
                     </div>
                  </div>
                  <div class="col-lg-4">
                     <div class="mb-3">
                        <label for="basicpill-firstname-input">Relieving Date</label>
                        <input type="date" name="other_relieving_date" class="form-control" id="other_relieving_date"  value="{{$candidate->other_relieving_date ?? ''}}">
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-lg-6">
                     <div class="mb-3">
                        <label for="basicpill-firstname-input">Nature of Business</label>
                        <input type="text" name="other_nature_business" class="form-control" id="other_nature_business"  value="{{$candidate->other_nature_business ?? ''}}">
                     </div>
                  </div>
                  <div class="col-lg-6">
                     <div class="mb-3">
                        <label for="basicpill-firstname-input">Reason for Leaving</label>
                        <input type="text" name="other_reason_for_leaving" id="other_reason_for_leaving" class="form-control"  spellcheck="false" value="{{$candidate->other_reason_for_leaving ?? ''}}">
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
                        <input type="text" name="history_from_date_to_date[]" class="form-control" id="history_from_date_to_date"  value="{{$val['history_from_date_to_date'] ?? ''}}">
                     </div>
                  </div>
                  <div class="col-lg-5">
                     <div class="mb-3">
                        <label for="basicpill-firstname-input">Description</label>
                        <input type="text" name="history_desc[]" class="form-control" id="history_desc"  value="{{$val['history_desc'] ?? ''}}">
                     </div>
                  </div>
                  <div class="col-lg-1">
                     <br>
                     <button type="button" class="btn btn-primary w-md add_10_year_data" data-id="{{count($ten_year_history)}}"  style="margin-top: 8px;">+</button>
                  </div>
               </div>
               @else
               <div class="row" id="remove_data_{{$i+1}}">
                  <div class="col-lg-5">
                     <div class="mb-3">
                        <label for="basicpill-firstname-input">From Date - To Date (mm/yy)</label>
                        <input type="text" name="history_from_date_to_date[]" class="form-control" id="history_from_date_to_date"  value="{{$val['history_from_date_to_date'] ?? ''}}">
                     </div>
                  </div>
                  <div class="col-lg-5">
                     <div class="mb-3">
                        <label for="basicpill-firstname-input">Description</label>
                        <input type="text" name="history_desc[]" class="form-control" id="history_desc"  value="{{$val['history_desc'] ?? ''}}">
                     </div>
                  </div>
                  <div class="col-lg-1">
                     <br>
                     <button type="button" class="btn btn-danger w-md remove_10_year_data" data-id="{{$i + 1}}"  style="margin-top: 8px;">-</button>
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
                        <input type="text" name="history_from_date_to_date[]" class="form-control"  id="history_from_date_to_date">
                     </div>
                  </div>
                  <div class="col-lg-5">
                     <div class="mb-3">
                        <label for="basicpill-firstname-input">Description</label>
                        <input type="text" name="history_desc[]" class="form-control"  id="history_desc">
                     </div>
                  </div>
                  <div class="col-lg-1">
                     <br>
                     <button type="button" class="btn btn-primary w-md add_10_year_data"  data-id="1" style="margin-top: 8px;">+</button>
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
                     <textarea name="supporting_desc" id="supporting_desc" class="form-control" rows="5"  spellcheck="false">{{$candidate->supporting_desc ?? ''}}</textarea>
                  </div>
               </div>
            </div>
            <br>
            <h4 class="card-title">Reference Details</h4>
            <br>
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
                            <div class="col-lg-2" style=""><button type="button" class="btn btn-primary w-md add_more_character_data"  data-id="1" style="margin-top: 8px;min-width:70px;float:right;">+</button></div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Reference Name</label>
                                    <input type="text" name="reference_name_1[]" value="{{$reference['name_1'] ?? ''}}" class="form-control" id="reference_name_1">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Name of Company</label>
                                    <input type="text" name="reference_place_work_1[]" class="form-control" id="reference_place_work_1" value="{{$reference['reference_place_work_1'] ?? ''}}">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Job Title</label>
                                    <input type="text" name="reference_job_title_1[]" class="form-control" id="reference_job_title_1" value="{{$reference['reference_job_title_1'] ?? ''}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Phone Number</label>
                                    <input type="number" name="reference_number_1[]" value="{{$reference['number_1'] ?? ''}}" class="form-control" id="reference_number_1">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Email Address</label>
                                    <input type="email" name="reference_email_1[]" value="{{$reference['email_1'] ?? ''}}" class="form-control" id="reference_email_1">
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
                            <div class="col-lg-2" style=""><button type="button" class="btn btn-danger w-md remove_more_character_data"  data-id="{{$i + 1}}" style="margin-top: 8px;min-width:70px;float:right;">-</button></div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Reference Name</label>
                                    <input type="text" name="reference_name_1[]" value="{{$reference['name_1'] ?? ''}}" class="form-control" id="reference_name_1">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Name of Company</label>
                                    <input type="text" name="reference_place_work_1[]" class="form-control" id="reference_place_work_1" value="{{$reference['reference_place_work_1'] ?? ''}}">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Job Title</label>
                                    <input type="text" name="reference_job_title_1[]" class="form-control" id="reference_job_title_1" value="{{$reference['reference_job_title_1'] ?? ''}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Phone Number</label>
                                    <input type="number" name="reference_number_1[]" value="{{$reference['number_1'] ?? ''}}" class="form-control" id="reference_number_1">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Email Address</label>
                                    <input type="email" name="reference_email_1[]" value="{{$reference['email_1'] ?? ''}}" class="form-control" id="reference_email_1">
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
                            <div class="col-lg-2" style=""><button type="button" class="btn btn-primary w-md add_more_character_data"  data-id="1" style="margin-top: 8px;min-width:70px;float:right;">+</button></div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Reference Name</label>
                                    <input type="text" name="reference_name_1[]"  class="form-control" id="reference_name_1">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Name of Company</label>
                                    <input type="text" name="reference_place_work_1[]" class="form-control" id="reference_place_work_1">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Job Title</label>
                                    <input type="text" name="reference_job_title_1[]" class="form-control" id="reference_job_title_1">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Phone Number</label>
                                    <input type="number" name="reference_number_1[]" class="form-control" id="reference_number_1">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Email Address</label>
                                    <input type="email" name="reference_email_1[]" class="form-control" id="reference_email_1">
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
                            <div class="col-lg-2" style=""><button type="button" class="btn btn-primary w-md add_more_professional_data"  data-id="1" style="margin-top: 8px;min-width:70px;float:right;">+</button></div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Reference Name</label>
                                    <input type="text" name="reference_name_2[]" value="{{$reference['name_2'] ?? ''}}" class="form-control" id="reference_name_1">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Name of Company</label>
                                    <input type="text" name="reference_place_work_2[]" class="form-control" id="reference_place_work_2" value="{{$reference['reference_place_work_2'] ?? ''}}">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Job Title</label>
                                    <input type="text" name="reference_job_title_2[]" class="form-control" id="reference_job_title_2" value="{{$reference['reference_job_title_2'] ?? ''}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Phone Number</label>
                                    <input type="number" name="reference_number_2[]" value="{{$reference['number_2'] ?? ''}}" class="form-control" id="reference_number_2">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Email Address</label>
                                    <input type="email" name="reference_email_2[]" value="{{$reference['email_2'] ?? ''}}" class="form-control" id="reference_email_2">
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
                            <div class="col-lg-2" style=""><button type="button" class="btn btn-danger w-md remove_more_professional_data"  data-id="1" style="margin-top: 8px;min-width:70px;float:right;">-</button></div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Reference Name</label>
                                    <input type="text" name="reference_name_2[]" value="{{$reference['name_2'] ?? ''}}" class="form-control" id="reference_name_1">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Name of Company</label>
                                    <input type="text" name="reference_place_work_2[]" class="form-control" id="reference_place_work_2" value="{{$reference['reference_place_work_2'] ?? ''}}">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Job Title</label>
                                    <input type="text" name="reference_job_title_2[]" class="form-control" id="reference_job_title_2" value="{{$reference['reference_job_title_2'] ?? ''}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Phone Number</label>
                                    <input type="number" name="reference_number_2[]" value="{{$reference['number_2'] ?? ''}}" class="form-control" id="reference_number_2">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Email Address</label>
                                    <input type="email" name="reference_email_2[]" value="{{$reference['email_2'] ?? ''}}" class="form-control" id="reference_email_2">
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
                            <div class="col-lg-2" style=""><button type="button" class="btn btn-primary w-md add_more_professional_data"  data-id="1" style="margin-top: 8px;min-width:70px;float:right;">+</button></div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Reference Name</label>
                                    <input type="text" name="reference_name_2[]" class="form-control" id="reference_name_1">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Name of Company</label>
                                    <input type="text" name="reference_place_work_2[]" class="form-control" id="reference_place_work_2">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Job Title</label>
                                    <input type="text" name="reference_job_title_2[]" class="form-control" id="reference_job_title_2">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Phone Number</label>
                                    <input type="number" name="reference_number_2[]" class="form-control" id="reference_number_2">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Email Address</label>
                                    <input type="email" name="reference_email_2[]" class="form-control" id="reference_email_2">
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
                     <input class="form-check-input" type="radio" value="Yes"  name="court_martial" id="court_martial_yes" @if($candidate->court_martial == 'Yes') checked @endif>
                     <label class="form-check-label" for="formRadios1">
                     Yes
                     </label>
                  </div>
                  <div class="form-check">
                     <input class="form-check-input" type="radio" value="No"  name="court_martial" id="court_martial_no" @if($candidate->court_martial == 'No') checked @endif>
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
                        <textarea name="court_martial_no_details" id="court_martial_no_details" class="form-control" rows="5" spellcheck="false">{{$candidate->court_martial_no_details ?? ''}}</textarea>
                    </div>
                </div>
            </div>
            <div class="row">
               <div class="col-lg-12">
                  <div class="mt-4">
                     <h5 class="font-size-14 mb-4">Do you have any current UNSPENT police cautions, reprimands or final warnings in the United Kingdom or in any other country?</h5>
                  </div>
                  <div class="form-check mb-3">
                     <input class="form-check-input" type="radio" value="Yes" name="police_cautions"  id="police_cautions_yes" @if($candidate->police_cautions == 'Yes') checked @endif>
                     <label class="form-check-label" for="formRadios1">
                     Yes
                     </label>
                  </div>
                  <div class="form-check">
                     <input class="form-check-input" type="radio" value="No" name="police_cautions"  id="police_cautions_no" @if($candidate->police_cautions == 'No') checked @endif>
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
                        <textarea name="police_cautions_no_details" id="police_cautions_no_details" class="form-control" rows="5" spellcheck="false">{{$candidate->police_cautions_no_details ?? ''}}</textarea>
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
                  <input class="form-check-input" type="checkbox" name="privacy_policy"  id="privacy_policy_check" @if($candidate->privacy_policy == 'on') checked @endif>
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
                     <textarea name="supporting_desc" id="supporting_desc" class="form-control" rows="5" spellcheck="false" >NDH Care Ltd will only collect data for specified, explicit and legitimate use in relation to the recruitment process. By signing this application form, you consent NDH Care Ltd holding the information contained within this application form. If successfully shortlisted, data will also include shortlisting scoring and interview records. We would like to keep this data until the vacancy is filled. (We cannot estimate the exact time period, but we will consider this period over when a candidate accepts our job offer for the position for which we are considering you). When that period is over, we will either delete your data or inform you that we would like to keep it in our database for future roles. We have privacy policies that you can request for further information. Please be assured that your data will be securely stored by the registered manager and only used for the purpose of recruiting for this vacant post. You have right for your data to be forgotten, to rectify or access data to restrict processing to withdraw consent and to be kept informed about the processing of your data. If you would like to discus further or withdraw your consent at any time, please contact Registered Manager or Data Protection Officer on 0121 448 0568.</textarea>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-lg-6">
            <div class="mb-3">
                <label for="basicpill-firstname-input">Identity Proof Type</label>
                <select class="form-control form-select" name="identity_proof_type" id="identity_proof_type" required>
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
                <select class="form-control form-select" name="address_proof_type" id="address_proof_type" required>
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
      </div>
      <br/>
      </form>
   </div>
   <!-- end col -->
</div>
<br>
<br>
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
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">CANDIDATE INTERVIEW SCREENING</h4>
        </div>
    </div>
</div>
<div>
    <div class="white-bg">
       <div class="row">
           <div class="col-4">
               <img src="https://job.ndhcare.co.uk/assets/images/NDH-care-1.png" alt="" height="45" class="advance-logo">
           </div>
           <div class="col-4">
               <h4 class="site-heading" style="font-size: 2rem"><b>NDH CARE LTD</b></h4>
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
                </form>
            </div>
        </div>
    </div>
   <!-- end col -->
</div>
<br>
<br>
@section('css')
<link href="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="{{ URL::asset('/assets/libs/datepicker/datepicker.min.css') }}">
<style>
    table {
        width: 100%;
    }

    .border-table tr,
    th,
    td {
        border: 1px solid #e1e1e1 !important;
        padding: 10px;
    }

    th {
        font-size: 15px;
        font-weight: 500;
    }

    td {
        font-size: 13px;

    }

    input[type="text"] {
        border: 0;
        transition: width .35s ease-in-out;
        width: 100%;
    }

    input[type="text"]:focus-visible {
        outline: none;
    }

    textarea {
        width: 100%;
    }

    .cust-add {
        text-align: center;
        align-items: center;
        justify-content: center;
        display: flex;
    }

    .cust-add-2 {
        align-items: center;
        justify-content: center;
        display: flex;
    }

    .acenter {
        border: 1px solid #e1e1e1;
        width: 50%;
        padding: 8px;
        font-size: 16px;
    }

    .acenter-2 {
        border: 1px solid #e1e1e1;
        width: 50%;
        padding: 8px 64px 8px 65px;
        font-size: 16px;
    }

    .margin_left {
        margin-left: 100px;
    }

    .add-border input {
        border-bottom: 1px solid #000;
        display: inline;
    }

    .add-border-2 input {
        border-bottom: 1px solid #000;
        width: 100%;
    }

    .input-2 input[type="text"] {
        width: 100% !important;
    }

    .col-set {
        width: 9.10%;
        text-align: center;
    }

    span.left {
        margin-left: 20px;
    }

    .width th {
        width: 20%;
    }

    .add-border input[type="text"] {
        width: 16%;
        border-radius: 0;
        padding: 0;
    }
    .add-border-3 input{
        border: 1px solid #000;
        width: 20%;
    }
    .sm-width{
        width: 50%;
    }
    p.add-border-3 input.form-control {
        display: inline;
    }
    .skill-Assessment p {
        font-size: 18px;
        font-weight: 400;
    }
    .skill-Assessment h4 {
        font-size: 22px;
        font-weight: 600;
    }
    .skill-Assessment h5 {
        font-size: 22px;
        font-weight: 600;
    }
    input.form-control {
        font-size: 17px !important;
        padding: 0;
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
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">ENGLISH & MATHS BASIC SKILL ASSESSMENT</h4>
        </div>
    </div>
</div>
<div>
    <div class="white-bg">
       <div class="row">
           <div class="col-4">
               <img src="https://job.ndhcare.co.uk/assets/images/NDH-care-1.png" alt="" height="45" class="advance-logo">
           </div>
           <div class="col-4">
               <h4 class="site-heading" style="font-size: 2rem"><b>NDH CARE LTD</b></h4>
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
                <form method="post" action="{{route('storeBasicEnglishTest')}}">
                @csrf
                <div class="section-1">
                    <div class="table-1">
                        <h5>Candidate Information </h5>
                        <table class=" w-100 d-block d-md-table">
                            <form>
                                <tr>
                                    <th>Candidate Name</th>
                                    <td colspan="3"><input type="text" class="form-control" name="candidate_name" value="{{$candidate->prefix .' '. $candidate->first_name .' '. $candidate->last_name}}" readonly/></td>
                                </tr>
                                <tr>
                                    <th>Date of Assessment</th>
                                    <td><input type="text" class="form-control" name="date_assessment" value="{{ $candidate->candidateBasicTest && $candidate->candidateBasicTest->date_assessment ? $candidate->candidateBasicTest->date_assessment : date('Y-m-d') }}"/></td>
                                    <th>Candidate Signature</th>
                                    <td><input type="text" class="form-control" name="candidate_sign" value="{{ $candidate->candidateBasicTest && $candidate->candidateBasicTest->candidate_sign ? $candidate->candidateBasicTest->candidate_sign : '' }}" @if(Auth::user()->role != 'Candidate') readonly @endif/></td>
                                </tr>
                            </form>
                        </table>
                    </div>
                    <br />
                    <br />
                    <div class="table-2">
                        <h5>Staff Use Only</h5>
                        <table class=" w-100 d-block d-md-table">
                            <form>
                                <tr>
                                    <th>English Assessment Score</th>
                                    <td><input type="text" class="form-control" name="english_assessment_score" readonly value="{{ $candidate->candidateBasicTest && $candidate->candidateBasicTest->english_assessment_score ? $candidate->candidateBasicTest->english_assessment_score : '' }}"/></td>
                                </tr>
                                <tr>
                                    <th>Maths Assessment Score</th>
                                    <td><input type="text" class="form-control" name="math_assessment_score" readonly value="{{$candidate->candidateBasicTest && $candidate->candidateBasicTest->math_assessment_score ? $candidate->candidateBasicTest->math_assessment_score : ''}}"/></td>
                                </tr>
                                <tr>
                                    <th>Total Score out of 25 </th>
                                    <td><input type="text" class="form-control" name="total_score" readonly value="{{$candidate->candidateBasicTest && $candidate->candidateBasicTest->total_score ? $candidate->candidateBasicTest->total_score : ''}}"/></td>
                                </tr>
                                <tr>
                                    <th colspan="2"><u>Recruitment Matrix Score guidance</u> <br />
                                        3 - Exceed Requirements – if score >= 22 <br />
                                        2 - Meet Essential Requirements – if score >= 15* <br />
                                        1 - Below Level - if Score
                                        < 15 <br />
                                        <b>(Note: Questions with * minimum requirement is score 2)</b>
                                    </th>
                                </tr>
                                <tr>
                                    <th>Recruitment Matrix Score</th>
                                    <td><input type="text" class="form-control" name="recruitment_matrix_score" @if(Auth::user()->role == 'Candidate') readonly @endif/></td>
                                </tr>
                                <tr>
                                    <th>Assessor Name</th>
                                    @if(Auth::user()->role == 'Candidate')
                                    @php
                                        $userData = $candidate->branch;
                                    @endphp
                                    @else
                                    @php
                                        $userData = Auth::user();
                                    @endphp
                                    @endif
                                    <td><input type="text" class="form-control" name="assessor_name" value="{{$userData->name}}" @if(Auth::user()->role == 'Candidate') readonly @endif/></td>
                                </tr>
                                @if(Auth::user()->role == 'Candidate')
                                    @php
                                        $userData = $candidate->branch;
                                    @endphp
                                @else
                                    @php
                                        $userData = Auth::user();
                                    @endphp
                                @endif
                                <tr>
                                    <th>Assessor Signature</th>
                                    @if(Auth::user()->role == 'Candidate')
                                    @if($userData && $userData->signature)
                                    <td><img width="450" height="160" src="{{ $userData->signature }}" alt="Candidate Signature"></td>
                                    @else
                                    <td><input type="text" class="form-control" value="No signature available"></td>
                                    @endif
                                    @else
                                    @if($userData && $userData->signature)
                                    <td><img width="450" height="160" src="{{ $userData->signature }}" alt="Candidate Signature"></td>
                                    @else
                                    <td><input type="text" class="form-control" value="No signature available"></td>
                                    @endif
                                    @endif
                                </tr>
                            </form>
                        </table>
                    </div>
                    <br />
                    <div class="table-2">
                        <h5>Comments :</h5>
                        <form>
                            <td><textarea class="form-control" rows="5" name="assessment_comment" @if(Auth::user()->role == 'Candidate') readonly @endif></textarea></td>

                        </form>
                    </div>
                </div>
                <br>
                <br>
                <h2 style="text-align: center;color: blue;">English Assessment</h2>
                <br>
                <br>
                <div class="section-2">
                    <div>
                        <input type="hidden" name="candidate_id" value="{{ $candidate->id ?? '' }}">
                        <h4> 1) Read this text and then answer question.</h4>
                        <div class="margin_left">
                            <div class="cust-add">
                                <p class="acenter">
                                    Sonia Is 25! <br />
                                    You are invited to afternoon tea. <br />
                                    3 pm – 5 pm at the <br />
                                    Royal Hotel High Street <br />
                                    No gifts – just bring a card.
                                </p>
                            </div>
                            <p>Your friend, Sonia, wants you to come to her birthday tea.</p>
                            <div>
                                <p class="add-border"> <b>When</b> does the tea finish? <input type="text" class="form-control" name="first_answer" value="{{$candidate->candidateBasicTest && $candidate->candidateBasicTest->first_answer ? $candidate->candidateBasicTest->first_answer : ''}}"/>pm.</p>
                            </div>
                        </div>
                    </div>
                    <br />
                    <div>
                        <h4> 2) Fill in the blanks with the correct spellings.</h4>
                        <div class="margin_left">
                            <div>
                                <p class="add-border"> The company set up a <input type="text" class="form-control" name="second_answer" value="{{$candidate->candidateBasicTest && $candidate->candidateBasicTest->second_answer ? $candidate->candidateBasicTest->second_answer : ''}}"/>to assist the customers/clients
                                    communicating with them. <b>[help desk, kiosk, booth, room]</b></p>
                            </div>
                        </div>
                    </div>
                    <br />
                    <div>
                        @if($candidate->candidateBasicTest && $candidate->candidateBasicTest->third_answer)
                            @php
                                $third_answer = json_decode($candidate->candidateBasicTest->third_answer);
                            @endphp
                        @else
                            @php
                                $third_answer = '';
                            @endphp
                        @endif
                        <h4> 3) Fill in the alphabet letter in the correct order. </h4>
                        <div class="margin_left">
                            <div>
                                <table class=" w-100 d-block d-md-table">
                                        <tr>
                                            <th class="col-set">E</th>
                                            <td class="input-2"><input type="text" class="form-control" name="third_answer[]" value="{{ $candidate->candidateBasicTest && $third_answer ? $third_answer[0] ?? '' : '' }}"/></td>
                                            <td class="input-2"><input type="text" class="form-control" name="third_answer[]" value="{{ $candidate->candidateBasicTest && $third_answer ? $third_answer[1] ?? '' : '' }}"/></td>
                                            <td class="input-2"><input type="text" class="form-control" name="third_answer[]" value="{{ $candidate->candidateBasicTest && $third_answer ? $third_answer[2] ?? '' : '' }}"/></td>
                                            <td class="input-2"><input type="text" class="form-control" name="third_answer[]" value="{{ $candidate->candidateBasicTest && $third_answer ? $third_answer[3] ?? '' : '' }}"/></td>
                                            <th class="col-set">J</th>
                                            <td class="input-2"><input type="text" class="form-control" name="third_answer[]" value="{{ $candidate->candidateBasicTest && $third_answer ? $third_answer[4] ?? '' : '' }}"/></td>
                                            <th class="col-set">L</th>
                                            <td class="input-2"><input type="text" class="form-control" name="third_answer[]" value="{{ $candidate->candidateBasicTest && $third_answer ? $third_answer[5] ?? '' : '' }}"/></td>
                                            <td class="input-2"><input type="text" class="form-control" name="third_answer[]" value="{{ $candidate->candidateBasicTest && $third_answer ? $third_answer[6] ?? '' : '' }}"/></td>
                                            <td class="input-2"><input type="text" class="form-control" name="third_answer[]" value="{{ $candidate->candidateBasicTest && $third_answer ? $third_answer[7] ?? '' : '' }}"/></td>
                                        </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    <br />
                    <div>
                        <h4> 4) Read this sentence and then answer question. </h4>
                        <div class="margin_left">
                            <div class="cust-add">
                                <p class="acenter">
                                    It’s at the Royal Hotel this Satturday.
                                </p>
                            </div>
                            <p class="add-border">Find the word that is not spelled correctly and write the correct spelling :
                                <input type="text" class="form-control" name="fourth_answer" value="{{$candidate->candidateBasicTest && $candidate->candidateBasicTest->fourth_answer ? $candidate->candidateBasicTest->fourth_answer : ''}}"/>
                            </p>
                            <br />
                            <div class="cust-add-2">
                                <div class="acenter-2">
                                    <b>The day before your operation</b><br />
                                    <span class="left">• Eat a light dinner in the evening.</span><br />
                                    <span class="left">• Do not eat or drink anything after midnight.</span>
                                    <br />
                                    <b>The day of your operation</b><br />
                                    <span class="left">• Eat a light dinner in the evening.</span><br />
                                    <span class="left">• Do not eat or drink anything after midnight.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br />
                    <div>
                        <h4> 5) Read the below mentioned nots and then answer question. </h4>
                        <div class="margin_left ">
                            <p class="add-border-2">
                                What do patients need to take to the hospital?<BR />
                                <input type="text" class="form-control" name="fifth_answer" value="{{$candidate->candidateBasicTest && $candidate->candidateBasicTest->fifth_answer ? $candidate->candidateBasicTest->fifth_answer : ''}}"/>
                            </p>
                        </div>
                    </div>
                    <br />
                    <div>
                        <h4> 6) Sort these words into alphabetical order. </h4>
                        <div class="margin_left ">
                            <table class=" w-100 d-block d-md-table width">
                                <tr class="text-center">
                                    <th>Build</th>
                                    <th>Break</th>
                                    <th>Bear</th>
                                    <th>Bare</th>
                                    <th>Blue</th>
                                </tr>
                            </table>
                            <br />
                            @if($candidate->candidateBasicTest && $candidate->candidateBasicTest->sixth_answer)
                                @php
                                    $sixth_answer = json_decode($candidate->candidateBasicTest->sixth_answer);
                                @endphp
                            @else
                                @php
                                    $sixth_answer = '';
                                @endphp
                            @endif
                            <table class=" w-100 d-block d-md-table ">
                                <tr class="text-center">
                                    <td><input type="text" class="form-control" name="sixth_answer[]" value="{{ $candidate->candidateBasicTest && $sixth_answer ? $sixth_answer[0] ?? '' : '' }}"/></td>
                                    <td><input type="text" class="form-control" name="sixth_answer[]" value="{{ $candidate->candidateBasicTest && $sixth_answer ? $sixth_answer[0] ?? '' : '' }}"/></td>
                                    <td><input type="text" class="form-control" name="sixth_answer[]" value="{{ $candidate->candidateBasicTest && $sixth_answer ? $sixth_answer[0] ?? '' : '' }}"/></td>
                                    <td><input type="text" class="form-control" name="sixth_answer[]" value="{{ $candidate->candidateBasicTest && $sixth_answer ? $sixth_answer[0] ?? '' : '' }}"/></td>
                                    <td><input type="text" class="form-control" name="sixth_answer[]" value="{{ $candidate->candidateBasicTest && $sixth_answer ? $sixth_answer[0] ?? '' : '' }}"/></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <br />
                    <div>
                        <h4> 7) Choose the correct word from the choices below and fill in the blank. (Both answers need to be
                            cor-rect)
                            (Total marks is 2) </h4>
                        <div class="margin_left ">
                            <div>
                                <p class="add-border">
                                    7a) There are 31 days in January,
                                    <input type="text" class="form-control" name="seven_a_answer" value="{{$candidate->candidateBasicTest && $candidate->candidateBasicTest->seven_a_answer ? $candidate->candidateBasicTest->seven_a_answer : ''}}"/>there are only 28 in February. <b>[as, and, or, so, but]</b>
                                </p>
                                <p class="add-border">
                                    7b) Sorry, our hospital car park will not be open.<br />In addition, the cafe will
                                    <input type="text" class="form-control" name="seven_b_answer" value="{{$candidate->candidateBasicTest && $candidate->candidateBasicTest->seven_b_answer ? $candidate->candidateBasicTest->seven_b_answer : ''}}"/>closed for r epair. <b>[first, then, also, finally]</b>
                                </p>
                            </div>
                        </div>
                    </div>

                    <br />
                    <div>
                        <h4> 8) What does correspond mean in the sentence below? </h4>
                        <div class="margin_left ">
                            <div class="row">
                                <p>
                                    They had to correspond by email while he worked abroad. (mark )
                                </p><br />
                                <div class="col-md-4">
                                    <table class=" w-100 d-block d-md-table ">
                                        <tr class="text-center">
                                            <th>Communicate</th>
                                            <td><input type="radio" name="eight_answer" value="Communicate" {{ $candidate->candidateBasicTest && $candidate->candidateBasicTest->eight_answer == 'Communicate' ? 'checked' : '' }} /></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-4">
                                    <table class=" w-100 d-block d-md-table ">
                                        <tr class="text-center">
                                            <th>Contact</th>
                                            <td><input type="radio" name="eight_answer" value="Contact" {{ $candidate->candidateBasicTest && $candidate->candidateBasicTest->eight_answer == 'Contact' ? 'checked' : '' }} /></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-4">
                                    <table class=" w-100 d-block d-md-table width">
                                        <tr class="text-center">
                                            <th>Meet</th>
                                            <td><input type="radio" name="eight_answer" value="Meet" {{ $candidate->candidateBasicTest && $candidate->candidateBasicTest->eight_answer == 'Meet' ? 'checked' : '' }}/></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <br />
                    <div>
                        <h4> 9) A patient is going to hospital. He follows these directions to get to where he needs to be: </h4>
                        <div class="margin_left ">
                            <div>
                                <p>a. Go through reception and turn right.</p>
                                <p>b. Walk to the end of the corridor and turn left.</p>
                                <p>c. Go past the plaster room and turn left.</p>
                                <p>d. The entrance to the place you need is the first door on your right.</p>
                            </div>
                            <div class="text-center">
                                <img src="{{asset('images/graph.jpeg')}}" />
                            </div>
                            <div class="row">
                                <p>Where is the patient going? (mark )</p>
                                <div class="col-md-6">
                                    <table class=" w-100 d-md-table ">
                                        <tr class="text-center">
                                            <th>Main Canteen</th>
                                            <td><input type="radio" name="nine_answer" value="Main Canteen" {{ $candidate->candidateBasicTest && $candidate->candidateBasicTest->nine_answer == 'Main Canteen' ? 'checked' : '' }}/></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table class=" w-100 d-md-table ">
                                        <tr class="text-center">
                                            <th>Admissions Ward</th>
                                            <td><input type="radio" name="nine_answer" value="Admissions Ward" {{ $candidate->candidateBasicTest && $candidate->candidateBasicTest->nine_answer == 'Admissions Ward' ? 'checked' : '' }}/></td>
                                        </tr>
                                    </table>
                                </div><br /><br /><br />
                                <div class="col-md-6">
                                    <table class=" w-100 d-md-table ">
                                        <tr class="text-center">
                                            <th>Plaster Room</th>
                                            <td><input type="radio" name="nine_answer" value="Plaster Room" {{ $candidate->candidateBasicTest && $candidate->candidateBasicTest->nine_answer == 'Plaster Room' ? 'checked' : '' }}/></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table class=" w-100 d-md-table ">
                                        <tr class="text-center">
                                            <th>Waiting Area</th>
                                            <td><input type="radio" name="nine_answer" value="Waiting Area" {{ $candidate->candidateBasicTest && $candidate->candidateBasicTest->nine_answer == 'Waiting Area' ? 'checked' : '' }}/></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <br />
                    <div>
                        @if($candidate->candidateBasicTest && $candidate->candidateBasicTest->ten_answer)
                            @php
                                $ten_answer = json_decode($candidate->candidateBasicTest->ten_answer);
                            @endphp
                        @else
                            @php
                                $ten_answer = '';
                            @endphp
                        @endif
                        <h4> 10) Look at the graphs below and Fill the Gaps with the correct word to describe the visual
                            information. Make sure you read the information carefully. (Total marks is 5) </h4>
                        <div class="margin_left ">
                            <div>
                                <p><b></b>Options:</b> 1. reached a peak, 2. a marked increase, 3. more popular, 4. a significant
                                    decrease, 5. a significant rise, </p>
                            </div>
                            <div class="text-center">
                                <img src="{{asset('images/10.png')}}" />
                            </div>
                            <br />
                            <div>
                                <p class="add-border">
                                    The graph shows the quantity of margarine, low fat spreads and butter consumed between 1981 and 2007. The quantities are measured in grams. Over the period 1981 to 2007 as a whole, there was <b>1.</b> <input type="text" class="form-control" name="ten_answer[]" value="{{ $candidate->candidateBasicTest && $ten_answer ? $ten_answer[0] ?? '' : '' }}"/>in the consumption of butter and margarine and a <b>2.</b> <input type="text" class="form-control" name="ten_answer[]" value="{{ $candidate->candidateBasicTest && $ten_answer ? $ten_answer[1] ?? '' : '' }}"/>in the consumption of low fat-fat spreads.
                                </p>
                            </div>
                            <div>
                                <p class="add-border">
                                    Butter was the most popular fat at the beginning of the period, and consumption <b>3. </b> <input type="text" class="form-control" name="ten_answer[]" value="{{ $candidate->candidateBasicTest && $ten_answer ? $ten_answer[2] ?? '' : '' }}"/>of about 160 grams in 1986. After this, there was a sharp decline.
                                </p>
                            </div>
                            <div>
                                <p>
                                    The consumption of margarine began lower than that for butter at 90 grams. Following this, in 1991, it Exceeded that of butter for the first time, but after 1996 there was a steady downward trend in the amount consumed, which seemed set to continue.
                                </p>
                            </div>
                            <div>
                                <p class="add-border">
                                    Low–fat spreads were introduced in 1996, and they saw <b>4. </b> <input type="text" class="form-control" name="ten_answer[]" value="{{ $candidate->candidateBasicTest && $ten_answer ? $ten_answer[3] ?? '' : '' }}"/>in their consumption from that time, so that by about 2001 they were <b>5. </b> <input type="text" class="form-control" name="ten_answer[]" value="{{ $candidate->candidateBasicTest && $ten_answer ? $ten_answer[4] ?? '' : '' }}"/>than either butter or margarine.
                                </p>
                            </div>
                            <div class="row">
                                <p></p>
                                <div class="col-md-6">
                                    <table class=" w-100 d-block d-md-table ">
                                        <tr class="text-center">
                                            <th>Learner Total score out of 15</th>
                                            <td><input type="text" class="form-control" name="learner_total_score" disabled/></td>
                                        </tr>
                                    </table>
                                </div>

                                @if (Auth::user()->role == 'Candidate')
                                    @php
                                    $userData = $candidate->branch;
                                    @endphp
                                @else
                                    @php
                                    $userData = Auth::user();
                                    @endphp
                                @endif
                                <div class="col-md-6">
                                    <div class="text">Assessor sign:</div>
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
                    </div>
                </div>
                <br>
                <br>
                <h2 style="text-align: center;color: blue;">Maths Assessment</h2>
                <br>
                <br>
                <div class="section-3">
                    <div>
                        <p><b>1) If today’s date is 15th July and day is Friday, then please can you tell me which date will be next
                                Friday?</b></p>
                        <div class="row">
                            <div class="col-md-3">
                                <p>a. 22nd July &nbsp;<input type="radio" name="first_maths_answer" value="a" @if($candidate->candidateBasicTest && $candidate->candidateBasicTest->first_maths_answer && $candidate->candidateBasicTest->first_maths_answer == 'a') checked @endif></p>
                            </div>
                            <div class="col-md-3">
                                <p>b. 23rd July &nbsp;<input type="radio" name="first_maths_answer" value="b" @if($candidate->candidateBasicTest && $candidate->candidateBasicTest->first_maths_answer && $candidate->candidateBasicTest->first_maths_answer == 'b') checked @endif></p>
                            </div>
                            <div class="col-md-3">
                                <p>c. 22nd June &nbsp;<input type="radio" name="first_maths_answer" value="c" @if($candidate->candidateBasicTest && $candidate->candidateBasicTest->first_maths_answer && $candidate->candidateBasicTest->first_maths_answer == 'c') checked @endif></p>
                            </div>
                            <div class="col-md-3">
                                <p>d. 25th June &nbsp;<input type="radio" name="first_maths_answer" value="d" @if($candidate->candidateBasicTest && $candidate->candidateBasicTest->first_maths_answer && $candidate->candidateBasicTest->first_maths_answer == 'd') checked @endif></p>
                            </div>
                        </div>
                        <!-- <div>
                            <p class="add-border">
                                Answer : <input type="text" class="form-control" name="first_maths_answer" value="{{$candidate->candidateBasicTest && $candidate->candidateBasicTest->first_maths_answer ? $candidate->candidateBasicTest->first_maths_answer : ''}}"/>.
                            </p>
                        </div> -->
                    </div>

                    <div>
                        <p><b>2) Add 10 + 15 + 5 = ? Write the correct answer.</b></p>
                        <div class="row">
                            <div class="col-md-3">
                                <p>a. 30 &nbsp;<input type="radio" name="second_maths_answer" value="a" @if($candidate->candidateBasicTest && $candidate->candidateBasicTest->second_maths_answer && $candidate->candidateBasicTest->second_maths_answer == 'a') checked @endif></p>
                            </div>
                            <div class="col-md-3">
                                <p>b. 25 &nbsp;<input type="radio" name="second_maths_answer" value="b" @if($candidate->candidateBasicTest && $candidate->candidateBasicTest->second_maths_answer && $candidate->candidateBasicTest->second_maths_answer == 'b') checked @endif></p>
                            </div>
                            <div class="col-md-3">
                                <p>c. 40 &nbsp;<input type="radio" name="second_maths_answer" value="c" @if($candidate->candidateBasicTest && $candidate->candidateBasicTest->second_maths_answer && $candidate->candidateBasicTest->second_maths_answer == 'c') checked @endif></p>
                            </div>
                            <div class="col-md-3">
                                <p>d. 35 &nbsp;<input type="radio" name="second_maths_answer" value="d" @if($candidate->candidateBasicTest && $candidate->candidateBasicTest->second_maths_answer && $candidate->candidateBasicTest->second_maths_answer == 'd') checked @endif></p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <p><b>3) If you need to reach workplace at 11:15 am, journey duration from your home to workplace is 35 min
                                so
                                please circle below what time you should start your journey?</b></p>
                        <div class="row">
                            <div class="col-md-3">
                                <p>a. 11:00am &nbsp;<input type="radio" name="third_maths_answer" value="a" @if($candidate->candidateBasicTest && $candidate->candidateBasicTest->third_maths_answer && $candidate->candidateBasicTest->third_maths_answer == 'a') checked @endif></p>
                            </div>
                            <div class="col-md-3">
                                <p>b. 11:05am &nbsp;<input type="radio" name="third_maths_answer" value="b" @if($candidate->candidateBasicTest && $candidate->candidateBasicTest->third_maths_answer && $candidate->candidateBasicTest->third_maths_answer == 'b') checked @endif></p>
                            </div>
                            <div class="col-md-3">
                                <p>c. 10.40am &nbsp;<input type="radio" name="third_maths_answer" value="c" @if($candidate->candidateBasicTest && $candidate->candidateBasicTest->third_maths_answer && $candidate->candidateBasicTest->third_maths_answer == 'c') checked @endif></p>
                            </div>
                            <div class="col-md-3">
                                <p>d. 10.40pm &nbsp;<input type="radio" name="third_maths_answer" value="d" @if($candidate->candidateBasicTest && $candidate->candidateBasicTest->third_maths_answer && $candidate->candidateBasicTest->third_maths_answer == 'd') checked @endif></p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <p><b>4) if you have £20 and you spend £10.50, what is remaining balance?</b></p>
                        <div class="row">
                            <div class="col-md-3">
                                <p>a. £15.00 &nbsp;<input type="radio" name="fourth_maths_answer" value="a" @if($candidate->candidateBasicTest && $candidate->candidateBasicTest->fourth_maths_answer && $candidate->candidateBasicTest->fourth_maths_answer == 'a') checked @endif></p>
                            </div>
                            <div class="col-md-3">
                                <p>b. £9.50 &nbsp;<input type="radio" name="fourth_maths_answer" value="b" @if($candidate->candidateBasicTest && $candidate->candidateBasicTest->fourth_maths_answer && $candidate->candidateBasicTest->fourth_maths_answer == 'b') checked @endif></p>
                            </div>
                            <div class="col-md-3">
                                <p>c. £10.50 &nbsp;<input type="radio" name="fourth_maths_answer" value="c" @if($candidate->candidateBasicTest && $candidate->candidateBasicTest->fourth_maths_answer && $candidate->candidateBasicTest->fourth_maths_answer == 'c') checked @endif></p>
                            </div>
                            <div class="col-md-3">
                                <p>d. £12.00 &nbsp;<input type="radio" name="fourth_maths_answer" value="d" @if($candidate->candidateBasicTest && $candidate->candidateBasicTest->fourth_maths_answer && $candidate->candidateBasicTest->fourth_maths_answer == 'd') checked @endif></p>
                            </div>
                        </div>
                        <!-- <div>
                            <p class="add-border">
                                Answer : <input type="text" class="form-control" name="fourth_maths_answer" value="{{$candidate->candidateBasicTest && $candidate->candidateBasicTest->fourth_maths_answer ? $candidate->candidateBasicTest->fourth_maths_answer : ''}}"/>.
                            </p>
                        </div> -->
                    </div>

                    <div>
                        @if($candidate->candidateBasicTest && $candidate->candidateBasicTest->fifth_maths_answer)
                            @php
                                $fifth_maths_answer = json_decode($candidate->candidateBasicTest->fifth_maths_answer);
                            @endphp
                        @else
                            @php
                                $fifth_maths_answer = '';
                            @endphp
                        @endif
                        <p class="add-border"><b>
                                5) Color sequence: Black, Blue, Pink, Yellow, Black, Blue, Pink, Yellow, Black, <input type="text" class="form-control" name="fifth_maths_answer[]" value="{{ $candidate->candidateBasicTest && $fifth_maths_answer ? $fifth_maths_answer[0] ?? '' : '' }}"/>,
                                <input type="text" class="form-control" name="fifth_maths_answer[]" value="{{ $candidate->candidateBasicTest && $fifth_maths_answer ? $fifth_maths_answer[1] ?? '' : '' }}"/>,<input type="text" class="form-control" name="fifth_maths_answer[]" value="{{ $candidate->candidateBasicTest && $fifth_maths_answer ? $fifth_maths_answer[2] ?? '' : '' }}"/>.
                            </b></p>
                    </div>

                    <div>
                        <p class="add-border"><b>
                                6) Convert time in 24 hours clock: 04:00pm = <input type="text" class="form-control" name="sixth_maths_answer" value="{{$candidate->candidateBasicTest && $candidate->candidateBasicTest->sixth_maths_answer ? $candidate->candidateBasicTest->sixth_maths_answer : ''}}"/>.</b>
                        </p>
                    </div>

                    <div>
                        <p class="add-border"><b>
                                7) The bus leaves at 10.15 am. Tick the correct clock showing this <input type="text" class="form-control" name="seven_maths_answer" value="{{$candidate->candidateBasicTest && $candidate->candidateBasicTest->seven_maths_answer ? $candidate->candidateBasicTest->seven_maths_answer : ''}}"/> time.</b>
                        </p>
                        <div class="row">
                            <div class="col-md-6">
                                <p class="add-border-3 "><b>
                                    Clock 1</b>
                                    <img src="{{asset('images/clock_01.jpeg')}}"/>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p class="add-border-3 "><b>
                                    Clock 2</b>
                                    <img src="{{asset('images/clock_02.jpeg')}}"/>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <p><b>8) There are 23 people on a bus. 19 more people get on the bus. How many people are on the bus
                                now?</b>
                        </p>
                        <div class="row">
                            <div class="col-md-3">
                                <p>a. 40 &nbsp;<input type="radio" name="eigth_maths_answer" value="a" @if($candidate->candidateBasicTest && $candidate->candidateBasicTest->eigth_maths_answer && $candidate->candidateBasicTest->eigth_maths_answer == 'a') checked @endif></p>
                            </div>
                            <div class="col-md-3">
                                <p>b. 42 &nbsp;<input type="radio" name="eigth_maths_answer" value="b" @if($candidate->candidateBasicTest && $candidate->candidateBasicTest->eigth_maths_answer && $candidate->candidateBasicTest->eigth_maths_answer == 'd') checked @endif></p>
                            </div>
                            <div class="col-md-3">
                                <p>c. 46 &nbsp;<input type="radio" name="eigth_maths_answer" value="c" @if($candidate->candidateBasicTest && $candidate->candidateBasicTest->eigth_maths_answer && $candidate->candidateBasicTest->eigth_maths_answer == 'c') checked @endif></p>
                            </div>
                            <div class="col-md-3">
                                <p>d. 48 &nbsp;<input type="radio" name="eigth_maths_answer" value="d" @if($candidate->candidateBasicTest && $candidate->candidateBasicTest->eigth_maths_answer && $candidate->candidateBasicTest->eigth_maths_answer == 'b') checked @endif></p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <p><b>9) Wanda baked 168 cookies, packaged them 12 cookies in one box, and she sold each box for £1.20. What
                                was
                                the total amount of money that Wanda made for all of the boxes sold?</b></p>
                        <div class="row">
                            <div class="col-md-3">
                                <p>a. £15.20 &nbsp;<input type="radio" name="nine_maths_answer" value="a" @if($candidate->candidateBasicTest && $candidate->candidateBasicTest->nine_maths_answer && $candidate->candidateBasicTest->nine_maths_answer == 'a') checked @endif></p>
                            </div>
                            <div class="col-md-3">
                                <p>b. £14.40 &nbsp;<input type="radio" name="nine_maths_answer" value="b" @if($candidate->candidateBasicTest && $candidate->candidateBasicTest->nine_maths_answer && $candidate->candidateBasicTest->nine_maths_answer == 'b') checked @endif></p>
                            </div>
                            <div class="col-md-3">
                                <p>c. £16.80 &nbsp;<input type="radio" name="nine_maths_answer" value="c" @if($candidate->candidateBasicTest && $candidate->candidateBasicTest->nine_maths_answer && $candidate->candidateBasicTest->nine_maths_answer == 'c') checked @endif></p>
                            </div>
                            <div class="col-md-3">
                                <p>d. £16.40 &nbsp;<input type="radio" name="nine_maths_answer" value="d" @if($candidate->candidateBasicTest && $candidate->candidateBasicTest->nine_maths_answer && $candidate->candidateBasicTest->nine_maths_answer == 'd') checked @endif></p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <p><b>10) Refer to the picture below to solve the problem</b></p>
                        <div class="text-center">
                            <img src="{{asset('images/tree_and_man.jpeg')}}" />
                        </div>
                        <P>A 6-foot tall man is standing near a tree on level ground as shown in the picture above. If the man’s
                            shadow
                            is 4 feet long, how many feet tall is the tree?</P>
                        <div class="row">
                            <div class="col-md-2">
                                <p>a. 27 &nbsp;<input type="radio" name="ten_maths_answer" value="a" @if($candidate->candidateBasicTest && $candidate->candidateBasicTest->ten_maths_answer && $candidate->candidateBasicTest->ten_maths_answer == 'a') checked @endif></p>
                            </div>
                            <div class="col-md-2">
                                <p>b. 12 &nbsp;<input type="radio" name="ten_maths_answer" value="b" @if($candidate->candidateBasicTest && $candidate->candidateBasicTest->ten_maths_answer && $candidate->candidateBasicTest->ten_maths_answer == 'b') checked @endif></p>
                            </div>
                            <div class="col-md-2">
                                <p>c. 108 &nbsp;<input type="radio" name="ten_maths_answer" value="c" @if($candidate->candidateBasicTest && $candidate->candidateBasicTest->ten_maths_answer && $candidate->candidateBasicTest->ten_maths_answer == 'c') checked @endif></p>
                            </div>
                            <div class="col-md-2">
                                <p>d. 72 &nbsp;<input type="radio" name="ten_maths_answer" value="d" @if($candidate->candidateBasicTest && $candidate->candidateBasicTest->ten_maths_answer && $candidate->candidateBasicTest->ten_maths_answer == 'd') checked @endif></p>
                            </div>
                            <div class="col-md-2">
                                <p>e. None of these &nbsp;<input type="radio" name="ten_maths_answer" value="e"></p>
                            </div>
                        </div>
                        <br>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <table class=" w-100 d-block d-md-table ">
                                    <tr class="text-center">
                                        <th>Learner Total score out of 10</th>
                                        <td><input type="text" class="form-control" name="learner_total_score_maths" disabled/></td>
                                    </tr>
                                </table>
                            </div>
                            @if (Auth::user()->role == 'Candidate')
                                @php
                                $userData = $candidate->branch;
                                @endphp
                            @else
                                @php
                                $userData = Auth::user();
                                @endphp
                            @endif
                            <div class="col-md-6">
                                <div class="text">Assessor sign:</div>
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
                    <br />
                </div>
                </form>
            </div>
        </div>
    </div> <!-- end col -->
</div>
<br>
<br>
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">LIVE INTERVIEW QUESTION</h4>
        </div>
    </div>
</div>
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
               <h4 class="site-heading" style="font-size: 2rem"><b>NDH CARE LTD</b></h4>
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
                </form>
            </div>
        </div>
    </div> <!-- end col -->
</div>
<br>
<br>
<br>
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
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Applicant Identity Check List</h4>
        </div>
    </div>
</div>
<div>
    <div class="white-bg">
       <div class="row">
           <div class="col-4">
               <img src="https://job.ndhcare.co.uk/assets/images/NDH-care-1.png" alt="" height="45" class="advance-logo">
           </div>
           <div class="col-4">
               <h4 class="site-heading" style="font-size: 2rem"><b>NDH CARE LTD</b></h4>
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
                <form method="post" action="{{route('storeApplicationIdentity', $candidateData->id)}}" enctype="multipart/form-data">
                @csrf
                <div class="container APPLICATION">
                    <div>
                        <h4 class="text-center"><u><strong>Applicant Identity Check List</strong></u></h4>
                    </div>

                    <div class="mt-5 input-bottom">
                        <label for="">Applicant Name : </label> <input type="text" class="form-control" name="applicant_name" value="{{$candidateData->prefix ?? ''}} {{$candidateData->first_name ?? ''}} {{$candidateData->last_name ?? ''}}"/>
                    </div>

                    <div class="mt-5">
                        <table border="1px" >
                            <tr>
                                <th>
                                    Original documents only – No photocopies
                                </th>
                                <th>
                                    Document Expiry Date (If Applicable)
                                </th>
                                <th>
                                    Date
                                </th>
                                <th>
                                    File Upload
                                </th>
                            </tr>


                            <tr>
                                <td colspan="4">
                                    <h5 class="text-center">1. Proof of Nationality / Work Eligibility</h5>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <h5>A. British Nationality</h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>1.a Passport</label>
                                </td>
                                <td>
                                    <input type="date" class="form-control" name="passport_expire_date" value="{{ $applicantDetails->passport_expire_date ?? '' }}"/>
                                </td>
                                <td>
                                    <input type="date" class="form-control" name="passport_update_date" value="{{ $applicantDetails->passport_update_date ?? '' }}"/>
                                </td>
                                <td>
                                    <input type="file" class="form-control" name="passport_file"/>
                                    @if($applicantDetails && $applicantDetails->passport_file)
                                        <br><a target="_blank" href="{{ $applicantDetails->passport_file }}">{{ basename($applicantDetails->passport_file) }}</a>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>1.b Birth Certificate</label>
                                </td>
                                <td>
                                    <input type="date" class="form-control" name="birth_certificate_expire_date" value="{{ $applicantDetails->birth_certificate_expire_date ?? '' }}"/>
                                </td>
                                <td>
                                    <input type="date" class="form-control" name="birth_certificate_update_date" value="{{ $applicantDetails->birth_certificate_update_date ?? '' }}"/>
                                </td>
                                <td>
                                    <input type="file" class="form-control" name="birth_certificate_file"/>
                                    @if($applicantDetails && $applicantDetails->birth_certificate_file)
                                    <br><a target="_blank" href="{{ $applicantDetails->birth_certificate_file ?? '' }}">{{ basename($applicantDetails->birth_certificate_file) ?? ''}}</a>
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <td colspan="4">
                                    <h5>B. EU, UEE and Swiss Nationality</h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>1.a EU, UEE and Swiss Passport</label>
                                </td>
                                <td>
                                    <input type="date" class="form-control" name="swiss_passport_expire_date" value="{{ $applicantDetails->swiss_passport_expire_date ?? '' }}"/>
                                </td>
                                <td>
                                    <input type="date" class="form-control" name="swiss_passport_update_date" value="{{ $applicantDetails->swiss_passport_update_date ?? '' }}"/>
                                </td>
                                <td>
                                    <input type="file" class="form-control" name="swiss_passport_file"/>
                                    @if($applicantDetails && $applicantDetails->swiss_passport_file)
                                    <br><a target="_blank" href="{{ $applicantDetails->swiss_passport_file ?? '' }}">{{ basename($applicantDetails->swiss_passport_file) ?? ''}}</a>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>1.b National Identity Card</label>
                                </td>
                                <td>
                                    <input type="date" class="form-control" name="identity_card_expire_date" value="{{ $applicantDetails->identity_card_expire_date ?? '' }}"/>
                                </td>
                                <td>
                                    <input type="date" class="form-control" name="identity_card_update_date" value="{{ $applicantDetails->identity_card_update_date ?? '' }}"/>
                                </td>
                                <td>
                                    <input type="file" class="form-control" name="identity_card_file"/>
                                    @if($applicantDetails && $applicantDetails->identity_card_file)
                                    <br><a target="_blank" href="{{ $applicantDetails->identity_card_file ?? '' }}">{{ basename($applicantDetails->identity_card_file) ?? ''}}</a>
                                    @endif
                                </td>
                            </tr>


                            <tr>
                                <td colspan="4">
                                    <h5>C. For Other Nationality</h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>1.a Passport (Compulsory)</label>
                                </td>
                                <td>
                                    <input type="date" class="form-control" name="other_passport_expire_date" value="{{ $applicantDetails->other_passport_expire_date ?? '' }}"/>
                                </td>
                                <td>
                                    <input type="date" class="form-control" name="other_passport_update_date" value="{{ $applicantDetails->other_passport_update_date ?? '' }}"/>
                                </td>
                                <td>
                                    <input type="file" class="form-control" name="other_passport_file"/>
                                    @if($applicantDetails && $applicantDetails->other_passport_file)
                                    <br><a target="_blank" href="{{ $applicantDetails->other_passport_file ?? '' }}">{{ basename($applicantDetails->other_passport_file) ?? ''}}</a>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>*1. b Visa/BRP Card (must have at least 6 months of
                                        valid visa/ work Permit) (Compulsory)</label>
                                </td>
                                <td>
                                    <input type="date" class="form-control" name="visa_card_expire_date" value="{{ $applicantDetails->visa_card_expire_date ?? '' }}"/>
                                </td>
                                <td>
                                    <input type="date" class="form-control" name="visa_card_update_date" value="{{ $applicantDetails->visa_card_update_date ?? '' }}"/>
                                </td>
                                <td>
                                    <input type="file" class="form-control" name="visa_card_file"/>
                                    @if($applicantDetails && $applicantDetails->visa_card_file)
                                    <br><a target="_blank" href="{{ $applicantDetails->visa_card_file ?? '' }}">{{ basename($applicantDetails->visa_card_file) ?? ''}}</a>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>1.C Right to Work (RTW) Check</label>
                                </td>
                                <td>
                                    <input type="date" class="form-control" name="right_to_work_expire_date" value="{{ $applicantDetails->right_to_work_expire_date ?? '' }}"/>
                                </td>
                                <td>
                                    <input type="date" class="form-control" name="right_to_work_update_date" value="{{ $applicantDetails->right_to_work_update_date ?? '' }}"/>
                                </td>
                                <td>
                                    <input type="file" class="form-control" name="right_to_work_file"/>
                                    @if($applicantDetails && $applicantDetails->right_to_work_file)
                                    <br><a target="_blank" href="{{ $applicantDetails->right_to_work_file ?? '' }}">{{ basename($applicantDetails->right_to_work_file) ?? ''}}</a>
                                    @endif
                                </td>
                            </tr>



                            <tr>
                                <td colspan="4">
                                    <h5 class="text-center">2. Photo ID (Must Have one ID)</h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>2.a Driving license</label>
                                </td>
                                <td>
                                    <input type="date" class="form-control" name="driving_license_expire_date" value="{{ $applicantDetails->driving_license_expire_date ?? '' }}"/>
                                </td>
                                <td>
                                    <input type="date" class="form-control" name="driving_license_update_date" value="{{ $applicantDetails->driving_license_update_date ?? '' }}"/>
                                </td>
                                <td>
                                    <input type="file" class="form-control" name="driving_license_file"/>
                                    @if($applicantDetails && $applicantDetails->driving_license_file)
                                    <br><a target="_blank" href="{{ $applicantDetails->driving_license_file ?? '' }}">{{ basename($applicantDetails->driving_license_file) ?? ''}}</a>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>2.b Passport</label>
                                </td>
                                <td>
                                    <input type="date" class="form-control" name="passport_photo_expire_date" value="{{ $applicantDetails->passport_photo_expire_date ?? '' }}"/>
                                </td>
                                <td>
                                    <input type="date" class="form-control" name="passport_photo_update_date" value="{{ $applicantDetails->passport_photo_update_date ?? '' }}"/>
                                </td>
                                <td>
                                    <input type="file" class="form-control" name="passport_photo_file"/>
                                    @if($applicantDetails && $applicantDetails->passport_photo_file)
                                    <br><a target="_blank" href="{{ $applicantDetails->passport_photo_file ?? '' }}">{{ basename($applicantDetails->passport_photo_file) ?? ''}}</a>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>2.c College ID Card (For Students Only) with current
                                        college letter</label>
                                </td>
                                <td>
                                    <input type="date" class="form-control" name="college_id_expire_date" value="{{ $applicantDetails->college_id_expire_date ?? '' }}"/>
                                </td>
                                <td>
                                    <input type="date" class="form-control" name="college_id_update_date" value="{{ $applicantDetails->college_id_update_date ?? '' }}"/>
                                </td>
                                <td>
                                    <input type="file" class="form-control" name="college_id_file"/>
                                    @if($applicantDetails && $applicantDetails->college_id_file)
                                    <br><a target="_blank" href="{{ $applicantDetails->college_id_file ?? '' }}">{{ basename($applicantDetails->college_id_file) ?? ''}}</a>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>2.d Official UK Photo ID</label>
                                </td>
                                <td>
                                    <input type="date" class="form-control" name="office_uk_id_expire_date" value="{{ $applicantDetails->office_uk_id_expire_date ?? '' }}"/>
                                </td>
                                <td>
                                    <input type="date" class="form-control" name="office_uk_id_update_date" value="{{ $applicantDetails->office_uk_id_update_date ?? '' }}"/>
                                </td>
                                <td>
                                    <input type="file" class="form-control" name="office_uk_id_file"/>
                                    @if($applicantDetails && $applicantDetails->office_uk_id_file)
                                    <br><a target="_blank" href="{{ $applicantDetails->office_uk_id_file ?? '' }}">{{ basename($applicantDetails->office_uk_id_file) ?? ''}}</a>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>2.e Others (Specify)</label>
                                </td>
                                <td>
                                    <input type="date" class="form-control" name="other_id_expire_date" value="{{ $applicantDetails->other_id_expire_date ?? '' }}"/>
                                </td>
                                <td>
                                    <input type="date" class="form-control" name="other_id_update_date" value="{{ $applicantDetails->other_id_update_date ?? '' }}"/>
                                </td>
                                <td>
                                    <input type="file" class="form-control" name="other_id_file"/>
                                    @if($applicantDetails && $applicantDetails->other_id_file)
                                    <br><a target="_blank" href="{{ $applicantDetails->other_id_file ?? '' }}">{{ basename($applicantDetails->other_id_file) ?? ''}}</a>
                                    @endif
                                </td>
                            </tr>


                            <tr>
                                <td colspan="4">
                                    <h5 class="text-center">3. Proof of Address (Must Have At least Two ID)</h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>3.a Utility bill, correct name and address, and must be
                                        within 3 months old</label>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="utility_bill_expire_date" value="{{ $applicantDetails->utility_bill_expire_date ?? '' }}"/>
                                </td>
                                <td>
                                    <input type="date" class="form-control" name="utility_bill_update_date" value="{{ $applicantDetails->utility_bill_update_date ?? '' }}"/>
                                </td>
                                <td>
                                    <input type="file" class="form-control" name="utility_bill_file"/>
                                    @if($applicantDetails && $applicantDetails->utility_bill_file)
                                    <br><a target="_blank" href="{{ $applicantDetails->utility_bill_file ?? '' }}">{{ basename($applicantDetails->utility_bill_file) ?? ''}}</a>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>3.b Driving License</label>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="proof_driving_expire_date" value="{{ $applicantDetails->proof_driving_expire_date ?? '' }}"/>
                                </td>
                                <td>
                                    <input type="date" class="form-control" name="proof_driving_update_date" value="{{ $applicantDetails->proof_driving_update_date ?? '' }}"/>
                                </td>
                                <td>
                                    <input type="file" class="form-control" name="proof_driving_file"/>
                                    @if($applicantDetails && $applicantDetails->proof_driving_file)
                                    <br><a target="_blank" href="{{ $applicantDetails->proof_driving_file ?? '' }}">{{ basename($applicantDetails->proof_driving_file) ?? ''}}</a>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>3.c Bank statement, correct name and address, and must
                                        be within 3 months old bank statement</label>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="bank_statement_expire_date" value="{{ $applicantDetails->bank_statement_expire_date ?? '' }}"/>
                                </td>
                                <td>
                                    <input type="date" class="form-control" name="bank_statement_update_date" value="{{ $applicantDetails->bank_statement_update_date ?? '' }}"/>
                                </td>
                                <td>
                                    <input type="file" class="form-control" name="bank_statement_file"/>
                                    @if($applicantDetails && $applicantDetails->bank_statement_file)
                                    <br><a target="_blank" href="{{ $applicantDetails->bank_statement_file ?? '' }}">{{ basename($applicantDetails->bank_statement_file) ?? ''}}</a>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>3.d Council tax bill, correct name and address, and must
                                        be within3 months’ old</label>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="council_tax_expire_date" value="{{ $applicantDetails->council_tax_expire_date ?? '' }}"/>
                                </td>
                                <td>
                                    <input type="date" class="form-control" name="council_tax_update_date" value="{{ $applicantDetails->council_tax_update_date ?? '' }}"/>
                                </td>
                                <td>
                                    <input type="file" class="form-control" name="council_tax_file"/>
                                    @if($applicantDetails && $applicantDetails->council_tax_file)
                                    <br><a target="_blank" href="{{ $applicantDetails->council_tax_file ?? '' }}">{{ basename($applicantDetails->council_tax_file) ?? ''}}</a>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>3.e Any official Government Letter must be within less
                                        than 3 month old NI letter</label>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="govt_expire_date" value="{{ $applicantDetails->govt_expire_date ?? '' }}"/>
                                </td>
                                <td>
                                    <input type="date" class="form-control" name="govt_update_date" value="{{ $applicantDetails->govt_update_date ?? '' }}"/>
                                </td>
                                <td>
                                    <input type="file" class="form-control" name="govt_file"/>
                                    @if($applicantDetails && $applicantDetails->govt_file)
                                    <br><a target="_blank" href="{{ $applicantDetails->govt_file ?? '' }}">{{ basename($applicantDetails->govt_file) ?? ''}}</a>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>3.f Other (specify)</label>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="other_photo_id_expire_date" value="{{ $applicantDetails->other_photo_id_expire_date ?? '' }}"/>
                                </td>
                                <td>
                                    <input type="date" class="form-control" name="other_photo_id_update_date" value="{{ $applicantDetails->other_photo_id_update_date ?? '' }}"/>
                                </td>
                                <td>
                                    <input type="file" class="form-control" name="other_photo_id_file"/>
                                    @if($applicantDetails && $applicantDetails->other_photo_id_file)
                                    <br><a target="_blank" href="{{ $applicantDetails->other_photo_id_file ?? '' }}">{{ basename($applicantDetails->other_photo_id_file) ?? ''}}</a>
                                    @endif
                                </td>
                            </tr>
                        </table>

                        <div class="row mt-5 input-bottom">
                            <div class="col-8">
                                <p><i>I have confirmed that, I have checked all original document.</i></p>
                            </div>
                            <div class="col-4">
                                <label>Post</label> <input type="text" class="form-control" name="post_name" value="{{ $applicantDetails->post_name ?? '' }}"/>
                            </div>
                        </div>
                        <div class="row mt-3 input-bottom">
                            <div class="col-6">
                                <label>Name : </label> <input type="text" class="form-control" name="name" value="{{ $applicantDetails->name ?? '' }}"/>
                            </div>
                            <div class="col-6">
                                <label>Date : </label> <input type="date" class="form-control" name="date" value="{{ $applicantDetails->date ?? '' }}"/>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <!--<div class="col-10"><div class="text">Signature: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="btn btn-secondary waves-effect waves-light" id="clear2">Clear</span><br><br></div>
                                <div class="sign signbox">
                                    <div id="signImage-signature" style="width: 450px;height:160px;@if(!$applicantDetails || $applicantDetails->signature == null) display:none; @else display:block; @endif">
                                        <img src="{{$applicantDetails->signature ?? ''}}" alt="Customer Signature">
                                    </div>
                                    <canvas id="serviceNowSign" width="450" height="150" style="@if(!$applicantDetails || $applicantDetails->signature == null) display:block; @else display:none; @endif"></canvas>
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
                </div>
                <br>
                <br>
                <div class="row">
                    <div class="col-lg-5">
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div> <!-- end col -->
</div>
<br>
<br>
<br>
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
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Disclosure Barrier Service(DBS)</h4>
        </div>
    </div>
</div>
<div>
    <div class="white-bg">
       <div class="row">
           <div class="col-4">
               <img src="https://job.ndhcare.co.uk/assets/images/NDH-care-1.png" alt="" height="45" class="advance-logo">
           </div>
           <div class="col-4">
               <h4 class="site-heading" style="font-size: 2rem"><b>NDH CARE LTD</b></h4>
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
                <form method="post" action="{{route('storeDbsCheckForm', $candidateData->id)}}" id="createCandidateForm">
                    @csrf
                    <div class="mb-3 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">Staff Name</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" value="{{$dbsData->staff_name ?? ''}}" id="example-text-input" name="staff_name">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">Certificate No</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" value="{{$dbsData->certification_number ?? ''}}" id="example-text-input" name="certification_number">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">Conviction</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" value="{{$dbsData->conviction ?? ''}}" id="example-text-input" name="conviction">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">Date of Issue</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" value="{{$dbsData->date_of_issue ?? ''}}" id="example-text-input" name="date_of_issue">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">Name</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" value="{{$dbsData->received_name ?? ''}}" id="example-text-input" name="received_name">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">Date</label>
                        <div class="col-md-5">
                            <input class="form-control" type="date" value="{{$dbsData->received_date ?? ''}}" id="example-text-input" name="received_date">
                        </div>
                    </div>
                    <div class="row">
                        <!--<div class="col-10"><div class="text">Signature: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="btn btn-secondary waves-effect waves-light" id="clear2">Clear</span><br><br></div>
                            <div class="sign signbox">
                                <div id="signImage-signature" style="width: 450px;height:160px;@if(!$dbsData || $dbsData->received_signature == null) display:none; @else display:block; @endif">
                                    <img src="{{$dbsData->received_signature ?? ''}}" alt="Customer Signature">
                                </div>
                                <canvas id="serviceNowSign" width="450" height="150" style="@if(!$dbsData || $dbsData->received_signature == null) display:block; @else display:none; @endif"></canvas>
                                <textarea id="signature" name="received_signature" style="display: none"></textarea>
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
                </form>
            </div>
        </div>
    </div> <!-- end col -->
</div>
@endsection