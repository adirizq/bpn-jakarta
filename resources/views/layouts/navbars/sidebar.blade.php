<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-0" href="{{ route('home') }}">
            <img src="{{ asset('img/logo-landscape.svg') }}" class="navbar-brand-img" alt="...">
        </a>
        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                        <img alt="Image placeholder" src="{{ auth()->user()->image }}">
                        </span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('Logout') }}</span>
                    </a>
                </div>
            </li>
        </ul>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('img/logo-landscape.svg') }}">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>

            @admin
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ $title=='dashboard' ? 'active font-weight-bold' : '' }}" href="{{ route('dashboard') }}">
                        <i class="ni ni-chart-pie-35 text-primary"></i> {{ __('Dashboard') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $title=='archives' ? 'active font-weight-bold' : '' }}" href="{{ route('archive.index') }}">
                        <i class="ni ni-single-copy-04 text-primary font-weight-bold"></i> {{ __('Archive') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $title=='Archive Type' || $title=='Archive Right Type' || $title=='Archive Scan Status' || $title=='Archive Physical Status' || $title=='Archive Condition' ? 'active font-weight-bold' : '' }} " href="#navbar-examples" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-examples">
                        <i class="ni ni-tag text-primary font-weight-bold"></i> {{ __('Categorization') }}
                    </a>
                    <div class="collapse {{ $title=='Archive Type' || $title=='Archive Right Type' || $title=='Archive Scan Status' || $title=='Archive Physical Status' || $title=='Archive Condition' ? 'show' : '' }} " id="navbar-examples">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link {{ $title=='Archive Type' ? 'active font-weight-bold' : '' }}" href="{{ route('type.index') }}">{{ __('Types') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ $title=='Archive Right Type' ? 'active font-weight-bold' : '' }}" href="{{ route('rightType.index') }}">{{ __('Right Types') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ $title=='Archive Scan Status' ? 'active font-weight-bold' : '' }}" href="{{ route('scanStatus.index') }}">{{ __('Scan Statuses') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ $title=='Archive Physical Status' ? 'active font-weight-bold' : '' }}" href="{{ route('physicalStatus.index') }}">{{ __('Physical Statuses') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ $title=='Archive Condition' ? 'active font-weight-bold' : '' }}" href="{{ route('condition.index') }}">{{ __('Conditions') }}</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $title=='users' ? 'active font-weight-bold' : '' }}" href="{{ route('user.index') }}">
                        <i class="ni ni-single-02 text-primary"></i> {{ __('User') }}
                    </a>
                </li>
            </ul>
            @else
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ $title=='home' ? 'active font-weight-bold' : '' }}" href="{{ route('home') }}">
                        <i class="ni ni-chart-pie-35 text-primary"></i> {{ __('Home') }}
                    </a>
                </li>
            </ul>
            @endadmin
            <!-- Navigation -->
        </div>
    </div>
</nav>
