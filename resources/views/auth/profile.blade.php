@extends('layouts.master')

@section('title') Profile @endsection

@section('content')

@component('components.breadcrumb')
@slot('li_1') Forms @endslot
@slot('title') Profile @endslot
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
</style>
@endsection
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <form method="post" action="{{route('storeUserDetails')}}" id="userProfileForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="user_id" value="{{$userData->id}}">
                    <fieldset id="step1">
                        @if ($userData->role == 'Branch' || $userData->role == 'Admin')
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Name</label>
                                    <input type="text" name="name" class="form-control" id="name" value="{{$userData->name}}" readonly>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Email</label>
                                    <input type="text" name="email" class="form-control" id="email" value="{{$userData->email}}" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Password</label>
                                    <input type="text" name="password" class="form-control" id="password" placeholder="Enter New Password">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!--<div class="col-10"><div class="text">Signature: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="btn btn-secondary waves-effect waves-light" id="clear2">Clear</span></div>
                                <div class="sign signbox">
                                    <div id="signImage-signature" style="width: 450px;height:160px;@if(!$userData || $userData->signature == null) display:none; @else display:block; @endif">
                                        <img src="{{$userData->signature ?? ''}}" alt="Customer Signature">
                                    </div>
                                    <canvas id="serviceNowSign" width="450" height="150" style="@if(!$userData || $userData->signature == null) display:block; @else display:none; @endif"></canvas>
                                    <textarea id="signature" name="signature" style="display: none"></textarea>
                                </div>
                            </div>-->
                            <div class="col-5"><div class="text">Signature:</div>
                                <input type="file" class="form-control" id="signature" name="signature">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-5" id="signImage-signature" style="width: 450px;height:160px;@if(!$userData || $userData->signature == null) display:none; @else display:block; @endif">
                                <img width="450" height="160" src="{{$userData->signature ?? ''}}" alt="Customer Signature">
                            </div>
                        </div>
                        <br>
                        @elseif ($userData->role == 'Candidate')
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Name</label>
                                    <input type="text" name="name" class="form-control" id="name" value="{{$candidateData->prefix ?? ''}} {{$candidateData->first_name ?? ''}} {{$candidateData->last_name ?? ''}}" disabled>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Email</label>
                                    <input type="text" name="email" class="form-control" id="email" value="{{$candidateData->email}}" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Mobile Number</label>
                                    <input type="text" name="mobile_number" class="form-control" id="mobile_number" value="{{$candidateData->mobile_number}}" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Street Address</label>
                                    <input type="text" name="street_address" class="form-control" id="street_address" value="{{$candidateData->street_address}}" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Country</label>
                                    <input type="text" name="country" class="form-control" id="country" value="{{$candidateData->country}}" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Password</label>
                                    <input type="text" name="password" class="form-control" id="password" placeholder="Enter New Password">
                                </div>
                            </div>
                        </div>
                        <!--<div class="row">
                            <div class="col-10"><div class="text">Signature: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="btn btn-secondary waves-effect waves-light" id="clear2">Clear</span></div>
                                <div class="sign signbox">
                                    <div id="signImage-signature" style="width: 450px;height:160px;@if(!$candidateData || $candidateData->signature == null) display:none; @else display:block; @endif">
                                        <img src="{{$candidateData->signature ?? ''}}" alt="Customer Signature">
                                    </div>
                                    <canvas id="serviceNowSign" width="450" height="150" style="@if(!$candidateData || $candidateData->signature == null) display:block; @else display:none; @endif"></canvas>
                                    <textarea id="signature" name="signature" style="display: none"></textarea>
                                </div>
                            </div>
                        </div>-->
                        @endif
                        <div class="row">
                            <div class="col-lg-5"></div>
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
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.5.3/signature_pad.min.js"></script>
<script src="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/datepicker/datepicker.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#document_type').on('change', function () {
            if ($(this).val() === 'Other') {
                $('#document_name_row').show();
            } else {
                $('#document_name_row').hide();
            }
        });
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
        $("#userProfileForm").validate({
            rules: {
                mobile_number: {
                    required: true,
                    minlength: 11,
                    maxlength: 11
                },
            },
            submitHandler: function(form) {
                var SignDataUrl = signaturePad2.isEmpty() ? null : signaturePad2.toDataURL();
                $('#signature').val(SignDataUrl);
                form.submit();
            }
        });
    });
</script>
@endsection