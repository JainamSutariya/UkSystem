
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

        /* .border-table input {
            width: 160px;
        } */

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
        
    </style>







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
@endsection
<div class="row">
    <div class="col-12 skill-Assessment">
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
                 <div class="section-1">
                    <div class="table-1">
                        <h5>Candidate Information </h5>
                        <table class=" w-100 d-block d-md-table">
                            <form>
                                <tr>
                                    <th>Candidate Name</th>
                                    <td colspan="3"><input type="text" class="form-control"/></td>
                                </tr>
                                <tr>
                                    <th>Date of Assessment</th>
                                    <td><input type="text" class="form-control"/></td>
                                    <th>Candidate Signature</th>
                                    <td><input type="text" class="form-control"/></td>
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
                                    <td><input type="text" class="form-control"/></td>
                                </tr>
                                <tr>
                                    <th>Maths Assessment Score</th>
                                    <td><input type="text" class="form-control"/></td>
                                </tr>
                                <tr>
                                    <th>Total Score out of 25 </th>
                                    <td><input type="text" class="form-control"/></td>
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
                                    <td><input type="text" class="form-control"/></td>
                                </tr>
                                <tr>
                                    <th>Assessor Name</th>
                                    <td><input type="text" class="form-control"/></td>
                                </tr>
                                <tr>
                                    <th>Assessor Signature</th>
                                    <td><input type="text" class="form-control"/></td>
                                </tr>
                            </form>
                        </table>
                    </div>
            
                    <br />
                    <div class="table-2">
                        <h5>Comments :</h5>
                        <form>
                            <td><textarea class="form-control" rows="5"></textarea></td>
            
                        </form>
                    </div>
                </div>
            
                <div class="section-2">
                    <div>
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
                                <p class="add-border"> <b>When</b> does the tea finish? <input type="text" class="form-control"/>pm.</p>
                            </div>
                        </div>
                    </div>
                    <br />
                    <div>
                        <h4> 2) Fill in the blanks with the correct spellings.</h4>
                        <div class="margin_left">
                            <div>
                                <p class="add-border"> The company set up a <input type="text" class="form-control"/>to assist the customers/clients
                                    communicating with them. <b>[help desk, kiosk, booth, room]</b></p>
                            </div>
                        </div>
                    </div>
                    <br />
                    <div>
                        <h4> 3) Fill in the alphabet letter in the correct order. </h4>
                        <div class="margin_left">
                            <div>
                                <table class=" w-100 d-block d-md-table">
                                    <form>
                                        <tr>
                                            <th class="col-set">E</th>
                                            <td class="input-2"><input type="text" class="form-control"/></td>
                                            <td class="input-2"><input type="text" class="form-control"/></td>
                                            <td class="input-2"><input type="text" class="form-control"/></td>
                                            <td class="input-2"><input type="text" class="form-control"/></td>
                                            <th class="col-set">J</th>
                                            <td class="input-2"><input type="text" class="form-control"/></td>
                                            <th class="col-set">L</th>
                                            <td class="input-2"><input type="text" class="form-control"/></td>
                                            <td class="input-2"><input type="text" class="form-control"/></td>
                                            <td class="input-2"><input type="text" class="form-control"/></td>
                                        </tr>
                                    </form>
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
                                <input type="text" class="form-control"/>
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
                                <input type="text" class="form-control"/>
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
                            <table class=" w-100 d-block d-md-table ">
                                <tr class="text-center">
                                    <td><input type="text" class="form-control"/></td>
                                    <td><input type="text" class="form-control"/></td>
                                    <td><input type="text" class="form-control"/></td>
                                    <td><input type="text" class="form-control"/></td>
                                    <td><input type="text" class="form-control"/></td>
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
                                    <input type="text" class="form-control"/>there are only 28 in February. <b>[as, and, or, so, but]</b>
                                </p>
                                <p class="add-border">
                                    7b) Sorry, our hospital car park will not be open.<br />In a    ddition, the cafe will
                                    <input type="text" class="form-control"/>closed for r epair. <b>[first, then, also, finally]</b>
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
                                            <td><input type="text" class="form-control"/></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-4">
                                    <table class=" w-100 d-block d-md-table ">
                                        <tr class="text-center">
                                            <th>Contact</th>
                                            <td><input type="text" class="form-control"/></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-4">
                                    <table class=" w-100 d-block d-md-table width">
                                        <tr class="text-center">
                                            <th>Meet</th>
                                            <td><input type="text" class="form-control"/></td>
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
                                    <table class=" w-100 d-block d-md-table ">
                                        <tr class="text-center">
                                            <th>Main Canteen</th>
                                            <td><input type="text" class="form-control"/></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table class=" w-100 d-block d-md-table ">
                                        <tr class="text-center">
                                            <th>Admissions Ward</th>
                                            <td><input type="text" class="form-control"/></td>
                                        </tr>
                                    </table>
                                </div><br /><br /><br />
                                <div class="col-md-6">
                                    <table class=" w-100 d-block d-md-table ">
                                        <tr class="text-center">
                                            <th>Main Canteen</th>
                                            <td><input type="text" class="form-control"/></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table class=" w-100 d-block d-md-table ">
                                        <tr class="text-center">
                                            <th>Admissions Ward</th>
                                            <td><input type="text" class="form-control"/></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
            
                    <br />
                    <div>
                        <h4> 10) Look at the graphs below and Fill the Gaps with the correct word to describe the visual
                            information. Make sure you read the information carefully. (Total marks is 5) </h4>
                        <div class="margin_left ">
                            <div>
                                <p><b></b>Options:</b> 1. reached a peak, 2. a marked increase, 3. more popular, 4. a significant
                                    decrease, 5. a significant rise, </p>
                            </div>
                            <div class="text-center">
                                <img src="{{asset('images/graph.jpeg')}}" />
                            </div>
                            <br />
                            <div>
                                <p class="add-border">
                                    The graph shows the quantity of margarine, low fat spreads and butter consumed between 1981 and 2007. The quantities are measured in grams. Over the period 1981 to 2007 as a whole, there was<b>1.</b> <input type="text" class="form-control"/>in the consumption of butter and margarine and a <b>2.</b> <input type="text" class="form-control"/>in the consumption of low fat-fat spreads.
                                </p>
                            </div>
                            <div>
                                <p class="add-border">
                                    Butter was the most popular fat at the beginning of the period, and consumption <b>3. </b> <input type="text" class="form-control"/>of about 160 grams in 1986. After this, there was a sharp decline.
                                </p>
                            </div>
                            <div>
                                <p>
                                    The consumption of margarine began lower than that for butter at 90 grams. Following this, in 1991, it Exceeded that of butter for the first time, but after 1996 there was a steady downward trend in the amount consumed, which seemed set to continue.
                                </p>
                            </div>
                            <div>
                                <p class="add-border">
                                    Low–fat spreads were introduced in 1996, and they saw <b>4. </b> <input type="text" class="form-control"/>in their consumption from that time, so that by about 2001 they were <b>5. </b> <input type="text" class="form-control"/>than either butter or margarine.
                                </p>
                            </div>
                            <div class="row">
                                <p>Where is the patient going? (mark )</p>
                                <div class="col-md-6">
                                    <table class=" w-100 d-block d-md-table ">
                                        <tr class="text-center">
                                            <th>Learner Total score out of 15</th>
                                            <td><input type="text" class="form-control"/></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table class=" w-100 d-block d-md-table ">
                                        <tr class="text-center">
                                            <th>Assessor sign </th>
                                            <td><input type="text" class="form-control"/></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
                <div class="section-3">
                    <div>
                        <p><b>1) If today’s date is 15th July and day is Friday, then please can you tell me which date will be next
                                Friday?</b></p>
                        <div class="row">
                            <div class="col-md-3">
                                <p>a. 22nd July</p>
                            </div>
                            <div class="col-md-3">
                                <p>b. 23rd July</p>
                            </div>
                            <div class="col-md-3">
                                <p>c. 22nd June</p>
                            </div>
                            <div class="col-md-3">
                                <p>d. 25th June</p>
                            </div>
                        </div>
                        <div>
                            <p class="add-border">
                                Answer : <input type="text" class="form-control"/>.
                            </p>
                        </div>
                    </div>
            
                    <div>
                        <p><b>2) Add 10 + 15 + 5 = ? Write the correct answer.</b></p>
                        <div class="row">
                            <div class="col-md-3">
                                <p>a. 30</p>
                            </div>
                            <div class="col-md-3">
                                <p>b. 25</p>
                            </div>
                            <div class="col-md-3">
                                <p>c. 40</p>
                            </div>
                            <div class="col-md-3">
                                <p>d. 35</p>
                            </div>
                        </div>
                        <div>
                            <p class="add-border">
                                Answer : <input type="text" class="form-control"/>.
                            </p>
                        </div>
                    </div>
            
                    <div>
                        <p><b>3) If you need to reach workplace at 11:15 am, journey duration from your home to workplace is 35 min
                                so
                                please circle below what time you should start your journey?</b></p>
                        <div class="row">
                            <div class="col-md-3">
                                <p>a. 11:00am</p>
                            </div>
                            <div class="col-md-3">
                                <p>b. 11:05am</p>
                            </div>
                            <div class="col-md-3">
                                <p>c. 10.40am</p>
                            </div>
                            <div class="col-md-3">
                                <p>d. 10.40pm</p>
                            </div>
                        </div>
                        <div>
                            <p class="add-border">
                                Answer : <input type="text" class="form-control"/>.
                            </p>
                        </div>
                    </div>
            
                    <div>
                        <p><b>4) if you have £20 and you spend £10.50, what is remaining balance?</b></p>
                        <div class="row">
                            <div class="col-md-3">
                                <p>a. £15.00</p>
                            </div>
                            <div class="col-md-3">
                                <p>b. £9.50</p>
                            </div>
                            <div class="col-md-3">
                                <p>c. £10.50</p>
                            </div>
                            <div class="col-md-3">
                                <p>d. £12.00</p>
                            </div>
                        </div>
                        <div>
                            <p class="add-border">
                                Answer : <input type="text" class="form-control"/>.
                            </p>
                        </div>
                    </div>
            
                    <div>
                        <p class="add-border"><b>
                                5) Color sequence: Black, Blue, Pink, Yellow, Black, Blue, Pink, Yellow, Black, <input
                                    type="text" class="form-control"/>,
                                <input type="text" class="form-control"/>,<input type="text" class="form-control"/>.
                            </b></p>
                    </div>
            
                    <div>
                        <p class="add-border"><b>
                                6) Convert time in 24 hours clock: 04:00pm = <input type="text" class="form-control"/>.</b>
                        </p>
                    </div>
            
                    <div>
                        <p class="add-border"><b>
                                7) The bus leaves at 10.15 am. Tick the correct clock showing this <input type="text" class="form-control"/> time.</b>
                        </p>
                        <div class="row">
                            <div class="col-md-6">
                                <p class="add-border-3 "><b>
                                    Clock 1 <input type="text" class="form-control"/></b>
                                    <img src="{{asset('images/clock_01.jpeg')}}"/> 
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p class="add-border-3 "><b>
                                    Clock 2 <input type="text" class="form-control"/></b>
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
                                <p>a. 40</p>
                            </div>
                            <div class="col-md-3">
                                <p>b. 42</p>
                            </div>
                            <div class="col-md-3">
                                <p>c. 46</p>
                            </div>
                            <div class="col-md-3">
                                <p>d. 48</p>
                            </div>
                        </div>
                        <div>
                            <p class="add-border">
                                Answer : <input type="text" class="form-control"/>.
                            </p>
                        </div>
                    </div>
            
                    <div>
                        <p><b>9) Wanda baked 168 cookies, packaged them 12 cookies in one box, and she sold each box for £1.20. What
                                was
                                the total amount of money that Wanda made for all of the boxes sold?</b></p>
                        <div class="row">
                            <div class="col-md-3">
                                <p>a. £15.20</p>
                            </div>
                            <div class="col-md-3">
                                <p>b. £14.40</p>
                            </div>
                            <div class="col-md-3">
                                <p>c. £16.80</p>
                            </div>
                            <div class="col-md-3">
                                <p>d. £16.40</p>
                            </div>
                        </div>
                        <div>
                            <p class="add-border">
                                Answer : <input type="text" class="form-control"/>.
                            </p>
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
                                <p>a. 27</p>
                            </div>
                            <div class="col-md-2">
                                <p>b. 12</p>
                            </div>
                            <div class="col-md-2">
                                <p>c. 108</p>
                            </div>
                            <div class="col-md-2">
                                <p>d. 72</p>
                            </div>
                            <div class="col-md-2">
                                <p>e. None of these</p>
                            </div>
                        </div>
                        <div>
                            <p class="add-border">
                                Answer : <input type="text" class="form-control"/>.
                            </p>
                        </div>
                        <div class="row">
                            <p>Where is the patient going? (mark )</p>
                            <div class="col-md-6">
                                <table class=" w-100 d-block d-md-table ">
                                    <tr class="text-center">
                                        <th>Learner Total score out of 10</th>
                                        <td><input type="text" class="form-control"/></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class=" w-100 d-block d-md-table ">
                                    <tr class="text-center">
                                        <th>Assessor sign </th>
                                        <td><input type="text" class="form-control"/></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
            
                    <br />
            
                    <!--<div>
                        <h3><u>
                                <center>Answer</center>
                            </u>
                        </h3>
                        <div>
                            <h4>English Test</h4>
                            <p>1. 5 PM</p>
                            <p>2. help desk</p>
                            <p>3. E, F, G, H, I, J, K, L, M, N, O, P</p>
                            <p>4. Saturday </p>
                            <p>5. Medicine or Tablets </p>
                            <p>6. Bare, Bear, Blue, Break, Build </p>
                            <p>7. But, Also</p>
                            <p>8. Communicate</p>
                            <p>9. Admissions Ward</p>
                            <p>10. 1. a significant decrease, 2. a marked increase, 3. reached a peak, 4. a significant rise, 5.
                                more popular </p>
                        </div>
                        <div>
                            <h4>Maths Test</h4>
                            <p>1. 22nd July </p>
                            <p>2. 30</p>
                            <p>3. 10.40am</p>
                            <p>4. £9.50 </p>
                            <p>5. Blue, Pink, Yellow </p>
                            <p>6. 16:00 </p>
                            <p>7. 1st clock</p>
                            <p>8. 42</p>
                            <p>9. £16.80</p>
                            <p>10. 27</p>
                        </div>
                    </div>-->
                </div>
            </div>
        </div>
    </div> <!-- end col -->
</div>
@endsection