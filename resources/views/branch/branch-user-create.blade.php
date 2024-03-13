@extends('layouts.master')

@section('title') Add User @endsection

@section('content')

@component('components.breadcrumb')
@slot('li_1') Forms @endslot
@slot('title') Add User @endslot
@endcomponent
@section('css')
<link href="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="{{ URL::asset('/assets/libs/datepicker/datepicker.min.css') }}">
@endsection
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
                <form method="post" action="{{route('storeGuestUser')}}" id="createUserForm">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="basicpill-firstname-input" style="margin-bottom: 1.4rem;">Name</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Enter Name" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="basicpill-firstname-input" style="margin-bottom: 1.4rem;">Email</label>
                                <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email" autocomplete="off" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="basicpill-firstname-input">Mobile Number</label>
                                <input type="number" name="mobile_number" class="form-control" id="mobile_number" placeholder="Enter Mobile Name" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="basicpill-firstname-input">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="userpassword" name="password" placeholder="Enter password" autocomplete="off" autofocus required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="basicpill-firstname-input">Confirm Password</label>
                                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="confirmpassword" name="password_confirmation" name="password_confirmation" placeholder="Enter Confirm password" autofocus required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-5"></div>
                        <div class="col-lg-2"><button type="submit" class="btn btn-primary w-md saveCandidate">Submit</button></div>
                        <div class="col-lg-5"></div>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end col -->
</div>
@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script src="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/datepicker/datepicker.min.js') }}"></script>
<script>
    $("#createUserForm").validate({
        rules: {
            mobile_number: {
                required: true,
                minlength: 10,
                maxlength: 10
            },
            password: {
                minlength: 6,
            },
            password_confirmation: {
                minlength: 6,
                equalTo: "#userpassword"
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
</script>
@endsection