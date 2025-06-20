@extends('layouts.surat')
@section('title', 'Form TA-006')

@section('content')
<!-- Tahap 1 -->
<div>
    @include('pdf.section.header')

    <div style="top:10px; padding-left: 10px;">
        <div class="row">
            <div class="col-12">
                <table width="100%">
                    <tr>
                        <td class="text-end"><b>Form. TA-006</b></td>
                    </tr>
                </table>
                <table width="100%" class="mt-2">
                    <tr class="text-center">
                        <td class="text-center"><b>LEMBAR KONSULTASI BIMBINGAN</b></td>
                    </tr>
                </table>
                <table width="100%" class="mt-3">
                    <tr>
                        <td width="20%">Nama Mahasiswa</td>
                        <td width="1%" style="text-align:start">:</td>
                        <td width="30%" style="text-align:start">{{ $user->mahasiswa->nama }}</td>
                        <td width="20%" class="text-start">(NIM.{{ $user->mahasiswa->nim }})</td>
                        <td width="10%"></td>
                    </tr>
                    <tr>
                        <td colspan="5"></td>
                    </tr>
                    <tr>
                        <td colspan="5"></td>
                    </tr>
                    <tr>
                        <td colspan="5"></td>
                    </tr>
                    <tr>
                        <td colspan="5"></td>
                    </tr>
                    <tr>
                        <td>Prodi / Jurusan</td>
                        <td>:</td>
                        <td colspan="2">Sistem Informasi / Teknik Elektro Informatika dan Bisnis</td>
                    </tr>
                    <tr>
                        <td colspan="5"></td>
                    </tr>
                    <tr>
                        <td colspan="5"></td>
                    </tr>
                    <tr>
                        <td colspan="5"></td>
                    </tr>
                    <tr>
                        <td colspan="5"></td>
                    </tr>
                    <tr>
                        <td>Judul TA</td>
                        <td>:</td>
                        <td colspan="3">{{ $user->mahasiswa->pengajuanTA ? $user->mahasiswa->pengajuanTA->judul : '' }}</td>
                    </tr>
                </table>
                <table width="100%" class="mt-4">
                    <tr>
                        <td width="15%">Dosen Pembimbing Utama</td>
                        <td width="30%">: {{ $user->mahasiswa->pengajuanTA ? $user->mahasiswa->pengajuanTA->pembimbing1->name : '' }}</td>
                    </tr>

                    <tr>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td>Dosen Pembimbing Pendamping</td>
                        <td>: {{ $user->mahasiswa->pengajuanTA ? $user->mahasiswa->pengajuanTA->pembimbing2->name : '' }}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12">
                <table style="border: 1px solid #000; border-collapse: collapse; width: 100%;">
                    <thead>
                        <tr style="border: 1px solid #000;text-align:center">
                            <th width="20%" style="font-weight: normal;border: 1px solid #000;padding:10px">HARI / TANGGAL</th>
                            <th width="40%" style="font-weight: normal;border: 1px solid #000;padding:10px">URAIAN AKTIVITAS</th>
                            <th width="20%" style="font-weight: normal;border: 1px solid #000;padding:10px">KETERANGAN</th>
                            <th width="20%" style="font-weight: normal;border: 1px solid #000;padding:10px;white-space:pre-wrap">PARAF DOSEN PEMBIMBING</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Blank Row 1 -->
                        @foreach($bimbingans as $bimbingan)
                        <tr style="border: 1px solid #000;text-align:start">
                            <td style="border: 1px solid #000;padding:40px">{{ \Carbon\Carbon::parse($bimbingan->tanggal)->format('d/m/Y') }}</td>
                            <td style="border: 1px solid #000;padding:5px;text-align:start">{{ $bimbingan->hasil_bimbingan }}</td>
                            <td style="border: 1px solid #000;padding:5px;text-align:start">{{ $bimbingan->ket_bimbingan }}</td>
                            <td style="border: 1px solid #000;padding:5px;text-align:center">
                                @if(isset($bimbingan->dosens->signature) && $bimbingan->dosens->signature)
                                    <div style="text-align:center">
                                        <img src="{{ storage_path('app/public/' . $bimbingan->dosens->signature) }}" style="width:100px;">
                                    </div>
                                @else
                                {{-- Area kosong bersih untuk TTD manual --}}
                                    <div style="height:60px;"></div>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        <tr style="border: 1px solid #000;">
                            <td style="border: 1px solid #000;padding:40px"></td>
                            <td style="border: 1px solid #000;padding:40px"></td>
                            <td style="border: 1px solid #000;padding:40px"></td>
                            <td style="border: 1px solid #000;padding:40px"></td>
                        </tr>
                        <tr style="border: 1px solid #000;">
                            <td style="border: 1px solid #000;padding:40px"></td>
                            <td style="border: 1px solid #000;padding:40px"></td>
                            <td style="border: 1px solid #000;padding:40px"></td>
                            <td style="border: 1px solid #000;padding:40px"></td>
                        </tr>
                        <tr style="border: 1px solid #000;">
                            <td style="border: 1px solid #000;padding:40px"></td>
                            <td style="border: 1px solid #000;padding:40px"></td>
                            <td style="border: 1px solid #000;padding:40px"></td>
                            <td style="border: 1px solid #000;padding:40px"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>
</div>
@endsection