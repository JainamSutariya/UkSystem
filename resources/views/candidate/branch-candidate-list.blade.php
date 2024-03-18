@extends('layouts.master')

@section('title') Candidate List @endsection

@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ URL::asset('/assets/libs/datepicker/datepicker.min.css') }}">
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1') Tables @endslot
        @slot('title') Candidate List @endslot
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
                                <th>Postcode</th>
                                <th>DOB</th>
                                <th>Assign Branch</th>
                                <th>Is Read</th>
                                <th>Profile</th>
                                <th>History</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
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
            ajax: "{{ route('get_branch_candidate') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'first_name', name: 'first_name'},
                {data: 'last_name', name: 'last_name'},
                {data: 'email', name: 'email'},
                {data: 'mobile_number', name: 'mobile_number'},
                {data: 'country', name: 'country'},
                {data: 'post_code', name: 'post_code'},
                {data: 'dob', name: 'dob'},
                {data: 'branch_name', name: 'branch_name'},
                {
                    data: 'is_read',
                    name: 'is_read',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'profile',
                    name: 'profile',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'history',
                    name: 'history',
                    orderable: true,
                    searchable: true
                },
            ]
        });
        $(document).ready(function() {
            $(document).on('click', '.candidateTelephone', function() {
                var id = $(this).attr('id');
                // Open modal here
                $('#exampleModal').modal('show');
                // $('#exampleModal').modal({backdrop: 'static', keyboard: false}, 'show');
                $("#telephonicInterview").attr("action", "{{route('candidateTelePhonic')}}");
                $('#candidate_id').val(id);
            });
            $(document).on('click', '.saveTelephonicInterview', function() {
                if ($('#telephonicInterview').validate()) {
                    $('#telephonicInterview').submit();
                }
            });
            $(document).on('click', '.candidateLiveInterview', function() {
                var id = $(this).attr('id');
                // Open modal here
                $('#candidateLiveInterview').modal('show');
                $("#liveInterview").attr("action", "{{route('candidateLiveInterview')}}");
                $('#live_candidate_id').val(id);
            });
            $(document).on('click', '.saveLiveInterview', function() {
                if ($('#liveInterview').validate()) {
                    $('#liveInterview').submit();
                }
            });
        });
    </script>
@endsection
