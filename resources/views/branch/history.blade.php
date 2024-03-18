@extends('layouts.master')

@section('title') Candidate History @endsection

@section('content')

@component('components.breadcrumb')
@slot('li_1') Forms @endslot
@slot('title') Candidate History @endslot
@endcomponent
<style>
   .row.first-div, .row.sec-div {
      text-align: center;
   }
   /*.row.main-div {*/
   /*   margin: 50px 150px 50px 150px;*/
   /*   background: #F8F7FC;*/
   /*   border-radius: 10px;*/
   /*   padding: 20px 100px 20px 100px;*/
   /*}*/
   .row.sec-div {
      border-radius: 28px;
      background: white;
      margin-top: 30px;
      padding: 10px 5px 10px 5px;
   }
   button.btn-his {
      background: #252D44;
      color: white;
      font-family: Times new Roman;
      font-weight: 700;
      font-size: 25px;
      border-radius: 8px;
      letter-spacing: 1px;
      text-transform: uppercase;
      padding: 5px 30px 5px 30px;
   }
   button.fist-btn {
      background: #11BA0D;
      border: transparent;
      padding: 0px 10px 0px 10px;
      color: white;
      width: 70px;
      height: 40px;
   }
   h5.firt-btn-text {
      font-size: 18px;
      font-family: Poppins;
      font-weight: 600;
      text-align: center;
      background: #11ba0d;
      color: white;
      border-radius: 5px;
      width: 100px;
   }
   h4.head-contain {
      font-family: Times New Roman;
      font-weight: 700;
      font-size: 19px;
      color: #252D44;
      text-align: center;
      position: relative;
      top: -30px;
   }
   h4.sec-head-contain
   {
      font-family: Times New Roman;
      font-weight: 700;
      font-size: 19px;
      color: #7D7A7A;
      text-align: center;
      position: relative;
      top: -30px;
   }
   h5.firt-btn-text:after{
      content: '';
      position: absolute;
      height: 47px;;
      width: 2.5px;
      background: #11ba0d;
      /*left: 0;*/
      /*right: 986px;*/
      /*margin: auto;*/
      top: 18px;
      margin-left: -20px !important;
   }
   h5.firt-btn-text2:after {
      content: '';
      position: absolute;
      height: 47px;
      width: 2.5px;
      background: #7d7a7a;
      /*left: 0;*/
      /*right: 986px;*/
      /*margin: auto;*/
      margin-left: -20px !important;
      top: 18px;
   }
   h5.firt-btn-text2, h5.firt-btn-text1 {
      font-size: 18px;
      font-family: Poppins;
      font-weight: 600;
      text-align: center;
      background: #7D7A7A;
      color: white;
      border-radius: 5px;
      width: 100px;
   }
   .approve-btn {
      display: inline-block;
      background: #7d7a7a;
      font-size: 15px;
      font-family: Poppins;
      font-weight: 600;
      text-align: center;
      background: #7D7A7A;
      color: white;
      border-radius: 5px;
      padding: 3px;
   }
   h5.done {
        font-size: 18px;
        font-family: Poppins;
        font-weight: 600;
        text-align: center;
        background: #11ba0d;
        color: white;
        border-radius: 5px;
        width: 100px;
   }
   h4.sec-head-contain.appor-text-btn {
      /* display: inline; */
      /* position: relative; */
      /* right: 111px; */
   }
   .col-md-10 {
      text-align: left;
   }
   .text-head{
    margin-right: 60px;
   }
   .view-1{
    margin-right: 18px;
   }
   .view-2{
    margin-right: 30px;
   }
   .view-3{
    margin-right: 3px;
   }
   .view-4{
    margin-right: -9px;
   }
   .view-5{
    margin-right: 26px;
   }
   .view-6{
    margin-right: 42px;
   }
   .view-7{
    margin-right: 52px;
   }
   .view-8{
    margin-right: 55px;
   }
   .view-9{
    margin-right: 30px;
   }
   @media only screen and (max-width: 600px)
   {
       .col-md-12.single-div {
            margin-bottom: -20px;
        }
       h5.firt-btn-text {
        font-size: 15px;
        font-family: Poppins;
        font-weight: 600;
        text-align: center;
        background: #11ba0d;
        color: white;
        border-radius: 5px;
        width: 60px;
        }
    h4.head-contain {
        font-family: Times New Roman;
        font-weight: 700;
        font-size: 15px;
        color: #252D44;
        text-align: left;
        position: relative;
        top: -30px;
        margin-left: 70px;
        margin-right: 0px;
    }
    h4.sec-head-contain
       {
          font-family: Times New Roman;
          font-weight: 700;
          font-size: 15px;
          color: #7D7A7A;
          text-align: left;
          position: relative;
          top: -30px;
          margin-left: 70px;
          margin-right: 0px;
       }
    h5.firt-btn-text2:after {
          content: '';
          position: absolute;
          height: 40px;
          width: 2.5px;
          background: #7d7a7a;
          /*left: 0;*/
          /*right: 986px;*/
          /*margin: auto;*/
          margin-left: -20px !important;
          top: 18px;
       }
       h5.firt-btn-text:after {
            content: '';
            position: absolute;
            height: 40px;
            width: 2.5px;
            background: #11ba0d;
            /* left: 0; */
            /* right: 986px; */
            /* margin: auto; */
            top: 18px;
            margin-left: -20px !important;
        }
       h5.firt-btn-text2, h5.firt-btn-text1 {
          font-size: 15px;
          font-family: Poppins;
          font-weight: 600;
          text-align: center;
          background: #7D7A7A;
          color: white;
          border-radius: 5px;
          width: 60px;
       }
       .approve-btn {
            display: inline-block;
            font-size: 12px;
            font-family: Poppins;
            font-weight: 500;
            text-align: center;
            background: #7D7A7A;
            color: white;
            border-radius: 5px;
            padding: 2px;
            border: none;
        }
   }
