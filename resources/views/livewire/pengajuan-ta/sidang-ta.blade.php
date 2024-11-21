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
                            <a class="nav-link px-3 active" href="{{ route('data-pengajuan:sidang-ta') }}" >Mahasiswa Bimbingan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-3" href="{{ route('data-pengajuan:sidang-ta', ['type' => 'mahasiswa-uji']) }}" >Mahasiswa Uji</a>
                        </li>
                    </ul>
                </div>
                <!-- end card body -->
            </div>
            <div class="card card-body blur shadow-blur">
                <div class="row align-items-center">
                    <div class="card-header">
                        <h2 class="my-heading">Daftar Mahasiswa Sidang TA</h2>
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
                                        <th scope="col">Status</th>
                                        <th scope="col" class="text-center">Persetujuan Sidang TA</th>
                                        <th scope="col" class="text-center">Persetujuan Revisi</th>
                                        <th scope="col" class="text-center">Nilai</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($pengajuans as $pengajuan)
                                        <tr>
                                            <td wire:click="openDetail('{{ $pengajuan->id }}')">{{ $loop->iteration }}.</td>
                                            <td wire:click="openDetail('{{ $pengajuan->id }}')">
                                                {{ $pengajuan->mahasiswa->nama }}
                                            </td>
                                            <td wire:click="openDetail('{{ $pengajuan->id }}')">{{ $pengajuan->mahasiswa->nim }}</td>
                                            <td style="white-space: pre-wrap" wire:click="openDetail('{{ $pengajuan->id }}')">{{ $pengajuan->mahasiswa->pengajuanTA->judul }}</td>
                                            <td wire:click="openDetail('{{ $pengajuan->id }}')">
                                                @if($pengajuan->mahasiswa->user->sidang && $pengajuan->mahasiswa->user->sidang->penilaianSidang()->first())
                                                <span class="badge bg-success" style="font-size: 10pt;">Sudah selesai Sidang TA</span>
                                                @elseif($pengajuan->mahasiswa->user->sidang)
                                                <span class="badge bg-primary" style="font-size: 10pt;">Sudah mendaftar Sidang TA</span>
                                                @else
                                                <span class="badge bg-secondary" style="font-size: 10pt;">Belum mendaftar Sidang TA</span>
                                                @endif
                                            </td>
                                            <td class="text-center" wire:click="openDetail('{{ $pengajuan->id }}')">
                                                @if($pengajuan->jadwal && $pengajuan->mahasiswa->user->sempro->revisi_pembimbing_1 && $pengajuan->mahasiswa->user->sempro->revisi_pembimbing_2 && $pengajuan->mahasiswa->user->sempro->revisi_penguji_1 && $pengajuan->mahasiswa->user->sempro->revisi_penguji_2 )
                                                    @if($pengajuan->jadwal && ($pengajuan->pembimbing_1 === auth()->id()))
                                                        @if(!$pengajuan->mahasiswa->user->sempro->approve_pembimbing_1)
                                                            <button class="btn btn-success btn-sm" wire:click="openSidangModal('{{ $pengajuan->mahasiswa->id }}')">Setujui</button>
                                                        @else
                                                        <span><i class="fas fa-check text-success"></i></span>
                                                        @endif
                                                    @endif
                                                    @if($pengajuan->jadwal && ($pengajuan->pembimbing_2 === auth()->id()))
                                                        @if(!$pengajuan->mahasiswa->user->sempro->approve_pembimbing_2)
                                                            <button class="btn btn-success btn-sm" wire:click="openSidangModal('{{ $pengajuan->mahasiswa->id }}')">Setujui</button>
                                                        @else
                                                        <span><i class="fas fa-check text-success"></i></span>
                                                        @endif
                                                    @endif
                                                @else
                                                    <span><i class="fas fa-minus text-primary"></i></span>
                                                @endif
                                            </td>
                                            <td class="text-center" wire:click="openDetail('{{ $pengajuan->id }}')">
                                                @if($pengajuan->jadwalTa && ($pengajuan->pembimbing_1 === auth()->id()))
                                                    @if(!$pengajuan->mahasiswa->user->sidang->revisi_pembimbing_1)
                                                        <button class="btn btn-success btn-sm" wire:click="openRevisiModal('{{ $pengajuan->mahasiswa->id }}')">Setujui</button>
                                                    @else
                                                    <span><i class="fas fa-check text-success"></i></span>
                                                    @endif
                                                @elseif($pengajuan->jadwalTa && ($pengajuan->pembimbing_2 === auth()->id()))
                                                    @if(!$pengajuan->mahasiswa->user->sidang->revisi_pembimbing_2)
                                                        <button class="btn btn-success btn-sm" wire:click="openRevisiModal('{{ $pengajuan->mahasiswa->id }}')">Setujui</button>
                                                    @else
                                                    <span><i class="fas fa-check text-success"></i></span>
                                                    @endif
                                                @else
                                                <span><i class="fas fa-minus text-primary"></i></span>
                                                @endif
                                            </td>

                                            <td class="text-center">
                                                @if($pengajuan->jadwalTa && ($pengajuan->pembimbing_1 === auth()->id()))
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
                                                    <span style="display: flex">{{ number_format(($total1 * 33 / 100) + ($total2 * 34 / 100) + ($nilai->sikap_kinerja * 33 / 100), 2) }} <a href="javascript:;" style="margin-left: 5px;" wire:click="openEditNilaiModal('{{ $pengajuan->mahasiswa->user->sidang->id }}')"><i class="fa fa-edit text-secondary"></i></a></span>
                                                    @else
                                                        <button class="btn btn-success btn-sm" wire:click="openNilaiModal('{{ $pengajuan->mahasiswa->id }}', '{{ $pengajuan->mahasiswa->user->sidang->id }}')">Tambah Nilai</button>
                                                    @endif
                                                @elseif($pengajuan->jadwalTa && ($pengajuan->pembimbing_2 === auth()->id()))
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
                                                        <span style="display: flex">{{ number_format(($total1 * 33 / 100) + ($total2 * 34 / 100) + ($nilai->sikap_kinerja * 33 / 100), 2) }} <a href="javascript:;" style="margin-left: 5px;" wire:click="openEditNilaiModal('{{ $pengajuan->mahasiswa->user->sidang->id }}')"><i class="fa fa-edit text-secondary"></i></a></span>
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
            @endif

            @if($jadwalSidang)
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-3">Jadwal</h5>
                    <div class="list-group list-group-flush">
                        @if($jadwalSidang->tanggal_sidang)
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm flex-shrink-0 me-3">
                                    <i class="fa fa-calendar fa-2x"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div>
                                        <h5 class="font-size-14 mb-1">Tanggal</h5>
                                        <p class="font-size-13 text-muted mb-0">{{ \Carbon\Carbon::parse($jadwalSidang->tanggal_sidang)->isoFormat('dddd, D MMMM YYYY') }}</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        @endif
                        @if($jadwalSidang->waktu_mulai && $jadwalSidang->waktu_selesai)
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm flex-shrink-0 me-3">
                                    <i class="fa fa-clock fa-2x"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div>
                                        <h5 class="font-size-14 mb-1">Waktu</h5>
                                        <p class="font-size-13 text-muted mb-0">{{ $jadwalSidang->waktu_mulai.' - '.$jadwalSidang->waktu_selesai }}</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        @endif
                        @if($jadwalSidang->ruangan)
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm flex-shrink-0 me-3">
                                    <i class="fa fa-university fa-2x"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div>
                                        <h5 class="font-size-14 mb-1">Ruangan</h5>
                                        <p class="font-size-13 text-muted mb-0">{{ $jadwalSidang->ruangan }}</p>
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
                    <h5 class="card-title mb-3">Jadwal</h5>
                    <div class="list-group list-group-flush">
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm flex-shrink-0 me-3">
                                    <i class="fa fa-calendar fa-2x"></i>
                                </div>
                                <div class="flex-grow-1">
                                    @if($dataPengajuan && !$jadwalSidang)
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
                    <h5 class="card-title mb-3">File Pendukung {{ $dataPengajuan->mahasiswa->nama }}</h5>
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

                        @if($sidang && $sidang->lembar_revisi)
                        <a href="{{ url('storage/' . $sidang->lembar_revisi) }}" target="_blank" class="list-group-item list-group-item-action">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm flex-shrink-0 me-3">
                                    <i class="fa fa-file fa-2x"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div>
                                        <h5 class="font-size-14 mb-1">Lembar Pernyataan Kesanggupan Revisi</h5>
                                        <p class="font-size-13 text-muted mb-0">Lihat file</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        @endif

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

                        @if($sidang && $sidang->bukti_plagiasi)
                        <a href="{{ url('storage/' . $sidang->bukti_plagiasi) }}" target="_blank" class="list-group-item list-group-item-action">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm flex-shrink-0 me-3">
                                    <i class="fa fa-file fa-2x"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div>
                                        <h5 class="font-size-14 mb-1">Bukti Plagiasi</h5>
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
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeRevisiModal()">Tutup</button>
                        <button type="submit" data-bs-dismiss="modal" class="btn btn-info">Setujui</button>
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
                            <h4 class="mt-4">Komponen Penilaian Laporan</h4>
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
                            <h4 class="mt-4">Komponen Penilaian Kinerja</h4>
                            <div class="form-group">
                                <label for="media">Sikap dan Kinerja (100%)</label>
                                <input type="text" wire:model.live="sikap_kinerja" class="form-control" placeholder="Masukkan Nilai (0 - 100)">
                                @error('sikap_kinerja') <small class="text-danger">{{ $message }}</small> @endif
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
                            <h4 class="mt-4">Komponen Penilaian Laporan</h4>
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
                            <h4 class="mt-4">Komponen Penilaian Kinerja</h4>
                            <div class="form-group">
                                <label for="media">Sikap dan Kinerja (100%)</label>
                                <input type="text" wire:model.live="sikap_kinerja" class="form-control" placeholder="Masukkan Nilai (0 - 100)">
                                @error('sikap_kinerja') <small class="text-danger">{{ $message }}</small> @endif
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