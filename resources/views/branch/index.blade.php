@extends('layouts.master')

@section('title') Branch List @endsection

@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1') Tables @endslot
        @slot('title') Branch List @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                @if (Auth::user()->role == 'Candidate')
                <div class="card-body">
                    <a href="{{route('candidate.create')}}" class="btn btn-primary w-md" style="float:right">Add Candidate</a>
                </div>
                @endif
                <div class="card-body">
                    <table class="table table-bordered dt-responsive nowrap w-100 yajra-datatable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Number</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
@endsection
@section('script')
    <!-- Required datatable js -->
    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <!-- Datatable init js -->
    <script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>
    <script>
        var table = $('.yajra-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('getBranchList') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'first_name'},
                {data: 'email', name: 'email'},
                {data: 'mobile_number', name: 'mobile_number'},
            ]
        });
    </script>
@endsection
