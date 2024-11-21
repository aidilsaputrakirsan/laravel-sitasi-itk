<?php

namespace App\Livewire\Bimbingan;

use App\Models\Bimbingan;
use App\Models\Dosen;
use Livewire\Attributes\On;
use Livewire\Component;

class Edit extends Component
{
    public $show = false;
    public $bimbingan;
    public $tanggal;
    public $dosen;
    public $ket_bimbingan;
    public $hasil_bimbingan;
    public $dosens;

    public function mount()
    {
        $this->dosens = Dosen::all();
    }

    #[On('edit:bimbingan')]
    public function setData($id)
    {
        $this->bimbingan = Bimbingan::where('id', $id)->first();
        $this->tanggal = $this->bimbingan->tanggal;
        $this->dosen = $this->bimbingan->dosen;
        $this->ket_bimbingan = $this->bimbingan->ket_bimbingan;
        $this->hasil_bimbingan = $this->bimbingan->hasil_bimbingan;
        $this->show = true;
        $this->js("document.getElementById('js-display-modal').setAttribute('class', 'modal-backdrop fade show')");
    }

    public function closeModal()
    {
        $this->show = false;
        $this->js("document.getElementById('js-display-modal').setAttribute('class', '')");
    }

    public function edit()
    {
        $this->validate([
            'tanggal' => 'required',
            'ket_bimbingan' => 'required',
            'hasil_bimbingan' => 'required',
        ]);

        Bimbingan::where('id', $this->bimbingan->id)->update([
            'tanggal' => $this->tanggal,
            'ket_bimbingan' => $this->ket_bimbingan,
            'hasil_bimbingan' => $this->hasil_bimbingan,
        ]);
        
        $this->js('location.reload();');
    }

    public function render()
    {
        return view('livewire.bimbingan.edit');
    }
}
