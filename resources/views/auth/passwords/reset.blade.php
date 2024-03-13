<style>
    .bg-primary .bg-soft {
        background-color:  #2a3042 !important;
    }
    button.btn.btn-primary.waves-effect.waves-light {
        background: #2a3042 !important;
        font-size:22px;
        font-weight:600;
    }
    label {
    font-weight: 600 !important;
    margin-bottom: 0.5rem;
    font-size: 20px !important;
}
h5.font-size{
    font-size: 25px !important;
}
p.paragraph {
    font-size: 20px;
    font-weight: 400;
}
label.form-label {
    font-size: 20px !important;
}
.mt-5.text-center p {
    font-size: 18px;
}
label.form-check-label {
    font-size: 17px !important;
}
input#email {
    font-size: 19px !important;
}
input.form-control {
    font-size: 19px !important;
}



</style>
@extends('layouts.master-without-nav')

@section('title')
    Login
@endsection

@section('body')

    <body>
    @endsection

    @section('content')
        <div class="account-pages my-5 pt-sm-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card overflow-hidden">
                            <div class="bg-primary bg-soft" style="background-color: #2a3042 !important; color:#fff !important;">
                                <div class="row">
                                    <div class="col-7">
                                        <div class="p-4">
                                            <h5 class="font-size">Reset Password</h5>
                                        </div>
                                    </div>
                                    <div class="col-5 align-self-end">
                                        <img src="{{ URL::asset('/assets/images/profile-img.png') }}" alt=""
                                            class="img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div class="auth-logo">
                                    <a class="auth-logo-light">
                                        <div class="avatar-md profile-user-wid mb-4">
                                            <span class="avatar-title rounded-circle bg-light">
                                                <img src="{{ URL::asset('/assets/images/logo.png') }}" alt=""
                                                    class="rounded-circle" height="40">
                                            </span>
                                        </div>
                                    </a>

                                    <a class="auth-logo-dark">
                                        <div class="avatar-md profile-user-wid mb-4">
                                            <span class="avatar-title rounded-circle bg-light">
                                                <img src="{{ URL::asset('/assets/images/logo.png') }}" alt=""
                                                    class="rounded-circle" height="40">
                                            </span>
                                        </div>
                                    </a>
                                </div>
                                <div class="p-2">
                                    <form class="form-horizontal" method="POST" action="{{route('password.update')}}">
                                        @csrf
                                        <input type="hidden" value="{{$user->email}}" name="email">

                                        <div class="mb-3">
                                            <label for="userpassword" class="form-label">Password</label>
                                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="userpassword" name="password"
                                                placeholder="Enter password" autofocus required>
                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="confirmpassword" class="form-label">Confirm Password</label>
                                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="confirmpassword" name="password_confirmation"
                                            name="password_confirmation" placeholder="Enter Confirm password" autofocus required>
                                            @error('password_confirmation')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mt-3 d-grid">
                                            <button class="btn btn-primary waves-effect waves-light" type="submit">Reset Password</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="mt-2 text-center">
                                    <div>
                                        <p>Don't have an account ? <a href="{{route('register')}}" class="fw-medium text-primary"> Signup now </a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end account-pages -->

    @endsection
