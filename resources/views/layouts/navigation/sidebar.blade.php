<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu">Menu</li>

                <li class="{{ Request::is('dashboard') ? 'mm-active' : '' }}">
                    <a href="{{ route('dashboard') }}">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Dashboard</span>
                    </a>
                </li>

                @if(auth()->user()->isDosen())
                <li class="{{ Request::is('data-pengajuan*') ? 'mm-active' : '' }}">
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="grid"></i>
                        <span data-key="t-apps">Data Pengajuan</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ route('data-pengajuan:judul-ta') }}">
                                <span data-key="t-daftar-judul">Daftar Judul</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('data-pengajuan:bimbingan') }}">
                                <span data-key="t-bimbingan">Bimbingan</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('data-pengajuan:seminar-proposal') }}">
                                <span data-key="t-seminar-proposal">Seminar Proposal</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('data-pengajuan:sidang-ta') }}">
                                <span data-key="t-sidang-ta">Sidang TA</span>
                            </a>
                        </li>

                    </ul>
                </li>
                @endif

                @if(auth()->user()->isTendik() || auth()->user()->isKoorpro())
                <li class="{{ Request::is('periode*') ? 'mm-active' : '' }}">
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="grid"></i>
                        <span data-key="t-apps">Periode</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ route('periode-sempro') }}">
                                <span data-key="t-periode-sempro">Periode Sempro</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('periode-ta') }}">
                                <span data-key="t-periode-ta">Periode TA</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="{{ Request::is('jadwal*') ? 'mm-active' : '' }}">
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="calendar"></i>
                        <span data-key="t-components">Jadwal</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('jadwal:sempro:index') }}" data-key="t-jadwal-sempro">Jadwal Sempro</a></li>
                        <li><a href="{{ route('jadwal:sidang-ta:index') }}" data-key="t-jadwal-ta">Jadwal TA</a></li>
                    </ul>
                </li>
                <li class="{{ Request::is('data*') ? 'mm-active' : '' }}">
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="users"></i>
                        <span data-key="t-components">Data User</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('data-dosen:index') }}" data-key="t-dosen">Dosen</a></li>
                        <li><a href="{{ route('data-mahasiswa:index') }}" data-key="t-mahasiswa">Mahasiswa</a></li>
                    </ul>
                </li>
                @endif


                @if(auth()->user()->isMahasiswa())
                <li class="{{ Request::is('ta*') ? 'mm-active' : '' }}">
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="file-text"></i>
                        <span data-key="t-pages">Pengajuan TA</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('ta:pengajuan') }}" data-key="t-m-pengajuan-judul">Pengajuan Judul</a></li>
                        <li><a href="{{ route('ta:bimbingan') }}" data-key="t-m-bimbingan">Bimbingan</a></li>
                        <li><a href="{{ route('ta:sempro') }}" data-key="t-m-seminar-proposal">Seminar Proposal</a></li>
                        <li><a href="{{ route('ta:sidang-ta') }}" data-key="t-m-sidang">Sidang TA</a></li>
                        {{-- <li><a href="{{ route('ta:penilaian') }}" data-key="t-m-penilaian">Penilaian</a></li> --}}
                    </ul>
                </li>
                @endif

                
                <li class="menu-title mt-2" data-key="t-components">Tugas Akhir</li>
                <li>
                    <a href="{{ route('prosedur:index') }}">
                        <i data-feather="layout"></i>
                        <span data-key="t-horizontal">Prosedur TA</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('referensi:index') }}">
                        <i data-feather="layout"></i>
                        <span data-key="t-referensi">Referensi TA</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('katalog:index') }}">
                        <i data-feather="layout"></i>
                        <span data-key="t-katalog">Katalog TA</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>