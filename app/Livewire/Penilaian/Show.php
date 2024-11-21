<?php

namespace App\Livewire\Penilaian;

use App\Models\PengajuanTA;
use App\Models\PenilaianSempro;
use App\Models\PenilaianSidangTa;
use Livewire\Attributes\Url;
use Livewire\Component;

class Show extends Component
{
    public $pengajuan;
    public $nilaiSempro;
    public $nilaiSidang;
    #[Url]
    public $tab = 'sempro';

    public function mount()
    {
        $this->pengajuan = PengajuanTA::where('mahasiswa_id', auth()->user()->mahasiswa->id)->first();
        if ($this->pengajuan && $this->pengajuan->mahasiswa->user->sempro) {
            $this->nilaiSempro = PenilaianSempro::where('sempro_id', $this->pengajuan->mahasiswa->user->sempro->id)->first();
        }
        if ($this->pengajuan && $this->pengajuan->mahasiswa->user->sidang) {
            $this->nilaiSidang = PenilaianSidangTa::where('sidang_ta_id', $this->pengajuan->mahasiswa->user->sidang->id)->first();
        }
    }

    public function changeTab($value)
    {
        $this->tab = $value;
    }

    public function render()
    {
        return view('livewire.penilaian.show');
    }
}
