@extends('layouts.master')

@section('title') Reference Varification @endsection

@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ URL::asset('/assets/libs/datepicker/datepicker.min.css') }}">
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1') Tables @endslot
        @slot('title') Reference Varification @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered dt-responsive nowrap w-100 yajra-datatable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Number</th>
                                <!--<th>Country</th>
                                <th>DOB</th>-->
                                <th>Assign Branch</th>
                                <th>Action</th>
                                <th>Profile</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
    <div class="modal fade bs-example-modal-xl" id="referencevarification" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="myExtraLargeModalLabel" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myExtraLargeModalLabel">Reference Varification</h5>
                    &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" id="sendEmailButton" type="button" class="btn btn-primary">Send Email</a>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="" id="referencevarificationCandidate" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="candidate_id" id="reference_candidate_id" value="">
                        <div class="response_json_1">
                            <div class="character_reference">
                                <div class="row first_reference">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">Character Reference 1:</label>
                                            <input type="text" class="form-control" name="json_1_name[]" id="name_1" placeholder="Enter Reference Name" autocomplete="off" style="background-color: var(--bs-gray-200);" readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">Status:</label>
                                            <select class="form-control form-select" name="json_1_status[]" id="status_1">
                                                <option value="Approved">Approved</option>
                                                <option value="Pending">Pending</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row first_reference">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">Email:</label>
                                            <input type="text" class="form-control" name="json_1_email[]" id="email_1" placeholder="Enter Email" autocomplete="off" style="background-color: var(--bs-gray-200);" readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">Character Reference Form</label><br>
                                            <a href="#" target="_blank" id="characterFormView" type="button" class="btn btn-primary">View Details</a>&nbsp;&nbsp;<a href="#" id="character_form_complete" type="button" class="btn btn-success">Completed</a>&nbsp;&nbsp;<a href="#" id="character_not_complete" type="button" class="btn btn-danger">Not Completed</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Note:</label>
                            <textarea class="form-control" id="note_1" name="note_1" placeholder="Enter Reference Note" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">File Upload:</label>
                            <input type="file" class="form-control" id="pdf_upload_1" name="pdf_upload_1">
                        </div>
                        <div class="mb-3" id="fileLink_1" style="display: none;">
                            <a href="" target="_blank"></a>
                        </div>
                        <div class="response_json_2">
                            <div class="professional_reference">
                                <div class="row second_reference">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">Professional Reference 1:</label>
                                            <input type="text" class="form-control" name="json_2_name[]" id="name_2" placeholder="Enter Reference Name" autocomplete="off" style="background-color: var(--bs-gray-200);" readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">Status:</label>
                                            <select class="form-control form-select" name="json_2_status[]" id="status_2">
                                                <option value="Approved">Approved</option>
                                                <option value="Pending">Pending</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row second_reference">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">Email:</label>
                                            <input type="text" class="form-control" name="json_2_email[]" id="email_2" placeholder="Enter Email" autocomplete="off" style="background-color: var(--bs-gray-200);" readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">Professional Reference Form</label><br>
                                            <a href="#" target="_blank" id="professionalFormView" type="button" class="btn btn-primary">View Details</a>&nbsp;&nbsp;<a href="#" id="professional_form_complete" type="button" class="btn btn-success">Completed</a>&nbsp;&nbsp;<a href="#" id="professional_not_complete" type="button" class="btn btn-danger">Not Completed</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Note:</label>
                            <textarea class="form-control" id="note_2" name="note_2" placeholder="Enter Reference Note" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">File Upload:</label>
                            <input type="file" class="form-control" id="pdf_upload_2" name="pdf_upload_2">
                        </div>
                        <div class="mb-3" id="fileLink_2" style="display: none;">
                            <a href="" target="_blank"></a>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary saveReferenceList">Submit</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    <!-- Required datatable js -->
    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <!-- Datatable init js -->
    <script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/datepicker/datepicker.min.js') }}"></script>
    <script>
        var table = $('.yajra-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('getReferenceList') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'first_name', name: 'first_name'},
                {data: 'last_name', name: 'last_name'},
                {data: 'email', name: 'email'},
                {data: 'mobile_number', name: 'mobile_number'},
                // {data: 'country', name: 'country'},
                // {data: 'dob', name: 'dob'},
                {data: 'branch_name', name: 'branch_name'},
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'profile',
                    name: 'profile',
                    orderable: true,
                    searchable: true
                },
            ]
        });
        $(document).ready(function() {
            $(document).on('click', '.referencevarification', function() {
                var id = $(this).attr('id');
                // Open modal here
                $('#referencevarification').modal('show');
                $("#referencevarificationCandidate").attr("action", "{{route('candidateReferenceNote')}}");
                $('#reference_candidate_id').val(id);
                $.ajax({
                  type:'POST',
                  url:"{{route('referenceData')}}",
                  data:{
                    '_token': '<?php echo csrf_token() ?>',
                    'candidate_id':  id,
                  },
                  success:function(data) {
                    var candidateId = data.candidate_id;
                    var url = "/send-email-reference/" + candidateId;
                    $('#sendEmailButton').attr('href', url);

                    var characterURL = "/character-reference/" + candidateId + "/1";
                    $('#characterFormView').attr('href', characterURL);
                    var professionalURL = "/professional-reference/" + candidateId + "/1";
                    $('#professionalFormView').attr('href', professionalURL);

                    var referenceArray = JSON.parse(data.reference_1_json);
                    if (Array.isArray(referenceArray) && referenceArray.length == 1) {
                        referenceArray.forEach(function(reference, index) {
                            if (reference.form_complete !== undefined && reference.form_complete === 'yes') {
                                $('#character_form_complete').show();
                                $('#character_not_complete').hide();
                            } else {
                                $('#character_form_complete').hide();
                                $('#character_not_complete').show();
                            }
                        });
                    }
                    if (Array.isArray(referenceArray) && referenceArray.length > 1) {
                        referenceArray.forEach(function(reference, index) {
                            if (index == 0) {
                                if (reference.form_complete !== undefined && reference.form_complete === 'yes') {
                                    $('#character_form_complete').show();
                                    $('#character_not_complete').hide();
                                } else {
                                    $('#character_form_complete').hide();
                                    $('#character_not_complete').show();
                                }
                            }
                            if (index != 0) {
                                if (reference.email_1 != null) {
                                    var mainDiv = $('<div class="character_reference"><div>')
                                    var newRow = $('<div class="row extraCharacterData"></div>');

                                    var nameInput = $('<input type="text" class="form-control" name="json_1_name[]" placeholder="Enter Reference Name" autocomplete="off" style="background-color: var(--bs-gray-200);" readonly>');
                                    nameInput.val(reference.name_1); // Set the value from the reference object
                                    var nameColumn = $('<div class="col-lg-6"><div class="mb-3"><label for="recipient-name" class="col-form-label">Character Reference ' + (index + 1) + ':</label></div></div>');
                                    nameColumn.find('.mb-3').append(nameInput);
                                    newRow.append(nameColumn);

                                    var statusSelect = $('<select class="form-control form-select" name="json_1_status[]"></select>');
                                    var approvedOption = $('<option value="Approved">Approved</option>');
                                    var pendingOption = $('<option value="Pending">Pending</option>');
                                    statusSelect.append(approvedOption, pendingOption);
                                    var status = "Pending";
                                    if (reference.status_1) {
                                        status = reference.status_1;
                                    }
                                    statusSelect.val(status); // Set the value from the reference object
                                    var statusColumn = $('<div class="col-lg-6"><div class="mb-3"><label for="recipient-name" class="col-form-label">Status:</label></div></div>');
                                    statusColumn.find('.mb-3').append(statusSelect);
                                    newRow.append(statusColumn);
                                    mainDiv.append(newRow);

                                    var newRow1 = $('<div class="row extraCharacterData"></div>');

                                    var nameInput = $('<input type="text" class="form-control" name="json_1_email[]" id="email" placeholder="Enter Email" autocomplete="off" style="background-color: var(--bs-gray-200);" readonly="">');
                                    nameInput.val(reference.email_1);

                                    var nameColumn = $('<div class="col-lg-6"><div class="mb-3"><label for="recipient-name" class="col-form-label">Email:</label></div></div>');
                                    nameColumn.find('.mb-3').append(nameInput);
                                    newRow1.append(nameColumn);
                                    var newURL = "/character-reference/" + candidateId + "/" + (index + 1);
                                    if (reference.form_complete !== undefined && reference.form_complete === 'yes') {
                                        var anchorTag = $('<a href="'+ newURL +'" target="_blank" id="characterFormView_' + (index + 1) +'" type="button" class="btn btn-primary">View Details</a>&nbsp;&nbsp;<a href="#" type="button" class="btn btn-success">Completed</a>');
                                    } else {
                                        var anchorTag = $('<a href="'+ newURL +'" target="_blank" id="characterFormView_' + (index + 1) +'" type="button" class="btn btn-primary">View Details</a>&nbsp;&nbsp;<a href="#" type="button" class="btn btn-danger">Not Completed</a></span>');
                                    }
                                    var statusColumn = $('<div class="col-lg-6"><div class="mb-3"><label for="recipient-name" class="col-form-label">Character Reference Form</label><br>');
                                    statusColumn.find('.mb-3').append(anchorTag);
                                    newRow1.append(statusColumn);
                                    mainDiv.append(newRow1);
                                    $('.response_json_1').append(mainDiv);
                                }
                            }
                        });
                    }

                    var referenceProfessionalArray = JSON.parse(data.reference_2_json);
                    if (Array.isArray(referenceProfessionalArray) && referenceProfessionalArray.length == 1) {
                        referenceProfessionalArray.forEach(function(reference, index) {
                            if (reference.form_complete !== undefined && reference.form_complete === 'yes') {
                                $('#professional_form_complete').show();
                                $('#professional_not_complete').hide();
                            } else {
                                $('#professional_form_complete').hide();
                                $('#professional_not_complete').show();
                            }
                        });
                    }
                    if (Array.isArray(referenceProfessionalArray) && referenceProfessionalArray.length > 1) {
                        referenceProfessionalArray.forEach(function(reference, index) {
                            if (index == 0) {
                                if (reference.form_complete !== undefined && reference.form_complete === 'yes') {
                                    $('#professional_form_complete').show();
                                    $('#professional_not_complete').hide();
                                } else {
                                    $('#professional_form_complete').hide();
                                    $('#professional_not_complete').show();
                                }
                            }
                            if (index != 0) {
                                if (reference.email_2 != null) {
                                    var mainDiv = $('<div class="professional_reference"><div>')
                                    var newRow = $('<div class="row extraProfessionalData"></div>');

                                    var nameInput = $('<input type="text" class="form-control" name="json_2_name[]" placeholder="Enter Reference Name" autocomplete="off" style="background-color: var(--bs-gray-200);" readonly>');
                                    nameInput.val(reference.name_2); // Set the value from the reference object
                                    var nameColumn = $('<div class="col-lg-6"><div class="mb-3"><label for="recipient-name" class="col-form-label">Prodessional Reference ' + (index + 1) + ':</label></div></div>');
                                    nameColumn.find('.mb-3').append(nameInput);
                                    newRow.append(nameColumn);

                                    var statusSelect = $('<select class="form-control form-select" name="json_2_status[]"></select>');
                                    var approvedOption = $('<option value="Approved">Approved</option>');
                                    var pendingOption = $('<option value="Pending">Pending</option>');
                                    statusSelect.append(approvedOption, pendingOption);
                                    var status = "Pending";
                                    if (reference.status_2) {
                                        status = reference.status_2;
                                    }
                                    statusSelect.val(status); // Set the value from the reference object
                                    var statusColumn = $('<div class="col-lg-6"><div class="mb-3"><label for="recipient-name" class="col-form-label">Status:</label></div></div>');
                                    statusColumn.find('.mb-3').append(statusSelect);
                                    newRow.append(statusColumn);
                                    mainDiv.append(newRow);

                                    var newRow1 = $('<div class="row extraProfessionalData"></div>');

                                    var nameInput = $('<input type="text" class="form-control" name="json_2_email[]" id="email_1" placeholder="Enter Email" autocomplete="off" style="background-color: var(--bs-gray-200);" readonly="">');
                                    nameInput.val(reference.email_2);
                                    var nameColumn = $('<div class="col-lg-6"><div class="mb-3"><label for="recipient-name" class="col-form-label">Email:</label></div></div>');
                                    nameColumn.find('.mb-3').append(nameInput);
                                    newRow1.append(nameColumn);
                                    var newURL = "/professional-reference/" + candidateId + "/" + (index + 1);

                                    if (reference.form_complete !== undefined && reference.form_complete === 'yes') {
                                        var anchorTag = $('<a href="' + newURL + '" target="_blank" id="characterFormView_' + (index + 1) + '" type="button" class="btn btn-primary">View Details</a>&nbsp;&nbsp;<a href="#" type="button" class="btn btn-success">Completed</a>');
                                    } else {
                                        var anchorTag = $('<a href="' + newURL + '" target="_blank" id="characterFormView_' + (index + 1) + '" type="button" class="btn btn-primary">View Details</a>&nbsp;&nbsp;<a href="#" type="button" class="btn btn-danger">Not Completed</a>');
                                    }
                                    var statusColumn = $('<div class="col-lg-6"><div class="mb-3"><label for="recipient-name" class="col-form-label">Character Reference Form</label><br>');
                                    statusColumn.find('.mb-3').append(anchorTag);
                                    newRow1.append(statusColumn);
                                    mainDiv.append(newRow1);
                                    $('.response_json_2').append(mainDiv);
                                }
                            }
                        });
                    }

                    $('#name_1').val(data.name_1);
                    $('#status_1').val(data.status_1);
                    $('#note_1').val(data.note_1);
                    $('#email_1').val(data.email_1);
                    // if (data.email_1 == null) {
                    //     $('.first_reference').hide();
                    // }

                    $('#name_2').val(data.name_2);
                    $('#status_2').val(data.status_2);
                    $('#note_2').val(data.note_2);
                    $('#email_2').val(data.email_2);
                    // if (data.email_2 == null) {
                    //     $('.second_reference').hide();
                    // }
                    if (data.pdf_upload_1) {
                        $('#fileLink_1').show();
                        var fileName = data.pdf_upload_1.split('/').pop();
                        $('#fileLink_1 a').attr('href', data.pdf_upload_1);
                        $('#fileLink_1 a').text(fileName);
                    }
                    if (data.pdf_upload_2) {
                        $('#fileLink_2').show();
                        var fileName = data.pdf_upload_2.split('/').pop();
                        $('#fileLink_2 a').attr('href', data.pdf_upload_2);
                        $('#fileLink_2 a').text(fileName);
                    }
                  }
                });
            });
            $('#referencevarification').on('hidden.bs.modal', function (e) {
                $('#referencevarificationCandidate')[0].reset();
                $('#fileLink_1').hide();
                $('#fileLink_2').hide();
                $('.extraProfessionalData').remove();
                $('.extraCharacterData').remove();
            });
            $(document).on('click', '.saveReferenceList', function() {
                if ($('#referencevarificationCandidate').validate()) {
                    $('#referencevarificationCandidate').submit();
                }
            });
        });
    </script>
@endsection
