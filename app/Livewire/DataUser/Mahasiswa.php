<?php

namespace App\Livewire\DataUser;

use App\Imports\MahasiswaImport;
use App\Traits\UpdateDeleteTraits;
use Livewire\Component;
use App\Models\Mahasiswa as MahasiswaModel;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Mahasiswa extends Component
{
    use UpdateDeleteTraits, WithFileUploads, WithPagination;
    public $addModal = false;
    public $importModal = false;
    public $import;
    public $search;
    public function mount()
    {
        $this->setModel(MahasiswaModel::class);
    }

    public function edit($id)
    {
        $this->dispatch('edit:mahasiswa', id: $id);
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

    public function submitImport()
    {
        try {
            Excel::import(new MahasiswaImport, $this->import);
            $this->closeImportModal();
            $this->dispatch('alert:data', state: 'success', message: 'Data Mahasiswa telah diupdate');
        } catch (\Throwable $th) {
            $this->dispatch('alert:data', state: 'error', message: 'Gagal mengimport data');
        }   
    }
    public function render()
    {
        $users = MahasiswaModel::where('nama', 'like', "%$this->search%")
            ->orWhere('nim', 'like', "%$this->search%")
            ->orWhere('email', 'like', "%$this->search%")
            ->orWhere('nomor_telepon', 'like', "%$this->search")
            ->paginate(8);
        return view('livewire.data-user.mahasiswa', [
            'users' => $users
        ]);
    }
}
