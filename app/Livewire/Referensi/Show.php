<?php

namespace App\Livewire\Referensi;

use App\Models\Referensi;
use App\Traits\NotifikasiTraits;
use App\Traits\UpdateDeleteTraits;
use Livewire\Component;

class Show extends Component
{
    use UpdateDeleteTraits, NotifikasiTraits;
    public $addModal = false;
    public $bidang_minat;
    public $judul;
    public $is_tersedia;
    public function mount()
    {
        $this->setModel(Referensi::class);
    }
    public function openModal()
    {
        $this->addModal = true;
        $this->js("document.getElementById('js-display-modal').setAttribute('class', 'modal-backdrop fade show')");
    }

    public function closeModal()
    {
        $this->addModal = false;
        $this->js("document.getElementById('js-display-modal').setAttribute('class', '')");
    }

    public function submit()
    {
        $this->validate([
            'bidang_minat' => 'required',
            'judul' => 'required',
        ]);

        Referensi::create([
            'bidang_minat' => $this->bidang_minat,
            'judul' => $this->judul,
            'is_tersedia' => $this->is_tersedia ?? false,
            'user_id' => auth()->id(),
        ]);
        $this->bidang_minat = null;
        $this->judul = null;
        $this->is_tersedia = null;
        $this->closeModal();
        $this->dispatch('alert:data', state: 'success', message: 'Referensi Ditambahkan ');
    }

    public function edit($id)
    {
        $this->dispatch('edit:referensi', id: $id);
    }

    public function render()
    {
        return view('livewire.referensi.show', [
            'referensi' => Referensi::where('is_tersedia', true)->get(),
        ]);
    }
}
