<style>
.card-body {
    background-image: linear-gradient(to bottom right, #0a4e76, #0092DD);
    padding: 10px 10px 10px 10px;
    border-radius: 5px;
    box-shadow: 0px 0px 10px #00000033;
}
.font-size-14 {
    font-size: 25px !important;
    color: white;
    font-weight: 800;
    font-family: none;
    letter-spacing: 1px;
    padding-top: 10px;
}
.text-muted.mt-4 h4 {
    color: white;
    font-size: 40px;
    font-weight: 600;
}
</style>
@extends('layouts.master')

@section('title') Dashboards @endsection

@section('content')

@component('components.breadcrumb')
@slot('li_1') Dashboards @endslot
@slot('title') Dashboards @endslot
@endcomponent

<div class="row">
    <div class="col-xl-12">
        <div class="row">
            <div class="col-sm-3">
                <div class="card">
                    <a href="#">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="avatar-xs me-3">
                                    <span class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-18">
                                        <i class="bx bx-copy-alt"></i>
                                    </span>
                                </div>
                                <h5 class="font-size-14 mb-0">Total Form</h5>
                            </div>
                            <div class="text-muted mt-4">
                                <h4>{{$candidateCount}}</h4>
                                <div class="d-flex">
                                    <span class="badge badge-soft-success font-size-12"></span> <span class="ms-2 text-truncate"></span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="card">
                    <a href="#">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="avatar-xs me-3">
                                    <span class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-18">
                                        <i class="bx bxs-user"></i>
                                    </span>
                                </div>
                                <h5 class="font-size-14 mb-0">New Candidates</h5>
                            </div>
                            <div class="text-muted mt-4">
                                <h4>{{$pendingCandidate}}</h4>
                                <div class="d-flex">
                                    <span class="badge badge-soft-success font-size-12"></span><span class="ms-2 text-truncate"></span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="avatar-xs me-3">
                                <span class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-18">
                                    <i class="bx bx-git-branch"></i>
                                </span>
                            </div>
                            <h5 class="font-size-14 mb-0">Total Branches</h5>
                        </div>
                        <div class="text-muted mt-4">
                            <h4>{{$branchCount}}</h4>
                            <div class="d-flex">
                                <span class="badge badge-soft-success font-size-12"></span><span class="ms-2 text-truncate"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="avatar-xs me-3">
                                <span class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-18">
                                    <i class="bx bx-question-mark"></i>
                                </span>
                            </div>
                            <h5 class="font-size-14 mb-0">Rejected Application</h5>
                        </div>
                        <div class="text-muted mt-4">
                            <h4>0</h4>
                            <div class="d-flex">
                                <span class="badge badge-soft-warning font-size-12"></span><span class="ms-2 text-truncate"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div>
</div>
<!-- end row -->
@endsection
@section('script')
<!-- apexcharts -->
<script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>

<!-- Saas dashboard init -->
<script src="{{ URL::asset('/assets/js/pages/saas-dashboard.init.js') }}"></script>
@endsection