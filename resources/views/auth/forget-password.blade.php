@extends('layouts.master-without-nav')

@section('title')
  Reset Password
@endsection
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
@section('body')

    <body>
    @endsection

    @section('content')
        <div class="account-pages my-5 pt-sm-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card overflow-hidden">
                            <div class="bg-primary-subtle">
                                <div class="row">
                                    <div class="col-7">
                                        <div class="text-primary p-4">
                                            <h5 class="text-primary"> Reset Password</h5>
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
                                    <form class="form-horizontal" method="post" action="{{route('reset-password-link')}}">
                                      @csrf
                                        <div class="mb-3">
                                            <label for="useremail" class="form-label">Email</label>
                                            <input type="email" name="email" class="form-control" id="useremail"
                                                placeholder="Enter email" required>
                                        </div>
                                        <div class="text-end">
                                            <button class="btn btn-primary w-md waves-effect waves-light"
                                                type="submit">Reset</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5 text-center">
                            <p>Remember It ? <a href="{{route('login')}}" class="fw-medium text-primary"> Sign In here</a> </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    @endsection
