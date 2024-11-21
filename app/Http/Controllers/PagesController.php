<?php

namespace App\Http\Controllers;

use App\Models\Bimbingan;
use App\Models\Dosen;
use App\Models\PengajuanTA;
use App\Models\Periode;
use App\Models\Referensi;
use App\Models\Sempro;
use App\Models\SidangTA;
use App\Traits\PeriodeTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    use PeriodeTraits;
    public function loginPage()
    {
        return view('session.login-session');
    }

    public function dashboardPage()
    {
        if(Auth::check()) {
            // session()->flash('success', 'Berhasil login');
            $data['mahasiswa'] = PengajuanTA::count();
            $data['sempro'] = $this->getSemproActive() !== null ? Sempro::where('periode_id', $this->getSemproActive())->count() : 0;
            $data['sidang'] = $this->getSidangActive() !== null ? SidangTA::where('periode_id', $this->getSidangActive())->count() : 0;
            $data['dosen'] = Dosen::count();
            $data['referensis'] = Referensi::where('is_tersedia', true)->take(5)->get();
            $data['periodeTA'] = Periode::where('type', 'TA')->where('status', 'Active')->first();

            if (auth()->user()->isMahasiswa()) {
                return view('dashboard', $data);
            } else {
                return view('dashboard-dosen', $data);
            }
        } else {
            return redirect('/login');
        }
    }

    public function bimbinganPage()
    {
        return view('pages.bimbingan.index');
    }

    public function editBimbinganPage($id)
    {
        $bimbingan = Bimbingan::find($id);
        return view('/bimbingan/edit-bimbingan', compact('bimbingan'));
    }

    public function semproPage()
    {
        return view('pages.sempro.index');
    }

    public function sidangPage()
    {
        return view('sidang');
    }

    public function penilaianPage()
    {
        return view('pages.penilaian.index');
    }

    public function periodePage()
    {
        return view('pages.periode.index');
    }

    public function listMahasiswaPage($id)
    {
        return view('pages.periode.list-mahasiswa', compact('id'));
    }

    public function periodeSemproPage()
    {
        return view('pages.periode-sempro.index');
    }

    public function listMahasiswaSempro($id)
    {
        return view('pages.periode-sempro.list-mahasiswa', compact('id'));
    }

    public function pengajuanTaPage()
    {
        return view('pages.pengajuan-ta.index');
    }

    public function userProfilePage()
    {
        return view('pages.user-profile.index');
    }

    public function judulTaPage()
    {
        return view('pages.data-pengajuan.judul-ta');
    }

    public function sidangTa()
    {
        return view('pages.data-pengajuan.sidang-ta');
    }

    public function pengajuanBimbingan()
    {
        return view('pages.pengajuan-ta.bimbingan');
    }

    public function detailBimbingan($id)
    {
        return view('pages.pengajuan-ta.detail-bimbingan', compact('id'));
    }

    public function pengajuanSeminarProposal()
    {
        return view('pages.pengajuan-ta.seminar-proposal');
    }

    public function pengajuanSidangTA()
    {
        return view('pages.pengajuan-ta.sidang-ta');
    }

    public function jadwalSemproPage()
    {
        return view('pages.jadwal.sempro.index');
    }

    public function detailJadwalSemproPage($periode_id)
    {
        return view('pages.jadwal.sempro.detail', compact('periode_id'));
    }

    public function jadwalSidangPage()
    {
        return view('pages.jadwal.sidang-ta.index');
    }

    public function detailJadwalSidangPage($periode_id)
    {
        return view('pages.jadwal.sidang-ta.detail', compact('periode_id'));
    }

    public function referensiPage()
    {
        return view('pages.referensi.index');
    }

    public function katalogPage()
    {
        return view('pages.katalog.index');
    }

    public function prosedurPage()
    {
        return view('pages.prosedur.index');
    }
}
