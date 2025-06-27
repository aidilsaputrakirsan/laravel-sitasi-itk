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
    use WithFileUploads, UpdateDeleteTraits, NotifikasiTraits;
    
    public $katalogs;
    public $katalogsPending = []; // TAMBAHKAN INI
    public $addModal = false;
    public $importModal = false;
    public $photo;
    public $nama;
    public $nim;
    public $judul;
    public $abstrak;
    public $import;
    public $activeTab = 'all'; // TAMBAHKAN INI

    public $canManage = false; // Bisa edit/hapus/approve
    public $canAdd = false;    // Bisa tambah katalog
    public $isReadOnly = false; // Dosen dan mahasiswa view

    public function mount()
    {
        $this->setModel(Katalog::class);
        $this->checkUserAccess();
        $this->refresh();
    }

    public function checkUserAccess()
    {
        $user = auth()->user();
        
        if ($user->isTendik() || $user->hasRole('admin')) {
            // Admin/Tendik: Full access
            $this->canManage = true;
            $this->canAdd = true;
            $this->isReadOnly = false;
        } elseif ($user->isDosen()) {
            // Dosen: Read-only
            $this->canManage = false;
            $this->canAdd = false;
            $this->isReadOnly = true;
        } else {
            // Mahasiswa: Read-only (tidak seharusnya sampai sini, tapi fallback)
            $this->canManage = false;
            $this->canAdd = false;
            $this->isReadOnly = true;
        }
    }

    public function refresh()
    {
        if ($this->isReadOnly) {
            // Untuk dosen dan mahasiswa: hanya tampilkan katalog yang approved
            $this->katalogs = Katalog::with(['user', 'sidangTA'])
                                    ->where(function($query) {
                                        $query->where('created_by', 'admin')
                                              ->orWhere('is_approved', true);
                                    })
                                    ->latest()
                                    ->get();
            
            // Tidak perlu pending untuk read-only
            $this->katalogsPending = collect([]);
        } else {
            // Untuk admin/tendik: tampilkan semua
            $this->katalogs = Katalog::with(['user', 'sidangTA'])
                                    ->where(function($query) {
                                        $query->where('created_by', 'admin')
                                              ->orWhere('is_approved', true);
                                    })
                                    ->latest()
                                    ->get();

            // Pending approval from mahasiswa
            $this->katalogsPending = Katalog::with(['user', 'sidangTA'])
                                           ->where('created_by', 'mahasiswa')
                                           ->where('is_approved', false)
                                           ->latest()
                                           ->get();
        }
    }

    public function openModal()
    {
        if (!$this->canAdd) return; // Prevent access
        
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
        if (!$this->canAdd) return; // Prevent access
        
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

        if (!$this->canAdd) return;

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
            'created_by' => 'admin',
            'is_approved' => true, 
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

        if (!$this->canAdd) return; // Prevent access

        Excel::import(new KatalogImport, $this->import);
        $this->refresh();
        $this->closeImportModal();
        $this->dispatch('alert:data', state: 'success', message: 'Data Katalog telah diupdate');
    }

    public function edit($id)
    {

        if (!$this->canManage) return;

        $this->dispatch('edit:katalog', id: $id);
    }

    public function approveKatalog($id)
    {
        if (!$this->canManage) return;

        $katalog = Katalog::findOrFail($id);
        $katalog->update(['is_approved' => true]);

        // Send notification to mahasiswa
        if ($katalog->user_id) {
            $this->addNotif(auth()->user()->id, $katalog->user_id, 'katalog-approved', [
                'katalog_id' => $katalog->id,
                'message' => 'Katalog TA Anda telah disetujui dan akan tampil di halaman katalog publik'
            ]);
        }

        $this->refresh();
        $this->dispatch('alert:data', state: 'success', message: 'Katalog telah disetujui');
    }

    // TAMBAHKAN METHOD BARU INI
    public function rejectKatalog($id)
    {
        if (!$this->canManage) return;

        $katalog = Katalog::findOrFail($id);
        
        // Send notification to mahasiswa untuk revisi
        if ($katalog->user_id) {
            $this->addNotif(auth()->user()->id, $katalog->user_id, 'katalog-rejected', [
                'katalog_id' => $katalog->id,
                'message' => 'Katalog TA Anda perlu diperbaiki. Silakan cek dan perbaiki data yang diperlukan'
            ]);
        }

        $this->dispatch('alert:data', state: 'info', message: 'Notifikasi revisi telah dikirim ke mahasiswa');
    }

    // TAMBAHKAN METHOD BARU INI
    public function setActiveTab($tab)
    {
        $this->activeTab = $tab;
    }
    
    public function delete($id)
    {
        if (!$this->canManage) return; // Prevent access
        
        $this->setDeleteId($id);
    }
    
    public function render()
    {
        return view('livewire.katalog.show');
    }
}