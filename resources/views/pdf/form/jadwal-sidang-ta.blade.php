@extends('layouts.surat')
@section('title', 'Form TA-017 dan Form TA-018')

@section('content')
<!-- Tahap 1 -->
<div>
    @include('pdf.section.header-2')

    <div style="top:10px; padding-left: 10px;">
        <div class="row">
            <div class="col-12">
                <table width="100%">
                    <tr>
                        <td class="text-end"><b>Form. TA-017</b></td>
                    </tr>
                </table>
                <table width="100%" class="mt-2">
                    <tr class="text-center">
                        <td class="text-center"><b>REKAPITULASI PENDAFTARAN SIDANG TUGAS AKHIR</b></td>
                    </tr>
                    <tr>
                        <td class="text-center"><b>PERIODE {{ strtoupper($periode->semester) }} TAHUN {{ $periode->periode }}</b></td>
                    </tr>
                </table>
                <table width="100%" class="mt-4">
                    <tr>
                        <td style="padding-top:3px;" width="20%">Program Studi</td>
                        <td style="padding-top:3px;" width="1%">:</td>
                        <td style="padding-top:3px;">Sistem Informasi</td>
                    </tr>
                    <tr>
                        <td style="padding-top:3px;">Jurusan</td>
                        <td style="padding-top:3px;">:</td>
                        <td style="padding-top:3px;">Teknik Elektro Informatika dan Bisnis</td>
                    </tr>
                    <tr>
                        <td style="padding-top:3px;">Semester</td>
                        <td style="padding-top:3px;">:</td>
                        <td style="padding-top:3px;">{{ $periode->semester }}</td>
                    </tr>
                    <tr>
                        <td style="padding-top:3px;">Tahun Ajaran</td>
                        <td style="padding-top:3px;">:</td>
                        <td style="padding-top:3px;">{{ $periode->periode }}</td>
                    </tr>
                </table>
            </div>

            <div class="col-md-12 mt-4">
                <table style="border: 1px solid #000; border-collapse: collapse; width: 100%;">
                    <thead>
                        <tr style="border: 1px solid #000;text-align:center">
                            <th width="5%" style="vertical-align: top;font-weight: bold;border: 1px solid #000;padding:10px">NO</th>
                            <th width="30%" style="vertical-align: top;font-weight: bold;border: 1px solid #000;padding:10px">MAHASISWA</th>
                            <th width="5%" style="vertical-align: top;font-weight: bold;border: 1px solid #000;padding:10px">NIM</th>
                            <th width="40%" style="vertical-align: top;font-weight: bold;border: 1px solid #000;padding:10px;white-space:pre-wrap">JUDUL TUGAS AKHIR</th>
                            <th width="15%" style="vertical-align: top;font-weight: bold;border: 1px solid #000;padding:10px;white-space:pre-wrap">DOSEN PEMBIMBING UTAMA</th>
                            <th width="15%" style="vertical-align: top;font-weight: bold;border: 1px solid #000;padding:10px;white-space:pre-wrap">DOSEN PEMBIMBING PENDAMPING</th>
                            <th width="15%" style="vertical-align: top;font-weight: bold;border: 1px solid #000;padding:10px">KET</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sidangs as $sidang)
                        <tr style="border: 1px solid #000;text-align:start">
                            <td style="border: 1px solid #000;padding: 10px;@if($sidang->status === 'Ditolak') color:red @endif">{{ $loop->iteration }}.</td>
                            <td style="border: 1px solid #000;padding: 10px;@if($sidang->status === 'Ditolak') color:red @endif">{{ $sidang->user->mahasiswa->nama }}</td>
                            <td style="border: 1px solid #000;padding: 10px;@if($sidang->status === 'Ditolak') color:red @endif">{{ $sidang->user->mahasiswa->nim }}</td>
                            <td style="border: 1px solid #000;padding: 10px;@if($sidang->status === 'Ditolak') color:red @endif">{{ $sidang->user->mahasiswa->pengajuanTA->judul }}</td>
                            <td style="border: 1px solid #000;padding: 10px;@if($sidang->status === 'Ditolak') color:red @endif">{{ $sidang->user->mahasiswa->pengajuanTA->pembimbing1->name }}</td>
                            <td style="border: 1px solid #000;padding: 10px;@if($sidang->status === 'Ditolak') color:red @endif">{{ $sidang->user->mahasiswa->pengajuanTA->pembimbing2->name }}</td>
                            <td style="border: 1px solid #000;padding: 10px;text-align:center;@if($sidang->status === 'Ditolak') color:red @endif"><b> {{ $sidang->status === 'Ditolak' ? 'Tidak Lengkap' : 'Lengkap' }} </b> </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <div class="page-break"></div>
    
    @include('pdf.section.header-2')
    <div style="top:10px; padding-left: 100px;padding-right:50px;">
        <div class="row mt-2">
            <div class="col-12">
                <table width="100%">
                    <tr>
                        <td class="text-start">Balikpapan, {{ \Carbon\Carbon::now()->isoFormat('D MMMM YYYY') }}</td>
                    </tr>
                </table>
                <table width="100%" class="mt-2">
                    <tr>
                        <td>Mengetahui,</td>
                        <td>Disusun oleh</td>
                    </tr>
                    <tr>
                        <td>Koordinator KP/TA Prodi Sistem Informasi</td>
                        <td>Administrasi Akademik Jurusan</td>
                    </tr>
                    <tr>
                        <td style="padding-top: 120px;">Sri Rahayu Natasia, S.Komp., M.Si., M.Sc</td>
                        <td style="padding-top: 120px;">Wahyuni Lasniah</td>
                    </tr>
                    <tr>
                        <td>NIP. 199001082020122003</td>
                        <td>NIPH. 100217046</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="page-break"></div>
    @include('pdf.section.header-2')

    <div style="top:10px; padding-left: 10px;">
        <div class="row">
            <div class="col-12">
                <table width="100%">
                    <tr>
                        <td class="text-end"><b>Form. TA-018</b></td>
                    </tr>
                </table>
                <table width="100%" class="mt-2">
                    <tr class="text-center">
                        <td class="text-center"><b>JADWAL SIDANG TUGAS AKHIR</b></td>
                    </tr>
                    <tr>
                        <td class="text-center"><b>PERIODE {{ strtoupper($periode->semester) }} TAHUN {{ $periode->periode }}</b></td>
                    </tr>
                </table>
                <table width="100%" class="mt-4">
                    <tr>
                        <td style="padding-top:3px;" width="20%">Program Studi</td>
                        <td style="padding-top:3px;" width="1%">:</td>
                        <td style="padding-top:3px;">Sistem Informasi</td>
                    </tr>
                    <tr>
                        <td style="padding-top:3px;">Jurusan</td>
                        <td style="padding-top:3px;">:</td>
                        <td style="padding-top:3px;">Teknik Elektro Informatika dan Bisnis</td>
                    </tr>
                </table>
            </div>

            <div class="col-md-12 mt-4">
                <table style="border: 1px solid #000; border-collapse: collapse; width: 100%;">
                    <thead>
                        <tr style="border: 1px solid #000;text-align:center">
                            <th width="5%" style="vertical-align: top;font-weight: bold;border: 1px solid #000;padding:10px">NO</th>
                            <th width="30%" style="vertical-align: top;font-weight: bold;border: 1px solid #000;padding:10px">MAHASISWA</th>
                            <th width="5%" style="vertical-align: top;font-weight: bold;border: 1px solid #000;padding:10px">NIM</th>
                            <th width="40%" style="vertical-align: top;font-weight: bold;border: 1px solid #000;padding:10px;white-space:pre-wrap">JUDUL TUGAS AKHIR</th>
                            <th width="15%" style="vertical-align: top;font-weight: bold;border: 1px solid #000;padding:10px;white-space:pre-wrap">DOSEN PEMBIMBING UTAMA</th>
                            <th width="15%" style="vertical-align: top;font-weight: bold;border: 1px solid #000;padding:10px;white-space:pre-wrap">DOSEN PEMBIMBING PENDAMPING</th>
                            <th width="15%" style="vertical-align: top;font-weight: bold;border: 1px solid #000;padding:10px;white-space:pre-wrap">PENGUJI 1 (KETUA)</th>
                            <th width="15%" style="vertical-align: top;font-weight: bold;border: 1px solid #000;padding:10px;white-space:pre-wrap">PENGUJI 2</th>
                            <th width="15%" style="vertical-align: top;font-weight: bold;border: 1px solid #000;padding:10px;white-space:pre-wrap">HARI/TGL</th>
                            <th width="15%" style="vertical-align: top;font-weight: bold;border: 1px solid #000;padding:10px">WAKTU (WITA)/RUANG</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jadwals as $jadwal)
                        <tr style="border: 1px solid #000;text-align:start">
                            <td style="border: 1px solid #000;padding: 10px;">{{ $loop->iteration }}.</td>
                            <td style="border: 1px solid #000;padding: 10px;">{{ $jadwal->user->mahasiswa->nama }}</td>
                            <td style="border: 1px solid #000;padding: 10px;">{{ $jadwal->user->mahasiswa->nim }}</td>
                            <td style="border: 1px solid #000;padding: 10px;">{{ $jadwal->user->mahasiswa->pengajuanTA->judul }}</td>
                            <td style="border: 1px solid #000;padding: 10px;">{{ $jadwal->user->mahasiswa->pengajuanTA->pembimbing1->name }}</td>
                            <td style="border: 1px solid #000;padding: 10px;">{{ $jadwal->user->mahasiswa->pengajuanTA->pembimbing2->name }}</td>
                            <td style="border: 1px solid #000;padding: 10px;">{{ $jadwal->user->mahasiswa->pengajuanTA->jadwal->penguji1->name }}</td>
                            <td style="border: 1px solid #000;padding: 10px;">{{ $jadwal->user->mahasiswa->pengajuanTA->jadwal->penguji2->name }}</td>
                            <td style="border: 1px solid #000;padding: 10px;">{{ \Carbon\Carbon::parse($jadwal->tanggal_sidang)->isoFormat('dddd, D MMMM YYYY') }}</td>
                            <td style="border: 1px solid #000;padding: 10px;"><b> {{ $jadwal->waktu_mulai }} - {{ $jadwal->waktu_selesai }} WITA <br> {{ $jadwal->ruangan }} </b> </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <div class="page-break"></div>
    
    @include('pdf.section.header-2')
    <div style="top:10px; padding-left: 100px;padding-right:50px;">
        <div class="row mt-2">
            <div class="col-12">
                <table width="100%">
                    <tr>
                        <td class="text-start">Balikpapan, {{ \Carbon\Carbon::now()->isoFormat('D MMMM YYYY') }}</td>
                    </tr>
                </table>
                <table width="100%" class="mt-2">
                    <tr>
                        <td>Menyetujui,</td>
                    </tr>
                    <tr>
                        <td>Koordinator Program Studi Sistem Informasi</td>
                    </tr>
                    <tr>
                        <td style="padding-top: 120px;">Sri Rahayu Natasia, S.Komp., M.Si., M.Sc</td>
                    </tr>
                    <tr>
                        <td>NIP. 199001082020122003</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection