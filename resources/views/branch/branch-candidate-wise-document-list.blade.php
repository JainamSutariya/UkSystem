@extends('layouts.master')

@section('title') Document List @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Document @endslot
        @slot('title') Candidate Document List @endslot
    @endcomponent
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-12"></h4>
                    <h5 class="text-truncate font-size-14 m-0">
                        <a class="btn btn-primary waves-effect waves-light" href="{{ route('candidates.download', ['id' => $id]) }}">Download</a>
                    </h5>
                    <div class="table-responsive">
                        <form method="POST" action="{{ route('submitForm') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="candidate_id" value="{{$id}}">
                            <table class="table table-nowrap align-middle mb-0">
                                <tbody>
                                    <tr>
                                        <td>
                                            <h5 class="text-truncate font-size-14 m-0"><a href="{{ route('candidate.show', ['candidate' => $id]) }}" class="text-dark">01. JOB APPLICATION FORM</a></h5>
                                        </td>
                                        <td>
                                            <h5 class="text-truncate font-size-14 m-0"></h5>
                                        </td>
                                        <td>
                                            <div class="text-center">
                                                <a class="btn btn-primary waves-effect waves-light" href="{{ route('candidate.show', ['candidate' => $id]) }}" target="_blank">View</a>
                                            </div>
                                        </td>
                                        @if ($candidateData->emailData && $candidateData->emailData->email_job_application)
                                        <td>
                                            <div class="text-center">
                                            <a class="btn btn-success" target="_blank" href="{{$candidateData->emailData->email_job_application ?? ''}}">View Email File</a>
                                            </div>
                                        </td>
                                        @else
                                        <td>
                                            <div class="text-center">
                                                <input type="file" class="form-control" id="email_job_application" name="email_job_application">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-center">
                                                <input type="submit" value="Email File Upload" class="btn btn-success">
                                            </div>
                                        </td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5 class="text-truncate font-size-14 m-0"><a href="{{ route('interviewScreening', ['id' => $id]) }}" class="text-dark">02. TELEPHONIC INTERVIEW</a></h5>
                                        </td>
                                        <td>
                                            <h5 class="text-truncate font-size-14 m-0"></h5>
                                        </td>
                                        <td>
                                            <div class="text-center">
                                                <a class="btn btn-primary waves-effect waves-light" href="{{ route('interviewScreening', ['id' => $id]) }}" target="_blank">View</a>
                                            </div>
                                        </td>
                                        @if ($candidateData->emailData && $candidateData->emailData->email_interview_screening)
                                        <td>
                                            <div class="text-center">
                                            <a class="btn btn-success" target="_blank" href="{{$candidateData->emailData->email_interview_screening ?? ''}}">View Email File</a>
                                            </div>
                                        </td>
                                        @else
                                        <td>
                                            <div class="text-center">
                                                <input type="file" class="form-control" id="email_interview_screening" name="email_interview_screening">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-center">
                                                <input type="submit" value="Email File Upload" class="btn btn-success">
                                            </div>
                                        </td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5 class="text-truncate font-size-14 m-0"><a href="{{ route('liveInterviewQuestion', ['id' => $id]) }}" class="text-dark">03. INTERVIEW</a></h5>
                                        </td>
                                        <td>
                                            <h5 class="text-truncate font-size-14 m-0"></h5>
                                        </td>
                                        <td>
                                            <div class="text-center">
                                                <a class="btn btn-primary waves-effect waves-light" href="{{ route('liveInterviewQuestion', ['id' => $id]) }}" target="_blank">View</a>
                                            </div>
                                        </td>
                                        @if ($candidateData->emailData && $candidateData->emailData->email_basic_english_test)
                                        <td>
                                            <div class="text-center">
                                            <a class="btn btn-success" target="_blank" href="{{$candidateData->emailData->email_basic_english_test ?? ''}}">View Email File</a>
                                            </div>
                                        </td>
                                        @else
                                        <td>
                                            <div class="text-center">
                                                <input type="file" class="form-control" id="email_basic_english_test" name="email_basic_english_test">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-center">
                                                <input type="submit" value="Email File Upload" class="btn btn-success">
                                            </div>
                                        </td>
                                        @endif
                                    </tr>

                                    <tr>
                                        <td>
                                            <h5 class="text-truncate font-size-14 m-0"><a href="#" class="text-dark">SECOND INTERVIEW</a></h5>
                                        </td>
                                        <td>
                                            <h5 class="text-truncate font-size-14 m-0">
                                                @if ($candidateData->secondInterviewData && $candidateData->secondInterviewData->file_path)
                                                    <a class="btn btn-success" target="_blank" href="{{$candidateData->secondInterviewData->file_path ?? ''}}">View File</a>
                                                @else
                                                    <a class="btn btn-success" href="#">File Not Found</a>
                                                @endif
                                            </h5>
                                        </td>
                                        <td>
                                            <div class="text-center">
                                                <!--<a class="btn btn-primary waves-effect waves-light" href="#">View</a>-->
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-center">
                                                <!--<input type="file" class="form-control" id="training_complete" name="email_right_work">-->
                                            </div>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td>
                                            <h5 class="text-truncate font-size-14 m-0"><a href="{{ route('basicEnglishTest', ['id' => $id]) }}" class="text-dark">ENGLISH & MATHS ASSESSMENT</a></h5>
                                        </td>
                                        <td>
                                            <h5 class="text-truncate font-size-14 m-0"></h5>
                                        </td>
                                        <td>
                                            <div class="text-center">
                                                <a class="btn btn-primary waves-effect waves-light" href="{{ route('basicEnglishTest', ['id' => $id]) }}" target="_blank">View</a>
                                            </div>
                                        </td>
                                        @if ($candidateData->emailData && $candidateData->emailData->email_interview_note)
                                        <td>
                                            <div class="text-center">
                                            <a class="btn btn-success" target="_blank" href="{{$candidateData->emailData->email_interview_note ?? ''}}">View Email File</a>
                                            </div>
                                        </td>
                                        @else
                                        <td>
                                            <div class="text-center">
                                                <input type="file" class="form-control" id="email_interview_note" name="email_interview_note">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-center">
                                                <input type="submit" value="Email File Upload" class="btn btn-success">
                                            </div>
                                        </td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5 class="text-truncate font-size-14 m-0"><a href="{{ route('aplicationIdentity', ['id' => $id]) }}" class="text-dark">04. APPLICANT IDENTITY CHECK</a></h5>
                                        </td>
                                        <td>
                                            <h5 class="text-truncate font-size-14 m-0"></h5>
                                        </td>
                                        <td>
                                            <div class="text-center">
                                                <a class="btn btn-primary waves-effect waves-light" href="{{ route('aplicationIdentity', ['id' => $id]) }}" target="_blank">View</a>
                                            </div>
                                        </td>
                                        @if ($candidateData->emailData && $candidateData->emailData->email_application_identity)
                                        <td>
                                            <div class="text-center">
                                            <a class="btn btn-success" target="_blank" href="{{$candidateData->emailData->email_application_identity ?? ''}}">View Email File</a>
                                            </div>
                                        </td>
                                        @else
                                        <td>
                                            <div class="text-center">
                                                <input type="file" class="form-control" id="email_application_identity" name="email_application_identity">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-center">
                                                <input type="submit" value="Email File Upload" class="btn btn-success">
                                            </div>
                                        </td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5 class="text-truncate font-size-14 m-0"><a href="#" class="text-dark">05. RIGHT TO WORK</a></h5>
                                        </td>
                                        <td>
                                            <h5 class="text-truncate font-size-14 m-0">
                                                @if ($candidateData->rightToWorkData && $candidateData->rightToWorkData->file_path)
                                                    <a class="btn btn-success" target="_blank" href="{{$candidateData->rightToWorkData->file_path ?? ''}}">View File</a>
                                                @else
                                                    <a class="btn btn-success" href="#">File Not Found</a>
                                                @endif
                                            </h5>
                                        </td>
                                        <td>
                                            <div class="text-center">
                                                <!--<a class="btn btn-primary waves-effect waves-light" href="#">View</a>-->
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-center">
                                                <!--<input type="file" class="form-control" id="training_complete" name="email_right_work">-->
                                            </div>
                                        </td>
                                    </tr>

                                    
                                    <tr>
                                        <td>
                                            <h5 class="text-truncate font-size-14 m-0"><a href="#" class="text-dark">06. CONDITIONAL OFFER LETTER</a></h5>
                                        </td>
                                        <td>
                                            <h5 class="text-truncate font-size-14 m-0">
                                                @if ($candidateData->conditionalOfferData && $candidateData->conditionalOfferData->file_path)
                                                    <a class="btn btn-success" target="_blank" href="{{$candidateData->conditionalOfferData->file_path ?? ''}}">View File</a>
                                                @else
                                                    <a class="btn btn-success" href="#">File Not Found</a>
                                                @endif
                                            </h5>
                                        </td>
                                        <td>
                                            <div class="text-center">
                                                <!--<a class="btn btn-primary waves-effect waves-light" href="#">View</a>-->
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-center">
                                                <!--<input type="file" class="form-control" id="training_complete" name="email_conditional_offer">-->
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5 class="text-truncate font-size-14 m-0"><a href="{{ route('dbsCheck', ['id' => $id]) }}" class="text-dark">07. DBS CONFIRMATION LETTER</a></h5>
                                        </td>
                                        <td>
                                            <h5 class="text-truncate font-size-14 m-0"></h5>
                                        </td>
                                        <td>
                                            <div class="text-center">
                                                <a class="btn btn-primary waves-effect waves-light" href="{{ route('dbsCheckForm', ['id' => $id]) }}" target="_blank">View</a>
                                            </div>
                                        </td>
                                        @if ($candidateData->emailData && $candidateData->emailData->email_dbs_check)
                                        <td>
                                            <div class="text-center">
                                            <a class="btn btn-success" target="_blank" href="{{$candidateData->emailData->email_dbs_check ?? ''}}">View Email File</a>
                                            </div>
                                        </td>
                                        @else
                                        <td>
                                            <div class="text-center">
                                                <input type="file" class="form-control" id="email_dbs_check" name="email_dbs_check">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-center">
                                                <input type="submit" value="Email File Upload" class="btn btn-success">
                                            </div>
                                        </td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5 class="text-truncate font-size-14 m-0"><a href="#" class="text-dark">08. REFERENCE</a></h5>
                                        </td>
                                        <td>
                                            <h5 class="text-truncate font-size-14 m-0"></h5>
                                        </td>
                                        <td>
                                            <div class="text-center">
                                                <a class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#referencevarification" href="#">Reference List</a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-center">
                                                <!--<input type="file" class="form-control" id="email_reference" name="email_reference">-->
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5 class="text-truncate font-size-14 m-0"><a href="#" class="text-dark">09. OFFER LETTER</a></h5>
                                        </td>
                                        <td>
                                            <h5 class="text-truncate font-size-14 m-0">
                                                @if ($candidateData->offerLetterData && $candidateData->offerLetterData->file_path)
                                                    <a class="btn btn-success" target="_blank" href="{{$candidateData->offerLetterData->file_path ?? ''}}">View File</a>
                                                @else
                                                    <a class="btn btn-success" href="#">File Not Found</a>
                                                @endif
                                            </h5>
                                        </td>
                                        <td>
                                            <div class="text-center">
                                                <!--<a class="btn btn-primary waves-effect waves-light" href="#">View</a>-->
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-center">
                                                <!--<input type="file" class="form-control" id="training_complete" name="email_offer_letter">-->
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5 class="text-truncate font-size-14 m-0"><a href="#" class="text-dark">10. GDPR AGREEMENT</a></h5>
                                        </td>
                                        <td>
                                            <h5 class="text-truncate font-size-14 m-0">
                                                @if ($candidateData->gdprAgreementData && $candidateData->gdprAgreementData->file_path)
                                                    <a class="btn btn-success" target="_blank" href="{{$candidateData->gdprAgreementData->file_path ?? ''}}">View File</a>
                                                @else
                                                    <a class="btn btn-success" href="#">File Not Found</a>
                                                @endif
                                            </h5>
                                        </td>
                                        <td>
                                            <div class="text-center">
                                                <!--<a class="btn btn-primary waves-effect waves-light" href="#">View</a>-->
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-center">
                                                <!--<input type="file" class="form-control" id="training_complete" name="email_gdpr_agreement">-->
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5 class="text-truncate font-size-14 m-0"><a href="#" class="text-dark">11. STAFF RISK ASSESSMENT</a></h5>
                                        </td>
                                        <td>
                                            <h5 class="text-truncate font-size-14 m-0"></h5>
                                        </td>
                                        <td>
                                            <div class="text-center">
                                                <!--<a class="btn btn-primary waves-effect waves-light" href="#">View</a>-->
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-center"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="1">
                                            <h4 class="text-truncate font-size-14 m-0">01. RA FORM</h4>
                                        </td>
                                        <td>
                                            <h5 class="text-truncate font-size-14 m-0">
                                                @if ($candidateData->staffRiskData && $candidateData->staffRiskData->ra_form)
                                                    <a class="btn btn-success" target="_blank" href="{{$candidateData->staffRiskData->ra_form ?? ''}}">View File</a>
                                                @else
                                                    <a class="btn btn-success" href="#">File Not Found</a>
                                                @endif
                                            </h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="1">
                                            <h4 class="text-truncate font-size-14 m-0">02. BAME FORM</h4>
                                        </td>
                                        <td>
                                            <h5 class="text-truncate font-size-14 m-0">
                                                @if ($candidateData->staffRiskData && $candidateData->staffRiskData->bame_form)
                                                    <a class="btn btn-success" target="_blank" href="{{$candidateData->staffRiskData->bame_form ?? ''}}">View File</a>
                                                @else
                                                    <a class="btn btn-success" href="#">File Not Found</a>
                                                @endif
                                            </h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="1">
                                            <h4 class="text-truncate font-size-14 m-0">13. COVID VACCINATION RECORD</h4>
                                        </td>
                                        <td>
                                            <h5 class="text-truncate font-size-14 m-0">
                                                @if ($candidateData->staffRiskData && $candidateData->staffRiskData->covid_vaccination)
                                                    <a class="btn btn-success" target="_blank" href="{{$candidateData->staffRiskData->covid_vaccination ?? ''}}">View File</a>
                                                @else
                                                    <a class="btn btn-success" href="#">File Not Found</a>
                                                @endif
                                            </h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5 class="text-truncate font-size-14 m-0"><a href="#" class="text-dark">12. EMPLOYMENT CONTRACT</a></h5>
                                        </td>
                                        <td>
                                            <h5 class="text-truncate font-size-14 m-0">
                                                @if ($candidateData->empContractData && $candidateData->empContractData->file_path)
                                                    <a class="btn btn-success" target="_blank" href="{{$candidateData->empContractData->file_path ?? ''}}">View File</a>
                                                @else
                                                    <a class="btn btn-success" href="#">File Not Found</a>
                                                @endif
                                            </h5>
                                        </td>
                                        <td>
                                            <div class="text-center">
                                                <!--<a class="btn btn-primary waves-effect waves-light" href="#">View</a>-->
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-center"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5 class="text-truncate font-size-14 m-0"><a href="#" class="text-dark">13. COVID-19 STAFF CONFIRMATION STATEMENT</a></h5>
                                        </td>
                                        <td>
                                            <h5 class="text-truncate font-size-14 m-0">
                                                @if ($candidateData->covid19Data && $candidateData->covid19Data->file_path)
                                                    <a class="btn btn-success" target="_blank" href="{{$candidateData->covid19Data->file_path ?? ''}}">View File</a>
                                                @else
                                                    <a class="btn btn-success" href="#">File Not Found</a>
                                                @endif
                                            </h5>
                                        </td>
                                        <td>
                                            <div class="text-center">
                                                <!--<a class="btn btn-primary waves-effect waves-light" href="#">View</a>-->
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-center"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5 class="text-truncate font-size-14 m-0"><a href="#" class="text-dark">14. AVAILABILITY FORMS</a></h5>
                                        </td>
                                        <td>
                                            <h5 class="text-truncate font-size-14 m-0">
                                                @if ($candidateData->availabilityFormData && $candidateData->availabilityFormData->file_path)
                                                    <a class="btn btn-success" target="_blank" href="{{$candidateData->availabilityFormData->file_path ?? ''}}">View File</a>
                                                @else
                                                    <a class="btn btn-success" href="#">File Not Found</a>
                                                @endif
                                            </h5>
                                        </td>
                                        <td>
                                            <div class="text-center">
                                                <!--<a class="btn btn-primary waves-effect waves-light" href="#">View</a>-->
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-center"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5 class="text-truncate font-size-14 m-0"><a href="{{ route('careStaffObservation', ['formNumber' => 1, 'id' => $id]) }}" class="text-dark">TRAINING COMPLETE</a></h5>
                                        </td>
                                        <td>
                                            <h5 class="text-truncate font-size-14 m-0"></h5>
                                        </td>
                                        <td>
                                            <div class="text-center">
                                                <a class="btn btn-primary waves-effect waves-light" href="{{ route('careStaffObservation', ['formNumber' => 1, 'id' => $id]) }}" target="_blank">View</a>
                                            </div>
                                        </td>
                                        @if ($candidateData->emailData && $candidateData->emailData->training_complete)
                                        <td>
                                            <div class="text-center">
                                            <a class="btn btn-success" target="_blank" href="{{$candidateData->emailData->training_complete ?? ''}}">View Email File</a>
                                            </div>
                                        </td>
                                        @else
                                        <td>
                                            <div class="text-center">
                                                <input type="file" class="form-control" id="training_complete" name="training_complete">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-center">
                                                <input type="submit" value="Email File Upload" class="btn btn-success">
                                            </div>
                                        </td>
                                        @endif
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
    <div class="modal fade bs-example-modal-xl" id="referencevarification" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="myExtraLargeModalLabel" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myExtraLargeModalLabel">Reference Varification</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="" id="referencevarificationCandidate" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="candidate_id" id="reference_candidate_id" value="">
                        @foreach ($data->reference_1_json as $key => $val)
                        @if ($val['email_1'] != null)
                        <div class="response_json_1">
                            <div class="character_reference">
                                <div class="row first_reference">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">Character Reference {{$key + 1}}:</label>
                                            <input type="text" class="form-control" name="json_1_name[]" id="name_1" placeholder="Enter Reference Name" autocomplete="off" value="{{ $val['name_1'] }}" style="background-color: var(--bs-gray-200);" readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">Status:</label>
                                            <select class="form-control form-select" name="json_1_status[]" id="status_1" disabled>
                                                <option value="Approved" @if(is_array($val) && array_key_exists('status_1', $val) && $val['status_1'] == 'Approved') selected @endif>Approved</option>
                                                <option value="Pending" @if(is_array($val) && array_key_exists('status_1', $val) && $val['status_1'] == 'Pending') selected @endif>Pending</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row first_reference">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">Email:</label>
                                            <input type="text" class="form-control" name="json_1_email[]" id="email_1" placeholder="Enter Email" autocomplete="off" value="{{ $val['email_1'] }}" style="background-color: var(--bs-gray-200);" readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">Character Reference Form</label><br>
                                            <a href="/character-reference/{{$data->candidate_id}}/{{$key+1}}" target="_blank" id="characterFormView" type="button" class="btn btn-primary">View Details</a>&nbsp;&nbsp;
                                            @if (is_array($val) && array_key_exists('form_complete', $val) && $val['form_complete'] == 'yes')
                                                <a href="#" id="character_form_complete" type="button" class="btn btn-success">Completed</a>&nbsp;&nbsp;
                                            @else
                                                <a href="#" id="character_not_complete" type="button" class="btn btn-danger">Not Completed</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Note:</label>
                            <textarea class="form-control" id="note_1" name="note_1" placeholder="Enter Reference Note" required>{{$data->note_1 ?? ''}}</textarea>
                        </div>
                        @php
                            $filename = basename($data->pdf_upload_1);
                        @endphp
                        <div class="mb-3" id="fileLink_1" style="">
                            <a href="{{$data->pdf_upload_1}}" target="_blank">{{$filename ?? ''}}</a>
                        </div>
                        @foreach ($data->reference_2_json as $key => $val)
                        @if ($val['email_2'] != null)
                        <div class="response_json_2">
                            <div class="professional_reference">
                                <div class="row second_reference">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">Professional Reference {{$key + 1}}:</label>
                                            <input type="text" class="form-control" name="json_2_name[]" id="name_2" placeholder="Enter Reference Name" value="{{$val['name_2']}}" autocomplete="off" style="background-color: var(--bs-gray-200);" readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">Status:</label>
                                            <select class="form-control form-select" name="json_2_status[]" id="status_2" disabled>
                                                <option value="Approved" @if(is_array($val) && array_key_exists('status_2', $val) && $val['status_2'] == 'Approved') selected @endif>Approved</option>
                                                <option value="Pending" @if(is_array($val) && array_key_exists('status_2', $val) && $val['status_2'] == 'Pending') selected @endif>Pending</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row second_reference">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">Email:</label>
                                            <input type="text" class="form-control" name="json_2_email[]" id="email_2" placeholder="Enter Email" autocomplete="off" value="{{$val['email_2']}}" style="background-color: var(--bs-gray-200);" readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">Professional Reference Form</label><br>
                                            <a href="/professional-reference/{{$data->candidate_id}}/{{$key+1}}" target="_blank" id="professionalFormView" type="button" class="btn btn-primary">View Details</a>&nbsp;&nbsp;
                                            @if (is_array($val) && array_key_exists('form_complete', $val) && $val['form_complete'] == 'yes')
                                                <a href="#" id="professional_form_complete" type="button" class="btn btn-success">Completed</a>&nbsp;&nbsp;
                                            @else
                                                <a href="#" id="professional_not_complete" type="button" class="btn btn-danger">Not Completed</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Note:</label>
                            <textarea class="form-control" id="note_2" name="note_2" placeholder="Enter Reference Note" required>{{$data->note_2 ?? ''}}</textarea>
                        </div>
                        @php
                            $filename2 = basename($data->pdf_upload_2);
                        @endphp
                        <div class="mb-3" id="fileLink_2" style="">
                            <a href="{{$data->pdf_upload_2}}" target="_blank">{{$filename2 ?? ''}}</a>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection
@section('script')
    <!-- dashboard init -->
    <script src="{{ URL::asset('/assets/js/pages/tasklist.init.js') }}"></script>
@endsection
