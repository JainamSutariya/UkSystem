@extends('layouts.master')

@section('title') Disclosure Barrier Service(DBS) @endsection

@section('content')

@component('components.breadcrumb')
@slot('li_1') Forms @endslot
@slot('title') Disclosure Barrier Service(DBS) @endslot
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