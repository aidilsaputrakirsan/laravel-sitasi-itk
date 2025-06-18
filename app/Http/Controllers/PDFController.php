<?php

namespace App\Http\Controllers;

use App\Models\Bimbingan;
use App\Models\JadwalSempro;
use App\Models\JadwalTA;
use App\Models\PengajuanTA;
use App\Models\Periode;
use App\Models\RiwayatPendaftaranSempro;
use App\Models\Sempro;
use App\Models\SidangTA;
use App\Models\User;
use App\Services\PdfService;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    protected PdfService $pdfService;

    public function __construct(PdfService $pdfService)
    {
        $this->pdfService = $pdfService;
    }

    public function form_ta_006(Request $request)
    {
        set_time_limit(120);
        ini_set('memory_limit', '512M');
        
        if (!$request->userId) {
            return redirect('dashboard');
        }
        
        $userId = $request->userId;
        
        // FIX: Tambah eager loading untuk relationship 'dosens'
        $data['bimbingans'] = Bimbingan::with([
            'dosens:id,name,signature' // LOAD signature field!
        ])->where('user_id', $userId)
            ->where('status', 'Approved')
            ->orderBy('tanggal', 'ASC')
            ->get();
            
        $data['user'] = User::with([
            'mahasiswa.pengajuanTA.pembimbing1',
            'mahasiswa.pengajuanTA.pembimbing2'
        ])->where('id', $userId)->first();
        
        return $this->pdfService->loadView('pdf.form.form-ta006', $data);
    }

    public function form_ta_001(Request $request)
    {
        if (!$request->userId) {
            return redirect('dashboard')->with('error', 'User tidak ditemukan');
        }
        $userId = $request->userId;
        $user = User::where('id', $userId)->first();
        $data['pengajuan'] = PengajuanTA::where('mahasiswa_id', $user->mahasiswa->id)->first();

        return $this->pdfService->loadView('pdf.form.form-ta001', $data);
    }

    public function form_ta_002(Request $request)
    {
        if (!$request->userId) {
            return redirect('dashboard')->with('error', 'User tidak ditemukan');
        }
        $userId = $request->userId;
        $user = User::where('id', $userId)->first();
        $data['pengajuan'] = PengajuanTA::where('mahasiswa_id', $user->mahasiswa->id)->first();

        return $this->pdfService->loadView('pdf.form.form-ta002', $data);
    }

    public function jadwal_seminar_proposal(Request $request)
    {
        if (!$request->periodeId) {
            return redirect('dashboard')->with('error', 'Periode tidak tersedia');
        }
        $periodeId = $request->periodeId;
        $data['jadwals'] = JadwalSempro::where('periode_id', $periodeId)->get();
        $data['sempros'] = Sempro::with(['user.mahasiswa' => function($query) {
            $query->orderBy('nim', 'ASC');
        }])->where('periode_id', $periodeId)
            ->get()
            ->sortBy('user.mahasiswa.nim')
            ->sortBy(function($sempro) {
                return $sempro->status === 'Diterima' ? 0 : 1;
            });
        $data['periode'] = Periode::where('id', $periodeId)->first();
        return $this->pdfService->loadView('pdf.form.jadwal-seminar-proposal', $data, true, 'legal');
    }

    public function lembar_persetujuan_revisi(Request $request)
    {
        if (!$request->userId) {
            return redirect('dashboard')->with('error', 'User tidak tersedia');
        }
        $userId = $request->userId;
        $user = User::where('id', $userId)->first();
        $data['pengajuan'] = PengajuanTA::where('mahasiswa_id', $user->mahasiswa->id)->first();
        $data['revisiPembimbing1'] = RiwayatPendaftaranSempro::where('pengajuan_ta_id', $data['pengajuan']->id)
            ->where('sempro_id', $user->sempro->id)
            ->where('user_id', $data['pengajuan']->pembimbing1->id)
            ->where('status', 'Lembar Revisi Seminar Proposal Disetujui')
            ->first();
        $data['revisiPembimbing2'] = RiwayatPendaftaranSempro::where('pengajuan_ta_id', $data['pengajuan']->id)
            ->where('sempro_id', $user->sempro->id)
            ->where('user_id', $data['pengajuan']->pembimbing2->id)
            ->where('status', 'Lembar Revisi Seminar Proposal Disetujui')
            ->first();
        $data['revisiPenguji1'] = RiwayatPendaftaranSempro::where('pengajuan_ta_id', $data['pengajuan']->id)
            ->where('sempro_id', $user->sempro->id)
            ->where('user_id', $data['pengajuan']->jadwal->penguji1->id)
            ->where('status', 'Lembar Revisi Seminar Proposal Disetujui')
            ->first();
        $data['revisiPenguji2'] = RiwayatPendaftaranSempro::where('pengajuan_ta_id', $data['pengajuan']->id)
            ->where('sempro_id', $user->sempro->id)
            ->where('user_id', $data['pengajuan']->jadwal->penguji2->id)
            ->where('status', 'Lembar Revisi Seminar Proposal Disetujui')
            ->first();

        return $this->pdfService->loadView('pdf.form.lembar-persetujuan-revisi', $data);
    }

    public function form_ta_007(Request $request)
    {
        if (!$request->userId) {
            return redirect('dashboard')->with('error', 'User tidak ditemukan');
        }
        $userId = $request->userId;
        $user = User::where('id', $userId)->first();
        $data['pengajuan'] = PengajuanTA::where('mahasiswa_id', $user->mahasiswa->id)->first();

        return $this->pdfService->loadView('pdf.form.form-ta007', $data);
    }

    public function form_ta_008(Request $request)
    {
        if (!$request->userId) {
            return redirect('dashboard')->with('error', 'User tidak ditemukan');
        }
        $userId = $request->userId;
        $user = User::where('id', $userId)->first();
        $data['pengajuan'] = PengajuanTA::where('mahasiswa_id', $user->mahasiswa->id)->first();

        return $this->pdfService->loadView('pdf.form.form-ta008', $data);
    }

    public function jadwal_sidang_ta(Request $request)
    {
        if (!$request->periodeId) {
            return redirect('dashboard')->with('error', 'Periode tidak tersedia');
        }
        $periodeId = $request->periodeId;
        $data['jadwals'] = JadwalTA::where('periode_id', $periodeId)->get();
        $data['sempros'] = Sempro::with(['user.mahasiswa' => function($query) {
            $query->orderBy('nim', 'ASC');
        }])->where('periode_id', $periodeId)
            ->get()
            ->sortBy('user.mahasiswa.nim')
            ->sortBy(function($sempro) {
                return $sempro->status === 'Diterima' ? 0 : 1;
            });
        $data['sidangs'] = SidangTA::with(['user.mahasiswa' => function($query) {
            $query->orderBy('nim', 'ASC');
        }])->where('periode_id', $periodeId)
            ->get()
            ->sortBy('user.mahasiswa.nim')
            ->sortBy(function($sempro) {
                return $sempro->status === 'Diterima' ? 0 : 1;
            });
        $data['periode'] = Periode::where('id', $periodeId)->first();
        return $this->pdfService->loadView('pdf.form.jadwal-sidang-ta', $data, true, 'legal');
    }

    public function berita_acara_sempro(Request $request)
    {
        // Performance optimization
        set_time_limit(120);
        ini_set('memory_limit', '512M');
        
        if (!$request->periodeId) {
            return redirect('dashboard')->with('error', 'Periode tidak tersedia');
        }
        
        $periodeId = $request->periodeId;
        
        // FIX: Add eager loading for signatures and relationships
        $data['jadwals'] = JadwalSempro::with([
            'user.mahasiswa.pengajuanTA.pembimbing1:id,name,signature',
            'user.mahasiswa.pengajuanTA.pembimbing2:id,name,signature', 
            'user.sempro.penilaianSempros',
            'penguji1:id,name,signature',
            'penguji1.dosen',  // Remove field selection, load all dosen fields
            'penguji2:id,name,signature',
            'penguji2.dosen'   // Also add dosen for penguji2
        ])->where('periode_id', $periodeId)->get();
        
        $data['sempros'] = Sempro::with(['user.mahasiswa' => function($query) {
            $query->orderBy('nim', 'ASC');
        }])->where('periode_id', $periodeId)
            ->get()
            ->sortBy('user.mahasiswa.nim')
            ->sortBy(function($sempro) {
                return $sempro->status === 'Diterima' ? 0 : 1;
            });
            
        $data['periode'] = Periode::where('id', $periodeId)->first();
        
        return $this->pdfService->loadView('pdf.form.berita-acara-sempro', $data, false, 'legal');
    }

    public function berita_acara_sidang(Request $request)
    {
        if (!$request->periodeId) {
            return redirect('dashboard')->with('error', 'Periode tidak tersedia');
        }
        $periodeId = $request->periodeId;
        $data['jadwals'] = JadwalTA::where('periode_id', $periodeId)->get();
        $data['sempros'] = Sempro::with(['user.mahasiswa' => function($query) {
            $query->orderBy('nim', 'ASC');
        }])->where('periode_id', $periodeId)
            ->get()
            ->sortBy('user.mahasiswa.nim')
            ->sortBy(function($sempro) {
                return $sempro->status === 'Diterima' ? 0 : 1;
            });
        $data['sidangs'] = SidangTA::with(['user.mahasiswa' => function($query) {
            $query->orderBy('nim', 'ASC');
        }])->where('periode_id', $periodeId)
            ->get()
            ->sortBy('user.mahasiswa.nim')
            ->sortBy(function($sempro) {
                return $sempro->status === 'Diterima' ? 0 : 1;
            });
        $data['periode'] = Periode::where('id', $periodeId)->first();
        return $this->pdfService->loadView('pdf.form.berita-acara-sidang', $data, false, 'legal');
    }

    public function kesanggupan_revisi(Request $request)
    {
        if (!$request->userId) {
            return redirect('dashboard')->with('error', 'User tidak ditemukan');
        }
        $userId = $request->userId;
        $user = User::where('id', $userId)->first();
        $data['pengajuan'] = PengajuanTA::where('mahasiswa_id', $user->mahasiswa->id)->first();

        return $this->pdfService->loadView('pdf.form.kesanggupan-revisi', $data);
    }
}
