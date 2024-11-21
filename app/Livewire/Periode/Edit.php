<?php

namespace App\Livewire\Periode;

use App\Models\Periode;
use Livewire\Attributes\On;
use Livewire\Component;

class Edit extends Component
{
    public $show = false;
    public $periods;
    public $semester;
    public $periode;
    public $gelombang;

    #[On('edit:periode')]
    public function setData($id)
    {
        $this->show = true;
        $this->periods = Periode::where('id', $id)->first();
        $this->periode = $this->periods->semester;
        $this->periode = $this->periods->periode;
        $this->gelombang = $this->periods->gelombang;
        $this->js("document.getElementById('js-display-modal').setAttribute('class', 'modal-backdrop fade show')");
    }

    public function closeModal()
    {
        $this->show = false;
        $this->js("document.getElementById('js-display-modal').setAttribute('class', '')");
        $this->js('location.reload()');
    }

    public function edit()
    {
        $this->validate([
            'periode' => 'required',
            'semester' => 'required',
            'gelombang' => 'required',
        ]);

        Periode::where('id', $this->periods->id)->update([
            'periode' => $this->periode,
            'semester' => $this->semester,
            'gelombang' =>  $this->gelombang
        ]);
        $this->js('location.reload()');
    }

    public function render()
    {
        return view('livewire.periode.edit');
    }
}
