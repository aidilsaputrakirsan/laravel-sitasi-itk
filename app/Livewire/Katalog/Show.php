<?php

namespace App\Livewire\Katalog;

use App\Imports\KatalogImport;
use App\Models\Katalog;
use App\Traits\NotifikasiTraits;
use App\Traits\UpdateDeleteTraits;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class Show extends Component
{
    use WithFileUploads, UpdateDeleteTraits;
    public $katalogs;
    public $addModal = false;
    public $importModal = false;
    public $photo;
    public $nama;
    public $nim;
    public $judul;
    public $abstrak;
    public $import;

    public function mount()
    {
        $this->setModel(Katalog::class);
        $this->refresh();
    }

    public function refresh()
    {
        $this->katalogs = Katalog::all();
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

    public function openImportModal()
    {
        $this->importModal = true;
        $this->js("document.getElementById('js-display-modal').setAttribute('class', 'modal-backdrop fade show')");
    }

    public function closeImportModal()
    {
        $this->importModal = false;
        $this->js("document.getElementById('js-display-modal').setAttribute('class', '')");
    }

    public function submit()
    {
        $this->validate([
            'photo' => 'required',
            'nama' => 'required',
            'nim' => 'required',
            'judul' => 'required',
            'abstrak' => 'required',
        ]);

        Katalog::create([
            'photo' => $this->photo->store('uploads/katalog', 'public'),
            'nama' => $this->nama,
            'nim' => $this->nim,
            'judul' => $this->judul,
            'abstrak' => $this->abstrak,
        ]);
        $this->refresh();
        $this->photo = null;
        $this->nama = null;
        $this->nim = null;
        $this->judul = null;
        $this->abstrak = null;
        $this->closeModal();
        $this->dispatch('alert:data', state: 'success', message: 'Data Katalog telah diupdate');
    }

    public function submitImport()
    {
        Excel::import(new KatalogImport, $this->import);
        $this->refresh();
        $this->closeImportModal();
        $this->dispatch('alert:data', state: 'success', message: 'Data Katalog telah diupdate');
    }

    public function edit($id)
    {
        $this->dispatch('edit:katalog', id: $id);
    }

    public function render()
    {
        return view('livewire.katalog.show');
    }
}
