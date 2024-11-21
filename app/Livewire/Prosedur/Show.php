<?php

namespace App\Livewire\Prosedur;

use App\Models\Prosedur;
use App\Traits\UpdateDeleteTraits;
use Livewire\Component;

class Show extends Component
{
    use UpdateDeleteTraits;
    public $judul;
    public $content;
    public $prosedurs;
    public $editId;
    public $editable = false;

    public function mount()
    {
        $this->setModel(Prosedur::class);
        $this->refresh();
    }

    public function refresh()
    {
        $this->prosedurs = Prosedur::orderBy('created_at', 'DESC')->get();
    }

    public function edit($id)
    {
        $this->editable = true;
        $this->editId = $id;
        $prosedur = Prosedur::where('id', $id)->first();
        $this->judul = $prosedur->judul;
        $this->content = $prosedur->content;
        $this->dispatch('content-updated', content: $prosedur->content);
    }

    public function cancel()
    {
        $this->editable = false;
        $this->editId = null;
        $this->judul = null;
        $this->content = null;
    }

    public function submit()
    {
        $this->validate([
            'judul' => 'required'
        ]);

        Prosedur::create([
            'judul' => $this->judul,
            'content' => $this->content,
        ]);
        $this->judul = null;
        $this->content = null;
        $this->dispatch('alert:data', state: 'success', message: 'Data Prosedur telah diupdate');
        $this->redirectRoute('prosedur:index');
    }

    public function save()
    {
        $this->validate([
            'judul' => 'required'
        ]);

        Prosedur::where('id', $this->editId)->update([
            'judul' => $this->judul,
            'content' => $this->content,
        ]);
        $this->judul = null;
        $this->content = null;
        $this->dispatch('alert:data', state: 'success', message: 'Data Prosedur telah diupdate');
        $this->redirectRoute('prosedur:index');
    }

    public function render()
    {
        return view('livewire.prosedur.show');
    }
}
