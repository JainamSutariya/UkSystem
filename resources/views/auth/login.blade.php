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
                                            <h5 class="font-size">Welcome Back !</h5>
                                            <p class="paragraph">Sign in to continue.</p>
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
                                @if(session()->has('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                <div class="p-2">
                                    <form class="form-horizontal" method="POST" action="{{route('login.post')}}">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="username" class="form-label">Email</label>
                                            <input type="text" name="email" class="form-control" id="email"
                                                placeholder="Enter Email Address">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Password</label>
                                            <div class="input-group auth-pass-inputgroup">
                                                <input type="password" name="password" class="form-control" placeholder="Enter password"
                                                    aria-label="Password" aria-describedby="password-addon">
                                                <button class="btn btn-light " type="button" id="password-addon"><i
                                                        class="mdi mdi-eye-outline"></i></button>
                                            </div>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="remember-check">
                                            <label class="form-check-label" for="remember-check">
                                                Remember me
                                            </label>
                                        </div>

                                        <div class="mt-3 d-grid">
                                            <button class="btn btn-primary waves-effect waves-light" type="submit">Log In</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="text-center">
                                    <a href="{{route('forgetPassword')}}" class="text-muted"><i class="mdi mdi-lock me-1"></i> Forgot your password?</a>
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
