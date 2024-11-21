<?php

namespace App\Helpers;

use App\Models\PenilaianSempro;
use Illuminate\Database\Eloquent\Collection;

class NilaiHelper
{
    public static function countNilaiSempro(Collection $nilais)
    {
        $totalAkhir = 0;
        
        foreach($nilais as $nilai) {
            $total1 = 0;
            $total1 += ($nilai->media_presentasi ?? 0) * 20 / 100;
            $total1 += ($nilai->komunikasi ?? 0) * 40 / 100;
            $total1 += ($nilai->penguasaan_materi ?? 0) * 40 / 100; 

            $total2 = 0;
            $total2 += ($nilai->isi_laporan_ta ?? 0) * 60 / 100;
            $total2 += ($nilai->struktur_penulisan ?? 0) * 40 / 100;

            $totalNilai = ($total1 * 50 / 100) + ($total2 * 50 / 100);
            $totalAkhir += $totalNilai;
        }

        return $totalAkhir / 4;
    }

    public static function countNilaiSidang(Collection $nilais)
    {
        $totalAkhir = 0;
        
        foreach($nilais as $nilai) {
            $total1 = 0;
            $total1 += ($nilai->media_presentasi ?? 0) * 20 / 100;
            $total1 += ($nilai->komunikasi ?? 0) * 40 / 100;
            $total1 += ($nilai->penguasaan_materi ?? 0) * 40 / 100; 

            $total2 = 0;
            $total2 += ($nilai->isi_laporan_ta ?? 0) * 60 / 100;
            $total2 += ($nilai->struktur_penulisan ?? 0) * 40 / 100;

            $total3 = 0;
            $total3 += ($nilai->sikap_kinerja ?? 0);

            if ($total3 > 0) {
                $totalNilai = ($total1 * 33 / 100) + ($total2 * 34 / 100) + ($total3 * 33 / 100);
            } else {
                $totalNilai = ($total1 * 50 / 100) + ($total2 * 50 / 100);
            } 

            $totalAkhir += $totalNilai;
        }

        return $totalAkhir / 4;
    }

    public static function countNilai(Collection $nilais, int $userId)
    {
        $totalAkhir = 0;

        $nilai = $nilais->where('user_id', $userId)->first();
        
        $total1 = 0;
        $total1 += ($nilai->media_presentasi ?? 0) * 20 / 100;
        $total1 += ($nilai->komunikasi ?? 0) * 40 / 100;
        $total1 += ($nilai->penguasaan_materi ?? 0) * 40 / 100; 

        $total2 = 0;
        $total2 += ($nilai->isi_laporan_ta ?? 0) * 60 / 100;
        $total2 += ($nilai->struktur_penulisan ?? 0) * 40 / 100;

        $total3 = 0;
        $total3 += ($nilai->sikap_kinerja ?? 0);

        if ($total3 > 0) {
            $totalNilai = ($total1 * 33 / 100) + ($total2 * 34 / 100) + ($total3 * 33 / 100);
        } else {
            $totalNilai = ($total1 * 50 / 100) + ($total2 * 50 / 100);
        } 

        $totalAkhir += $totalNilai;

        return $totalAkhir;
    }

    public static function countNilaiProposal(Collection $nilais, int $userId)
    {
        $totalAkhir = 0;

        $nilai = $nilais->where('user_id', $userId)->first();
        
        $total1 = 0;
        $total1 += ($nilai->media_presentasi ?? 0) * 20 / 100;
        $total1 += ($nilai->komunikasi ?? 0) * 40 / 100;
        $total1 += ($nilai->penguasaan_materi ?? 0) * 40 / 100;

        $total2 = 0;
        $total2 += ($nilai->isi_laporan_ta ?? 0) * 60 / 100 ;
        $total2 += ($nilai->struktur_penulisan ?? 0) * 40 / 100;

        $totalAkhir += ($total1 * 50 /100) + ($total2 * 50 / 100);

        return $totalAkhir;
    }

    public static function countNilaiSidangTA(Collection $nilais, int $userId)
    {
        $totalAkhir = 0;

        $nilai = $nilais->where('user_id', $userId)->first();

        $total1 = 0;
        $total1 += ($nilai->media_presentasi ?? 0) * 20 / 100;
        $total1 += ($nilai->komunikasi ?? 0) * 40 / 100;
        $total1 += ($nilai->penguasaan_materi ?? 0) * 40 / 100;
    
        $total2 = 0;
        $total2 += ($nilai->isi_laporan_ta ?? 0) * 60 / 100;
        $total2 += ($nilai->struktur_penulisan ?? 0) * 40 / 100;

        $total3 = 0;
        $total3 += ($nilai->sikap_kinerja ?? 0);

        if ($total3 > 0) {
            $totalAkhir += ($total1 * 33 / 100) + ($total2 * 34 / 100) + ($total3 * 33 / 100);
        } else {
            $totalAkhir += ($total1 * 50 / 100) + ($total2 * 50 / 100);
        }


        return $totalAkhir;
    }

    public static function countTotalSidang(Collection $nilaisSempro, Collection $nilaiSidang, int $userId)
    {
        $sempro = self::countNilaiProposal($nilaisSempro, $userId);
        $sidang = self::countNilaiSidangTA($nilaiSidang, $userId);

        return ($sempro * 40 / 100) + ($sidang * 60 / 100);
    }
    
    public static function countTotalAkhir(Collection $nilaiSempro, Collection $nilaiSidang, object $pengajuan)
    {
        $dosen1 = $pengajuan->pembimbing1->id;
        $dosen2 = $pengajuan->pembimbing2->id;
        $dosen3 = $pengajuan->jadwal->penguji1->id;
        $dosen4 = $pengajuan->jadwal->penguji2->id;

        $nilai1 = self::countTotalSidang($nilaiSempro, $nilaiSidang, $dosen1);
        $nilai2 = self::countTotalSidang($nilaiSempro, $nilaiSidang, $dosen2);
        $nilai3 = self::countTotalSidang($nilaiSempro, $nilaiSidang, $dosen3);
        $nilai4 = self::countTotalSidang($nilaiSempro, $nilaiSidang, $dosen4);

        return ($nilai1 + $nilai2 + $nilai3 + $nilai4) / 4;
    }
}
