@extends('layouts.master')

@section('title') Training Complete @endsection

@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ URL::asset('/assets/libs/datepicker/datepicker.min.css') }}">
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1') Tables @endslot
        @slot('title') Training Complete @endslot
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
                                <th>Profile</th>
                                <th>Number of Shadowing</th>
                                <th>Shadowing Access</th>
                                <th>Show Form</th>
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
            ajax: "{{ route('getTrainingCompleteList') }}",
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
                    data: 'profile',
                    name: 'profile',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'how_many_form',
                    name: 'how_many_form',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'interview_complete_access',
                    name: 'interview_complete_access',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'show_candidate_form',
                    name: 'show_candidate_form',
                    orderable: true,
                    searchable: true
                },
            ]
        });
        $(document).on('input', '[name="how_many_form"]', function() {
            var candidateId = $(this).data('id');
            var howManyFormValue = $(this).val();
            $.ajax({
                url: "{{ route('storeHowManyForm') }}",
                method: 'POST',
                data: {
                    candidateId: candidateId,
                    howManyFormValue: howManyFormValue,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    // $('.yajra-datatable').DataTable().ajax.reload();
                    console.log(response);
                },
                error: function(error) {
                    console.error(error);
                }
            });
        });
        function tainingCompleteAccess(id, access) {
            var con=confirm("Are you sure you want to give shadowing form access?");
            if(con){
                $.ajax({
                    type:'post',
                    url:'set-care-staff-access/' + id,
                    data: {
                        "access": access,
                        "_token": "{{ csrf_token() }}",
                    },
                    success:function(data) {
                        $('.yajra-datatable').DataTable().ajax.reload();
                    },
                    error: function (msg) {
                      console.log(msg);
                    }
                });
            }
        }
    </script>
@endsection
