<div class="dropdown d-inline-block">
    <button type="button" class="btn header-item noti-icon position-relative" wire:click="toggle()" aria-haspopup="true" aria-expanded="false">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell icon-lg"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
        <span class="badge bg-danger rounded-pill">{{ $count === 0 ? '' : $count}}</span>
    </button>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
        aria-labelledby="page-header-notifications-dropdown"
        @if($show)
        style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate3d(0px, 72px, 0px);display: block;top:100%;"
        @endif
        >
        <div class="p-3">
            <div class="row align-items-center">
                <div class="col">
                    <h6 class="m-0"> Notifications </h6>
                </div>
            </div>
        </div>
        <div data-simplebar style="max-height: 230px;overflow-y: scroll;">
            @forelse($notifikasi as $notif)
                @if($notif->type === 'notifikasi')
                    <a href="
                    @if(isset($notif->data['sidang_ta_id']))
                    {{ route('data-pengajuan:sidang-ta') }}
                    @elseif(isset($notif->data['sempro_id']))
                    {{ route('data-pengajuan:seminar-proposal') }}
                    @else
                    {{ route('data-pengajuan:judul-ta') }}
                    @endif
                    " class="text-reset notification-item">
                        <div class="d-flex">
                            <div class="flex-shrink-0 avatar-sm me-3">
                                <span class="avatar-title bg-primary rounded-circle font-size-16">
                                    <i class="bx bx-receipt"></i>
                                </span>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">Notifikasi Terbaru</h6>
                                <div class="font-size-13 text-muted">
                                    <p class="mb-1">{{ $notif->from->name . ', '. $notif->data['message'] }}</p>
                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>{{ $notif->displayTime() }}</span></p>
                                </div>
                            </div>
                        </div>
                    </a>
                @endif

                @if($notif->type === 'judul-disetujui')
                    <a href="{{ route('ta:pengajuan') }}" class="text-reset notification-item">
                        <div class="d-flex">
                            <div class="flex-shrink-0 avatar-sm me-3">
                                <span class="avatar-title bg-success rounded-circle font-size-16">
                                    <i class="bx bx-check"></i>
                                </span>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">Notifikasi Terbaru</h6>
                                <div class="font-size-13 text-muted">
                                    <p class="mb-1">{{ $notif->from->name . ', '. $notif->data['message'] }}</p>
                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>{{ $notif->displayTime() }}</span></p>
                                </div>
                            </div>
                        </div>
                    </a>
                @endif

                @if($notif->type === 'pengajuan-judul-disetujui')
                    <a href="{{ route('ta:pengajuan') }}" class="text-reset notification-item">
                        <div class="d-flex">
                            <div class="flex-shrink-0 avatar-sm me-3">
                                <span class="avatar-title bg-success rounded-circle font-size-16">
                                    <i class="bx bx-book-open"></i>
                                </span>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">Notifikasi Terbaru</h6>
                                <div class="font-size-13 text-muted">
                                    <p class="mb-1">{{ $notif->data['message'] }}</p>
                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>{{ $notif->displayTime() }}</span></p>
                                </div>
                            </div>
                        </div>
                    </a>
                @endif

                @if($notif->type === 'judul-ditolak')
                    <a href="{{ route('ta:pengajuan') }}" class="text-reset notification-item">
                        <div class="d-flex">
                            <div class="flex-shrink-0 avatar-sm me-3">
                                <span class="avatar-title bg-danger rounded-circle font-size-16">
                                    <i class="bx bx-x"></i>
                                </span>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">Notifikasi Terbaru</h6>
                                <div class="font-size-13 text-muted">
                                    <p class="mb-1">{{ $notif->from->name . ', '. $notif->data['message'] }}</p>
                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>{{ $notif->displayTime() }}</span></p>
                                </div>
                            </div>
                        </div>
                    </a>
                @endif

                @if($notif->type === 'pengajuan-bimbingan')
                    <a href="{{ route('data-pengajuan:detail', ['id' => $notif->from_id]) }}" class="text-reset notification-item">
                        <div class="d-flex">
                            <div class="flex-shrink-0 avatar-sm me-3">
                                <span class="avatar-title bg-success rounded-circle font-size-16">
                                    <i class="bx bx-file"></i>
                                </span>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">Notifikasi Terbaru</h6>
                                <div class="font-size-13 text-muted">
                                    <p class="mb-1">{{ $notif->from->name . ', '. $notif->data['message'] }}</p>
                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>{{ $notif->displayTime() }}</span></p>
                                </div>
                            </div>
                        </div>
                    </a>
                @endif

                @if($notif->type === 'bimbingan-disetujui')
                    <a href="{{ route('ta:bimbingan') }}" class="text-reset notification-item">
                        <div class="d-flex">
                            <div class="flex-shrink-0 avatar-sm me-3">
                                <span class="avatar-title bg-success rounded-circle font-size-16">
                                    <i class="bx bx-file"></i>
                                </span>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">Notifikasi Terbaru</h6>
                                <div class="font-size-13 text-muted">
                                    <p class="mb-1">{{ $notif->from->name . ', '. $notif->data['message'] }}</p>
                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>{{ $notif->displayTime() }}</span></p>
                                </div>
                            </div>
                        </div>
                    </a>
                @endif

                @if($notif->type === 'seminar-proposal-disetujui')
                    <a href="{{ route('ta:sempro') }}" class="text-reset notification-item">
                        <div class="d-flex">
                            <div class="flex-shrink-0 avatar-sm me-3">
                                <span class="avatar-title bg-success rounded-circle font-size-16">
                                    <i class="bx bx-bell"></i>
                                </span>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">Notifikasi Terbaru</h6>
                                <div class="font-size-13 text-muted">
                                    <p class="mb-1">{{ $notif->from->name . ', '. $notif->data['message'] }}</p>
                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>{{ $notif->displayTime() }}</span></p>
                                </div>
                            </div>
                        </div>
                    </a>
                @endif

                @if($notif->type === 'tendik-seminar-proposal')
                    <a href="{{ route('periode-sempro:list', ['id' => $notif->data['periode_id']]) }}" class="text-reset notification-item">
                        <div class="d-flex">
                            <div class="flex-shrink-0 avatar-sm me-3">
                                <span class="avatar-title bg-success rounded-circle font-size-16">
                                    <i class="bx bx-bell"></i>
                                </span>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">Notifikasi Terbaru</h6>
                                <div class="font-size-13 text-muted">
                                    <p class="mb-1">{{ $notif->from->name . ', '. $notif->data['message'] }}</p>
                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>{{ $notif->displayTime() }}</span></p>
                                </div>
                            </div>
                        </div>
                    </a>
                @endif

                @if($notif->type === 'tendik-update-seminar-proposal')
                    <a href="{{ route('periode-sempro:list', ['id' => $notif->data['periode_id']]) }}" class="text-reset notification-item">
                        <div class="d-flex">
                            <div class="flex-shrink-0 avatar-sm me-3">
                                <span class="avatar-title bg-success rounded-circle font-size-16">
                                    <i class="bx bx-bell"></i>
                                </span>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">Notifikasi Terbaru</h6>
                                <div class="font-size-13 text-muted">
                                    <p class="mb-1">{{ $notif->from->name . ', '. $notif->data['message'] }}</p>
                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>{{ $notif->displayTime() }}</span></p>
                                </div>
                            </div>
                        </div>
                    </a>
                @endif

                @if($notif->type === 'tendik-revisi-sempro')
                    <a href="{{ route('ta:sempro') }}" class="text-reset notification-item">
                        <div class="d-flex">
                            <div class="flex-shrink-0 avatar-sm me-3">
                                <span class="avatar-title bg-warning rounded-circle font-size-16">
                                    <i class="bx bx-bell"></i>
                                </span>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">Notifikasi Terbaru</h6>
                                <div class="font-size-13 text-muted">
                                    <p class="mb-1">{{ $notif->from->name . ', '. $notif->data['message'] }}</p>
                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>{{ $notif->displayTime() }}</span></p>
                                </div>
                            </div>
                        </div>
                    </a>
                @endif

                @if($notif->type === 'tendik-tolak-sempro')
                    <a href="{{ route('ta:sempro') }}" class="text-reset notification-item">
                        <div class="d-flex">
                            <div class="flex-shrink-0 avatar-sm me-3">
                                <span class="avatar-title bg-danger rounded-circle font-size-16">
                                    <i class="bx bx-bell"></i>
                                </span>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">Notifikasi Terbaru</h6>
                                <div class="font-size-13 text-muted">
                                    <p class="mb-1">{{ $notif->from->name . ', '. $notif->data['message'] }}</p>
                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>{{ $notif->displayTime() }}</span></p>
                                </div>
                            </div>
                        </div>
                    </a>
                @endif

                @if($notif->type === 'tendik-terima-sempro')
                    <a href="{{ route('ta:sempro') }}" class="text-reset notification-item">
                        <div class="d-flex">
                            <div class="flex-shrink-0 avatar-sm me-3">
                                <span class="avatar-title bg-success rounded-circle font-size-16">
                                    <i class="bx bx-like"></i>
                                </span>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">Notifikasi Terbaru</h6>
                                <div class="font-size-13 text-muted">
                                    <p class="mb-1">{{ $notif->from->name . ', '. $notif->data['message'] }}</p>
                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>{{ $notif->displayTime() }}</span></p>
                                </div>
                            </div>
                        </div>
                    </a>
                @endif

                @if($notif->type === 'tendik-jadwal-sempro')
                    <a href="{{ route('ta:sempro') }}" class="text-reset notification-item">
                        <div class="d-flex">
                            <div class="flex-shrink-0 avatar-sm me-3">
                                <span class="avatar-title bg-success rounded-circle font-size-16">
                                    <i class="bx bx-calendar"></i>
                                </span>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">Notifikasi Terbaru</h6>
                                <div class="font-size-13 text-muted">
                                    <p class="mb-1">{{ $notif->from->name . ', '. $notif->data['message'] }}</p>
                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>{{ $notif->displayTime() }}</span></p>
                                </div>
                            </div>
                        </div>
                    </a>
                @endif

                @if($notif->type === 'revisi-seminar-disetujui')
                    <a href="{{ route('ta:sempro') }}" class="text-reset notification-item">
                        <div class="d-flex">
                            <div class="flex-shrink-0 avatar-sm me-3">
                                <span class="avatar-title bg-success rounded-circle font-size-16">
                                    <i class="bx bx-bell"></i>
                                </span>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">Notifikasi Terbaru</h6>
                                <div class="font-size-13 text-muted">
                                    <p class="mb-1">{{ $notif->from->name . ', '. $notif->data['message'] }}</p>
                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>{{ $notif->displayTime() }}</span></p>
                                </div>
                            </div>
                        </div>
                    </a>
                @endif

                @if($notif->type === 'sidang-ta-disetujui')
                    <a href="{{ route('ta:sempro') }}" class="text-reset notification-item">
                        <div class="d-flex">
                            <div class="flex-shrink-0 avatar-sm me-3">
                                <span class="avatar-title bg-success rounded-circle font-size-16">
                                    <i class="bx bx-bell"></i>
                                </span>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">Notifikasi Terbaru</h6>
                                <div class="font-size-13 text-muted">
                                    <p class="mb-1">{{ $notif->from->name . ', '. $notif->data['message'] }}</p>
                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>{{ $notif->displayTime() }}</span></p>
                                </div>
                            </div>
                        </div>
                    </a>
                @endif

                @if($notif->type === 'tendik-sidang-ta')
                    <a href="{{ route('periode-ta:list', ['id' => $notif->data['periode_id']]) }}" class="text-reset notification-item">
                        <div class="d-flex">
                            <div class="flex-shrink-0 avatar-sm me-3">
                                <span class="avatar-title bg-success rounded-circle font-size-16">
                                    <i class="bx bx-bell"></i>
                                </span>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">Notifikasi Terbaru</h6>
                                <div class="font-size-13 text-muted">
                                    <p class="mb-1">{{ $notif->from->name . ', '. $notif->data['message'] }}</p>
                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>{{ $notif->displayTime() }}</span></p>
                                </div>
                            </div>
                        </div>
                    </a>
                @endif

                @if($notif->type === 'tendik-update-sidang-ta')
                    <a href="{{ route('periode-ta:list', ['id' => $notif->data['periode_id']]) }}" class="text-reset notification-item">
                        <div class="d-flex">
                            <div class="flex-shrink-0 avatar-sm me-3">
                                <span class="avatar-title bg-success rounded-circle font-size-16">
                                    <i class="bx bx-bell"></i>
                                </span>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">Notifikasi Terbaru</h6>
                                <div class="font-size-13 text-muted">
                                    <p class="mb-1">{{ $notif->from->name . ', '. $notif->data['message'] }}</p>
                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>{{ $notif->displayTime() }}</span></p>
                                </div>
                            </div>
                        </div>
                    </a>
                @endif

                @if($notif->type === 'tendik-revisi-sidang-ta')
                    <a href="{{ route('ta:sidang-ta') }}" class="text-reset notification-item">
                        <div class="d-flex">
                            <div class="flex-shrink-0 avatar-sm me-3">
                                <span class="avatar-title bg-warning rounded-circle font-size-16">
                                    <i class="bx bx-bell"></i>
                                </span>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">Notifikasi Terbaru</h6>
                                <div class="font-size-13 text-muted">
                                    <p class="mb-1">{{ $notif->from->name . ', '. $notif->data['message'] }}</p>
                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>{{ $notif->displayTime() }}</span></p>
                                </div>
                            </div>
                        </div>
                    </a>
                @endif

                @if($notif->type === 'tendik-tolak-sidang-ta')
                    <a href="{{ route('ta:sidang-ta') }}" class="text-reset notification-item">
                        <div class="d-flex">
                            <div class="flex-shrink-0 avatar-sm me-3">
                                <span class="avatar-title bg-danger rounded-circle font-size-16">
                                    <i class="bx bx-bell"></i>
                                </span>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">Notifikasi Terbaru</h6>
                                <div class="font-size-13 text-muted">
                                    <p class="mb-1">{{ $notif->from->name . ', '. $notif->data['message'] }}</p>
                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>{{ $notif->displayTime() }}</span></p>
                                </div>
                            </div>
                        </div>
                    </a>
                @endif

                @if($notif->type === 'tendik-terima-sidang-ta')
                    <a href="{{ route('ta:sidang-ta') }}" class="text-reset notification-item">
                        <div class="d-flex">
                            <div class="flex-shrink-0 avatar-sm me-3">
                                <span class="avatar-title bg-success rounded-circle font-size-16">
                                    <i class="bx bx-like"></i>
                                </span>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">Notifikasi Terbaru</h6>
                                <div class="font-size-13 text-muted">
                                    <p class="mb-1">{{ $notif->from->name . ', '. $notif->data['message'] }}</p>
                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>{{ $notif->displayTime() }}</span></p>
                                </div>
                            </div>
                        </div>
                    </a>
                @endif

                @if($notif->type === 'tendik-jadwal-sidang-ta')
                    <a href="{{ route('ta:sidang-ta') }}" class="text-reset notification-item">
                        <div class="d-flex">
                            <div class="flex-shrink-0 avatar-sm me-3">
                                <span class="avatar-title bg-success rounded-circle font-size-16">
                                    <i class="bx bx-calendar"></i>
                                </span>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">Notifikasi Terbaru</h6>
                                <div class="font-size-13 text-muted">
                                    <p class="mb-1">{{ $notif->from->name . ', '. $notif->data['message'] }}</p>
                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>{{ $notif->displayTime() }}</span></p>
                                </div>
                            </div>
                        </div>
                    </a>
                @endif

                @if($notif->type === 'revisi-sidang-ta-disetujui')
                    <a href="{{ route('ta:sidang-ta') }}" class="text-reset notification-item">
                        <div class="d-flex">
                            <div class="flex-shrink-0 avatar-sm me-3">
                                <span class="avatar-title bg-success rounded-circle font-size-16">
                                    <i class="bx bx-bell"></i>
                                </span>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">Notifikasi Terbaru</h6>
                                <div class="font-size-13 text-muted">
                                    <p class="mb-1">{{ $notif->from->name . ', '. $notif->data['message'] }}</p>
                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>{{ $notif->displayTime() }}</span></p>
                                </div>
                            </div>
                        </div>
                    </a>
                @endif

                @if($notif->type === 'tendik-katalog-ta')
                    <a href="{{ route('katalog:index') }}" class="text-reset notification-item">
                        <div class="d-flex">
                            <div class="flex-shrink-0 avatar-sm me-3">
                                <span class="avatar-title bg-info rounded-circle font-size-16">
                                    <i class="bx bx-book"></i>
                                </span>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">Katalog TA Baru</h6>
                                <div class="font-size-13 text-muted">
                                    <p class="mb-1">{{ $notif->from->name . ', '. $notif->data['message'] }}</p>
                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>{{ $notif->displayTime() }}</span></p>
                                </div>
                            </div>
                        </div>
                    </a>
                @endif

                @if($notif->type === 'katalog-approved')
                    <a href="{{ route('ta:katalog-ta') }}" class="text-reset notification-item">
                        <div class="d-flex">
                            <div class="flex-shrink-0 avatar-sm me-3">
                                <span class="avatar-title bg-success rounded-circle font-size-16">
                                    <i class="bx bx-check-circle"></i>
                                </span>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">Katalog TA Disetujui</h6>
                                <div class="font-size-13 text-muted">
                                    <p class="mb-1">{{ $notif->data['message'] }}</p>
                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>{{ $notif->displayTime() }}</span></p>
                                </div>
                            </div>
                        </div>
                    </a>
                @endif

                {{-- Notification untuk Mahasiswa: Katalog perlu diperbaiki --}}
                @if($notif->type === 'katalog-rejected')
                    <a href="{{ route('ta:katalog-ta') }}" class="text-reset notification-item">
                        <div class="d-flex">
                            <div class="flex-shrink-0 avatar-sm me-3">
                                <span class="avatar-title bg-warning rounded-circle font-size-16">
                                    <i class="bx bx-edit"></i>
                                </span>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">Katalog TA Perlu Diperbaiki</h6>
                                <div class="font-size-13 text-muted">
                                    <p class="mb-1">{{ $notif->data['message'] }}</p>
                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>{{ $notif->displayTime() }}</span></p>
                                </div>
                            </div>
                        </div>
                    </a>
                @endif

            @empty
            <a href="#!" class="text-reset notification-item">
                <div class="d-flex">
                    <div class="flex-shrink-0 avatar-sm me-3">
                        <span class="avatar-title bg-danger rounded-circle font-size-16">
                            <i class="bx bx-no-entry"></i>
                        </span>
                    </div>
                    <div class="flex-grow-1">
                        <h6 class="mb-1">Tidak ada Notifikasi</h6>
                        <div class="font-size-13 text-muted">
                            <p class="mb-1">-</p>
                            <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span></span></p>
                        </div>
                    </div>
                </div>
            </a>
            @endif

            
        </div>
    </div>
</div>