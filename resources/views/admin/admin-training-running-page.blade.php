@extends('layouts.master')

@section('title') Training Running @endsection

@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    <!--<link href="{{ URL::asset('/assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css">-->
    <link rel="stylesheet" href="{{ URL::asset('/assets/libs/datepicker/datepicker.min.css') }}">
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1') Tables @endslot
        @slot('title') Training Running @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="post" action="" id="trainingrunning">
                        @csrf
                        <input type="hidden" name="candidate_id" value="{{$id}}">
                        @php
                            $trainingDay = count($training) + 1;
                        @endphp
                        @for ($i = 1; $i <= $trainingDay; $i++)
                        @if ($i != 11)
                        <div class="mb-3 row">
                            @php $index = $i - 1; @endphp
                            <input type="hidden" name="day[]" value="{{$i}}">
                            <div class="col-md-2" style="text-align: center;">
                                <label for="example-text-input" class="col-form-label">{{ $training["{$index}"]['date'] ?? '' }}</label>
                            </div>
                            <div class="col-md-2" style="text-align: center;">
                                <label for="example-text-input" class="col-form-label">Day {{$i}}</label>
                            </div>
                            <div class="col-md-1">
                            </div>
                            <div class="col-md-2">
                                <div class="input-group" id="timepicker-input-group{{$i}}">
                                    <input id="in_{{$i}}" name="in[]" placeholder="Enter In Time" type="text" class="form-control" value="{{ $training["{$index}"]["time_in"] ?? '' }}" autocomplete="off" disabled required>
                                    <span class="input-group-text"><i class="mdi mdi-clock-outline"></i></span>
                                    <label for="in_{{$i}}" class="error"></label>
                                </div>
                            </div>
                            <div class="col-md-1">
                            </div>
                            <div class="col-md-2">
                                <div class="input-group" id="timepicker-input-group{{$i}}{{$i}}">
                                    <input id="out_{{$i}}" name="out[]" placeholder="Enter Out Time" type="text" class="form-control" value="{{ $training["{$index}"]["time_out"] ?? '' }}" autocomplete="off" disabled required>
                                    <span class="input-group-text"><i class="mdi mdi-clock-outline"></i></span>
                                    <label for="out_{{$i}}" class="error"></label>
                                </div>
                            </div>
                            <div class="col-md-1">
                            </div>
                        </div>
                        @endif
                        @endfor
                        <br>
                    </form>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
    <script>

    </script>
@endsection
