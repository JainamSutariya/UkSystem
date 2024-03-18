@extends('layouts.master')

@section('title') Live Interview Schedule @endsection

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
        @slot('title') Live Interview Schedule @endslot
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
                                <th>Test Access</th>
                                <th>Show Test</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
    <div class="modal fade" id="candidateLiveInterview" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="candidateLiveInterviewLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="candidateLiveInterviewLabel">Live Interview Schedule</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="" id="liveInterview">
                        @csrf
                        <input type="hidden" name="candidate_id" id="live_candidate_id" value="">
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Select Date:</label>
                            <input type="text" class="form-control" name="date" id="date" placeholder="yyyy-mm-dd" data-date-autoclose="true" autocomplete="off" required>
                        </div>
                        <!--<div class="mb-3" id="datepicker1">
                            <label for="recipient-name" class="col-form-label">Location:</label>
                            <select class="form-control form-select" name="location" id="location">
                                <option value="">Select location</option>
                            </select>
                        </div>-->
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Note:</label>
                            <textarea class="form-control" id="note" name="note" required></textarea>
                        </div>
                        <!--<div class="mb-3">-->
                        <!--    <label for="message-text" class="col-form-label">File Upload:</label>-->
                        <!--    <input type="file" class="form-control" id="pdf_upload" name="pdf_upload">-->
                        <!--</div>-->
                        <!--<div class="mb-3" id="fileLink" style="display: none;">-->
                        <!--    <a href="" target="_blank"></a>-->
                        <!--</div>-->
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary saveLiveInterview">Submit</button>
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
            ajax: "{{ route('getLiveScheduleList') }}",
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
                {
                    data: 'test_access',
                    name: 'test_access',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'show_candidate_test',
                    name: 'show_candidate_test',
                    orderable: true,
                    searchable: true
                },
            ]
        });
        $(document).ready(function() {
            $(document).on('click', '.candidateLiveInterview', function() {
                var id = $(this).attr('id');
                // Open modal here
                $('#candidateLiveInterview').modal('show');
                $("#liveInterview").attr("action", "{{route('candidateLiveInterview')}}");
                $('#live_candidate_id').val(id);
                $.ajax({
                  type:'POST',
                  url:"{{route('liveInterviewScheduleData')}}",
                  data:{
                    '_token': '<?php echo csrf_token() ?>',
                    'candidate_id':  id,
                  },
                  success:function(data) {
                    $('#date').val(data.date);
                    $('#note').val(data.note);
                    // if (data.pdf_upload) {
                    //     $('#fileLink').show();
                    //     var fileName = data.pdf_upload.split('/').pop();
                    //     $('#fileLink a').attr('href', data.pdf_upload);
                    //     $('#fileLink a').text(fileName);
                    // }
                  }
                });
            });
            $(document).on('click', '.saveLiveInterview', function() {
                if ($('#liveInterview').validate()) {
                    $('#liveInterview').submit();
                }
            });
            $('#candidateLiveInterview').on('hidden.bs.modal', function (e) {
                $('#liveInterview')[0].reset();
                $('#fileLink').hide();
            });
            $('#date').datetimepicker({
                format: 'Y-m-d h:i A',
                validateOnBlur: false,
                scrollInput: false,
            });
        });
        function testAccess(id, access) {
            var con=confirm("Are you sure you want to give basic test access?");
            if(con){
                $.ajax({
                    type:'post',
                    url:'set-basic-english-test-access/' + id,
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
