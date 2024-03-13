@extends('layouts.master-without-nav')

@section('title')
    Verify OTP
@endsection

@section('body')
    <body>
@endsection

@section('content')
    <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            <!-- end row -->
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card">
                        <div class="card-body">
                            <div class="p-2">
                                <div class="text-center">
                                    <div class="avatar-md mx-auto">
                                        <div class="avatar-title rounded-circle bg-light">
                                            <i class="bx bxs-envelope h1 mb-0 text-primary"></i>
                                        </div>
                                    </div>
                                    <div class="p-2 mt-4">

                                        <h4>Verify your email</h4>
                                        <p class="mb-5">Please enter the 4 digit code sent to <span
                                                class="fw-semibold">{{old('email', $email)}}</span></p>

                                        <form method="post" action="{{ route('auth.verify.verifyOtp') }}">
                                            @csrf
                                            <div class="row">
                                                <div class="col-3">
                                                    <div class="mb-3">
                                                        <label for="digit1" class="visually-hidden">Digit 1</label>
                                                        <input type="text" name="digit1" class="form-control form-control-lg text-center two-step" id="digit1-input" maxLength="1">
                                                    </div>
                                                </div>
                                                <input type="hidden" name="email" value="{{old('email', $email)}}">
                                                <div class="col-3">
                                                    <div class="mb-3">
                                                        <label for="digit2" class="visually-hidden">Digit 2</label>
                                                        <input type="text" name="digit2" class="form-control form-control-lg text-center two-step" id="digit2-input" maxLength="1">
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <div class="mb-3">
                                                        <label for="digit3" class="visually-hidden">Digit 3</label>
                                                        <input type="text" name="digit3" class="form-control form-control-lg text-center two-step" id="digit3-input" maxLength="1">
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <div class="mb-3">
                                                        <label for="digit4" class="visually-hidden">Digit 4</label>
                                                        <input type="text" name="digit4" class="form-control form-control-lg text-center two-step"  id="digit4-input" maxLength="1">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-4">
                                                <button type="submit" class="btn btn-success w-md">Confirm</button>
                                            </div>
                                        </form>
                                        <br>
                                        @if($errors->any())
                                            <div class="alert alert-danger">Invalid OTP. Please try again.</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <!-- two-step-verification js -->
    <script src="{{ URL::asset('build/js/pages/two-step-verification.init.js') }}" type="text/javascript"></script>
@endsection
