@extends('layouts.master')

@section('title') Training Running @endsection

@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    <!--<link href="{{ URL::asset('/assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css">-->
    <link rel="stylesheet" href="{{ URL::asset('/assets/libs/datepicker/datepicker.min.css') }}">
    <style>
    .white-bg {
        margin-bottom: 20px;
        padding: 18px;
        background: #fff;
        border-radius: 5px;
    }
    .white-bg .col-4 {
        align-items: center;
        display: grid;
    }
    p.contact {
        margin: 0;
        text-align: end;
    }
</style>
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1') Tables @endslot
        @slot('title') Training Running @endslot
    @endcomponent
    <div>
        <div class="white-bg">
            <div class="row">
                <div class="col-4">
                    <img src="https://job.ndhcare.co.uk/assets/images/NDH-care-1.png" alt="" height="45" class="advance-logo">
                </div>
                <div class="col-4">
                    <h4 class="site-heading" style="font-size: 2rem"><b>NDH CARE LDT</b></h4>
                </div>
                <div class="col-4">
                    <p class="contact">Suite 06, Elite House, 70 Warwick Street, Birmingham, B12 0NL</p>
                    <p class="contact">Ph: 0121 448 0568</p>
                    <p class="contact">Website: www.ndhcare.co.uk</p>
                    <p class="contact">Email: info@ndhcare.co.uk</p>
                </div>
            </div>
        </div>
    </div>
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
                    <form method="post" action="{{route('trainingRunningSave')}}" id="trainingrunning">
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
                                    <input id="in_{{$i}}" name="in[]" placeholder="Enter In Time" type="text" class="form-control" value="{{ $training["{$index}"]["time_in"] ?? '' }}" autocomplete="off" required>
                                    <span class="input-group-text"><i class="mdi mdi-clock-outline"></i></span>
                                    <label for="in_{{$i}}" class="error"></label>
                                </div>
                            </div>
                            <div class="col-md-1">
                            </div>
                            <div class="col-md-2">
                                <div class="input-group" id="timepicker-input-group{{$i}}{{$i}}">
                                    <input id="out_{{$i}}" name="out[]" placeholder="Enter Out Time" type="text" class="form-control" value="{{ $training["{$index}"]["time_out"] ?? '' }}" autocomplete="off" required>
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
                        @if ($trainingDay == 11)
                        <!--<div class="row">
                            <div class="col-lg-5"></div>
                            <div class="col-lg-2"><a href="{{route('trainingComplete', $id)}}" class="btn btn-success w-md">Complete Interview</a></div>
                            <div class="col-lg-5"></div>
                        </div>-->
                        @else
                        <div class="row">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-2"><button type="submit" class="btn btn-primary w-md saveRunningCandidate">Submit</button></div>
                            <div class="col-lg-2"><a href="{{route('trainingRunning')}}" class="btn btn-danger w-md">Back To List</a></div>
                            <div class="col-lg-2"><a href="{{route('candidateTrainingComplete', $id)}}" class="btn btn-success w-md">Complete Interview</a></div>
                            <div class="col-lg-3"></div>
                        </div>
                        @endif
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
        $(document).ready(function() {
            $.extend( $.validator.prototype, {
                checkForm: function () {
                    this.prepareForm();
                    for (var i = 0, elements = (this.currentElements = this.elements()); elements[i]; i++) {
                    if (this.findByName(elements[i].name).length != undefined && this.findByName(elements[i].name).length > 1) {
                        for (var cnt = 0; cnt < this.findByName(elements[i].name).length; cnt++) {
                        this.check(this.findByName(elements[i].name)[cnt]);
                        }
                    } else {
                        this.check(elements[i]);
                    }
                    }
                    return this.valid();
                }
            });
            $("#trainingrunning").validate({
                rules: {
                    "in[]": "required",
                    "out[]": "required",
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
            $('#in_1').timepicker({
                minuteStep: 15,
                defaultTime: false,
                icons: {
                    up: 'mdi mdi-chevron-up',
                    down: 'mdi mdi-chevron-down'
                },
                appendWidgetTo: "#timepicker-input-group1"
            });
            $('#out_1').timepicker({
                minuteStep: 15,
                defaultTime: false,
                icons: {
                    up: 'mdi mdi-chevron-up',
                    down: 'mdi mdi-chevron-down'
                },
                appendWidgetTo: "#timepicker-input-group11"
            });
            $('#in_2').timepicker({
                minuteStep: 15,
                defaultTime: false,
                icons: {
                    up: 'mdi mdi-chevron-up',
                    down: 'mdi mdi-chevron-down'
                },
                appendWidgetTo: "#timepicker-input-group2"
            });
            $('#out_2').timepicker({
                minuteStep: 15,
                defaultTime: false,
                icons: {
                    up: 'mdi mdi-chevron-up',
                    down: 'mdi mdi-chevron-down'
                },
                appendWidgetTo: "#timepicker-input-group22"
            });
            $('#in_3').timepicker({
                minuteStep: 15,
                defaultTime: false,
                icons: {
                    up: 'mdi mdi-chevron-up',
                    down: 'mdi mdi-chevron-down'
                },
                appendWidgetTo: "#timepicker-input-group3"
            });
            $('#out_3').timepicker({
                minuteStep: 15,
                defaultTime: false,
                icons: {
                    up: 'mdi mdi-chevron-up',
                    down: 'mdi mdi-chevron-down'
                },
                appendWidgetTo: "#timepicker-input-group33"
            });
            $('#in_4').timepicker({
                minuteStep: 15,
                defaultTime: false,
                icons: {
                    up: 'mdi mdi-chevron-up',
                    down: 'mdi mdi-chevron-down'
                },
                appendWidgetTo: "#timepicker-input-group4"
            });
            $('#out_4').timepicker({
                minuteStep: 15,
                defaultTime: false,
                icons: {
                    up: 'mdi mdi-chevron-up',
                    down: 'mdi mdi-chevron-down'
                },
                appendWidgetTo: "#timepicker-input-group44"
            });
            $('#in_5').timepicker({
                minuteStep: 15,
                defaultTime: false,
                icons: {
                    up: 'mdi mdi-chevron-up',
                    down: 'mdi mdi-chevron-down'
                },
                appendWidgetTo: "#timepicker-input-group5"
            });
            $('#out_5').timepicker({
                minuteStep: 15,
                defaultTime: false,
                icons: {
                    up: 'mdi mdi-chevron-up',
                    down: 'mdi mdi-chevron-down'
                },
                appendWidgetTo: "#timepicker-input-group55"
            });
            $('#in_6').timepicker({
                minuteStep: 15,
                defaultTime: false,
                icons: {
                    up: 'mdi mdi-chevron-up',
                    down: 'mdi mdi-chevron-down'
                },
                appendWidgetTo: "#timepicker-input-group6"
            });
            $('#out_6').timepicker({
                minuteStep: 15,
                defaultTime: false,
                icons: {
                    up: 'mdi mdi-chevron-up',
                    down: 'mdi mdi-chevron-down'
                },
                appendWidgetTo: "#timepicker-input-group66"
            });
            $('#in_7').timepicker({
                minuteStep: 15,
                icons: {
                    up: 'mdi mdi-chevron-up',
                    down: 'mdi mdi-chevron-down'
                },
                appendWidgetTo: "#timepicker-input-group7"
            });
            $('#out_7').timepicker({
                minuteStep: 15,
                icons: {
                    up: 'mdi mdi-chevron-up',
                    down: 'mdi mdi-chevron-down'
                },
                appendWidgetTo: "#timepicker-input-group77"
            });
            $('#in_8').timepicker({
                minuteStep: 15,
                defaultTime: false,
                icons: {
                    up: 'mdi mdi-chevron-up',
                    down: 'mdi mdi-chevron-down'
                },
                appendWidgetTo: "#timepicker-input-group8"
            });
            $('#out_8').timepicker({
                minuteStep: 15,
                defaultTime: false,
                icons: {
                    up: 'mdi mdi-chevron-up',
                    down: 'mdi mdi-chevron-down'
                },
                appendWidgetTo: "#timepicker-input-group88"
            });
            $('#in_9').timepicker({
                minuteStep: 15,
                defaultTime: false,
                icons: {
                    up: 'mdi mdi-chevron-up',
                    down: 'mdi mdi-chevron-down'
                },
                appendWidgetTo: "#timepicker-input-group9"
            });
            $('#out_9').timepicker({
                minuteStep: 15,
                defaultTime: false,
                icons: {
                    up: 'mdi mdi-chevron-up',
                    down: 'mdi mdi-chevron-down'
                },
                appendWidgetTo: "#timepicker-input-group99"
            });
            $('#in_10').timepicker({
                minuteStep: 15,
                defaultTime: false,
                icons: {
                    up: 'mdi mdi-chevron-up',
                    down: 'mdi mdi-chevron-down'
                },
                appendWidgetTo: "#timepicker-input-group10"
            });
            $('#out_10').timepicker({
                minuteStep: 15,
                defaultTime: false,
                icons: {
                    up: 'mdi mdi-chevron-up',
                    down: 'mdi mdi-chevron-down'
                },
                appendWidgetTo: "#timepicker-input-group1010"
            });
        });
    </script>
@endsection
