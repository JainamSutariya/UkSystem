<aside id="sidebar-left" class="sidebar-left">
    <div class="sidebar-header">
        <div class="sidebar-title">
            <span style="color:#abb4be;">Navigation</span>
        </div>
        <div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
            <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
        </div>
    </div>
    <div class="nano">
        <div class="nano-content">
            <nav id="menu" class="nav-main" role="navigation">
                <ul class="nav nav-main">
                    @if (Auth::user()->role ==  'Admin')
                    <li class="@if (Request::path() == 'user') nav-active @endif">
                        <a href="{{route('customer.index')}}">
                            <i class="fa fa-users" aria-hidden="true"></i>
                            <span>User</span>
                        </a>
                    </li>
                    @endif
                </ul>
            </nav>
            <hr class="separator" />
            <hr class="separator" />
        </div>
        <div class="nano-content">
            <nav id="menu" class="nav-main" role="navigation">
                <ul class="nav nav-main">
                    @if (Auth::user()->role ==  'Admin')
                    <li class="@if (Request::path() == 'branch') nav-active @endif">
                        <a href="{{route('customer.index')}}">
                            <i class="fa fa-users" aria-hidden="true"></i>
                            <span>Branch</span>
                        </a>
                    </li>
                    @endif
                </ul>
            </nav>
            <hr class="separator" />
            <hr class="separator" />
        </div>
    </div>
</aside>