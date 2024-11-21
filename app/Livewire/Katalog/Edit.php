<?php

namespace App\Livewire\Katalog;

use App\Models\Katalog;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;
    public $show = false;
    public $katalog;
    public $imgPhoto;
    public $photo;
    public $nama;
    public $nim;
    public $judul;
    public $abstrak;

    #[On('edit:katalog')]
    public function setData($id)
    {
        $this->show = true;
        $this->katalog = Katalog::where('id', $id)->first();
        $this->imgPhoto = $this->katalog->photo;
        $this->nama = $this->katalog->nama;
        $this->nim = $this->katalog->nim;
        $this->judul = $this->katalog->judul;
        $this->abstrak = $this->katalog->abstrak;
        $this->js("document.getElementById('js-display-modal').setAttribute('class', 'modal-backdrop fade show')");
    }

    public function closeModal()
    {
        $this->show = false;
        $this->js("document.getElementById('js-display-modal').setAttribute('class', '')");
    }

    public function submit()
    {
        $this->validate([
            'nama' => 'required',
            'nim' => 'required',
            'judul' => 'required',
            'abstrak' => 'required',
        ]);

        Katalog::where('id', $this->katalog->id)->update([
            'photo' => $this->photo !== null ? $this->photo->store('uploads/katalog', 'public') : $this->katalog->photo,
            'nama' => $this->nama,
            'nim' => $this->nim,
            'judul' => $this->judul,
            'abstrak' => $this->abstrak,
        ]);

        $this->closeModal();
        session()->flash('success', 'Data telah di update.');
        return $this->redirectRoute('katalog:index');
    }

    public function render()
    {
        return view('livewire.katalog.edit');
    }
}
