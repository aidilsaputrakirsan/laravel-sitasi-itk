<?php

namespace App\Livewire\UserProfile;

use App\Models\Bimbingan;
use App\Models\Dosen;
use App\Models\PengajuanTA;
use App\Models\Referensi;
use App\Models\RiwayatPengajuan;
use App\Models\User;
use Livewire\Component;
use App\Traits\NotifikasiTraits;
use App\Traits\UpdateDeleteTraits;
use Livewire\Attributes\Url;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;

class Show extends Component
{
    use NotifikasiTraits, WithPagination, UpdateDeleteTraits, NotifikasiTraits, WithFileUploads;

    public $addModal = false;
    public $bidang_minat;
    public $judul;
    public $is_tersedia;
    public $signature;
    public $imgSignature;
    public $photo;

    public $name;
    public $username;
    public $email;
    public $current_password;
    public $new_password;
    public $new_password_confirmation;

    #[Url]
    public $type;

    public function mount()
    {
        $this->setModel(Referensi::class);
        $this->refreshSignature();
        $this->loadUserData();
    }

     public function loadUserData()
    {
        $user = auth()->user();
        $this->name = $user->name;
        $this->username = $user->username;
        $this->email = $user->email;
    }

     public function updateProfile()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . auth()->id(),
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'photo' => 'nullable|image|max:2048'
        ]);

        $updateData = [
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
        ];

        // Handle photo upload
        if ($this->photo) {
            $updateData['photo'] = $this->photo->store('uploads/profile', 'public');
        }

        User::where('id', auth()->id())->update($updateData);

        $this->photo = null;
        $this->dispatch('alert:data', state: 'success', message: 'Profile berhasil diupdate');
    }

     public function changePassword()
    {
        $this->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6',
            'new_password_confirmation' => 'required|same:new_password'
        ], [
            'current_password.required' => 'Password lama wajib diisi',
            'new_password.required' => 'Password baru wajib diisi',
            'new_password.min' => 'Password baru minimal 6 karakter',
            'new_password_confirmation.required' => 'Konfirmasi password wajib diisi',
            'new_password_confirmation.same' => 'Konfirmasi password tidak cocok'
        ]);

        // Cek password lama
        if (!Hash::check($this->current_password, auth()->user()->password)) {
            $this->addError('current_password', 'Password lama tidak sesuai');
            return;
        }

        // Update password
        User::where('id', auth()->id())->update([
            'password' => Hash::make($this->new_password)
        ]);

        // Reset form
        $this->current_password = null;
        $this->new_password = null;
        $this->new_password_confirmation = null;

        $this->dispatch('alert:data', state: 'success', message: 'Password berhasil diubah');
    }

    public function refreshSignature()
    {
        $user = User::where('id', auth()->id())->first();
        $this->imgSignature = $user->signature;
    }

    public function changeTab($value)
    {
        $this->type = $value;
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

    public function saveSignature()
    {
        $this->validate([
            'signature' => 'required',
        ],[
            'signature.required' => 'Tanda tangan wajib di isi'
        ]);

        User::where('id', auth()->id())->update([
        'signature' => $this->signature->store('signatures', 'public')
        ]);
        
        $this->signature = null;
        $this->refreshSignature();
        $this->dispatch('alert:data', state: 'success', message: 'Tanda Tangan Telah di update ');
    }

    public function savePhoto()
    {
        $this->validate([
            'photo' => 'required',
        ],[
            'photo.required' => 'Foto harus di isi',
        ]);

        User::where('id', auth()->id())->update([
            'photo' => $this->photo->store('uploads/profile', 'public'),
        ]);
        session()->flash('success', 'Foto telah diupdate');
        $this->redirectRoute('user-profile:index');
    }
    
    public function render()
    {
        $data['bimbings'] = PengajuanTA::where('pembimbing_1', auth()->id())
            ->orWhere('pembimbing_2', auth()->id())
            ->get();

        $data['ujis'] = PengajuanTA::whereHas('jadwal', function ($query) {
            $query->where('penguji_1', auth()->id())
                ->orWhere('penguji_2', auth()->id());
        })->get();

        if (auth()->user()->isMahasiswa()) {
            return view('livewire.user-profile.mahasiswa-show');
        } else {
            if ($this->type === 'referensi') {
                $data['referensi'] = Referensi::where('user_id', auth()->id())->get();
                return view('livewire.user-profile.referensi', $data);
            }
            return view('livewire.user-profile.show', $data);
        }
        
    }
}
