@extends('layouts.master')

@section('title') English & Maths Basic Skill Assessment @endsection

@section('content')

@component('components.breadcrumb')
@slot('li_1') Forms @endslot
@slot('title') English & Maths Basic Skill Assessment @endslot
@endcomponent
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
                                <!--<div class="col-md-6">
                                    <table class=" w-100 d-block d-md-table ">
                                        <tr class="text-center">
                                            <th>Assessor sign </th>
                                            <td><input type="text" class="form-control" name="assessor_sign_english" disabled/></td>
                                        </tr>
                                    </table>
                                </div>-->
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
                        <!-- <div>
                            <p class="add-border">
                                Answer : <input type="text" class="form-control" name="second_maths_answer" value="{{$candidate->candidateBasicTest && $candidate->candidateBasicTest->second_maths_answer ? $candidate->candidateBasicTest->second_maths_answer : ''}}"/>.
                            </p>
                        </div> -->
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
                        <!-- <div>
                            <p class="add-border">
                                Answer : <input type="text" class="form-control" name="third_maths_answer" value="{{$candidate->candidateBasicTest && $candidate->candidateBasicTest->third_maths_answer ? $candidate->candidateBasicTest->third_maths_answer : ''}}"/>.
                            </p>
                        </div> -->
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
                        <!-- <div>
                            <p class="add-border">
                                Answer : <input type="text" class="form-control" name="eigth_maths_answer" value="{{$candidate->candidateBasicTest && $candidate->candidateBasicTest->eigth_maths_answer ? $candidate->candidateBasicTest->eigth_maths_answer : ''}}"/>.
                            </p>
                        </div> -->
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
                        <!-- <div>
                            <p class="add-border">
                                Answer : <input type="text" class="form-control" name="nine_maths_answer" value="{{$candidate->candidateBasicTest && $candidate->candidateBasicTest->nine_maths_answer ? $candidate->candidateBasicTest->nine_maths_answer : ''}}"/>.
                            </p>
                        </div> -->
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
                        <!-- <div>
                            <p class="add-border">
                                Answer : <input type="text" class="form-control" name="ten_maths_answer" value="{{$candidate->candidateBasicTest && $candidate->candidateBasicTest->ten_maths_answer ? $candidate->candidateBasicTest->ten_maths_answer : ''}}"/>.
                            </p>
                        </div> -->
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
                            <!--<div class="col-md-6">
                                <table class=" w-100 d-block d-md-table ">
                                    <tr class="text-center">
                                        <th>Assessor sign </th>
                                        <td><input type="text" class="form-control" name="assessor_sign_maths" disabled/></td>
                                    </tr>
                                </table>
                            </div>-->
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