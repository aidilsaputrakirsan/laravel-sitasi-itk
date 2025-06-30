<!-- sidebar.blade.php -->
<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <div id="sidebar-menu">
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <!-- DASHBOARD -->
                <li class="{{ Request::is('dashboard') ? 'mm-active' : '' }}">
                    <a href="{{ route('dashboard') }}" class="menu-link">
                        <span class="menu-icon">📊</span>
                        <span>Dashboard</span>
                    </a>
                </li>

                <!-- ROLE DOSEN -->
                @if(auth()->user()->isDosen())
                <li class="{{ Request::is('data-pengajuan*') ? 'mm-active' : '' }}">
                    <a href="javascript: void(0);" class="has-arrow menu-link">
                        <span class="menu-icon">📋</span>
                        <span>Data Pengajuan</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ route('data-pengajuan:judul-ta') }}" class="sub-link">
                                <span class="sub-icon">✅</span>
                                <span>Daftar Judul</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('data-pengajuan:bimbingan') }}" class="sub-link">
                                <span class="sub-icon">💬</span>
                                <span>Bimbingan</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('data-pengajuan:seminar-proposal') }}" class="sub-link">
                                <span class="sub-icon">🎤</span>
                                <span>Seminar Proposal</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('data-pengajuan:sidang-ta') }}" class="sub-link">
                                <span class="sub-icon">🏆</span>
                                <span>Sidang TA</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif

                <!-- ROLE TENDIK/KOORPRO -->
                @if(auth()->user()->isTendik() || auth()->user()->isKoorpro())
                <li class="{{ Request::is('periode*') ? 'mm-active' : '' }}">
                    <a href="javascript: void(0);" class="has-arrow menu-link">
                        <span class="menu-icon">📅</span>
                        <span>Periode</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ route('periode-sempro') }}" class="sub-link">
                                <span class="sub-icon">📝</span>
                                <span>Periode Sempro</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('periode-ta') }}" class="sub-link">
                                <span class="sub-icon">📄</span>
                                <span>Periode TA</span>
                            </a>
                        </li>
                    </ul>
                </li>
                
                <li class="{{ Request::is('jadwal*') ? 'mm-active' : '' }}">
                    <a href="javascript: void(0);" class="has-arrow menu-link">
                        <span class="menu-icon">🗓️</span>
                        <span>Jadwal</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ route('jadwal:sempro:index') }}" class="sub-link">
                                <span class="sub-icon">⏰</span>
                                <span>Jadwal Sempro</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('jadwal:sidang-ta:index') }}" class="sub-link">
                                <span class="sub-icon">⏱️</span>
                                <span>Jadwal TA</span>
                            </a>
                        </li>
                    </ul>
                </li>
                
                <li class="{{ Request::is('data*') ? 'mm-active' : '' }}">
                    <a href="javascript: void(0);" class="has-arrow menu-link">
                        <span class="menu-icon">👥</span>
                        <span>Data User</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ route('data-dosen:index') }}" class="sub-link">
                                <span class="sub-icon">👨‍🏫</span>
                                <span>Dosen</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('data-mahasiswa:index') }}" class="sub-link">
                                <span class="sub-icon">🎓</span>
                                <span>Mahasiswa</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif

                <!-- ROLE MAHASISWA -->
                @if(auth()->user()->isMahasiswa())
                <li class="{{ Request::is('ta*') ? 'mm-active' : '' }}">
                    <a href="javascript: void(0);" class="has-arrow menu-link">
                        <span class="menu-icon">📚</span>
                        <span>Pengajuan TA</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ route('ta:pengajuan') }}" class="sub-link">
                                <span class="sub-icon">➕</span>
                                <span>Pengajuan Judul</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('ta:bimbingan') }}" class="sub-link">
                                <span class="sub-icon">💭</span>
                                <span>Bimbingan</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('ta:sempro') }}" class="sub-link">
                                <span class="sub-icon">📢</span>
                                <span>Seminar Proposal</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('ta:sidang-ta') }}" class="sub-link">
                                <span class="sub-icon">🎯</span>
                                <span>Sidang TA</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif

                <!-- TUGAS AKHIR SECTION -->
                <li class="menu-title mt-4">Tugas Akhir</li>
                
                <li class="{{ Request::is('prosedur*') ? 'mm-active' : '' }}">
                    <a href="{{ route('prosedur:index') }}" class="menu-link">
                        <span class="menu-icon">📖</span>
                        <span>Prosedur TA</span>
                    </a>
                </li>
                
                <li class="{{ Request::is('referensi*') ? 'mm-active' : '' }}">
                    <a href="{{ route('referensi:index') }}" class="menu-link">
                        <span class="menu-icon">🔖</span>
                        <span>Referensi TA</span>
                    </a>
                </li>
                
                <li class="{{ Request::is('katalog*') ? 'mm-active' : '' }}">
                    <a href="{{ route('katalog:index') }}" class="menu-link">
                        <span class="menu-icon">📦</span>
                        <span>Katalog TA</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

<!-- Mobile Overlay -->
<div class="sidebar-overlay"></div>