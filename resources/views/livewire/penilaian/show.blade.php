<div>
    <div>
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Penilaian</h4>
    
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Pengajuan TA</a></li>
                            <li class="breadcrumb-item active">Penilaian</li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <x-profile-header />
                        <ul class="nav nav-tabs-custom card-header-tabs border-top mt-4" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <button class="nav-link px-3 @if($tab === 'sempro') active @endif" wire:click="changeTab('sempro')">Penilaian Seminar Proposal</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link px-3 @if($tab === 'ta') active @endif" wire:click="changeTab('ta')">Penilaian Sidang TA</button>
                            </li>
                        </ul>
                    </div>
                    <!-- end card body -->
                </div>
                @if($tab === 'sempro')
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Penilaian Seminar Proposal</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive p-0">
                            <div class="table-responsive mb-4">
                                <table class="table align-middle datatable dt-responsive table-check nowrap" style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th rowspan="2" style="width: 50px;vertical-align:middle" class="text-center">No</th>
                                            <th rowspan="2" style="vertical-align:middle" class="text-center">Nama</th>
                                            <th colspan="3" class="text-center">Komponen Penilaian Presentasi</th>
                                            <th colspan="3" class="text-center">Komponen Penilaian Proposal</th>
                                        </tr>
                                        <tr>
                                            <th scope="col" style="vertical-align:top" class="text-center">Media Presentasi / Power Point</th>
                                            <th scope="col" style="vertical-align:top" class="text-center">Komunikasi dalam presentasi</th>
                                            <th scope="col" style="vertical-align:top" class="text-center">Penguasaan Materi</th>
                                            <th scope="col" style="vertical-align:top" class="text-center">Isi Laporan TA</th>
                                            <th scope="col" style="vertical-align:top" class="text-center">Struktur dan Tata Cara Penulisan Proposal</th>
                                            <th scope="col" style="vertical-align:top" class="text-center">Total</th>
                                          </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $totalAkhir = 0;
                                        @endphp
                                        @if($nilaiSempro)
                                        <tr>
                                            <td class="text-center">1.</td>
                                            <td class="text-center">{{ $pengajuan->pembimbing1->name }}</td>
                                            <td class="text-center" style="font-weight: bold;">{{ $pengajuan->mahasiswa->user->sempro->penilaianSempros()->where('user_id', $pengajuan->pembimbing_1)->first()->media_presentasi ?? '-' }}</td>
                                            <td class="text-center" style="font-weight: bold;">{{ $pengajuan->mahasiswa->user->sempro->penilaianSempros()->where('user_id', $pengajuan->pembimbing_1)->first()->komunikasi ?? '-' }}</td>
                                            <td class="text-center" style="font-weight: bold;">{{ $pengajuan->mahasiswa->user->sempro->penilaianSempros()->where('user_id', $pengajuan->pembimbing_1)->first()->penguasaan_materi ?? '-' }}</td>
                                            <td class="text-center" style="font-weight: bold;">{{ $pengajuan->mahasiswa->user->sempro->penilaianSempros()->where('user_id', $pengajuan->pembimbing_1)->first()->isi_laporan_ta ?? '-' }}</td>
                                            <td class="text-center" style="font-weight: bold;">{{ $pengajuan->mahasiswa->user->sempro->penilaianSempros()->where('user_id', $pengajuan->pembimbing_1)->first()->struktur_penulisan ?? '-' }}</td>
                                            <td class="text-center" style="font-weight: bold;">
                                                @php
                                                    $totalNilai = 0;
                                                    $nilai = $pengajuan->mahasiswa->user->sempro->penilaianSempros()->where('user_id', $pengajuan->pembimbing_1)->first();
                                                    
                                                    $total1 = 0;
                                                    $total1 += ($nilai->media_presentasi ?? 0) * 20 / 100;
                                                    $total1 += ($nilai->komunikasi ?? 0) * 40 / 100;
                                                    $total1 += ($nilai->penguasaan_materi ?? 0) * 40 / 100;

                                                    $total2 = 0;
                                                    $total2 += ($nilai->isi_laporan_ta ?? 0) * 60 / 100;
                                                    $total2 += ($nilai->struktur_penulisan ?? 0) * 40 / 100;

                                                    $totalNilai = ($total1 * 50 / 100) + ($total2 * 50 / 100);
                                                    $totalAkhir += $totalNilai;
                                                @endphp
                                                {{ number_format($totalNilai, 2) }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">2.</td>
                                            <td class="text-center">{{ $pengajuan->pembimbing2->name }}</td>
                                            <td class="text-center" style="font-weight: bold;">{{ $pengajuan->mahasiswa->user->sempro->penilaianSempros()->where('user_id', $pengajuan->pembimbing_2)->first()->media_presentasi ?? '-' }}</td>
                                            <td class="text-center" style="font-weight: bold;">{{ $pengajuan->mahasiswa->user->sempro->penilaianSempros()->where('user_id', $pengajuan->pembimbing_2)->first()->komunikasi ?? '-' }}</td>
                                            <td class="text-center" style="font-weight: bold;">{{ $pengajuan->mahasiswa->user->sempro->penilaianSempros()->where('user_id', $pengajuan->pembimbing_2)->first()->penguasaan_materi ?? '-' }}</td>
                                            <td class="text-center" style="font-weight: bold;">{{ $pengajuan->mahasiswa->user->sempro->penilaianSempros()->where('user_id', $pengajuan->pembimbing_2)->first()->isi_laporan_ta ?? '-' }}</td>
                                            <td class="text-center" style="font-weight: bold;">{{ $pengajuan->mahasiswa->user->sempro->penilaianSempros()->where('user_id', $pengajuan->pembimbing_2)->first()->struktur_penulisan ?? '-' }}</td>
                                            <td class="text-center" style="font-weight: bold;">
                                                @php
                                                    $totalNilai = 0;
                                                    $nilai = $pengajuan->mahasiswa->user->sempro->penilaianSempros()->where('user_id', $pengajuan->pembimbing_2)->first();
                                                    
                                                    $total1 = 0;
                                                    $total1 += ($nilai->media_presentasi ?? 0) * 20 / 100;
                                                    $total1 += ($nilai->komunikasi ?? 0) * 40 / 100;
                                                    $total1 += ($nilai->penguasaan_materi ?? 0) * 40 / 100;

                                                    $total2 = 0;
                                                    $total2 += ($nilai->isi_laporan_ta ?? 0) * 60 / 100;
                                                    $total2 += ($nilai->struktur_penulisan ?? 0) * 40 / 100;

                                                    $totalNilai = ($total1 * 50 / 100) + ($total2 * 50 / 100);
                                                    $totalAkhir += $totalNilai;
                                                @endphp
                                                {{ number_format($totalNilai, 2) }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">3.</td>
                                            <td class="text-center">{{ $pengajuan->jadwal->penguji1->name }}</td>
                                            <td class="text-center" style="font-weight: bold;">{{ $pengajuan->mahasiswa->user->sempro->penilaianSempros()->where('user_id', $pengajuan->jadwal->penguji_1)->first()->media_presentasi ?? '-' }}</td>
                                            <td class="text-center" style="font-weight: bold;">{{ $pengajuan->mahasiswa->user->sempro->penilaianSempros()->where('user_id', $pengajuan->jadwal->penguji_1)->first()->komunikasi ?? '-' }}</td>
                                            <td class="text-center" style="font-weight: bold;">{{ $pengajuan->mahasiswa->user->sempro->penilaianSempros()->where('user_id', $pengajuan->jadwal->penguji_1)->first()->penguasaan_materi ?? '-' }}</td>
                                            <td class="text-center" style="font-weight: bold;">{{ $pengajuan->mahasiswa->user->sempro->penilaianSempros()->where('user_id', $pengajuan->jadwal->penguji_1)->first()->isi_laporan_ta ?? '-' }}</td>
                                            <td class="text-center" style="font-weight: bold;">{{ $pengajuan->mahasiswa->user->sempro->penilaianSempros()->where('user_id', $pengajuan->jadwal->penguji_1)->first()->struktur_penulisan ?? '-' }}</td>
                                            <td class="text-center" style="font-weight: bold;">
                                                @php
                                                    $totalNilai = 0;
                                                    $nilai = $pengajuan->mahasiswa->user->sempro->penilaianSempros()->where('user_id', $pengajuan->jadwal->penguji_1)->first();
                                                    
                                                    $total1 = 0;
                                                    $total1 += ($nilai->media_presentasi ?? 0) * 20 / 100;
                                                    $total1 += ($nilai->komunikasi ?? 0) * 40 / 100;
                                                    $total1 += ($nilai->penguasaan_materi ?? 0) * 40 / 100;

                                                    $total2 = 0;
                                                    $total2 += ($nilai->isi_laporan_ta ?? 0) * 60 / 100;
                                                    $total2 += ($nilai->struktur_penulisan ?? 0) * 40 / 100;

                                                    $totalNilai = ($total1 * 50 / 100) + ($total2 * 50 / 100);
                                                    $totalAkhir += $totalNilai;
                                                @endphp
                                                {{ number_format($totalNilai, 2) }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">4.</td>
                                            <td class="text-center">{{ $pengajuan->jadwal->penguji2->name }}</td>
                                            <td class="text-center" style="font-weight: bold;">{{ $pengajuan->mahasiswa->user->sempro->penilaianSempros()->where('user_id', $pengajuan->jadwal->penguji_2)->first()->media_presentasi ?? '-' }}</td>
                                            <td class="text-center" style="font-weight: bold;">{{ $pengajuan->mahasiswa->user->sempro->penilaianSempros()->where('user_id', $pengajuan->jadwal->penguji_2)->first()->komunikasi ?? '-' }}</td>
                                            <td class="text-center" style="font-weight: bold;">{{ $pengajuan->mahasiswa->user->sempro->penilaianSempros()->where('user_id', $pengajuan->jadwal->penguji_2)->first()->penguasaan_materi ?? '-' }}</td>
                                            <td class="text-center" style="font-weight: bold;">{{ $pengajuan->mahasiswa->user->sempro->penilaianSempros()->where('user_id', $pengajuan->jadwal->penguji_2)->first()->isi_laporan_ta ?? '-' }}</td>
                                            <td class="text-center" style="font-weight: bold;">{{ $pengajuan->mahasiswa->user->sempro->penilaianSempros()->where('user_id', $pengajuan->jadwal->penguji_2)->first()->struktur_penulisan ?? '-' }}</td>
                                            <td class="text-center" style="font-weight: bold;">
                                                @php
                                                    $totalNilai = 0;
                                                    $nilai = $pengajuan->mahasiswa->user->sempro->penilaianSempros()->where('user_id', $pengajuan->jadwal->penguji_2)->first();
                                                    
                                                    $total1 = 0;
                                                    $total1 += ($nilai->media_presentasi ?? 0) * 20 / 100;
                                                    $total1 += ($nilai->komunikasi ?? 0) * 40 / 100;
                                                    $total1 += ($nilai->penguasaan_materi ?? 0) * 40 / 100;

                                                    $total2 = 0;
                                                    $total2 += ($nilai->isi_laporan_ta ?? 0) * 60 / 100;
                                                    $total2 += ($nilai->struktur_penulisan ?? 0) * 40 / 100;

                                                    $totalNilai = ($total1 * 50 / 100) + ($total2 * 50 / 100);
                                                    $totalAkhir += $totalNilai;
                                                @endphp
                                                {{ number_format($totalNilai, 2) }}
                                            </td>
                                        </tr>
                                        @else 
                                        <tr>
                                            <td colspan="8">Belum ada penilaian</td>
                                        </tr>
                                        @endif
                                        <tr>
                                            <td colspan="7" class="text-end"><b>TOTAL</b></td>
                                            <td><b>{{ number_format($totalAkhir / 4, 2) }}</b></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Penilaian Sidang TA</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive p-0">
                            <div class="table-responsive mb-4">
                                <table class="table align-middle datatable dt-responsive table-check nowrap" style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th rowspan="2" style="width: 50px;vertical-align:middle" class="text-center">No</th>
                                            <th rowspan="2" style="vertical-align:middle" class="text-center">Nama</th>
                                            <th style="vertical-align:top" colspan="3" class="text-center">Komponen Penilaian Presentasi</th>
                                            <th style="vertical-align:top" colspan="2" class="text-center">Komponen Penilaian Proposal</th>
                                            <th style="vertical-align:top" class="text-center">Komponen Penilaian Kinerja</th>
                                            <th></th>
                                        </tr>
                                        <tr>
                                            <th style="vertical-align:top" scope="col" class="text-center">Media Presentasi / Power Point</th>
                                            <th style="vertical-align:top" scope="col" class="text-center">Komunikasi dalam presentasi</th>
                                            <th style="vertical-align:top" scope="col" class="text-center">Penguasaan Materi</th>
                                            <th style="vertical-align:top" scope="col" class="text-center">Isi Laporan TA</th>
                                            <th style="vertical-align:top" scope="col" class="text-center">Struktur dan Tata Cara Penulisan Proposal</th>
                                            <th style="vertical-align:top" scope="col" class="text-center">Sikap dan Kinerja</th>
                                            <th style="vertical-align:top" scope="col" class="text-center">Total</th>
                                          </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $totalAkhir = 0;
                                        @endphp
                                        @if($nilaiSidang)
                                        <tr>
                                            <td class="text-center">1.</td>
                                            <td class="text-center">{{ $pengajuan->pembimbing1->name }}</td>
                                            <td class="text-center" style="font-weight: bold;">{{ $pengajuan->mahasiswa->user->sidang->penilaianSidang()->where('user_id', $pengajuan->pembimbing_1)->first()->media_presentasi ?? '-' }}</td>
                                            <td class="text-center" style="font-weight: bold;">{{ $pengajuan->mahasiswa->user->sidang->penilaianSidang()->where('user_id', $pengajuan->pembimbing_1)->first()->komunikasi ?? '-' }}</td>
                                            <td class="text-center" style="font-weight: bold;">{{ $pengajuan->mahasiswa->user->sidang->penilaianSidang()->where('user_id', $pengajuan->pembimbing_1)->first()->penguasaan_materi ?? '-' }}</td>
                                            <td class="text-center" style="font-weight: bold;">{{ $pengajuan->mahasiswa->user->sidang->penilaianSidang()->where('user_id', $pengajuan->pembimbing_1)->first()->isi_laporan_ta ?? '-' }}</td>
                                            <td class="text-center" style="font-weight: bold;">{{ $pengajuan->mahasiswa->user->sidang->penilaianSidang()->where('user_id', $pengajuan->pembimbing_1)->first()->struktur_penulisan ?? '-' }}</td>
                                            <td class="text-center" style="font-weight: bold;">{{ $pengajuan->mahasiswa->user->sidang->penilaianSidang()->where('user_id', $pengajuan->pembimbing_1)->first()->sikap_kinerja ?? '-' }}</td>
                                            <td class="text-center" style="font-weight: bold;">
                                                @php
                                                    $totalNilai = 0;
                                                    $nilai = $pengajuan->mahasiswa->user->sidang->penilaianSidang()->where('user_id', $pengajuan->pembimbing_1)->first();
                                                    
                                                    $total1 = 0;
                                                    $total1 += ($nilai->media_presentasi ?? 0) * 20 / 100;
                                                    $total1 += ($nilai->komunikasi ?? 0) * 40 / 100;
                                                    $total1 += ($nilai->penguasaan_materi ?? 0) * 40 / 100;

                                                    $total2 = 0;
                                                    $total2 += ($nilai->isi_laporan_ta ?? 0) * 60 / 100;
                                                    $total2 += ($nilai->struktur_penulisan ?? 0) * 40 / 100;

                                                    $totalNilai = ($total1 * 33 / 100) + ($total2 * 34 / 100) + (($nilai->sikap_kinerja ?? 0) * 33 / 100);
                                                    $totalAkhir += $totalNilai;
                                                @endphp
                                                {{ number_format($totalNilai, 2) }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">2.</td>
                                            <td class="text-center">{{ $pengajuan->pembimbing2->name }}</td>
                                            <td class="text-center" style="font-weight: bold;">{{ $pengajuan->mahasiswa->user->sidang->penilaianSidang()->where('user_id', $pengajuan->pembimbing_2)->first()->media_presentasi ?? '-' }}</td>
                                            <td class="text-center" style="font-weight: bold;">{{ $pengajuan->mahasiswa->user->sidang->penilaianSidang()->where('user_id', $pengajuan->pembimbing_2)->first()->komunikasi ?? '-' }}</td>
                                            <td class="text-center" style="font-weight: bold;">{{ $pengajuan->mahasiswa->user->sidang->penilaianSidang()->where('user_id', $pengajuan->pembimbing_2)->first()->penguasaan_materi ?? '-' }}</td>
                                            <td class="text-center" style="font-weight: bold;">{{ $pengajuan->mahasiswa->user->sidang->penilaianSidang()->where('user_id', $pengajuan->pembimbing_2)->first()->isi_laporan_ta ?? '-' }}</td>
                                            <td class="text-center" style="font-weight: bold;">{{ $pengajuan->mahasiswa->user->sidang->penilaianSidang()->where('user_id', $pengajuan->pembimbing_2)->first()->struktur_penulisan ?? '-' }}</td>
                                            <td class="text-center" style="font-weight: bold;">{{ $pengajuan->mahasiswa->user->sidang->penilaianSidang()->where('user_id', $pengajuan->pembimbing_2)->first()->sikap_kinerja ?? '-' }}</td>
                                            <td class="text-center" style="font-weight: bold;">
                                                @php
                                                    $totalNilai = 0;
                                                    $nilai = $pengajuan->mahasiswa->user->sidang->penilaianSidang()->where('user_id', $pengajuan->pembimbing_2)->first();
                                                    
                                                    $total1 = 0;
                                                    $total1 += ($nilai->media_presentasi ?? 0) * 20 / 100;
                                                    $total1 += ($nilai->komunikasi ?? 0) * 40 / 100;
                                                    $total1 += ($nilai->penguasaan_materi ?? 0) * 40 / 100;

                                                    $total2 = 0;
                                                    $total2 += ($nilai->isi_laporan_ta ?? 0) * 60 / 100;
                                                    $total2 += ($nilai->struktur_penulisan ?? 0) * 40 / 100;

                                                    $totalNilai = ($total1 * 33 / 100) + ($total2 * 34 / 100) + (($nilai->sikap_kinerja ?? 0) * 33 / 100);
                                                    $totalAkhir += $totalNilai;
                                                @endphp
                                                {{ number_format($totalNilai, 2) }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">3.</td>
                                            <td class="text-center">{{ $pengajuan->jadwal->penguji1->name }}</td>
                                            <td class="text-center" style="font-weight: bold;">{{ $pengajuan->mahasiswa->user->sidang->penilaianSidang()->where('user_id', $pengajuan->jadwal->penguji_1)->first()->media_presentasi ?? '-' }}</td>
                                            <td class="text-center" style="font-weight: bold;">{{ $pengajuan->mahasiswa->user->sidang->penilaianSidang()->where('user_id', $pengajuan->jadwal->penguji_1)->first()->komunikasi ?? '-' }}</td>
                                            <td class="text-center" style="font-weight: bold;">{{ $pengajuan->mahasiswa->user->sidang->penilaianSidang()->where('user_id', $pengajuan->jadwal->penguji_1)->first()->penguasaan_materi ?? '-' }}</td>
                                            <td class="text-center" style="font-weight: bold;">{{ $pengajuan->mahasiswa->user->sidang->penilaianSidang()->where('user_id', $pengajuan->jadwal->penguji_1)->first()->isi_laporan_ta ?? '-' }}</td>
                                            <td class="text-center" style="font-weight: bold;">{{ $pengajuan->mahasiswa->user->sidang->penilaianSidang()->where('user_id', $pengajuan->jadwal->penguji_1)->first()->struktur_penulisan ?? '-' }}</td>
                                            <td class="text-center" style="font-weight: bold;"></td>
                                            <td class="text-center" style="font-weight: bold;">
                                                @php
                                                    $totalNilai = 0;
                                                    $nilai = $pengajuan->mahasiswa->user->sidang->penilaianSidang()->where('user_id', $pengajuan->jadwal->penguji_1)->first();
                                                    
                                                    $total1 = 0;
                                                    $total1 += ($nilai->media_presentasi ?? 0) * 20 / 100;
                                                    $total1 += ($nilai->komunikasi ?? 0) * 40 / 100;
                                                    $total1 += ($nilai->penguasaan_materi ?? 0) * 40 / 100;

                                                    $total2 = 0;
                                                    $total2 += ($nilai->isi_laporan_ta ?? 0) * 60 / 100;
                                                    $total2 += ($nilai->struktur_penulisan ?? 0) * 40 / 100;

                                                    $totalNilai = ($total1 * 50 / 100) + ($total2 * 50 / 100);
                                                    $totalAkhir += $totalNilai;
                                                @endphp
                                                {{ number_format($totalNilai, 2) }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">4.</td>
                                            <td class="text-center">{{ $pengajuan->jadwal->penguji2->name }}</td>
                                            <td class="text-center" style="font-weight: bold;">{{ $pengajuan->mahasiswa->user->sidang->penilaianSidang()->where('user_id', $pengajuan->jadwal->penguji_2)->first()->media_presentasi ?? '-' }}</td>
                                            <td class="text-center" style="font-weight: bold;">{{ $pengajuan->mahasiswa->user->sidang->penilaianSidang()->where('user_id', $pengajuan->jadwal->penguji_2)->first()->komunikasi ?? '-' }}</td>
                                            <td class="text-center" style="font-weight: bold;">{{ $pengajuan->mahasiswa->user->sidang->penilaianSidang()->where('user_id', $pengajuan->jadwal->penguji_2)->first()->penguasaan_materi ?? '-' }}</td>
                                            <td class="text-center" style="font-weight: bold;">{{ $pengajuan->mahasiswa->user->sidang->penilaianSidang()->where('user_id', $pengajuan->jadwal->penguji_2)->first()->isi_laporan_ta ?? '-' }}</td>
                                            <td class="text-center" style="font-weight: bold;">{{ $pengajuan->mahasiswa->user->sidang->penilaianSidang()->where('user_id', $pengajuan->jadwal->penguji_2)->first()->struktur_penulisan ?? '-' }}</td>
                                            <td class="text-center" style="font-weight: bold;"></td>
                                            <td class="text-center" style="font-weight: bold;">
                                                @php
                                                    $totalNilai = 0;
                                                    $nilai = $pengajuan->mahasiswa->user->sidang->penilaianSidang()->where('user_id', $pengajuan->jadwal->penguji_2)->first();
                                                    
                                                    $total1 = 0;
                                                    $total1 += ($nilai->media_presentasi ?? 0) * 20 / 100;
                                                    $total1 += ($nilai->komunikasi ?? 0) * 40 / 100;
                                                    $total1 += ($nilai->penguasaan_materi ?? 0) * 40 / 100;

                                                    $total2 = 0;
                                                    $total2 += ($nilai->isi_laporan_ta ?? 0) * 60 / 100;
                                                    $total2 += ($nilai->struktur_penulisan ?? 0) * 40 / 100;

                                                    $totalNilai = ($total1 * 50 / 100) + ($total2 * 50 / 100);
                                                    $totalAkhir += $totalNilai;
                                                @endphp
                                                {{ number_format($totalNilai, 2) }}
                                            </td>
                                        </tr>
                                        @else
                                        <tr>
                                            <td colspan="9">Belum ada penilaian</td>
                                        </tr>
                                        @endif
                                        <tr>
                                            <td colspan="8" class="text-end"><b>TOTAL</b></td>
                                            <td><b>{{ number_format($totalAkhir / 4, 2) }}</b></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

            </div>
        </div>
    </div>
</div>