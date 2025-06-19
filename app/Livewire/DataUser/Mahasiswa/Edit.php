<?php
namespace App\Livewire\DataUser\Mahasiswa;

use App\Models\Mahasiswa;
use App\Models\User;
use App\Models\PengajuanTA;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\On;
use Livewire\Component;

class Edit extends Component
{
    public $show = false;
    public $mahasiswa;
    public $nama;
    public $nim;
    public $email;
    public $nomor_telepon;
    
    // TAMBAHAN: Properties untuk pembimbing
    public $pembimbing_1;
    public $pembimbing_2; 
    public $dosenList = [];
    public $hasPengajuanTA = false;
    public $judulTA;

    #[On('edit:mahasiswa')]
    public function setData($id)
    {
        $this->show = true;
        $this->mahasiswa = Mahasiswa::where('id', $id)->first();
        $this->nama = $this->mahasiswa->nama;
        $this->nim = $this->mahasiswa->nim;
        $this->email = $this->mahasiswa->email;
        $this->nomor_telepon = $this->mahasiswa->nomor_telepon;
        
        // TAMBAHAN: Load data pembimbing
        $this->dosenList = User::whereHas('dosen')->get();
        
        $pengajuan = PengajuanTA::where('mahasiswa_id', $this->mahasiswa->id)->first();
        if($pengajuan) {
            $this->hasPengajuanTA = true;
            $this->pembimbing_1 = $pengajuan->pembimbing_1;
            $this->pembimbing_2 = $pengajuan->pembimbing_2;
            $this->judulTA = $pengajuan->judul;
        } else {
            $this->hasPengajuanTA = false;
            $this->pembimbing_1 = null;
            $this->pembimbing_2 = null;
            $this->judulTA = null;
        }
        
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
            'nama' => 'required',
            'nim' => 'required',
            'email' => 'required|email'
        ]);
        
        $user = User::where('email', $this->mahasiswa->email)->first();
        if ($user) {
            User::where('id', $user->id)->update([
                'name' => $this->nama,
                'username' => $this->email,
                'email' => $this->email,
                'password' => Hash::make($this->nim),
            ]);
        }
        
        Mahasiswa::where('id', $this->mahasiswa->id)->update([
            'nama' => $this->nama,
            'nim' => $this->nim,
            'email' => $this->email,
            'nomor_telepon' => $this->nomor_telepon,
        ]);
        
        // TAMBAHAN: Update pembimbing + reset approval jika berubah
        if($this->hasPengajuanTA && ($this->pembimbing_1 || $this->pembimbing_2)) {
            $pengajuan = PengajuanTA::where('mahasiswa_id', $this->mahasiswa->id)->first();
        
            // Cek apakah pembimbing berubah
            $pembimbing1Changed = $pengajuan->pembimbing_1 != $this->pembimbing_1;
            $pembimbing2Changed = $pengajuan->pembimbing_2 != $this->pembimbing_2;
        
            // Update data pembimbing
            $updateData = [
                'pembimbing_1' => $this->pembimbing_1,
                'pembimbing_2' => $this->pembimbing_2,
            ];
        
            // Reset approval jika pembimbing berubah
            if($pembimbing1Changed) {
                $updateData['approve_pembimbing1'] = false;
            }
            if($pembimbing2Changed) {
                $updateData['approve_pembimbing2'] = false;
            }
            
            // TAMBAHAN: Reset status judul jika pembimbing berubah
            if($pembimbing1Changed || $pembimbing2Changed) {
                $updateData['status'] = 'Pending'; // Reset ke status awal
            }
        
            PengajuanTA::where('mahasiswa_id', $this->mahasiswa->id)->update($updateData);
        }
        
        $this->js('location.reload()');
    }

    public function render()
    {
        return view('livewire.data-user.mahasiswa.edit');
    }
}