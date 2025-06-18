@extends('layouts.surat')
@section('title', 'Lembar Kesanggupan Revisi')

@section('content')
<!-- Tahap 1 -->
<div>

    <div style="top:10px; padding-left: 10px;">
        <div class="row">
            <div class="col-12">
                <table width="100%" class="mt-4">
                    <tr class="text-center">
                        <td class="text-center"><b>SURAT PERNYATAAN KESANGGUPAN PENYELESAIAN REVISI TUGAS AKHIR</b></td>
                    </tr>
                </table>
                <table width="100%" class="mt-5">
                    <tr>
                        <td colspan="4" style="padding:10px">Yang bertanda tangan dibawah ini :</td>
                    </tr>
                    <tr>
                        <td width="5%" style="padding-top:5px"></td>
                        <td width="20%" style="padding-top:10px;">Nama Lengkap</td>
                        <td width="2%" style="padding-top:10px;">:</td>
                        <td style="padding-top:10px;"> {{ $pengajuan->mahasiswa->nama }}</td>
                    </tr>
                    <tr>
                        <td style="padding-top:10px;"></td>
                        <td style="padding-top:10px;">NIM</td>
                        <td style="padding-top:10px;">:</td>
                        <td style="padding-top:10px;"> {{ $pengajuan->mahasiswa->nim }}</td>
                    </tr>
                    <tr>
                        <td style="padding-top:10px;"></td>
                        <td style="padding-top:10px;">Program Studi</td>
                        <td style="padding-top:10px;">:</td>
                        <td style="padding-top:10px;"> Sistem Informasi</td>
                    </tr>
                    <tr>
                        <td style="padding-top:10px;"></td>
                        <td style="padding-top:10px;">Jurusan</td>
                        <td style="padding-top:10px;">:</td>
                        <td style="padding-top:10px;"> Teknik Elektro Informatika dan Bisnis</td>
                    </tr>
                    <tr>
                        <td style="padding-top:10px;"></td>
                        <td style="padding-top:10px;">Tema Penelitian</td>
                        <td style="padding-top:10px;">:</td>
                        <td style="padding-top:10px;"> {{ $pengajuan->bidang_penelitian }}</td>
                    </tr>
                    <tr>
                        <td style="padding-top:10px;"></td>
                        <td style="padding-top:10px;">Nomor Telepon</td>
                        <td style="padding-top:10px;">:</td>
                        <td style="padding-top:10px;"> {{ $pengajuan->mahasiswa->nomor_telepon }}</td>
                    </tr>
                    <tr>
                        <td colspan="4" style="padding:10px">Menyatakan dengan sebenarnya kesanggupan saya jika dinyatakan lulus dalam sidang pada waktu yang akan ditentukan, maka saya akan merevisi perbaikan tugas akhir sesuai dengan saran-saran yang telah disampaikan penguji maksimal dua minggu dan atau 14 (empat belas) hari kerja, terhitung sejak diumumkan kelulusan saya dalam sidang tugas akhir.</td>
                    </tr>
                    <tr>
                        <td colspan="4" style="padding:10px">Demikian surat pernyataan ini saya buat dengan penuh kesadaran tanpa paksaan dari pihak manapun juga.</td>
                    </tr>
                </table>

                <table width="100%" style="margin-top:40px;">
                    <tr>
                        <td style="text-align:center"></td>
                        <td style="text-align:right; padding-right: 150px;">Balikpapan, {{ \Carbon\Carbon::now()->isoFormat('D MMMM Y') }}</td>
                    </tr>
                    <tr>
                        <td style="position: relative">
                            
                        </td>
                        <td style="position: relative">
                            <span style="position: absolute;right:250px;margin-top:80px;">Materai 10.000</span>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align:center;padding-top: 120px;"></td>
                        <td style="text-align:left;padding-top: 120px; padding-left: 400px;">{{ $pengajuan->mahasiswa->nama }}</td>
                    </tr>
                    <tr>
                        <td style="text-align:center"></td>
                        <td style="text-align:left; padding-left: 400px;">NIM. {{ $pengajuan->mahasiswa->nim }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection