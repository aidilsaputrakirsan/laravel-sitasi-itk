<?php

namespace App\Livewire\KatalogTa;

use App\Models\Katalog;
use App\Models\SidangTA;
use App\Models\RiwayatPendaftaranSidangTA;
use App\Traits\NotifikasiTraits;
use App\Traits\PeriodeTraits;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;

class MahasiswaShow extends Component
{
    use WithFileUploads, NotifikasiTraits, PeriodeTraits;
    
    public $sidang;
    public $katalog;
    public $photo;
    public $nama;
    public $nim;
    public $judul;
    public $abstrak;
    public $displayError;
    public $isRevisiComplete = false;
    public $isEligible = false;
    public $editablePhoto = false;
    public $editableData = false;

    public function mount()
    {
        $this->refresh();
        $this->checkEligibility();
    }

    public function refresh()
    {
        // Load sidang TA mahasiswa yang sudah diterima
        $this->sidang = SidangTA::where('user_id', auth()->id())
                               ->where('status', 'Diterima')
                               ->first();

        // Load katalog yang sudah dibuat mahasiswa (jika ada)
        $this->katalog = Katalog::where('user_id', auth()->id())
                                ->where('created_by', 'mahasiswa')
                                ->first();

        // Pre-fill data jika katalog sudah ada
        if ($this->katalog) {
            $this->nama = $this->katalog->nama;
            $this->nim = $this->katalog->nim;
            $this->judul = $this->katalog->judul;
            $this->abstrak = $this->katalog->abstrak;
        } else {
            // Pre-fill dengan data user dan pengajuan TA
            $this->nama = auth()->user()->name;
            $this->nim = auth()->user()->nim;
            
            // Ambil judul dari pengajuan TA jika ada
            if (auth()->user()->mahasiswa && auth()->user()->mahasiswa->pengajuanTA) {
                $this->judul = auth()->user()->mahasiswa->pengajuanTA->judul;
            }
        }
    }

    public function checkEligibility()
    {
        // Cek apakah sudah ada sidang TA yang diterima
        if (!$this->sidang) {
            $this->displayError = "Anda belum menyelesaikan sidang TA atau sidang TA belum diterima";
            $this->isEligible = false;
            return;
        }

        // Cek apakah semua revisi sudah selesai
        $this->isRevisiComplete = $this->sidang->revisi_pembimbing_1 && 
                                 $this->sidang->revisi_pembimbing_2 && 
                                 $this->sidang->revisi_penguji_1 && 
                                 $this->sidang->revisi_penguji_2;

        if (!$this->isRevisiComplete) {
            $this->displayError = "Anda belum menyelesaikan semua revisi sidang TA. Silakan selesaikan revisi dari pembimbing dan penguji terlebih dahulu.";
            $this->isEligible = false;
            return;
        }

        // Semua syarat terpenuhi
        $this->isEligible = true;
        $this->displayError = '';
    }

    public function submit()
    {
        // Double check eligibility
        if (!$this->isEligible) {
            return;
        }

        // Validation
        $this->validate([
            'photo' => $this->katalog ? 'nullable|image|max:2048' : 'required|image|max:2048',
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:20',
            'judul' => 'required|string|max:500',
            'abstrak' => 'required|string',
        ], [
            'photo.required' => 'Photo cover TA wajib diupload',
            'photo.image' => 'File harus berupa gambar',
            'photo.max' => 'Ukuran file maksimal 2MB',
            'nama.required' => 'Nama wajib diisi',
            'nim.required' => 'NIM wajib diisi',
            'judul.required' => 'Judul TA wajib diisi',
            'abstrak.required' => 'Abstrak wajib diisi',
        ]);

        if ($this->katalog) {
            // Update existing katalog
            $this->katalog->update([
                'photo' => $this->photo ? $this->photo->store('uploads/katalog', 'public') : $this->katalog->photo,
                'nama' => $this->nama,
                'nim' => $this->nim,
                'judul' => $this->judul,
                'abstrak' => $this->abstrak,
                'is_approved' => false, // Reset approval jika ada perubahan
            ]);

            $message = 'Katalog TA berhasil diperbarui dan menunggu persetujuan admin';
            $notifMessage = 'memperbarui katalog TA';
            $riwayatStatus = 'Update Katalog TA';
        } else {
            // Create new katalog
            $this->katalog = Katalog::create([
                'user_id' => auth()->id(),
                'sidang_ta_id' => $this->sidang->id,
                'photo' => $this->photo->store('uploads/katalog', 'public'),
                'nama' => $this->nama,
                'nim' => $this->nim,
                'judul' => $this->judul,
                'abstrak' => $this->abstrak,
                'created_by' => 'mahasiswa',
                'is_approved' => false,
            ]);

            $message = 'Katalog TA berhasil dibuat dan menunggu persetujuan admin';
            $notifMessage = 'membuat katalog TA';
            $riwayatStatus = 'Katalog TA Disubmit';
        }

        // Create history record
        RiwayatPendaftaranSidangTA::create([
            'user_id' => auth()->id(),
            'sidang_ta_id' => $this->sidang->id,
            'pengajuan_ta_id' => auth()->user()->mahasiswa->pengajuanTA->id,
            'riwayat' => 'Mengisi Katalog TA',
            'keterangan' => $notifMessage,
            'status' => $riwayatStatus
        ]);

        // Send notification to tendik/admin
        $this->addNotif(auth()->user()->id, null, 'tendik-katalog-ta', [
            'user_id' => auth()->id(),
            'katalog_id' => $this->katalog->id,
            'periode_id' => $this->sidang->periode_id,
            'message' => $notifMessage
        ]);

        // Reset form state
        $this->photo = null;
        $this->editablePhoto = false;
        $this->editableData = false;

        $this->dispatch('alert:data', state: 'success', message: $message);
        $this->refresh();
    }

    public function toggleEditPhoto()
    {
        $this->editablePhoto = !$this->editablePhoto;
        if (!$this->editablePhoto) {
            $this->photo = null; // Reset jika cancel
        }
    }

    public function toggleEditData()
    {
        $this->editableData = !$this->editableData;
        if (!$this->editableData) {
            // Reset ke data original jika cancel
            if ($this->katalog) {
                $this->nama = $this->katalog->nama;
                $this->nim = $this->katalog->nim;
                $this->judul = $this->katalog->judul;
                $this->abstrak = $this->katalog->abstrak;
            }
        }
    }

    public function render()
    {
        return view('livewire.katalog-ta.mahasiswa-show');
    }
}