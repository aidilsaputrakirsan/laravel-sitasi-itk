@extends('layouts.surat')
@section('title', 'Form TA-005')

@section('content')
<!-- Tahap 1 -->
<div>
    @include('pdf.section.header')

    <div style="top:10px; padding-left: 10px;">
        <div class="row">
            <div class="col-12">
                <table width="100%">
                    <tr>
                        <td class="text-end"><b>Form. TA-005</b></td>
                    </tr>
                </table>
                <table width="100%" class="mt-2">
                    <tr class="text-center">
                        <td class="text-center"><b>LEMBAR PERSETUJUAN HASIL REVISI PROPOSAL TUGAS AKHIR</b></td>
                    </tr>
                </table>
                <table width="100%" class="mt-3">
                    <tr>
                        <td width="35%">Nama / NIM</td>
                        <td width="2%">:</td>
                        <td width="63%"> {{ $pengajuan->mahasiswa->nama }} / {{ $pengajuan->mahasiswa->nim }}</td>
                    </tr>
                    <tr>
                        <td style="padding-top:10px;">Program Studi / Jurusan</td>
                        <td style="padding-top:10px;">:</td>
                        <td style="padding-top:10px;"> Sistem Informasi / Teknik Elektro Informatika dan Bisnis</td>
                    </tr>
                    <tr>
                        <td style="padding-top:10px;vertical-align:top">Judul TA</td>
                        <td style="padding-top:10px;vertical-align:top">:</td>
                        <td style="padding-top:10px;"> {{ $pengajuan->judul }}</td>
                    </tr>
                </table>

                <table style="border: 1px solid #000; border-collapse: collapse; width: 100%;" class="mt-4">
                    <thead>
                        <tr style="border: 1px solid #000;text-align:center">
                            <th width="5%" style="font-weight: normal;border: 1px solid #000;padding:10px">NO</th>
                            <th width="45%" style="font-weight: normal;border: 1px solid #000;padding:10px">NAMA TIM PENGUJI</th>
                            <th width="20%" style="font-weight: normal;border: 1px solid #000;padding:10px">TANGGAL</th>
                            <th width="30%" style="font-weight: normal;border: 1px solid #000;padding:10px;white-space:pre-wrap">TTD</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="text-align:start">
                            <td style="border: 1px solid #000;padding:40px">1. </td>
                            <td style="border: 1px solid #000;padding:5px;text-align:start">{{ $pengajuan->pembimbing1->dosen->nama_dosen }}</td>
                            <td style="border: 1px solid #000;padding:5px;text-align:center">{{ $revisiPembimbing1 ? \Carbon\Carbon::parse($revisiPembimbing1->created_at)->isoFormat('D MMMM YYYY') : null }}</td>
                            <td style="border: 1px solid #000;padding:5px;text-align:start">
                                @if($pengajuan->pembimbing1->signature !== null)
                                <div style="text-align:center">
                                    <img src="{{ storage_path('app/public/' . $pengajuan->pembimbing1->signature) }}" style="width:100px;text-align:center">
                                </div>
                                @endif
                            </td>
                        </tr>
                        <tr style="text-align:start">
                            <td style="border: 1px solid #000;padding:40px">2. </td>
                            <td style="border: 1px solid #000;padding:5px;text-align:start">{{ $pengajuan->pembimbing2->dosen->nama_dosen }}</td>
                            <td style="border: 1px solid #000;padding:5px;text-align:center">{{ $revisiPembimbing2 ? \Carbon\Carbon::parse($revisiPembimbing2->created_at)->isoFormat('D MMMM YYYY') : null }}</td>
                            <td style="border: 1px solid #000;padding:5px;text-align:start">
                                @if($pengajuan->pembimbing2->signature !== null)
                                <div style="text-align:center">
                                    <img src="{{ storage_path('app/public/' . $pengajuan->pembimbing2->signature) }}" style="width:100px;text-align:center">
                                </div>
                                @endif
                            </td>
                        </tr>
                        <tr style="text-align:start">
                            <td style="border: 1px solid #000;padding:40px">3. </td>
                            <td style="border: 1px solid #000;padding:5px;text-align:start">{{ $pengajuan->jadwal->penguji1->dosen->nama_dosen }}</td>
                            <td style="border: 1px solid #000;padding:5px;text-align:center">{{ $revisiPenguji1 ? \Carbon\Carbon::parse($revisiPenguji1->created_at)->isoFormat('D MMMM YYYY') : null }}</td>
                            <td style="border: 1px solid #000;padding:5px;text-align:start">
                                @if($pengajuan->jadwal->penguji1->signature !== null)
                                <div style="text-align:center">
                                    <img src="{{ storage_path('app/public/' . $pengajuan->jadwal->penguji1->signature) }}" style="width:100px;text-align:center">
                                </div>
                                @endif
                            </td>
                        </tr>
                        <tr style="text-align:start">
                            <td style="border: 1px solid #000;padding:40px">4. </td>
                            <td style="border: 1px solid #000;padding:5px;text-align:start">{{ $pengajuan->jadwal->penguji2->dosen->nama_dosen }}</td>
                            <td style="border: 1px solid #000;padding:5px;text-align:center">{{ $revisiPenguji2 ? \Carbon\Carbon::parse($revisiPenguji2->created_at)->isoFormat('D MMMM YYYY') : null }}</td>
                            <td style="border: 1px solid #000;padding:5px;text-align:start">
                                @if($pengajuan->jadwal->penguji2->signature !== null)
                                <div style="text-align:center">
                                    <img src="{{ storage_path('app/public/' . $pengajuan->jadwal->penguji2->signature) }}" style="width:100px;text-align:center">
                                </div>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection