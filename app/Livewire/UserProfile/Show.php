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

    #[Url]
    public $type;

    public function mount()
    {
        $this->setModel(Referensi::class);
        $this->refreshSignature();
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