</style>
<div class="row">
   <div class="col-12">
      <div class="card">
         <div class="card-body">
         <div class="row sec-div">
                <div class="col-md-12 single-div">
                    <div class="col-md-2">
                        <h5 class="firt-btn-text">view</h5>
                    </div>
                    <div class="col-md-8">
                        <h4 class="head-contain">
                           Account Created ({{ $candidate->created_at->format('M d Y')}}, {{ $candidate->created_at->format('g:i A') }})
                        </h4>
                    </div>
                </div>
                <div class="col-md-12 single-div">
                    <div class="col-md-2">
                        <h5 class="@if ($candidate == null) firt-btn-text2 @elseif ($candidate->is_submit == 'No') firt-btn-text2  @else firt-btn-text @endif">view</h5>
                    </div>
                    <div class="col-md-8">
                        <h4 class="@if ($candidate == null) sec-head-contain @elseif ($candidate->is_submit == 'No') sec-head-contain @else head-contain @endif text-head">
                            @if ($candidate == null)
                                Form submitted (Pending)
                            @elseif ($candidate->is_submit == 'No')
                                Form submitted (Pending)
                            @else
                                Form submitted ({{ $candidate->created_at->format('M d Y')}}, {{ $candidate->created_at->format('g:i A') }})
                            @endif
                        </h4>
                    </div>
                </div>
                <div class="col-md-12 single-div">
                    <div class="col-md-2">
                        <!--<h5 class="@if ($candidate == null) firt-btn-text2 @else firt-btn-text @endif">view</h5>-->
                        <h5 class="@if ($candidate->candidate_telephonic_count == 0) firt-btn-text2 @else firt-btn-text @endif">view</h5>
                    </div>
                    <div class="col-md-8">
                        <h4 class="@if ($candidate->candidate_telephonic_count == 0) sec-head-contain @else head-contain @endif view-1">
                            @if ($candidate->candidate_telephonic_count == 0)
                                Application Approved (pending)
                            @else
                                Application Approved ({{ $candidate->updated_at->format('M d Y')}}, {{ $candidate->updated_at->format('g:i A') }})
                            @endif
                        </h4>
                    </div>
                </div>
                <div class="col-md-12 single-div">
                    <div class="col-md-2">
                        <h5 class="@if ($candidate->candidate_telephonic_count == 0) firt-btn-text2 @else firt-btn-text @endif">view</h5>
                    </div>
                    <div class="col-md-8">
                        <h4 class="@if ($candidate->candidate_telephonic_count == 0) sec-head-contain @else head-contain @endif view-2">
                            @if ($candidate->candidate_telephonic_count == 0)
                                Telephonic Interview (pending)
                            @else
                                Telephonic Interview ({{ $candidate->candidateTelephonic->created_at->format('M d Y')}}, {{ $candidate->candidateTelephonic->created_at->format('g:i A') }})
                            @endif
                        </h4>
                    </div>
                </div>
                <div class="col-md-12 single-div">
                    <div class="col-md-2">
                        <h5 class="@if ($candidate->candidate_live_schedule_count == 0) firt-btn-text2 @else firt-btn-text @endif">view</h5>
                    </div>
                    <div class="col-md-8">
                        <h4 class="@if ($candidate->candidate_live_schedule_count == 0) sec-head-contain @else head-contain @endif view-3">
                        @if ($candidate->candidate_live_schedule_count == 0)
                            Live Interview Schedule (pending)
                        @else
                            Live Interview Schedule ({{ $candidate->candidateLiveSchedule->created_at->format('M d Y')}}, {{ $candidate->candidateLiveSchedule->created_at->format('g:i A') }})
                        @endif
                        </h4>
                    </div>
                </div>
                <div class="col-md-12 single-div">
                    <div class="col-md-2">
                        <h5 class="@if ($candidate?->candidateLiveSchedule?->status == null) firt-btn-text2 @else firt-btn-text @endif">view</h5>
                    </div>
                    <div class="col-md-8">
                        <h4 class="@if ($candidate?->candidateLiveSchedule?->status == null) sec-head-contain @else head-contain @endif view-4">
                        @if ($candidate?->candidateLiveSchedule?->status == null)
                            Live Interview Completed (pending)
                        @else
                            Live Interview Completed ({{ date('M d Y', strtotime($candidate->candidateLiveSchedule->status_date)) }}, {{ date('h:i A', strtotime($candidate->candidateLiveSchedule->status_date)) }})
                        @endif
                        </h4>
                    </div>
                </div>
                <div class="col-md-12 single-div">
                    <div class="col-md-2">
                    @if ($candidate?->candidateLiveSchedule?->status != null)
                    @if ($candidate?->candidateReference?->status_1 == 'Pending' && $candidate?->candidateReference?->status_2 == 'Pending')
                        <h5 class="firt-btn-text2">view</h5>
                    @else
                    <h5 class="firt-btn-text">view</h5>
                    @endif
                    @endif
                    </div>
                    <div class="col-md-8">
                        @if ($candidate?->candidateLiveSchedule?->status != null)
                        @if ($candidate?->candidateReference?->status_1 == 'Pending' && $candidate?->candidateReference?->status_2 == 'Pending')
                        <h4 class="sec-head-contain view-5">
                            Reference verification (pending)
                        @else
                        <h4 class="head-contain view-5">
                            Reference verification ({{ date('M d Y', strtotime($candidate->candidateReference->updated_at)) }}, {{ date('h:i A', strtotime($candidate->candidateReference->updated_at)) }})
                        @endif
                        @endif
                        </h4>
                    </div>
                </div>
                <div class="col-md-12 single-div">
                    <div class="col-md-2">
                        @if ($candidate?->candidateLiveSchedule?->status != null)
                        @if ($candidate?->candidateReference?->status_1 == 'Pending' && $candidate?->candidateReference?->status_2 == 'Pending')
                            <h5 class="firt-btn-text2">view</h5>
                        @else
                        <h5 class="firt-btn-text">view</h5>
                        @endif
                        @endif
                    </div>
                    <div class="col-md-10">
                        @if ($candidate?->candidateLiveSchedule?->status != null)
                        @if ($candidate?->candidateReference?->status_1 == 'Pending' && $candidate?->candidateReference?->status_2 == 'Pending')
                        <h4 class="sec-head-contain appor-text-btn view-6">
                            Reference verification status <button class="approve-btn">Approve</button><button class="approve-btn" style="background-color:red;">Reject</button>&nbsp;&nbsp;(2 Reference Pending)
                        </h4>
                        @elseif (($candidate?->candidateReference?->status_1 == 'Pending' || $candidate?->candidateReference?->status_2 == 'Pending'))
                        <h4 class="sec-head-contain appor-text-btn view-6">
                            Reference verification status <button class="approve-btn">Approve</button><button class="approve-btn" style="background-color:red;">Reject</button>&nbsp;&nbsp;(1 Reference Pending)
                        </h4>
                        @else
                        <h4 class="head-contain appor-text-btn view-6">
                            Reference verification status <button class="approve-btn" style="background-color:green;">Approve</button> <button class="approve-btn">Reject</button>
                        </h4>
                        @endif
                        @endif
                    </div>
                </div>
                <div class="col-md-12 single-div">
                    <div class="col-md-2">
                    @if ($candidate?->candidateTrainingSchedule?->note == null)
                        <h5 class="firt-btn-text2">view</h5>
                    @else
                        <h5 class="firt-btn-text">view</h5>
                    @endif
                    </div>
                    <div class="col-md-8">
                    @if ($candidate?->candidateTrainingSchedule?->note == null)
                        <h4 class="sec-head-contain view-7">
                            Training Schedule (pending)
                        </h4>
                    @else
                        <h4 class="head-contain view-7">
                            Training Schedule ({{ date('M d Y', strtotime($candidate->candidateTrainingSchedule->date)) }}, {{ date('h:i A', strtotime($candidate->candidateTrainingSchedule->created_at)) }})
                        </h4>
                    @endif
                    </div>
                </div>
                <div class="col-md-12 single-div">
                    <div class="col-md-2">
                    @if (count($candidate->candidateTrainingRunning) == 0)
                        <h5 class="firt-btn-text2">view</h5>
                    @else
                        <h5 class="firt-btn-text">view</h5>
                    @endif
                    </div>
                    <div class="col-md-8">
                    @if (count($candidate->candidateTrainingRunning) == 0)
                        <h4 class="sec-head-contain view-8">
                            Training running (pending)
                        </h4>
                    @else
                        <h4 class="head-contain view-8">
                            Training running ({{ date('M d Y', strtotime($candidate->candidateTrainingRunning['0']->created_at)) }}, {{ date('h:i A', strtotime($candidate->candidateTrainingRunning['0']->created_at)) }})
                        </h4>
                    @endif
                    </div>
                </div>
                <div class="col-md-12 single-div">
                    <div class="col-md-2">
                    @if ($candidate->is_complete == 'No')
                        <h5 class="firt-btn-text1">view</h5>
                    @else
                        <h5 class="firt-btn-text1 done">view</h5>
                    @endif
                    </div>
                    <div class="col-md-8">
                    @if ($candidate->is_complete == 'No')
                        <h4 class="sec-head-contain">
                            Training Completed (pending)
                        </h4>
                    @else
                        <h4 class="head-contain">
                            Training Completed ({{ date('M d Y', strtotime($candidate->updated_at)) }}, {{ date('h:i A', strtotime($candidate->updated_at)) }})
                        </h4>
                    @endif
                    </div>
                </div>
            </div>
         </div>
      </div>
   </div>
   <!-- end col -->
</div>
@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script src="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/datepicker/datepicker.min.js') }}"></script>
<script>
    // $(document).ready(function() {
    //     $('.saveCustomer').click(function() {
    //         if ($('#createCustomerForm').validate()) {
    //             $('#createCustomerForm').submit();
    //         }
    //     });
    // });
</script>
@endsection