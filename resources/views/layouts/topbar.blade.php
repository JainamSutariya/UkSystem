<style>
@media only screen and (max-width: 600px) {
  .col-sm-3 {
    width: 50%;
}
}

.navbar-brand-box {
    justify-content: center;
    display: flex;
    align-items: center;
}
input.form-control {
    font-size: 17px !important;
}
span.d-none.d-xl-inline-block.ms-1 {
    font-size: 20px !important;
    font-weight:900;
}
i.mdi.mdi-chevron-down.d-none.d-xl-inline-block {
    font-size: 20px;
}
.navbar-brand-box {
    background-color: #2a3042 !important;
}
img.advance-logo {
    width: 210px;
    height: 55px;
    margin-top: 0px;
    margin-left: -10px;
}
</style>


<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="index" class="logo logo-dark">
                   <span class="logo-sm">
                        <img src="{{ URL::asset('/assets/images/logo-3.png') }}" alt="" height="45">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ URL::asset('/assets/images/logo-3.png') }}" alt="" height="45" class="advance-logo">
                    </span>
                </a>

                <a href="index" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ URL::asset('/assets/images/logo-3.png') }}" alt="" height="45">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ URL::asset('/assets/images/logo-3.png') }}" alt="" height="45" class="advance-logo">
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>

           <!-- App Search-->
           <!--<form class="app-search d-none d-lg-block">
            <div class="position-relative">
                <input type="text" class="form-control" placeholder="Search">
                <span class="bx bx-search-alt"></span>
            </div>-->
        </form>

        <div class="dropdown dropdown-mega d-none d-lg-block ms-2">

        </div>
    </div>

    <div class="d-flex">

        <div class="dropdown d-inline-block d-lg-none ms-2">
            <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="mdi mdi-magnify"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                aria-labelledby="page-header-search-dropdown">

                <!--<form class="p-3">
                    <div class="form-group m-0">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="@lang('translation.Search')" aria-label="Search input">

                            <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                        </div>
                    </div>
                </form>-->
            </div>
        </div>



        <div class="dropdown d-none d-lg-inline-block ms-1">
        </div>
        @guest
        @else
        <div class="dropdown d-inline-block">
            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img class="rounded-circle header-profile-user" src="{{ URL::asset('/assets/images/logo.png') }}"
                    alt="Header Avatar">
                <span class="d-none d-xl-inline-block ms-1" key="t-henry">{{ ucfirst(auth()->user()->name) }}</span>
                <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-end">
                <!-- item-->
                @if (auth()->user()->role != 'Admin')
                <a class="dropdown-item" href="{{route('userProfile', ['id' => auth()->user()->id])}}"><i class="bx bx-user font-size-16 align-middle me-1"></i> <span key="t-profile">Profile</span></a>
                @endif
                <a class="dropdown-item text-danger" href="{{ route('logout') }}"><i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span key="t-logout">Logout</span></a>
            </div>
        </div>
        @endguest
    </div>
</div>
</header>
