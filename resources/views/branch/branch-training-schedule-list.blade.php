@extends('layouts.master')

@section('title') Training Schedule @endsection

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
        @slot('title') Training Schedule @endslot
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
    <div class="modal fade" id="candidateTrainingSchedule" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="candidateTrainingScheduleLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="candidateTrainingScheduleLabel">Training Schedule</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="" id="trainingSchedule">
                        @csrf
                        <input type="hidden" name="candidate_id" id="training_candidate_id" value="">
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Select Date:</label>
                            <input type="text" class="form-control" name="training_date" id="training_date" placeholder="yyyy-mm-dd" data-date-autoclose="true" autocomplete="off" required>
                        </div>
                        <div class="mb-3" id="datepicker1">
                            <label for="recipient-name" class="col-form-label">Start Date:</label>
                            <input type="text" class="form-control" name="start_date" id="start_date" placeholder="yyyy-mm-dd" data-date-autoclose="true" autocomplete="off" required>
                        </div>
                        <div class="mb-3" id="datepicker2">
                            <label for="recipient-name" class="col-form-label">End Date:</label>
                            <input type="text" class="form-control" name="end_date" id="end_date" placeholder="yyyy-mm-dd" data-date-autoclose="true" autocomplete="off" required>
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Note:</label>
                            <textarea class="form-control" id="training_note" name="training_note" required></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary saveTrainigSchedule">Submit</button>
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
            ajax: "{{ route('getTrainingScheduleList') }}",
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
            $(document).on('click', '.trainingSchedule', function() {
                var id = $(this).attr('id');
                // Open modal here
                $('#candidateTrainingSchedule').modal('show');
                $("#trainingSchedule").attr("action", "{{route('candidateTrainingSchedule')}}");
                $('#training_candidate_id').val(id);
                $.ajax({
                  type:'POST',
                  url:"{{route('trainingScheduleData')}}",
                  data:{
                    '_token': '<?php echo csrf_token() ?>',
                    'candidate_id':  id,
                  },
                  success:function(data) {
                    $('#training_date').val(data.date);
                    $('#training_note').val(data.note);
                    $("#start_date").val(data.start_date);
                    $("#end_date").val(data.end_date);
                  }
                });
            });
            $(document).on('click', '.saveTrainigSchedule', function() {
                if ($('#trainingSchedule').validate()) {
                    $('#trainingSchedule').submit();
                }
            });
            $('#training_date').datetimepicker({
                format: 'Y-m-d h:i A',
                validateOnBlur: false,
                scrollInput: false,
            });
            $('#start_date').datetimepicker({
                format: 'Y-m-d',
                timepicker:false,
                scrollInput: false,
            });
            $('#end_date').datetimepicker({
                format: 'Y-m-d',
                timepicker:false,
                scrollInput: false,
            });
        });
    </script>
@endsection
