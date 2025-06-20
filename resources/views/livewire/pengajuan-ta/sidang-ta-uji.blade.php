<div>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Sidang TA</h4>
    
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Data Pengajuan</a></li>
                        <li class="breadcrumb-item active">Sidang TA</li>
                    </ol>
                </div>
    
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <x-profile-header />
                    <ul class="nav nav-tabs-custom card-header-tabs border-top mt-4" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link px-3 " href="{{ route('data-pengajuan:sidang-ta') }}" >Mahasiswa Bimbingan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-3 active" href="{{ route('data-pengajuan:sidang-ta', ['type' => 'mahasiswa-uji']) }}" >Mahasiswa Uji</a>
                        </li>
                    </ul>
                </div>
                <!-- end card body -->
            </div>
            <div class="card card-body blur shadow-blur">
                <div class="row align-items-center">
                    <div class="card-header">
                        <h2 class="my-heading">Daftar Mahasiswa Uji Sidang TA</h2>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive p-0">
                            <div class="table-responsive mb-4">
                                <table class="table align-middle datatable dt-responsive table-check nowrap" style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
                                    <thead>
                                      <tr>
                                        <th scope="col" style="width: 50px;">No</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">NIM</th>
                                        <th scope="col">Judul</th>
                                        <th scope="col" class="text-center">Persetujuan Revisi</th>
                                        <th scope="col" class="text-center">Nilai</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($pengajuans as $pengajuan)
                                        <tr>
                                            <td wire:click="openDetail('{{ $pengajuan->id }}')">{{ $loop->iteration }}.</td>
                                            <td wire:click="openDetail('{{ $pengajuan->id }}')">
                                                <span
                                                    wire:click="openDetail('{{ $pengajuan->id }}')"
                                                    title="Klik untuk melihat file pendukung"
                                                    style="cursor: pointer; color: #007bff; font-weight: 600; transition: all 0.3s ease;"
                                                    onmouseover="this.style.textDecoration='underline'; this.style.backgroundColor='#e3f2fd'; this.style.padding='4px 8px'; this.style.borderRadius='4px'; this.style.color='#0056b3'; this.style.transform='scale(1.02)';"
                                                    onmouseout="this.style.textDecoration='none'; this.style.backgroundColor='transparent'; this.style.padding='0'; this.style.color='#007bff'; this.style.transform='scale(1)';"
                                                >
                                                    {{ $pengajuan->mahasiswa->nama }}
                                                </span>
                                            </td>
                                            <td wire:click="openDetail('{{ $pengajuan->id }}')">{{ $pengajuan->mahasiswa->nim }}</td>
                                            <td style="white-space: pre-wrap" wire:click="openDetail('{{ $pengajuan->id }}')">{{ $pengajuan->mahasiswa->pengajuanTA->judul }}</td>
                                            <td class="text-center" wire:click="openDetail('{{ $pengajuan->id }}')">
                                                @if($pengajuan->jadwalTa && ($pengajuan->jadwal->penguji_1 === auth()->id()))
                                                    @if(!$pengajuan->mahasiswa->user->sidang->revisi_penguji_1)
                                                        <button class="btn btn-success btn-sm" wire:click="openRevisiModal('{{ $pengajuan->mahasiswa->id }}')">Setujui</button>
                                                    @else
                                                    <span><i class="fas fa-check text-success"></i></span>
                                                    @endif
                                                @elseif($pengajuan->jadwalTa && ($pengajuan->jadwal->penguji_2 === auth()->id()))
                                                    @if(!$pengajuan->mahasiswa->user->sidang->revisi_penguji_2)
                                                        <button class="btn btn-success btn-sm" wire:click="openRevisiModal('{{ $pengajuan->mahasiswa->id }}')">Setujui</button>
                                                    @else
                                                    <span><i class="fas fa-check text-success"></i></span>
                                                    @endif
                                                @else
                                                <span><i class="fas fa-minus text-primary"></i></span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if($pengajuan->jadwalTa && ($pengajuan->jadwal->penguji_1 === auth()->id()))
                                                    @if($pengajuan->mahasiswa->user->sidang->penilaianSidang()->where('user_id', auth()->id())->first())
                                                    @php 
                                                        $nilai = $pengajuan->mahasiswa->user->sidang->penilaianSidang()->where('user_id', auth()->id())->first();
                                                        $total1 = 0;
                                                        $total1 += $nilai->media_presentasi * 20 / 100;
                                                        $total1 += $nilai->komunikasi * 40 / 100;
                                                        $total1 += $nilai->penguasaan_materi * 40 / 100;

                                                        $total2 = 0;
                                                        $total2 += $nilai->isi_laporan_ta * 60 / 100;
                                                        $total2 += $nilai->struktur_penulisan * 40 / 100;
                                                    @endphp
                                                    <span>{{ number_format(($total1 * 50 / 100) + ($total2 * 50 / 100), 2) }} <a href="javascript:;" style="margin-left: 5px;" wire:click="openEditNilaiModal('{{ $pengajuan->mahasiswa->user->sidang->id }}')"><i class="fa fa-edit text-secondary"></i></a></span>
                                                    @else
                                                        <button class="btn btn-success btn-sm" wire:click="openNilaiModal('{{ $pengajuan->mahasiswa->id }}', '{{ $pengajuan->mahasiswa->user->sidang->id }}')">Tambah Nilai</button>
                                                    @endif
                                                    @elseif($pengajuan->jadwalTa && ($pengajuan->jadwal->penguji_2 === auth()->id()))
                                                        @if($pengajuan->mahasiswa->user->sidang->penilaianSidang()->where('user_id', auth()->id())->first())
                                                            @php 
                                                                $nilai = $pengajuan->mahasiswa->user->sidang->penilaianSidang()->where('user_id', auth()->id())->first();
                                                                $total1 = 0;
                                                                $total1 += $nilai->media_presentasi * 20 / 100;
                                                                $total1 += $nilai->komunikasi * 40 / 100;
                                                                $total1 += $nilai->penguasaan_materi * 40 / 100;

                                                                $total2 = 0;
                                                                $total2 += $nilai->isi_laporan_ta * 60 / 100;
                                                                $total2 += $nilai->struktur_penulisan * 40 / 100;
                                                            @endphp
                                                            <span>{{ number_format(($total1 * 50 / 100) + ($total2 * 50 / 100), 2) }} <a href="javascript:;" style="margin-left: 5px;" wire:click="openEditNilaiModal('{{ $pengajuan->mahasiswa->user->sidang->id }}')"><i class="fa fa-edit text-secondary"></i></a></span>
                                                        @else
                                                            <button class="btn btn-success btn-sm" wire:click="openNilaiModal('{{ $pengajuan->mahasiswa->id }}', '{{ $pengajuan->mahasiswa->user->sidang->id }}')">Tambah Nilai</button>
                                                        @endif
                                                    @else
                                                    <span><i class="fas fa-minus text-primary"></i></span>
                                                    @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!-- end table -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">


            @if($jadwal)
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-3">Dosen Penguji</h5>
                    <div class="list-group list-group-flush">
                        @if($jadwal->penguji_1 !== null)
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm flex-shrink-0 me-3">
                                    <i class="fa fa-user fa-2x"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div>
                                        <h5 class="font-size-14 mb-1">{{ $jadwal->penguji1->name }}</h5>
                                        <p class="font-size-13 text-muted mb-0">Dosen Penguji 1</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        @endif
                        @if($jadwal->penguji_2 !== null)
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm flex-shrink-0 me-3">
                                    <i class="fa fa-user fa-2x"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div>
                                        <h5 class="font-size-14 mb-1">{{ $jadwal->penguji2->name }}</h5>
                                        <p class="font-size-13 text-muted mb-0">Dosen Penguji 2</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-3">Jadwal</h5>
                    <div class="list-group list-group-flush">
                        @if($jadwal->tanggal_sempro)
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm flex-shrink-0 me-3">
                                    <i class="fa fa-calendar fa-2x"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div>
                                        <h5 class="font-size-14 mb-1">Tanggal</h5>
                                        <p class="font-size-13 text-muted mb-0">{{ \Carbon\Carbon::parse($jadwal->tanggal_sempro)->isoFormat('dddd, D MMMM YYYY') }}</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        @endif
                        @if($jadwal->waktu_mulai && $jadwal->waktu_selesai)
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm flex-shrink-0 me-3">
                                    <i class="fa fa-clock fa-2x"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div>
                                        <h5 class="font-size-14 mb-1">Waktu</h5>
                                        <p class="font-size-13 text-muted mb-0">{{ $jadwal->waktu_mulai.' - '.$jadwal->waktu_selesai }}</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        @endif
                        @if($jadwal->ruangan)
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm flex-shrink-0 me-3">
                                    <i class="fa fa-university fa-2x"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div>
                                        <h5 class="font-size-14 mb-1">Ruangan</h5>
                                        <p class="font-size-13 text-muted mb-0">{{ $jadwal->ruangan }}</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            @else
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-3">Dosen Penguji</h5>
                    <div class="list-group list-group-flush">
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm flex-shrink-0 me-3">
                                    <i class="fa fa-user fa-2x"></i>
                                </div>
                                <div class="flex-grow-1">
                                    @if($dataPengajuan && !$jadwal)
                                    <div>
                                        <h5 class="font-size-14 mb-1">Belum ditentukan</h5>
                                        <p class="font-size-13 text-muted mb-0">Dosen penguji belum ditentukan</p>
                                    </div>
                                    @else
                                    <div>
                                        <h5 class="font-size-14 mb-1">Belum ada data</h5>
                                        <p class="font-size-13 text-muted mb-0">Klik pada nama mahasiswa untuk melihat dosen penguji</p>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-3">Jadwal</h5>
                    <div class="list-group list-group-flush">
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm flex-shrink-0 me-3">
                                    <i class="fa fa-calendar fa-2x"></i>
                                </div>
                                <div class="flex-grow-1">
                                    @if($dataPengajuan && !$jadwal)
                                    <div>
                                        <h5 class="font-size-14 mb-1">Belum ditentukan</h5>
                                        <p class="font-size-13 text-muted mb-0">Jadwal belum ditentukan</p>
                                    </div>
                                    @else
                                    <div>
                                        <h5 class="font-size-14 mb-1">Belum ada data</h5>
                                        <p class="font-size-13 text-muted mb-0">Klik pada nama mahasiswa untuk melihat jadwal</p>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            @endif
            @if($detailMahasiswa)
            <div class="card">
                <div class="card-body">
                    <div class="bg-green-50 border-l-4 border-green-400 p-3 mb-4">
                        <h5 class="text-green-800 font-semibold">File Pendukung: {{ $dataPengajuan->mahasiswa->nama }}</h5>
                        <p class="text-green-600 text-sm">NIM: {{ $dataPengajuan->mahasiswa->nim }}</p>
                    </div>
                    <div class="list-group list-group-flush">
                        @if($sempro && $sempro->revisi_pembimbing_1 && $sempro->revisi_pembimbing_2 && $sempro->revisi_penguji_1 && $sempro->revisi_penguji_2)
                        <a href="{{ route('pdf:lembar-persetujuan-revisi', ['userId' => $dataPengajuan->mahasiswa->user->id]) }}" target="_blank" class="list-group-item list-group-item-action">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm flex-shrink-0 me-3">
                                    <i class="fa fa-file fa-2x"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div>
                                        <h5 class="font-size-14 mb-1">Lembar Persetujuan Revisi Proposal TA</h5>
                                        <p class="font-size-13 text-muted mb-0">Lihat file</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        @endif
                        <a href="{{ route('pdf:form-ta-006', ['userId' => $dataPengajuan->mahasiswa->user->id]) }}" target="_blank" class="list-group-item list-group-item-action">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm flex-shrink-0 me-3">
                                    <i class="fa fa-file fa-2x"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div>
                                        <h5 class="font-size-14 mb-1">Form. TA-006</h5>
                                        <p class="font-size-13 text-muted mb-0">Lihat file</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        @if($sempro && $sempro->approve_pembimbing_1 && $sempro->approve_pembimbing_2)
                        <a href="{{ route('pdf:form-ta-007', ['userId' => $dataPengajuan->mahasiswa->user->id]) }}" target="_blank" class="list-group-item list-group-item-action">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm flex-shrink-0 me-3">
                                    <i class="fa fa-file fa-2x"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div>
                                        <h5 class="font-size-14 mb-1">Form. TA-007</h5>
                                        <p class="font-size-13 text-muted mb-0">Lihat file</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('pdf:form-ta-008', ['userId' => $dataPengajuan->mahasiswa->user->id]) }}" target="_blank" class="list-group-item list-group-item-action">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm flex-shrink-0 me-3">
                                    <i class="fa fa-file fa-2x"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div>
                                        <h5 class="font-size-14 mb-1">Form. TA-008</h5>
                                        <p class="font-size-13 text-muted mb-0">Lihat file</p>
                                    </div>
                                </div>
                            </div>
                        </a>

                         @if($sidang && $sidang->draft_ta)
                        <a href="{{ url('storage/' . $sidang->draft_ta) }}" target="_blank" class="list-group-item list-group-item-action">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm flex-shrink-0 me-3">
                                    <i class="fa fa-file fa-2x"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div>
                                        <h5 class="font-size-14 mb-1">Draft Laporan TA</h5>
                                        <p class="font-size-13 text-muted mb-0">Lihat file</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        @endif

                        @endif
                        
                    </div>
                </div>
            </div>
            @else
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-3">File Pendukung</h5>

                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 mb-3">
                        <div class="flex items-center">
                            <i class="fa fa-info-circle text-blue-500 mr-2"></i>
                            <div>
                                <p class="text-sm font-medium text-blue-800">Cara melihat file:</p>
                                <p class="text-xs text-blue-600">Klik <span class="font-semibold">nama mahasiswa</span> di tabel</p>
                            </div>
                        </div>
                    </div>
                    <div class="list-group list-group-flush">
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm flex-shrink-0 me-3">
                                    <i class="fa fa-file fa-2x"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div>
                                        <h5 class="font-size-14 mb-1">Belum ada data</h5>
                                        <p class="font-size-13 text-muted mb-0">Klik pada nama mahasiswa untuk melihat file</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            @endif


        </div>
    </div>


    <div class="modal fade @if($setujuiSidangModal) show @endif" @if($setujuiSidangModal) style="display: block" @endif id="tambahData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Persetujuan Sidang TA</h1>
                    <button type="button" class="btn-close" wire:click="closeSidangModal()" aria-label="Close"></button>
                </div>
                <form wire:submit="setujuiSidang()">
                    <div class="modal-body">
                        <div class="form-container">
                            <div class="alert alert-success">
                                <p class="text-dark">Apakah anda yakin menyetujui mahasisa ini untuk Sidang TA?</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeSidangModal()">Tutup</button>
                        <button type="submit" data-bs-dismiss="modal" class="btn btn-info">Setujui</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade @if($setujuiRevisiModal) show @endif" @if($setujuiRevisiModal) style="display: block" @endif id="tambahData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Lembar Revisi Seminar Proposal</h1>
                    <button type="button" class="btn-close" wire:click="closeRevisiModal()" aria-label="Close"></button>
                </div>
                <form wire:submit="setujuiRevisi()">
                    <div class="modal-body">
                        <div class="form-container">
                            <div class="alert alert-success">
                                <p class="text-dark">Apakah anda yakin menyetujui hasil revisi mahasiswa ini?</p>
                            </div>
                            
                            {{-- INFO WORKING DAYS UNTUK SIDANG TA --}}
                            @if($workingDaysInfo && isset($workingDaysInfo['jadwal_ada']) && $workingDaysInfo['jadwal_ada'])
                            <div class="alert
                                @if($workingDaysInfo['status'] === 'normal') alert-info
                                @else alert-warning
                                @endif">
                                <h6><i class="fas fa-calendar-alt"></i> Informasi Waktu Persetujuan:</h6>
                                <p class="mb-1"><strong>Jadwal Sidang TA:</strong> {{ $workingDaysInfo['tanggal_sidang'] }} ({{ $workingDaysInfo['waktu_sidang'] }})</p>
                                <p class="mb-1"><strong>Ruangan:</strong> {{ $workingDaysInfo['ruangan'] }}</p>
                                <p class="mb-1"><strong>Tanggal Persetujuan:</strong> {{ $workingDaysInfo['tanggal_setuju'] }}</p>
                                <p class="mb-1"><strong>Selisih:</strong> {{ $workingDaysInfo['hari_kerja'] }} hari kerja setelah sidang</p>
                                <p class="mb-0
                                    @if($workingDaysInfo['status'] === 'normal') text-success
                                    @else text-warning
                                    @endif">
                                    <strong>{{ $workingDaysInfo['pesan'] }}</strong>
                                </p>
                            
                                @if($workingDaysInfo['status'] !== 'normal')
                                <hr>
                                <small class="text-muted">
                                    <i class="fas fa-info-circle"></i>
                                    Rentang waktu ideal: H+1 sampai maksimal 20 hari kerja setelah sidang TA.
                                    Anda tetap dapat melanjutkan persetujuan.
                                </small>
                                @endif
                            </div>
                            @elseif($workingDaysInfo && !$workingDaysInfo['jadwal_ada'])
                            <div class="alert alert-warning">
                                <p class="mb-0 text-warning">{{ $workingDaysInfo['pesan'] }}</p>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeRevisiModal()">Tutup</button>
                        <button type="submit" data-bs-dismiss="modal"
                                class="btn
                                @if($workingDaysInfo && isset($workingDaysInfo['status']) && $workingDaysInfo['status'] === 'normal') btn-info
                                @else btn-warning
                                @endif">
                            @if($workingDaysInfo && isset($workingDaysInfo['status']) && $workingDaysInfo['status'] !== 'normal')
                            Tetap Setujui
                            @else
                            Setujui
                            @endif
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade @if($nilaiModal) show @endif" @if($nilaiModal) style="display: block" @endif id="tambahData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Form Penilaian Sidang TA</h1>
                    <button type="button" class="btn-close" wire:click="closeNilaiModal()" aria-label="Close"></button>
                </div>
                <form wire:submit="submitNilai()">
                    <div class="modal-body">
                        <div class="form-container">
                            <h4>Komponen Penilaian Presentasi</h4>
                            <div class="form-group">
                                <label for="media">Media Presentasi/Power Point (20%)</label>
                                <input type="text" wire:model.live="media_presentasi" class="form-control" placeholder="Masukkan Nilai (0 - 100)">
                                @error('media_presentasi') <small class="text-danger">{{ $message }}</small> @endif
                            </div>
                            <div class="form-group">
                                <label for="media">Komunikasi dalam presentasi (40%)</label>
                                <input type="text" wire:model.live="komunikasi" class="form-control" placeholder="Masukkan Nilai (0 - 100)">
                                @error('komunikasi') <small class="text-danger">{{ $message }}</small> @endif
                            </div>
                            <div class="form-group">
                                <label for="media">Penguasaan Materi (40%)</label>
                                <input type="text" wire:model.live="penguasaan_materi" class="form-control" placeholder="Masukkan Nilai (0 - 100)">
                                @error('penguasaan_materi') <small class="text-danger">{{ $message }}</small> @endif
                            </div>
                            <h4 class="mt-4">Komponen Penilaian Proposal</h4>
                            <div class="form-group">
                                <label for="media">Isi Laporan TA (60%)</label>
                                <input type="text" wire:model.live="isi_laporan_ta" class="form-control" placeholder="Masukkan Nilai (0 - 100)">
                                @error('isi_laporan_ta') <small class="text-danger">{{ $message }}</small> @endif
                            </div>
                            <div class="form-group">
                                <label for="media">Struktur dan Tata Cara Penulisan Proposal (40%)</label>
                                <input type="text" wire:model.live="struktur_penulisan" class="form-control" placeholder="Masukkan Nilai (0 - 100)">
                                @error('struktur_penulisan') <small class="text-danger">{{ $message }}</small> @endif
                            </div>
                            <h4 class="mt-4">Nilai Keseluruhan</h4>
                            <div class="form-group">
                                <label for="media">Total Nilai</label>
                                <input type="text" wire:model="total_nilai" disabled class="form-control" placeholder="Total Nilai">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeNilaiModal()">Tutup</button>
                        <button type="submit" data-bs-dismiss="modal" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade @if($editNilaiModal) show @endif" @if($editNilaiModal) style="display: block" @endif id="tambahData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Form Penilaian Sidang TA</h1>
                    <button type="button" class="btn-close" wire:click="closeEditNilaiModal()" aria-label="Close"></button>
                </div>
                <form wire:submit="submitEditNilai()">
                    <div class="modal-body">
                        <div class="form-container">
                            <h4>Komponen Penilaian Presentasi</h4>
                            <div class="form-group">
                                <label for="media">Media Presentasi/Power Point (20%)</label>
                                <input type="text" wire:model.live="media_presentasi" class="form-control" placeholder="Masukkan Nilai (0 - 100)">
                                @error('media_presentasi') <small class="text-danger">{{ $message }}</small> @endif
                            </div>
                            <div class="form-group">
                                <label for="media">Komunikasi dalam presentasi (40%)</label>
                                <input type="text" wire:model.live="komunikasi" class="form-control" placeholder="Masukkan Nilai (0 - 100)">
                                @error('komunikasi') <small class="text-danger">{{ $message }}</small> @endif
                            </div>
                            <div class="form-group">
                                <label for="media">Penguasaan Materi (40%)</label>
                                <input type="text" wire:model.live="penguasaan_materi" class="form-control" placeholder="Masukkan Nilai (0 - 100)">
                                @error('penguasaan_materi') <small class="text-danger">{{ $message }}</small> @endif
                            </div>
                            <h4 class="mt-4">Komponen Penilaian Proposal</h4>
                            <div class="form-group">
                                <label for="media">Isi Laporan TA (60%)</label>
                                <input type="text" wire:model.live="isi_laporan_ta" class="form-control" placeholder="Masukkan Nilai (0 - 100)">
                                @error('isi_laporan_ta') <small class="text-danger">{{ $message }}</small> @endif
                            </div>
                            <div class="form-group">
                                <label for="media">Struktur dan Tata Cara Penulisan Proposal (40%)</label>
                                <input type="text" wire:model.live="struktur_penulisan" class="form-control" placeholder="Masukkan Nilai (0 - 100)">
                                @error('struktur_penulisan') <small class="text-danger">{{ $message }}</small> @endif
                            </div>
                            <h4 class="mt-4">Nilai Keseluruhan</h4>
                            <div class="form-group">
                                <label for="media">Total Nilai</label>
                                <input type="text" wire:model="total_nilai" disabled class="form-control" placeholder="Total Nilai">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeEditNilaiModal()">Tutup</button>
                        <button type="submit" data-bs-dismiss="modal" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>