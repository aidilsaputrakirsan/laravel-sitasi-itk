<!-- header.blade.php -->
<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="{{ route('dashboard') }}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset('assets/img/logo-si.png') }}" alt="" height="28">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('assets/img/logo-si.png') }}" alt="" height="32" class="me-2">
                        <span class="d-none d-md-inline">
                            <img src="{{ asset('assets/img/logo-sitasi.png') }}" alt="" height="24">
                        </span>
                    </span>
                </a>
                <a href="{{ route('dashboard') }}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ asset('assets/img/logo-si.png') }}" alt="" height="28">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('assets/img/logo-si.png') }}" alt="" height="32" class="me-2">
                        <span class="d-none d-md-inline">
                            <img src="{{ asset('assets/img/logo-sitasi.png') }}" alt="" height="24">
                        </span>
                    </span>
                </a>
            </div>
            
            <!-- MENU TOGGLE -->
            <button type="button" class="btn btn-sm px-3 font-size-16 header-item" id="vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>
        </div>
        
        <div class="d-flex">
            <!-- NOTIFICATION -->
            @livewire('notification')
           
            <!-- USER PROFILE -->
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item bg-light-subtle border-start border-end" id="page-header-user-dropdown"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="{{ asset('dist/assets/images/users/avatar.png')}}"
                        alt="Header Avatar">
                    <span class="d-none d-xl-inline-block ms-1 fw-medium">{{ auth()->user()->name }}</span>
                    
                    <!-- ROLE EMOJI -->
                    <span class="d-none d-lg-inline-block ms-1 role-emoji">
                        @if(auth()->user()->isDosen())
                            👨‍🏫
                        @elseif(auth()->user()->isMahasiswa())
                            🎓
                        @elseif(auth()->user()->isTendik())
                            👩‍💼
                        @elseif(auth()->user()->isKoorpro())
                            👩‍💼
                        @else
                            👤
                        @endif
                    </span>
                    
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- Profile item -->
                    <a class="dropdown-item" href="{{ route('user-profile:index') }}">
                        <span class="emoji-icon">👤</span>
                        <span>Profile</span>
                    </a>
                   
                    <div class="dropdown-divider"></div>
                    
                    <!-- Logout item -->
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="dropdown-item" type="submit">
                            <span class="emoji-icon">🚪</span>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>