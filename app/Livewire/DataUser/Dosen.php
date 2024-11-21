<?php

namespace App\Livewire\DataUser;

use App\Imports\DosenImport;
use App\Models\Dosen as DosenModel;
use App\Traits\UpdateDeleteTraits;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Dosen extends Component
{
    use UpdateDeleteTraits, WithFileUploads, WithPagination;

    public $addModal = false;
    public $importModal = false;
    public $roles = [];
    public $role;
    public $import;
    public $search;

    public function mount()
    {
        $this->setModel(DosenModel::class);
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

    public function edit($id)
    {
        $this->dispatch('edit:dosen', id: $id);
    }

    public function updatedRole()
    {
        if (!in_array($this->role, $this->roles)) {
            $this->roles[] = $this->role;
        }
        $this->role = null;
    }

    public function unsetRole($index)
    {
        unset($this->roles[$index]);
        $this->roles = array_values($this->roles);
    }

    public function submitImport()
    {
        try {
            Excel::import(new DosenImport, $this->import);
            $this->closeImportModal();
            $this->dispatch('alert:data', state: 'success', message: 'Data Dosen telah diupdate');
        } catch (\Throwable $th) {
            $this->dispatch('alert:data', state: 'error', message: 'Gagal Mengimport data');
        }
    }

    public function render()
    {
        $users = DosenModel::where('nama_dosen', 'like', "%$this->search%")
            ->orWhere('nip', 'like', "%$this->search%")
            ->orWhere('email', 'like', "%$this->search%")
            ->paginate(8);
        return view('livewire.data-user.dosen', [
            'users' => $users,
        ]);
    }
}
