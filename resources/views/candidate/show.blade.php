@extends('layouts.master')

@section('title') Candidate Details @endsection

@section('content')

@component('components.breadcrumb')
@slot('li_1') Forms @endslot
@slot('title') view Candidate @endslot
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
                        <option value="Part Time" @if($candidate->employment_type == 'Part Time') selected @endif>Part Time</option>
                        <option value="Full Time" @if($candidate->employment_type == 'Full Time') selected @endif>Full Time</option>
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
                <div class="col-sm-6">
                    <div class="mt-3">
                        <label for="formFile" class="form-label">Identity proof</label>
                        <input class="form-control" name="identity_proof[]" type="file" id="identityFile" accept=".pdf,.jpg,.jpeg,.png,.doc" multiple>
                    </div>
                </div>
            </div>
            <br>
            @if ($candidate->identity_proof)
            @php
                $identityProofs = json_decode($candidate->identity_proof);
            @endphp
            @if (is_array($identityProofs) && count($identityProofs) > 0)
            @foreach($identityProofs as $identityProof)
                <div class="file-item">
                    <i class="fas fa-file-pdf"></i>
                    <a href="{{ $identityProof }}" target="_blank">{{ basename($identityProof) }}</a>
                </div>
            @endforeach
            @endif
            <br>
            @endif
            <div class="row">
                <div class="col-sm-6">
                    <div class="mt-3">
                        <label for="formFile" class="form-label">Address proof</label>
                        <input class="form-control" name="address_proof[]" type="file" id="addressFile" accept=".pdf,.jpg,.jpeg,.png,.doc" multiple>
                    </div>
                </div>
            </div>
            <br>
            @if ($candidate->address_proof)
            @php
                $addressProofs = json_decode($candidate->address_proof);
            @endphp
            @if (is_array($addressProofs) && count($addressProofs) > 0)
            @foreach($addressProofs as $addressProof)
                <div class="file-item">
                    <i class="fas fa-file-pdf"></i>
                    <a href="{{ $addressProof }}" target="_blank">{{ basename($addressProof) }}</a>
                </div>
            @endforeach
            @endif
            <br>
            @endif
            
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
      <div class="row">
        <div class="col-lg-5"></div>
        <div class="col-lg-2"><button type="submit" class="btn btn-primary w-md saveCustomer">Submit</button></div>
        <div class="col-lg-5"></div>
      </div>
      <br/>
      </form>
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
    $(document).ready(function () {
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
            var addField = '<div class="row" id="remove_studying_data_'+newId+'">' +
                                '<div class="col-lg-3">' +
                                    '<div class="mb-3">' +
                                        '<label for="basicpill-firstname-input">Date of Completion (Expected Date)</label>' +
                                        '<input type="date" name="date_of_comletion[]" class="form-control" id="date_of_comletion" placeholder="Enter Date">' +
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
                                    '<button type="button" class="btn btn-danger w-md remove_education_data_no" data-id="'+ newId +'" style="margin-top: 8px;min-width:70px;">-</button>' +
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