@extends('layouts.master')

@section('title') Reference Log View @endsection

@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ URL::asset('/assets/libs/datepicker/datepicker.min.css') }}">
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1') Tables @endslot
        @slot('title') Reference Log View@endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                    @php
                    $requestData = json_decode($log->request, true);
                    @endphp
                    @if (isset($requestData['body']))
                        <p>{!! $requestData['body'] !!}</p><br><br>
                    @endif
                    @if (isset($requestData['reference_name']))
                    <p><strong>Reference Name:</strong> {{ $requestData['reference_name'] }}</p>
                    @endif
                    @if (isset($requestData['reference_email']))
                    <p><strong>Reference Email:</strong> {{ $requestData['reference_email'] }}</p>
                    @endif
                    @if (isset($requestData['old_name']))
                    <p><strong>Old Name:</strong> {{ $requestData['old_name'] }}</p>
                    @endif
                    @if (isset($requestData['old_email']))
                    <p><strong>Old Email:</strong> {{ $requestData['old_email'] }}</p>
                    @endif
                    @if (isset($requestData['new_name']))
                    <p><strong>New Name:</strong> {{ $requestData['new_name'] }}</p>
                    @endif
                    @if (isset($requestData['new_email']))
                    <p><strong>New Email:</strong> {{ $requestData['new_email'] }}</p>
                    @endif
                    </div>
                </div>
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
            ajax: "{{ route('referenceLogList') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'candidate_name', name: 'candidate_name'},
                {data: 'reference_id', name: 'reference_id'},
                {data: 'reference_type', name: 'reference_type'},
                {
                    data: 'request',
                    name: 'request',
                    orderable: true,
                    searchable: true
                },
                {data: 'formatted_created_at', name: 'formatted_created_at'}
            ]
        });
    </script>
@endsection
