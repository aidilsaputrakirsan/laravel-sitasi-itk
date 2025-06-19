@extends('layouts.surat')
@section('title', 'Form TA-008')

@section('content')
<!-- Tahap 1 -->
<div>
    @include('pdf.section.header')

    <div style="top:10px; padding-left: 10px;">
        <div class="row">
            <div class="col-12">
                <table width="100%">
                    <tr>
                        <td class="text-end"><b>Form. TA-008</b></td>
                    </tr>
                </table>
                <table width="100%" class="mt-4">
                    <tr class="text-center">
                        <td class="text-center"><b>FORMULIR PERMOHONAN SIDANG TUGAS AKHIR</b></td>
                    </tr>
                </table>
                <table width="100%" class="mt-5">
                    <tr>
                        <td width="35%">Nama Mahasiswa / NIM</td>
                        <td width="2%">:</td>
                        <td width="63%"> {{ $pengajuan->mahasiswa->nama }} / {{ $pengajuan->mahasiswa->nim }}</td>
                    </tr>
                    <tr>
                        <td style="padding-top:10px;">Program Studi / Jurusan</td>
                        <td style="padding-top:10px;">:</td>
                        <td style="padding-top:10px;"> Sistem Informasi / Teknik Elektro Informatika dan Bisnis</td>
                    </tr>
                    <tr>
                        <td style="padding-top:10px;">Bidang Konsentrasi Penelitian</td>
                        <td style="padding-top:10px;">:</td>
                        <td style="padding-top:10px;">{{ $pengajuan->bidang_penelitian }}</td>
                    </tr>
                    <tr>
                        <td style="padding-top:10px;vertical-align:top">Judul Laporan TA</td>
                        <td style="padding-top:10px;vertical-align:top">:</td>
                        <td style="padding-top:10px;"> {{ $pengajuan->judul }}</td>
                    </tr>
                    <tr>
                        <td style="padding-top:10px;">Dosen Pembimbing Utama</td>
                        <td style="padding-top:10px;">:</td>
                        <td style="padding-top:10px;"> {{ $pengajuan->pembimbing1->dosen->nama_dosen }}</td>
                    </tr>
                    <tr>
                        <td style="padding-top:10px;">Dosen Pembimbing Pendamping</td>
                        <td style="padding-top:10px;">:</td>
                        <td style="padding-top:10px;"> {{ $pengajuan->pembimbing2->dosen->nama_dosen }}</td>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-end" style="padding-top: 20px;">Balikpapan, {{ \Carbon\Carbon::now()->isoFormat('D MMMM Y') }}</td>
                    </tr>
                </table>

                <table width="100%" style="margin-top:10px;">
                    <tr>
                        <td style="text-align: center;" colspan="2">Pemohon,</td>
                    </tr>
                    <tr>
                        <td style="position: relative">
                            @if($pengajuan->mahasiswa->user->signature !== null)
                            <img src="{{ storage_path('app/public/' . $pengajuan->mahasiswa->user->signature) }}" style="position: absolute;left:300px;margin-top:-30px;width:120px;">
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center;padding-top:100px" colspan="2">{{ $pengajuan->mahasiswa->nama }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: center;" colspan="2">NIM. {{ $pengajuan->mahasiswa->nim }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: center;padding-top:20px;padding-bottom:10px;" colspan="2">Mengetahui dan menyetujui,</td>
                    </tr>
                    <tr>
                        <td style="text-align:center">Dosen Pembimbing Utama,</td>
                        <td style="text-align:center">Dosen Pembimbing Pendamping,</td>
                    </tr>
                    <tr>
                        <td style="position: relative">
                            @if($pengajuan->pembimbing1->signature !== null)
                            <img src="{{ storage_path('app/public/' . $pengajuan->pembimbing1->signature) }}" style="position: absolute;left:100px;margin-top:20px;width:120px;">
                            @endif
                        </td>
                        <td style="position: relative">
                            @if($pengajuan->pembimbing2->signature !== null)
                            <img src="{{ storage_path('app/public/' . $pengajuan->pembimbing2->signature) }}" style="position: absolute;right:150px;margin-top:20px;width:120px">
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align:center;padding-top: 120px;">{{ $pengajuan->pembimbing1->dosen->nama_dosen }}</td>
                        <td style="text-align:center;padding-top: 120px;">{{ $pengajuan->pembimbing2->dosen->nama_dosen }}</td>
                    </tr>
                    <tr>
                        <td style="text-align:center">NIP. {{ $pengajuan->pembimbing1->dosen->nip }}</td>
                        <td style="text-align:center">NIP. {{ $pengajuan->pembimbing2->dosen->nip }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection