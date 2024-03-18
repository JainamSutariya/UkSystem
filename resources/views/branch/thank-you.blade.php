@extends('layouts.master-without-nav')

@section('title')
    Thank You
@endsection

@section('body')

    <body>
    @endsection

    @section('content')

        <div class="account-pages my-5 pt-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mb-5">
                            <h1 class="display-2 fw-medium">Thank You</h1>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-8 col-xl-6">
                        <div>
                            <img src="{{ URL::asset('/assets/images/profile-img.png') }}" alt="" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endsection
