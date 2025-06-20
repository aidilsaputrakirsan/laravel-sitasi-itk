@extends('layouts.surat')
@section('title', 'Form TA-001')

@section('content')
<!-- Tahap 1 -->
<div>
    @include('pdf.section.header')

    <div style="top:10px; padding-left: 10px;">
        <div class="row">
            <div class="col-12">
                <table width="100%">
                    <tr>
                        <td class="text-end" style="padding-right: 50px;"><b>Form. TA-001A</b></td>
                    </tr>
                </table>
                <table width="100%" class="mt-2">
                    <tr class="text-center">
                        <td class="text-center"><b>FORMULIR USULAN DOSEN PEMBIMBING</b></td>
                    </tr>
                </table>
                <table width="100%" class="mt-3">
                    <tr>
                        <td colspan="4" style="padding:10px">Saya yang bertanda tangan dibawah ini :</td>
                    </tr>
                    <tr>
                        <td width="5%" style="padding-top:5px"></td>
                        <td width="20%">Nama (dengan gelar)</td>
                        <td width="2%" >:</td>
                        <td> {{ $pengajuan->pembimbing1->dosen->nama_dosen }}</td>
                    </tr>
                    <tr>
                        <td style="padding-top:10px;"></td>
                        <td style="padding-top:10px;">NIP</td>
                        <td>:</td>
                        <td> {{ $pengajuan->pembimbing1->dosen->nip }}</td>
                    </tr>
                    <tr>
                        <td style="padding-top:10px;"></td>
                        <td style="padding-top:10px;">Jabatan Akademik</td>
                        <td>:</td>
                        <td> {{ $pengajuan->pembimbing1->dosen->jabatan_akademik ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td style="padding-top:10px;"></td>
                        <td style="padding-top:10px;">Unit Kerja</td>
                        <td>:</td>
                        <td> Dosen Program Studi Sistem Informasi</td>
                    </tr>
                    <tr>
                        <td colspan="4" style="padding:10px">dengan ini menyatakan bersedia menjadi Pembimbing Tugas Akhir mahasiswa :</td>
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
                        <td colspan="4" style="padding-top:18px;text-align:justify;">Demikianlah surat kesediaan ini saya buat dengan sesungguhnya untuk dipergunakan sebagaimana mestinya.</td>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-end" style="padding-top: 25px; padding-right: 50px;">Balikpapan, {{ \Carbon\Carbon::now()->isoFormat('D MMMM Y') }}</td>
                    </tr>
                </table>

                <table width="100%" style="margin-top:40px;">
                    <tr>
                        <td style="text-align:center">Mahasiswa Peserta TA</td>
                        <td style="text-align:center">Dosen Pembimbing</td>
                    </tr>
                    <tr>
                        <td style="position: relative">
                            @if($pengajuan->mahasiswa->user->signature !== null)
                            <img src="{{ storage_path('app/public/' . $pengajuan->mahasiswa->user->signature) }}" style="position: absolute;left:100px;margin-top:-20px;width:120px;">
                            @endif
                        </td>
                        <td style="position: relative">
                            @if($pengajuan->pembimbing1->signature !== null)
                            <img src="{{ storage_path('app/public/' . $pengajuan->pembimbing1->signature) }}" style="position: absolute;right:140px;margin-top:5px;width:120px">
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align:center;padding-top: 120px;">{{ $pengajuan->mahasiswa->nama }}</td>
                        <td style="text-align:center;padding-top: 120px;">{{ $pengajuan->pembimbing1->dosen->nama_dosen }}</td>
                    </tr>
                    <tr>
                        <td style="text-align:center">NIM. {{ $pengajuan->mahasiswa->nim }}</td>
                        <td style="text-align:center">NIP. {{ $pengajuan->pembimbing1->dosen->nip }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="page-break"></div>

    @include('pdf.section.header')

    <div style="top:10px; padding-left: 10px;">
        <div class="row">
            <div class="col-12">
                <table width="100%">
                    <tr>
                        <td class="text-end" style="padding-right: 50px;"><b>Form. TA-001A</b></td>
                    </tr>
                </table>
                <table width="100%" class="mt-4">
                    <tr class="text-center">
                        <td class="text-center"><b>FORMULIR USULAN DOSEN PEMBIMBING</b></td>
                    </tr>
                </table>
                <table width="100%" class="mt-5">
                    <tr>
                        <td colspan="4" style="padding:10px">Saya yang bertanda tangan dibawah ini :</td>
                    </tr>
                    <tr>
                        <td width="5%" style="padding-top:5px"></td>
                        <td width="20%">Nama (dengan gelar)</td>
                        <td width="2%" >:</td>
                        <td> {{ $pengajuan->pembimbing2->dosen->nama_dosen }}</td>
                    </tr>
                    <tr>
                        <td style="padding-top:10px;"></td>
                        <td style="padding-top:10px;">NIP</td>
                        <td>:</td>
                        <td> {{ $pengajuan->pembimbing2->dosen->nip }}</td>
                    </tr>
                    <tr>
                        <td style="padding-top:10px;"></td>
                        <td style="padding-top:10px;">Jabatan Akademik</td>
                        <td>:</td>
                        <td> {{ $pengajuan->pembimbing2->dosen->jabatan_akademik ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td style="padding-top:10px;"></td>
                        <td style="padding-top:10px;">Unit Kerja</td>
                        <td>:</td>
                        <td> Dosen Program Studi Sistem Informasi</td>
                    </tr>
                    <tr>
                        <td colspan="4" style="padding:10px">dengan ini menyatakan bersedia menjadi Pembimbing Tugas Akhir mahasiswa :</td>
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
                        <td colspan="4" style="padding-top:18px;text-align:justify;">Demikianlah surat kesediaan ini saya buat dengan sesungguhnya untuk dipergunakan sebagaimana mestinya.</td>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-end" style="padding-top: 25px; padding-right: 50px;">Balikpapan, {{ \Carbon\Carbon::now()->isoFormat('D MMMM Y') }}</td>
                    </tr>
                </table>

                <table width="100%" style="margin-top:40px;">
                    <tr>
                        <td style="text-align:center">Mahasiswa Peserta TA</td>
                        <td style="text-align:center">Dosen Pembimbing</td>
                    </tr>
                    <tr>
                        <td style="position: relative">
                            @if($pengajuan->mahasiswa->user->signature !== null)
                            <img src="{{ storage_path('app/public/' . $pengajuan->mahasiswa->user->signature) }}" style="position: absolute;left:140px;margin-top:-20px;width:120px;">
                            @endif
                        </td>
                        <td style="position: relative">
                            @if($pengajuan->pembimbing2->signature !== null)
                            <img src="{{ storage_path('app/public/' . $pengajuan->pembimbing2->signature) }}" style="position: absolute;right:80px;margin-top:0px;width:120px">
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align:center;padding-top: 120px;">{{ $pengajuan->mahasiswa->nama }}</td>
                        <td style="text-align:center;padding-top: 120px;">{{ $pengajuan->pembimbing2->dosen->nama_dosen }}</td>
                    </tr>
                    <tr>
                        <td style="text-align:center">NIM. {{ $pengajuan->mahasiswa->nim }}</td>
                        <td style="text-align:center">NIP. {{ $pengajuan->pembimbing2->dosen->nip }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection