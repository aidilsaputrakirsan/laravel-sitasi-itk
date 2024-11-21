<?php

namespace App\Livewire\DataUser\Mahasiswa;

use App\Models\Mahasiswa;
use App\Models\User;
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

    #[On('edit:mahasiswa')]
    public function setData($id)
    {
        $this->show = true;
        $this->mahasiswa = Mahasiswa::where('id', $id)->first();
        $this->nama = $this->mahasiswa->nama;
        $this->nim = $this->mahasiswa->nim;
        $this->email = $this->mahasiswa->email;
        $this->nomor_telepon = $this->mahasiswa->nomor_telepon;
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

        $this->js('location.reload()');

    }
    public function render()
    {
        return view('livewire.data-user.mahasiswa.edit');
    }
}
