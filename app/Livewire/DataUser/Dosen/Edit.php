<?php

namespace App\Livewire\DataUser\Dosen;

use App\Models\Dosen;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\On;
use Livewire\Component;

class Edit extends Component
{
    public $show = false;
    public $dosen;
    public $nama;
    public $nip;
    public $email;
    public $roles = [];
    public $role;

    #[On('edit:dosen')]
    public function setData($id)
    {
        $this->show = true;
        $this->dosen = Dosen::where('id', $id)->first();
        $this->nama = $this->dosen->nama_dosen;
        $this->nip = $this->dosen->nip;
        $this->email = $this->dosen->email;
        $roles = $this->dosen->user->roles->pluck('name')->toArray();

        $roles = array_filter($roles, function($role) {
            return $role !== 'dosen';
        });
        $roles = array_values($roles);
        $this->roles = $roles;
        $this->js("document.getElementById('js-display-modal').setAttribute('class', 'modal-backdrop fade show')");
    }

    public function closeModal()
    {
        $this->show = false;
        $this->js("document.getElementById('js-display-modal').setAttribute('class', '')");
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

    public function edit()
    {
        $this->validate([
            'nama' => 'required',
            'nip' => 'required',
            'email' => 'required|email',
        ]);

        $user = User::where('email', $this->dosen->email)->first();

        $currentRoles = $user->roles->pluck('name')->toArray();

        $defaultRole = ['dosen'];
        $newRoles = array_merge($defaultRole, $this->roles);
        $filteredRoles = array_intersect($currentRoles, $newRoles);
        foreach ($newRoles as $role) {
            if (!in_array($role, $filteredRoles)) {
                $filteredRoles[] = $role;
            }
        }

        if ($user) {
            User::where('id', $user->id)->update([
                'name' => $this->nama,
                'username' => $this->email,
                'email' => $this->email,
                'password' => Hash::make($this->nip),
            ]);
            $user->syncRoles($filteredRoles);
        }

        Dosen::where('id', $this->dosen->id)->update([
            'nama_dosen' => $this->nama,
            'nip' => $this->nip,
            'email' => $this->email,
        ]);


        $this->js('location.reload()');
    }
    public function render()
    {
        return view('livewire.data-user.dosen.edit');
    }
}
