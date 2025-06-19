@extends('layouts.surat')
@section('title', 'Form TA-007')

@section('content')
<!-- Tahap 1 -->
<div>

    @include('pdf.section.header')

    <div style="top:10px; padding-left: 10px;">
        <div class="row">
            <div class="col-12">
                <table width="100%">
                    <tr>
                        <td class="text-end"><b>Form. TA-007</b></td>
                    </tr>
                </table>
                <table width="100%" class="mt-4">
                    <tr class="text-center">
                        <td class="text-center"><b>FORMULIR PERSETUJUAN SIDANG TUGAS AKHIR</b></td>
                    </tr>
                </table>
                <table width="100%" class="mt-5">
                    <tr>
                        <td colspan="4" style="padding:10px">Saya yang bertanda tangan dibawah ini, menerangkan bahwa pemohon adalah mahasiswa:</td>
                    </tr>
                    <tr>
                        <td width="5%" style="padding-top:5px"></td>
                        <td width="20%">Nama</td>
                        <td width="2%" >:</td>
                        <td> {{ $pengajuan->mahasiswa->nama }}</td>
                    </tr>
                    <tr>
                        <td style="padding-top:10px;"></td>
                        <td style="padding-top:10px;">NIM</td>
                        <td>:</td>
                        <td> {{ $pengajuan->mahasiswa->nim }}</td>
                    </tr>
                    <tr>
                        <td style="padding-top:10px;"></td>
                        <td style="padding-top:10px;">Program Studi</td>
                        <td>:</td>
                        <td> Sistem Informasi</td>
                    </tr>
                    <tr>
                        <td style="padding-top:10px;"></td>
                        <td style="padding-top:10px;">Jurusan</td>
                        <td>:</td>
                        <td> Teknik Elektro Informatika dan Bisnis</td>
                    </tr>
                    <tr>
                        <td style="padding-top:10px;"></td>
                        <td style="padding-top:10px;">Tema Penelitian</td>
                        <td>:</td>
                        <td> {{ $pengajuan->bidang_penelitian }}</td>
                    </tr>
                    <tr>
                        <td colspan="4" style="padding:10px">telah menyelesaikan tugas akhir dan menyusun draft Laporan TA serta dinilai layak untuk mengikuti Sidang Tugas Akhir dengan mengajukan:</td>
                    </tr>
                    <tr>
                        <td width="5%" style="padding-top:5px"></td>
                        <td width="20%"style="vertical-align: top;">Judul TA</td>
                        <td width="2%" style="vertical-align: top;">:</td>
                        <td> {{ $pengajuan->judul }}</td>
                    </tr>
                    <tr>
                        <td colspan="4" style="padding-top:18px;text-align:justify;">Demikian persetujuan ini dibuat untuk dipergunakan sebagaimana mestinya.</td>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-end" style="padding-top: 25px;">Balikpapan, {{ \Carbon\Carbon::now()->isoFormat('D MMMM Y') }}</td>
                    </tr>
                </table>

                <table width="100%" style="margin-top:40px;">
                    <tr>
                        <td style="text-align:center">Dosen Pembimbing Utama</td>
                        <td style="text-align:center">Dosen Pembimbing Pendamping</td>
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
                        <td style="text-align:center;padding-top: 120px;">({{ $pengajuan->pembimbing1->dosen->nama_dosen }})</td>
                        <td style="text-align:center;padding-top: 120px;">({{ $pengajuan->pembimbing2->dosen->nama_dosen }})</td>
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