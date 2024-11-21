<?php

namespace App\Livewire\Bimbingan;

use App\Models\Bimbingan;
use App\Models\Dosen;
use App\Services\PdfService;
use App\Traits\UpdateDeleteTraits;
use Livewire\Component;
use Livewire\WithPagination;

class Show extends Component
{
    use WithPagination, UpdateDeleteTraits;
    public $addModal = false;

    public function mount()
    {
        $this->setModel(Bimbingan::class);
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

    public function edit($id)
    {
        $this->dispatch('edit:bimbingan', id: $id);
    }

    public function render()
    {
        $data['bimbingans'] = Bimbingan::where('user_id', auth()->id())->paginate(10);
        $data['dosens'] = Dosen::all();
        return view('livewire.bimbingan.show', $data);
    }
}
