<div class="vertical-menu" style="background-color: #f8f9fa;">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title text-uppercase fw-bold" style="color: #6c757d; font-size: 0.75rem; letter-spacing: 0.05em;" data-key="t-menu">Menu</li>

                <li class="{{ Request::is('dashboard') ? 'mm-active' : '' }}">
                    <a href="{{ route('dashboard') }}" class="d-flex align-items-center py-2 px-3 rounded-2 text-dark text-decoration-none position-relative overflow-hidden">
                        <i data-feather="home" class="me-3" style="width: 20px; height: 20px; color: #495057; transition: all 0.3s ease;"></i>
                        <span data-key="t-dashboard" class="fw-medium fs-6">Dashboard</span>
                    </a>
                </li>

                @if(auth()->user()->isDosen())
                <li class="{{ Request::is('data-pengajuan*') ? 'mm-active' : '' }}">
                    <a href="javascript: void(0);" class="has-arrow d-flex align-items-center py-2 px-3 rounded-2 text-dark text-decoration-none position-relative overflow-hidden">
                        <i data-feather="file-text" class="me-3" style="width: 20px; height: 20px; color: #495057; transition: all 0.3s ease;"></i>
                        <span data-key="t-apps" class="fw-medium fs-6">Data Pengajuan</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li class="ps-3">
                            <a href="{{ route('data-pengajuan:judul-ta') }}" class="d-flex align-items-center py-2 px-3 rounded-1 text-secondary text-decoration-none position-relative overflow-hidden">
                                <i data-feather="check-circle" class="me-2" style="width: 16px; height: 16px; color: #6c757d; transition: all 0.3s ease;"></i>
                                <span data-key="t-daftar-judul" class="fs-6">Daftar Judul</span>
                            </a>
                        </li>
                        <li class="ps-3">
                            <a href="{{ route('data-pengajuan:bimbingan') }}" class="d-flex align-items-center py-2 px-3 rounded-1 text-secondary text-decoration-none position-relative overflow-hidden">
                                <i data-feather="users" class="me-2" style="width: 16px; height: 16px; color: #6c757d; transition: all 0.3s ease;"></i>
                                <span data-key="t-bimbingan" class="fs-6">Bimbingan</span>
                            </a>
                        </li>
                        <li class="ps-3">
                            <a href="{{ route('data-pengajuan:seminar-proposal') }}" class="d-flex align-items-center py-2 px-3 rounded-1 text-secondary text-decoration-none position-relative overflow-hidden">
                                <i data-feather="mic" class="me-2" style="width: 16px; height: 16px; color: #6c757d; transition: all 0.3s ease;"></i>
                                <span data-key="t-seminar-proposal" class="fs-6">Seminar Proposal</span>
                            </a>
                        </li>
                        <li class="ps-3">
                            <a href="{{ route('data-pengajuan:sidang-ta') }}" class="d-flex align-items-center py-2 px-3 rounded-1 text-secondary text-decoration-none position-relative overflow-hidden">
                                <i data-feather="award" class="me-2" style="width: 16px; height: 16px; color: #6c757d; transition: all 0.3s ease;"></i>
                                <span data-key="t-sidang-ta" class="fs-6">Sidang TA</span>
                            </a>
                        </li>

                    </ul>
                </li>
                @endif

                @if(auth()->user()->isTendik() || auth()->user()->isKoorpro())
                <li class="{{ Request::is('periode*') ? 'mm-active' : '' }}">
                    <a href="javascript: void(0);" class="has-arrow d-flex align-items-center py-2 px-3 rounded-2 text-dark text-decoration-none position-relative overflow-hidden">
                        <i data-feather="clock" class="me-3" style="width: 20px; height: 20px; color: #495057; transition: all 0.3s ease;"></i>
                        <span data-key="t-apps" class="fw-medium fs-6">Periode</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li class="ps-3">
                            <a href="{{ route('periode-sempro') }}" class="d-flex align-items-center py-2 px-3 rounded-1 text-secondary text-decoration-none position-relative overflow-hidden">
                                <i data-feather="calendar" class="me-2" style="width: 16px; height: 16px; color: #6c757d; transition: all 0.3s ease;"></i>
                                <span data-key="t-periode-sempro" class="fs-6">Periode Sempro</span>
                            </a>
                        </li>

                        <li class="ps-3">
                            <a href="{{ route('periode-ta') }}" class="d-flex align-items-center py-2 px-3 rounded-1 text-secondary text-decoration-none position-relative overflow-hidden">
                                <i data-feather="calendar-check" class="me-2" style="width: 16px; height: 16px; color: #6c757d; transition: all 0.3s ease;"></i>
                                <span data-key="t-periode-ta" class="fs-6">Periode TA</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="{{ Request::is('jadwal*') ? 'mm-active' : '' }}">
                    <a href="javascript: void(0);" class="has-arrow d-flex align-items-center py-2 px-3 rounded-2 text-dark text-decoration-none position-relative overflow-hidden">
                        <i data-feather="calendar" class="me-3" style="width: 20px; height: 20px; color: #495057; transition: all 0.3s ease;"></i>
                        <span data-key="t-components" class="fw-medium fs-6">Jadwal</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li class="ps-3">
                            <a href="{{ route('jadwal:sempro:index') }}" data-key="t-jadwal-sempro" class="d-flex align-items-center py-2 px-3 rounded-1 text-secondary text-decoration-none position-relative overflow-hidden">
                                <i data-feather="clock" class="me-2" style="width: 16px; height: 16px; color: #6c757d; transition: all 0.3s ease;"></i>
                                <span class="fs-6">Jadwal Sempro</span>
                            </a>
                        </li>
                        <li class="ps-3">
                            <a href="{{ route('jadwal:sidang-ta:index') }}" data-key="t-jadwal-ta" class="d-flex align-items-center py-2 px-3 rounded-1 text-secondary text-decoration-none position-relative overflow-hidden">
                                <i data-feather="watch" class="me-2" style="width: 16px; height: 16px; color: #6c757d; transition: all 0.3s ease;"></i>
                                <span class="fs-6">Jadwal TA</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="{{ Request::is('data*') ? 'mm-active' : '' }}">
                    <a href="javascript: void(0);" class="has-arrow d-flex align-items-center py-2 px-3 rounded-2 text-dark text-decoration-none position-relative overflow-hidden">
                        <i data-feather="users" class="me-3" style="width: 20px; height: 20px; color: #495057; transition: all 0.3s ease;"></i>
                        <span data-key="t-components" class="fw-medium fs-6">Data User</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li class="ps-3">
                            <a href="{{ route('data-dosen:index') }}" data-key="t-dosen" class="d-flex align-items-center py-2 px-3 rounded-1 text-secondary text-decoration-none position-relative overflow-hidden">
                                <i data-feather="user-check" class="me-2" style="width: 16px; height: 16px; color: #6c757d; transition: all 0.3s ease;"></i>
                                <span class="fs-6">Dosen</span>
                            </a>
                        </li>
                        <li class="ps-3">
                            <a href="{{ route('data-mahasiswa:index') }}" data-key="t-mahasiswa" class="d-flex align-items-center py-2 px-3 rounded-1 text-secondary text-decoration-none position-relative overflow-hidden">
                                <i data-feather="user" class="me-2" style="width: 16px; height: 16px; color: #6c757d; transition: all 0.3s ease;"></i>
                                <span class="fs-6">Mahasiswa</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif


                @if(auth()->user()->isMahasiswa())
                <li class="{{ Request::is('ta*') ? 'mm-active' : '' }}">
                    <a href="javascript: void(0);" class="has-arrow d-flex align-items-center py-2 px-3 rounded-2 text-dark text-decoration-none position-relative overflow-hidden">
                        <i data-feather="edit-3" class="me-3" style="width: 20px; height: 20px; color: #495057; transition: all 0.3s ease;"></i>
                        <span data-key="t-pages" class="fw-medium fs-6">Pengajuan TA</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li class="ps-3">
                            <a href="{{ route('ta:pengajuan') }}" data-key="t-m-pengajuan-judul" class="d-flex align-items-center py-2 px-3 rounded-1 text-secondary text-decoration-none position-relative overflow-hidden">
                                <i data-feather="file-plus" class="me-2" style="width: 16px; height: 16px; color: #6c757d; transition: all 0.3s ease;"></i>
                                <span class="fs-6">Pengajuan Judul</span>
                            </a>
                        </li>
                        <li class="ps-3">
                            <a href="{{ route('ta:bimbingan') }}" data-key="t-m-bimbingan" class="d-flex align-items-center py-2 px-3 rounded-1 text-secondary text-decoration-none position-relative overflow-hidden">
                                <i data-feather="message-circle" class="me-2" style="width: 16px; height: 16px; color: #6c757d; transition: all 0.3s ease;"></i>
                                <span class="fs-6">Bimbingan</span>
                            </a>
                        </li>
                        <li class="ps-3">
                            <a href="{{ route('ta:sempro') }}" data-key="t-m-seminar-proposal" class="d-flex align-items-center py-2 px-3 rounded-1 text-secondary text-decoration-none position-relative overflow-hidden">
                                <i data-feather="mic" class="me-2" style="width: 16px; height: 16px; color: #6c757d; transition: all 0.3s ease;"></i>
                                <span class="fs-6">Seminar Proposal</span>
                            </a>
                        </li>
                        <li class="ps-3">
                            <a href="{{ route('ta:sidang-ta') }}" data-key="t-m-sidang" class="d-flex align-items-center py-2 px-3 rounded-1 text-secondary text-decoration-none position-relative overflow-hidden">
                                <i data-feather="award" class="me-2" style="width: 16px; height: 16px; color: #6c757d; transition: all 0.3s ease;"></i>
                                <span class="fs-6">Sidang TA</span>
                            </a>
                        </li>
                        {{-- <li class="ps-3"><a href="{{ route('ta:penilaian') }}" data-key="t-m-penilaian" class="d-flex align-items-center py-2 px-3 rounded-1 text-secondary text-decoration-none position-relative overflow-hidden">
                            <i data-feather="star" class="me-2" style="width: 16px; height: 16px; color: #6c757d; transition: all 0.3s ease;"></i>
                            <span class="fs-6">Penilaian</span>
                        </a></li> --}}
                    </ul>
                </li>
                @endif

                
                <li class="menu-title mt-4 mb-2 text-uppercase fw-bold border-top pt-3" style="color: #6c757d; font-size: 0.75rem; letter-spacing: 0.05em;" data-key="t-components">Tugas Akhir</li>
                <li>
                    <a href="{{ route('prosedur:index') }}" class="d-flex align-items-center py-2 px-3 rounded-2 text-dark text-decoration-none position-relative overflow-hidden">
                        <i data-feather="book-open" class="me-3" style="width: 20px; height: 20px; color: #495057; transition: all 0.3s ease;"></i>
                        <span data-key="t-horizontal" class="fw-medium fs-6">Prosedur TA</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('referensi:index') }}" class="d-flex align-items-center py-2 px-3 rounded-2 text-dark text-decoration-none position-relative overflow-hidden">
                        <i data-feather="bookmark" class="me-3" style="width: 20px; height: 20px; color: #495057; transition: all 0.3s ease;"></i>
                        <span data-key="t-referensi" class="fw-medium fs-6">Referensi TA</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('katalog:index') }}" class="d-flex align-items-center py-2 px-3 rounded-2 text-dark text-decoration-none position-relative overflow-hidden">
                        <i data-feather="archive" class="me-3" style="width: 20px; height: 20px; color: #495057; transition: all 0.3s ease;"></i>
                        <span data-key="t-katalog" class="fw-medium fs-6">Katalog TA</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>

