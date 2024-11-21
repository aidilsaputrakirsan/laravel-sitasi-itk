<?php

namespace App\Livewire\PengajuanTa;

use App\Models\Bimbingan as ModelsBimbingan;
use Livewire\Component;

class Bimbingan extends Component
{
    public $bimbingans;

    public function mount()
    {
        $this->bimbingans = ModelsBimbingan::where('dosen', auth()->id())
            ->select('user_id', 'dosen')
            ->groupBy('user_id', 'dosen')
            ->get();
    }
    public function render()
    {
        return view('livewire.pengajuan-ta.bimbingan');
    }
}
