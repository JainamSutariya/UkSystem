@extends('layouts.master')

@section('title') Live Interview Note @endsection

@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ URL::asset('/assets/libs/datepicker/datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('/css/jquery.datetimepicker.css') }}">
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1') Tables @endslot
        @slot('title') Live Interview Note @endslot
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
                                <th>Country</th>
                                <th>DOB</th>
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
    <div class="modal fade" id="candidateLiveInterviewNote" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="candidateLiveInterviewNoteLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="candidateLiveInterviewNoteLabel">Live Interview Note</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="" id="liveInterviewNote" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="candidate_id" id="live_candidate_id" value="">
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Select Date:</label>
                            <input type="text" class="form-control" name="status_date" id="status_date" placeholder="yyyy-mm-dd" data-date-autoclose="true" autocomplete="off" required>
                        </div>
                        <div class="mb-3">
                            <label for="basicpill-firstname-input">Status:</label>
                            <select class="form-control form-select" name="note_status" id="note_status">
                                <option value="Selected">Selected</option>
                                <option value="Rejected">Rejected</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Note:</label>
                            <textarea class="form-control" id="status_note" name="status_note" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">File Upload:</label>
                            <input type="file" class="form-control" id="pdf_upload" name="pdf_upload">
                        </div>
                        <div class="mb-3" id="fileLink" style="display: none;">
                            <a href="" target="_blank"></a>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary saveLiveInterviewNote">Submit</button>
                </div>
            </div>
        </div>
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
    <script src="{{ URL::asset('/js/jquery.datetimepicker.full.js') }}"></script>
    <script>
        var table = $('.yajra-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('getLiveScheduleNote') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'first_name', name: 'first_name'},
                {data: 'last_name', name: 'last_name'},
                {data: 'email', name: 'email'},
                {data: 'mobile_number', name: 'mobile_number'},
                {data: 'country', name: 'country'},
                {data: 'dob', name: 'dob'},
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
            $(document).on('click', '.candidateLiveInterviewNote', function() {
                var id = $(this).attr('id');
                // Open modal here
                $('#candidateLiveInterviewNote').modal('show');
                $("#liveInterviewNote").attr("action", "{{route('candidateLiveInterviewNote')}}");
                $('#live_candidate_id').val(id);
                $.ajax({
                  type:'POST',
                  url:"{{route('liveInterviewNoteData')}}",
                  data:{
                    '_token': '<?php echo csrf_token() ?>',
                    'candidate_id':  id,
                  },
                  success:function(data) {
                    $('#status_date').val(data.date);
                    if (data.status) {
                        $('#note_status').val(data.status);
                    }
                    $('#status_note').val(data.status_note);
                    if (data.pdf_upload) {
                        $('#fileLink').show();
                        var fileName = data.pdf_upload.split('/').pop();
                        $('#fileLink a').attr('href', data.pdf_upload);
                        $('#fileLink a').text(fileName);
                    }
                  }
                });
            });
            $(document).on('click', '.saveLiveInterviewNote', function() {
                if ($('#liveInterviewNote').validate()) {
                    $('#liveInterviewNote').submit();
                }
            });
            $('#candidateLiveInterviewNote').on('hidden.bs.modal', function (e) {
                $('#liveInterviewNote')[0].reset();
                $('#fileLink').hide();
            });
            $('#status_date').datetimepicker({
                format: 'Y-m-d h:i A',
                validateOnBlur: false,
                scrollInput: false,
            });
        });
    </script>
@endsection