<style>
/* Hover effects untuk main menu */
#side-menu > li > a:hover {
    background-color: #e9ecef;
    transform: translateX(3px);
}

#side-menu > li > a:hover > i {
    color: #0d6efd !important;
    transform: scale(1.1);
}

#side-menu > li > a:hover > span {
    color: #0d6efd !important;
}

/* Hover effects untuk submenu */
.sub-menu li a:hover {
    background-color: #e9ecef;
    transform: translateX(3px);
}

.sub-menu li a:hover > i {
    color: #0d6efd !important;
    transform: scale(1.1);
}

.sub-menu li a:hover > span {
    color: #212529 !important;
}

/* Active state effects */
.mm-active > a {
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.08);
    border-left: 3px solid #0d6efd;
    padding-left: calc(1rem - 3px) !important;
}

.mm-active > a > i {
    color: #0d6efd !important;
}

.mm-active > a > span {
    color: #0d6efd !important;
}

/* Smooth transitions */
#side-menu a {
    transition: all 0.3s ease;
}

/* Icon animation on parent hover */
.has-arrow:hover > i {
    animation: pulse 0.6s ease;
}

@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.1); }
    100% { transform: scale(1); }
}

/* Subtle glow effect on active items */
.mm-active > a::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    bottom: 0;
    width: 3px;
    background: linear-gradient(180deg, #0d6efd 0%, #0a58ca 100%);
}

/* Menu separator styling */
.menu-title {
    position: relative;
}

.menu-title.border-top {
    border-color: #dee2e6 !important;
}

/* Sidebar scrollbar styling */
.vertical-menu [data-simplebar] {
    scrollbar-width: thin;
    scrollbar-color: #dee2e6 transparent;
}

.vertical-menu [data-simplebar]::-webkit-scrollbar {
    width: 6px;
}

.vertical-menu [data-simplebar]::-webkit-scrollbar-track {
    background: transparent;
}

.vertical-menu [data-simplebar]::-webkit-scrollbar-thumb {
    background-color: #dee2e6;
    border-radius: 3px;
}

.vertical-menu [data-simplebar]::-webkit-scrollbar-thumb:hover {
    background-color: #ced4da;
}

/* Submenu item hover with icon color transition */
.sub-menu li {
    position: relative;
}

.sub-menu li::before {
    content: '';
    position: absolute;
    left: 28px;
    top: 50%;
    width: 0;
    height: 0;
    border-radius: 50%;
    background-color: #0d6efd;
    transition: all 0.3s ease;
    transform: translate(-50%, -50%);
}

.sub-menu li:hover::before {
    width: 6px;
    height: 6px;
}
</style>