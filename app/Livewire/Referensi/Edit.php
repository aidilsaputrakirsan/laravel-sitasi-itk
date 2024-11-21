<?php

namespace App\Livewire\Referensi;

use App\Models\Referensi;
use Livewire\Attributes\On;
use Livewire\Component;

class Edit extends Component
{
    public $show = false;
    public $referensi;
    public $bidang_minat;
    public $judul;
    public $is_tersedia = false;

    #[On('edit:referensi')]
    public function setData($id)
    {
        $this->show = true;
        $this->referensi = Referensi::where('id', $id)->first();
        $this->bidang_minat = $this->referensi->bidang_minat;
        $this->judul = $this->referensi->judul;
        $this->is_tersedia = $this->referensi->is_tersedia ? true : false;
        $this->js("document.getElementById('js-display-modal').setAttribute('class', 'modal-backdrop fade show')");
    }
    
    public function closeModal()
    {
        $this->show = false;
        $this->js("document.getElementById('js-display-modal').setAttribute('class', '')");
    }

    public function submit()
    {
        $this->validate([
            'bidang_minat' => 'required',
            'judul' => 'required',
        ]);

        Referensi::where('id', $this->referensi->id)->update([
            'bidang_minat' => $this->bidang_minat,
            'judul' => $this->judul,
            'is_tersedia' => $this->is_tersedia
        ]);
        session()->flash('success', 'Data telah di update.');
        return $this->redirectRoute('user-profile:index', ['type' => 'referensi']);
    }

    public function render()
    {
        return view('livewire.referensi.edit');
    }
}
