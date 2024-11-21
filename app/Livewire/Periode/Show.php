<?php

namespace App\Livewire\Periode;

use App\Models\Periode;
use App\Traits\UpdateDeleteTraits;
use Livewire\Component;
use Livewire\WithPagination;

class Show extends Component
{
    use WithPagination, UpdateDeleteTraits;
    public $addModal = false;

    public function mount()
    {
        $this->setModel(Periode::class);
    }

    public function active($id)
    {
        $allNonactive = Periode::where('status', 'Active')
            ->where('type', 'TA')
            ->update(['status' => 'Nonactive']);

        // Set Period Aktif for $id
        Periode::where('id', $id)->update(['status' => 'Active']);
    }

    public function nonactive($id)
    {
        Periode::where('id', $id)->update(['status' => 'Nonactive']);
    }

    public function edit($id)
    {
        $this->dispatch('edit:periode', id: $id);
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

    public function render()
    {
        $data['periode'] = Periode::where('type', 'TA')->get();
        return view('livewire.periode.show', $data);
    }
}
