@extends('layouts.surat')
@section('title', 'Form TA-004')

@section('style')
@endsection

@section('content')
<!-- Tahap 1 -->
<div>

    @foreach($jadwals as $jadwal)
        @if($jadwal->user->sempro->penilaianSempros()->count() > 0)
        @include('pdf.section.header')

        <div style="top:10px; padding-left: 10px;">
            <div class="row">
                <div class="col-12">
                    <table width="100%">
                        <tr>
                            <td class="text-end"><b>Form. TA-004</b></td>
                        </tr>
                    </table>
                    <table width="100%" class="mt-4">
                        <tr class="text-center">
                            <td class="text-center"><b>BERITA ACARA SEMINAR PROPOSAL TUGAS AKHIR</b></td>
                        </tr>
                    </table>
                    <table width="100%" class="mt-2">
                        <tr>
                            <td colspan="4" style="padding:10px;line-height: 25px;">Pada hari {{ \Carbon\Carbon::parse($jadwal->tanggal_sempro)->isoFormat('dddd') }}, tanggal {{\Carbon\Carbon::parse($jadwal->tanggal_sempro)->isoFormat('D MMMM YYYY') }}, pada pukul {{ $jadwal->waktu_mulai }} s/d {{ $jadwal->waktu_selesai }}, WITA, telah dilaksanakan Seminar Proposal TA di Kampus Institut Teknologi Kalimantan atas nama :</td>
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
                            <td> Sistem Informasi / Teknik Elektro Informatika dan Bisnis</td>
                        </tr>
                        <tr>
                            <td style="padding-top:10px;"></td>
                            <td style="padding-top:10px;vertical-align: top;">Judul TA</td>
                            <td style="vertical-align: top;">:</td>
                            <td> {{ $jadwal->user->mahasiswa->pengajuanTA->judul }}</td>
                        </tr>
                        <tr>
                            <td style="padding-top:10px;"></td>
                            <td style="padding-top:10px;">Tema Penelitian</td>
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
                            <td colspan="4" style="padding:10px;line-height: 25px;">Berdasarkan hasil kepuasan Tim Penguji Seminar Proposal TA, maka proposal TA dari mahasiswa tersebut dinyatakan :</td>
                        </tr>
                    </table>
                    <table width="100%" class="mt-2 mb-2">
                        <tr>
                            <td width="33%" style="text-align: center">
                                <div>
                                    <input type="checkbox" style="transform: scale(2);">
                                    <span style="font-size: 110%;margin-left: 10px;vertical-align: top;">Diterima</span>
                                </div>
                            </td>
                            <td width="34%" style="text-align: center">
                                <div>
                                    <input type="checkbox" style="transform: scale(2);" @if(NilaiHelper::countNilaiSempro($jadwal->user->sempro->penilaianSempros()->get()) > 51) checked @endif>
                                    <span style="font-size: 110%;margin-left: 10px;vertical-align: top;">Diterima dengan revisi</span>
                                </div>
                            </td>
                            <td width="33%" style="text-align: center">
                                <div>
                                    <input type="checkbox" style="transform: scale(2);" @if(NilaiHelper::countNilaiSempro($jadwal->user->sempro->penilaianSempros()->get()) < 51) checked @endif>
                                    <span style="font-size: 110%;margin-left: 10px;vertical-align: top;">Tidak Diterima</span>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <table style="border: 1px solid #000; border-collapse: collapse; width: 100%;">
                        <thead>
                            <tr style="border: 1px solid #000;text-align:center">
                                <th width="10%" style="font-weight: normal;border: 1px solid #000;padding:5px">NO</th>
                                <th width="50%" style="font-weight: normal;border: 1px solid #000;padding:5px">NAMA TIM PENGUJI</th>
                                <th width="20%" style="font-weight: normal;border: 1px solid #000;padding:5px">NILAI</th>
                                <th width="20%" style="font-weight: normal;border: 1px solid #000;padding:5px;white-space:pre-wrap">TTD</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="border: 1px solid #000;">
                                <td style="border: 1px solid #000;padding:5px;text-align:center;">1.</td>
                                <td style="border: 1px solid #000;padding:5px">{{ $jadwal->user->mahasiswa->pengajuanTA->pembimbing1->name }}</td>
                                <td style="border: 1px solid #000;padding:5px;text-align:center;">{{ number_format(NilaiHelper::countNilai($jadwal->user->sempro->penilaianSempros()->get(), $jadwal->user->mahasiswa->pengajuanTA->pembimbing1->id), 2) }}</td>
                                <td style="border: 1px solid #000;padding:5px;text-align:center;">
                                    @if(isset($jadwal->user->mahasiswa->pengajuanTA->pembimbing1->signature) && $jadwal->user->mahasiswa->pengajuanTA->pembimbing1->signature)
                                        <img src="{{ storage_path('app/public/' . $jadwal->user->mahasiswa->pengajuanTA->pembimbing1->signature) }}" alt="" style="width: 80px;">
                                    @else
                                        <div style="border: 1px solid #000; width: 80px; height: 40px; text-align: center; line-height: 40px; font-size: 10px;">
                                            [TTD 1]
                                        </div>
                                    @endif
                                </td>
                            </tr>
                            <tr style="border: 1px solid #000;">
                                <td style="border: 1px solid #000;padding:5px;text-align:center;">2.</td>
                                <td style="border: 1px solid #000;padding:5px">{{ $jadwal->user->mahasiswa->pengajuanTA->pembimbing2->name }}</td>
                                <td style="border: 1px solid #000;padding:5px;text-align:center;">{{ number_format(NilaiHelper::countNilai($jadwal->user->sempro->penilaianSempros()->get(), $jadwal->user->mahasiswa->pengajuanTA->pembimbing2->id), 2) }}</td>
                                <td style="border: 1px solid #000;padding:5px;text-align:center;">
                                    @if(isset($jadwal->user->mahasiswa->pengajuanTA->pembimbing2->signature) && $jadwal->user->mahasiswa->pengajuanTA->pembimbing2->signature)
                                        <img src="{{ storage_path('app/public/' . $jadwal->user->mahasiswa->pengajuanTA->pembimbing2->signature) }}" alt="" style="width: 80px;">
                                    @else
                                        <div style="border: 1px solid #000; width: 80px; height: 40px; text-align: center; line-height: 40px; font-size: 10px;">
                                            [TTD 2]
                                        </div>
                                    @endif
                                </td>
                            </tr>
                            <tr style="border: 1px solid #000;">
                                <td style="border: 1px solid #000;padding:5px;text-align:center;">3.</td>
                                <td style="border: 1px solid #000;padding:5px">{{ $jadwal->penguji1->name }}</td>
                                <td style="border: 1px solid #000;padding:5px;text-align:center;">{{ number_format(NilaiHelper::countNilai($jadwal->user->sempro->penilaianSempros()->get(), $jadwal->penguji1->id), 2) }}</td>
                                <td style="border: 1px solid #000;padding:5px;text-align:center;">
                                    @if(isset($jadwal->penguji1->signature) && $jadwal->penguji1->signature)
                                        <img src="{{ storage_path('app/public/' . $jadwal->penguji1->signature) }}" alt="" style="width: 80px;">
                                    @else
                                        <div style="border: 1px solid #000; width: 80px; height: 40px; text-align: center; line-height: 40px; font-size: 10px;">
                                            [TTD P1]
                                        </div>
                                    @endif
                                </td>
                            </tr>
                            <tr style="border: 1px solid #000;">
                                <td style="border: 1px solid #000;padding:5px;text-align:center;">4.</td>
                                <td style="border: 1px solid #000;padding:5px">{{ $jadwal->penguji2->name }}</td>
                                <td style="border: 1px solid #000;padding:5px;text-align:center;">{{ number_format(NilaiHelper::countNilai($jadwal->user->sempro->penilaianSempros()->get(), $jadwal->penguji2->id), 2) }}</td>
                                <td style="border: 1px solid #000;padding:5px;text-align:center;">
                                    @if(isset($jadwal->penguji2->signature) && $jadwal->penguji2->signature)
                                        <img src="{{ storage_path('app/public/' . $jadwal->penguji2->signature) }}" alt="" style="width: 80px;">
                                    @else
                                        <div style="border: 1px solid #000; width: 80px; height: 40px; text-align: center; line-height: 40px; font-size: 10px;">
                                            [TTD P2]
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <table width="100%" style="margin-top:10px;">
                        <tr>
                            <td colspan="2" class="text-start" style="padding: 10px;">Demikian berita acara ini dibuat dengan sebenarnya.</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-end" style="padding-top: 25px; padding-right: 80px;">Balikpapan, {{ \Carbon\Carbon::now()->isoFormat('D MMMM Y') }}</td>
                        </tr>
                        <tr>
                            <td width="50%" style="text-align:center"></td>
                            <td width="50%" style="text-align:center; padding-top: 30px;">Ketua Tim Penguji</td>
                        </tr>
                        <tr>
                            <td style="text-align:center"></td>
                            <td style="text-align:center; padding: 2px 0;">
                                @if(isset($jadwal->penguji1->signature) && $jadwal->penguji1->signature)
                                    <img src="{{ storage_path('app/public/' . $jadwal->penguji1->signature) }}" alt="" style="width: 150px; height: auto;">
                                @else
                                    <div style="width: 150px; height: 80px; border: 1px solid #000; text-align: center; line-height: 80px; font-size: 12px; margin: 0 auto;">
                                        [Tanda Tangan Penguji 1]
                                    </div>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align:center"></td>
                            <td style="text-align:center; padding-top: 5px;">
                                <strong>({{ $jadwal->penguji1->name }})</strong>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align:center"></td>
                            <td style="text-align:center; padding-top: 2px;">
                                NIP. {{ $jadwal->penguji1->dosen ? $jadwal->penguji1->dosen->nip : '-' }}
                            </td>
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

