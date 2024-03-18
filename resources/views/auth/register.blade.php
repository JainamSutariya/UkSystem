<style>
    
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
h5.text-primary {
    font-size: 26px;
    color:#fff !important;
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
    Registration
@endsection
@section('css')
    <link href="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css">
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
                                        <div class="text-primary p-4">
                                            <h5 class="text-primary">Registration</h5>
                                        </div>
                                    </div>
                                    <div class="col-5 align-self-end">
                                        <img src="{{ URL::asset('/assets/images/profile-img.png') }}" alt=""
                                            class="img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div>
                                    <a href="index">
                                        <div class="avatar-md profile-user-wid mb-4">
                                            <span class="avatar-title rounded-circle bg-light">
                                                <img src="{{ URL::asset('/assets/images/logo.png') }}" alt=""
                                                    class="rounded-circle" height="40">
                                            </span>
                                        </div>
                                    </a>
                                </div>
                                <div class="p-2">
                                    <form method="POST" id="registerForm" class="form-horizontal" action="{{ route('register.post') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="first_name" class="form-label">First Name</label>
                                            <input type="text" class="form-control @error('first_name') is-invalid @enderror"
                                            value="{{ old('first_name') }}" id="first_name" name="first_name" autocomplete="off" autofocus required
                                                placeholder="Enter First Name">
                                            @error('first_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="last_name" class="form-label">Last Name</label>
                                            <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                            value="{{ old('last_name') }}" id="last_name" name="last_name" autocomplete="off" autofocus required
                                                placeholder="Enter Last Name">
                                            @error('last_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="useremail" class="form-label">Email</label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="useremail"
                                            value="{{ old('email') }}" name="email" placeholder="Enter email" autocomplete="off" autofocus required>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="useremail" class="form-label">Mobile No.</label>
                                            <input type="text" class="form-control @error('mobile_number') is-invalid @enderror" id="mobile_number"
                                            value="{{ old('mobile_number') }}" name="mobile_number" placeholder="Enter mobile number with country code" autocomplete="off" autofocus required>
                                            @error('mobile_number')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
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
                                        <div class="mt-4 d-grid">
                                            <button class="btn btn-primary waves-effect waves-light"
                                                type="submit">Register</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5 text-center">

                            <div>
                                <p>Already have an account ? <a href="{{ url('login') }}" class="fw-medium text-primary">
                                        Login</a> </p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    @endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script>
$(document).ready(function() {
    $("#registerForm").validate({
        rules: {
            first_name: {
                required: true
            },
            last_name: {
                required: true
            },
            email: {
                required: true
            },
            mobile_number: {
                required: true,
                minlength: 10,
                maxlength: 14
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
});
</script>
@endsection
