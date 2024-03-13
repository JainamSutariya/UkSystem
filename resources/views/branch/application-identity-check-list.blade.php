<style>
        .APPLICATION table{
            width: 100%;
        }
        .APPLICATION table th{
            padding: 10px;
            border: 1px solid #000;
        }
        .APPLICATION table td{
            padding: 10px;
            border: 1px solid #000;
        }
        .input-bottom input{
            border-bottom: 1px solid #000;
            border-left: 0;
            border-right: 0;
            border-top: 0;
            width: 70%;
        }
        h5.text-center {
            font-size: 18px;
            font-weight: 800;
        }
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

@extends('layouts.master')

@section('title') Application Identity Check List @endsection

@section('content')

@component('components.breadcrumb')
@slot('li_1') Forms @endslot
@slot('title') Application Identity Check List @endslot
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
                    <div class="col-lg-2"><button type="submit" class="btn btn-primary w-md saveCustomer">Submit</button></div>
                        <div class="col-lg-5"></div>
                    </div>
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