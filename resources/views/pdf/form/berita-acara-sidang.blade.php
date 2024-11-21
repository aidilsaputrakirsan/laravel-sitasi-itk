@extends('layouts.surat')
@section('title', 'Form TA-011')

@section('style')
@endsection

@section('content')
<!-- Tahap 1 -->
<div>

    @foreach($jadwals as $jadwal)
        @if($jadwal->user->sidang->penilaianSidang()->count() > 0 && $jadwal->user->sidang->status === 'Diterima')
        @include('pdf.section.header')

        <div style="top:10px; padding-left: 10px;">
            <div class="row">
                <div class="col-12">
                    <table width="100%">
                        <tr>
                            <td class="text-end"><b>Form. TA-011</b></td>
                        </tr>
                    </table>
                    <table width="100%" class="mt-4">
                        <tr class="text-center">
                            <td class="text-center"><b>BERITA ACARA SIDANG TUGAS AKHIR</b></td>
                        </tr>
                    </table>
                    <table width="100%" class="mt-2">
                        <tr>
                            <td colspan="4" style="padding:10px;line-height: 25px;">Pada hari {{ \Carbon\Carbon::parse($jadwal->tanggal_sidang)->isoFormat('dddd') }}, tanggal {{\Carbon\Carbon::parse($jadwal->tanggal_sidang)->isoFormat('D MMMM YYYY') }}, pada pukul {{ $jadwal->waktu_mulai }} s/d {{ $jadwal->waktu_selesai }}, WITA, telah dilaksanakan Sidang TA di Kampus Institut Teknologi Kalimantan atas nama :</td>
                        </tr>
                        <tr>
                            <td width="5%" style="padding-top:5px"></td>
                            <td width="30%">Nama / NIM</td>
                            <td width="2%" >:</td>
                            <td> {{ $jadwal->user->mahasiswa->nama }} / {{ $jadwal->user->mahasiswa->nim }}</td>
                        </tr>
                        <tr>
                            <td style="padding-top:10px;"></td>
                            <td style="padding-top:10px;">Program Studi / Jurusan</td>
                            <td>:</td>
                            <td> Sistem Informasi / Matematikan dan Teknologi Informasi</td>
                        </tr>
                        <tr>
                            <td style="padding-top:10px;"></td>
                            <td style="padding-top:10px;vertical-align: top;">Judul TA</td>
                            <td style="vertical-align: top;">:</td>
                            <td> {{ $jadwal->user->mahasiswa->pengajuanTA->judul }}</td>
                        </tr>
                        <tr>
                            <td style="padding-top:10px;"></td>
                            <td style="padding-top:10px;">Bidang Konsentrasi Penelitian</td>
                            <td>:</td>
                            <td> {{ $jadwal->user->mahasiswa->pengajuanTA->bidang_penelitian }}</td>
                        </tr>
                        <tr>
                            <td style="padding-top:10px;"></td>
                            <td style="padding-top:10px;">Dosen Pembimbing Utama</td>
                            <td>:</td>
                            <td> {{ $jadwal->user->mahasiswa->pengajuanTA->pembimbing1->name }}</td>
                        </tr>
                        <tr>
                            <td style="padding-top:10px;"></td>
                            <td style="padding-top:10px;">Dosen Pembimbing Pendamping</td>
                            <td>:</td>
                            <td> {{ $jadwal->user->mahasiswa->pengajuanTA->pembimbing2->name }}</td>
                        </tr>
                        <tr>
                            <td colspan="4" style="padding:10px;line-height: 25px;">Berdasarkan hasil keputusan Tim Penguji Sidang TA pada hasil Laporan TA, mahasiswa tersebut dinyatakan :</td>
                        </tr>
                    </table>
                    <table width="100%" class="mt-2 mb-2">
                        <tr>
                            <td width="33%" style="text-align: center">
                                <div>
                                    <input type="checkbox" style="transform: scale(2);">
                                    <span style="font-size: 110%;margin-left: 10px;vertical-align: top;">Lulus</span>
                                </div>
                            </td>
                            <td width="34%" style="text-align: center">
                                <div>
                                    <input type="checkbox" style="transform: scale(2);" @if(NilaiHelper::countNilaiSempro($jadwal->user->sidang->penilaianSidang()->get()) > 51) checked @endif>
                                    <span style="font-size: 110%;margin-left: 10px;vertical-align: top;">Lulus dengan revisi</span>
                                </div>
                            </td>
                            <td width="33%" style="text-align: center">
                                <div>
                                    <input type="checkbox" style="transform: scale(2);" @if(NilaiHelper::countNilaiSempro($jadwal->user->sidang->penilaianSidang()->get()) < 51) checked @endif>
                                    <span style="font-size: 110%;margin-left: 10px;vertical-align: top;">Tidak Lulus</span>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <table style="border: 1px solid #000; border-collapse: collapse; width: 100%;">
                        <thead>
                            <tr style="border: 1px solid #000;text-align:center">
                                <th width="10%" style="font-weight: normal;border: 1px solid #000;padding:5px">NO</th>
                                <th width="50%" style="font-weight: normal;border: 1px solid #000;padding:5px">NAMA TIM PENGUJI</th>
                                <th width="20%" style="font-weight: normal;border: 1px solid #000;padding:5px">Proposal TA (40%)</th>
                                <th width="20%" style="font-weight: normal;border: 1px solid #000;padding:5px">Sidang TA (60%)</th>
                                <th width="20%" style="font-weight: normal;border: 1px solid #000;padding:5px">Total (100%)</th>
                                <th width="20%" style="font-weight: normal;border: 1px solid #000;padding:5px;white-space:pre-wrap">TTD</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="border: 1px solid #000;">
                                <td style="border: 1px solid #000;padding:5px;text-align:center;">1.</td>
                                <td style="border: 1px solid #000;padding:5px">{{ $jadwal->user->mahasiswa->pengajuanTA->jadwal->penguji1->name }}</td>
                                <td style="border: 1px solid #000;padding:5px;text-align:center;">{{ number_format(NilaiHelper::countNilaiProposal($jadwal->user->sempro->penilaianSempros()->get(), $jadwal->user->mahasiswa->pengajuanTA->jadwal->penguji1->id), 2) }}</td>
                                <td style="border: 1px solid #000;padding:5px;text-align:center;">{{ number_format(NilaiHelper::countNilaiSidangTA($jadwal->user->sidang->penilaianSidang()->get(), $jadwal->user->mahasiswa->pengajuanTA->jadwal->penguji1->id), 2) }}</td>
                                <td style="border: 1px solid #000;padding:5px;text-align:center;">{{ number_format(NilaiHelper::countTotalSidang($jadwal->user->sempro->penilaianSempros()->get(), $jadwal->user->sidang->penilaianSidang()->get(), $jadwal->user->mahasiswa->pengajuanTA->jadwal->penguji1->id), 2) }}</td>
                                <td style="border: 1px solid #000;padding:5px;text-align:center;">
                                    @if($jadwal->user->mahasiswa->pengajuanTA->jadwal->penguji1->signature !== null)
                                        <img src="{{ Storage::disk('s3')->url($jadwal->user->mahasiswa->pengajuanTA->jadwal->penguji1->signature) }}" alt="" style="width: 80px;">
                                    @endif
                                </td>
                            </tr>
                            <tr style="border: 1px solid #000;">
                                <td style="border: 1px solid #000;padding:5px;text-align:center;">2.</td>
                                <td style="border: 1px solid #000;padding:5px">{{ $jadwal->user->mahasiswa->pengajuanTA->jadwal->penguji2->name }}</td>
                                <td style="border: 1px solid #000;padding:5px;text-align:center;">{{ number_format(NilaiHelper::countNilaiProposal($jadwal->user->sempro->penilaianSempros()->get(), $jadwal->user->mahasiswa->pengajuanTA->jadwal->penguji2->id), 2) }}</td>
                                <td style="border: 1px solid #000;padding:5px;text-align:center;">{{ number_format(NilaiHelper::countNilaiSidangTA($jadwal->user->sidang->penilaianSidang()->get(), $jadwal->user->mahasiswa->pengajuanTA->jadwal->penguji2->id), 2) }}</td>
                                <td style="border: 1px solid #000;padding:5px;text-align:center;">{{ number_format(NilaiHelper::countTotalSidang($jadwal->user->sempro->penilaianSempros()->get(), $jadwal->user->sidang->penilaianSidang()->get(), $jadwal->user->mahasiswa->pengajuanTA->jadwal->penguji2->id), 2) }}</td>
                                <td style="border: 1px solid #000;padding:5px;text-align:center;">
                                    @if($jadwal->user->mahasiswa->pengajuanTA->jadwal->penguji2->signature !== null)
                                        <img src="{{ Storage::disk('s3')->url($jadwal->user->mahasiswa->pengajuanTA->jadwal->penguji2->signature) }}" alt="" style="width: 80px;">
                                    @endif
                                </td>
                            </tr>
                            <tr style="border: 1px solid #000;">
                                <td style="border: 1px solid #000;padding:5px;text-align:center;">3.</td>
                                <td style="border: 1px solid #000;padding:5px">{{ $jadwal->user->mahasiswa->pengajuanTA->pembimbing1->name }}</td>
                                <td style="border: 1px solid #000;padding:5px;text-align:center;">{{ number_format(NilaiHelper::countNilaiProposal($jadwal->user->sempro->penilaianSempros()->get(), $jadwal->user->mahasiswa->pengajuanTA->pembimbing1->id), 2) }}</td>
                                <td style="border: 1px solid #000;padding:5px;text-align:center;">{{ number_format(NilaiHelper::countNilaiSidangTA($jadwal->user->sidang->penilaianSidang()->get(), $jadwal->user->mahasiswa->pengajuanTA->pembimbing1->id), 2) }}</td>
                                <td style="border: 1px solid #000;padding:5px;text-align:center;">{{ number_format(NilaiHelper::countTotalSidang($jadwal->user->sempro->penilaianSempros()->get(), $jadwal->user->sempro->penilaianSempros()->get(), $jadwal->user->mahasiswa->pengajuanTA->pembimbing1->id), 2) }}</td>
                                <td style="border: 1px solid #000;padding:5px;text-align:center;">
                                    @if($jadwal->user->mahasiswa->pengajuanTA->pembimbing1->signature !== null)
                                        <img src="{{ Storage::disk('s3')->url($jadwal->user->mahasiswa->pengajuanTA->pembimbing1->signature) }}" alt="" style="width: 80px;">
                                    @endif
                                </td>
                            </tr>
                            <tr style="border: 1px solid #000;">
                                <td style="border: 1px solid #000;padding:5px;text-align:center;">4.</td>
                                <td style="border: 1px solid #000;padding:5px">{{ $jadwal->user->mahasiswa->pengajuanTA->pembimbing2->name }}</td>
                                <td style="border: 1px solid #000;padding:5px;text-align:center;">{{ number_format(NilaiHelper::countNilaiProposal($jadwal->user->sempro->penilaianSempros()->get(), $jadwal->user->mahasiswa->pengajuanTA->pembimbing2->id), 2) }}</td>
                                <td style="border: 1px solid #000;padding:5px;text-align:center;">{{ number_format(NilaiHelper::countNilaiSidangTA($jadwal->user->sidang->penilaianSidang()->get(), $jadwal->user->mahasiswa->pengajuanTA->pembimbing2->id), 2) }}</td>
                                <td style="border: 1px solid #000;padding:5px;text-align:center;">{{ number_format(NilaiHelper::countTotalSidang($jadwal->user->sempro->penilaianSempros()->get(), $jadwal->user->sempro->penilaianSempros()->get(), $jadwal->user->mahasiswa->pengajuanTA->pembimbing2->id), 2) }}</td>
                                <td style="border: 1px solid #000;padding:5px;text-align:center;">
                                    @if($jadwal->user->mahasiswa->pengajuanTA->pembimbing2->signature !== null)
                                        <img src="{{ Storage::disk('s3')->url($jadwal->user->mahasiswa->pengajuanTA->pembimbing2->signature) }}" alt="" style="width: 80px;">
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4" style="text-align: right; border: 1px solid #000; padding:5px;"><b>TOTAL AKHIR</b></td>
                                <td style="text-align: center; border: 1px solid #000; padding:5px;">{{ number_format(NilaiHelper::countTotalAkhir($jadwal->user->sempro->penilaianSempros()->get(), $jadwal->user->sidang->penilaianSidang()->get(), $jadwal->user->mahasiswa->pengajuanTA), 2) }}</td>
                                <td style="text-align: center; border: 1px solid #000; padding:5px;"></td>
                            </tr>
                        </tbody>
                    </table>

                    <table width="100%" style="margin-top:10px;">
                        <tr>
                            <td colspan="2" class="text-start" style="padding: 10px;">dengan Nilai Akhir adalah {{ number_format(NilaiHelper::countTotalAkhir($jadwal->user->sempro->penilaianSempros()->get(), $jadwal->user->sidang->penilaianSidang()->get(), $jadwal->user->mahasiswa->pengajuanTA), 2) }}</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-start" style="padding: 10px;">Demikian berita acara ini dibuat dengan sebenarnya.</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-end" style="padding-top: 25px;padding-bottom: 25px;">Balikpapan, {{ \Carbon\Carbon::now()->isoFormat('D MMMM Y') }}</td>
                        </tr>
                        <tr>
                            <td style="text-align:left">CATATAN</td>
                            <td style="text-align:center">Ketua Tim Penguji</td>
                        </tr>
                        <tr>
                            <td>
                                <table>
                                    <tr>
                                        <td colspan="2" style="border-bottom: 1px solid grey"><b>Prosentase Nilai Akhir TA</b></td>
                                    </tr>
                                    <tr>
                                        <td>Seminar Proposal</td>
                                        <td style="text-align: right">40 %</td>
                                    </tr>
                                    <tr>
                                        <td>Sidang TA</td>
                                        <td style="text-align: right">60 %</td>
                                    </tr>
                                </table>
                            </td>
                            <td style="position: relative">
                                @if($jadwal->user->mahasiswa->pengajuanTA->jadwal->penguji1->signature !== null)
                                    <img src="{{ Storage::disk('s3')->url($jadwal->user->mahasiswa->pengajuanTA->jadwal->penguji1->signature) }}" alt="" style="position: absolute;right:130px;margin-top:10px;width:180px">
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td style="text-align:center;padding-top: 90px;">({{ $jadwal->user->mahasiswa->pengajuanTA->jadwal->penguji1->name }})</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td style="text-align:center">NIP/NIPH. {{ $jadwal->user->mahasiswa->pengajuanTA->jadwal->penguji1->dosen->nip }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        @if(count($jadwals) !== $loop->iteration)
        <div class="page-break"></div>
        @endif
        @endif
    @endforeach
</div>
@endsection