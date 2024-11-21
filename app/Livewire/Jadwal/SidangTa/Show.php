<?php

namespace App\Livewire\Jadwal\SidangTa;

use App\Models\Periode;
use Livewire\Component;
use Livewire\WithPagination;

class Show extends Component
{
    use WithPagination;
    public $periode;
    public $editData = [];
    
    public function mount()
    {
        $this->periode = Periode::where('type', 'TA')->get();
        $this->refresh();
    }
    public function refresh()
    {
        foreach($this->periode as $p) {
            $this->editData[$p->id] = [
                'is_tampilkan' => $p->is_tampilkan,
            ];
        }
    }
    public function tampilkanJadwal($id)
    {
        $periodValue = $this->editData[$id]['is_tampilkan'];
        Periode::where('id', $id)->update([
            'is_tampilkan' => $periodValue,
        ]);
        $this->dispatch('alert:data', state: 'success', message: 'Jadwal diupdate ');
    }

    public function render()
    {
        return view('livewire.jadwal.sidang-ta.show');
    }
}
