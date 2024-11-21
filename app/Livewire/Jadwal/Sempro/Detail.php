<?php

namespace App\Livewire\Jadwal\Sempro;

use App\Models\Dosen;
use App\Models\JadwalSempro;
use App\Models\RiwayatPendaftaranSempro;
use App\Models\Sempro;
use App\Traits\NotifikasiTraits;
use App\Traits\UpdateDeleteTraits;
use Livewire\Component;
use Livewire\WithPagination;

class Detail extends Component
{
    use WithPagination, UpdateDeleteTraits, NotifikasiTraits;
    public $addModal = false;
    public $periode_id;
    public $mahasiswas;
    public $editable = false;
    public $editState = [];
    public $editData = [];
    public $dosens;

    public function mount($periode_id)
    {
        $this->periode_id = $periode_id;
        $this->mahasiswas = Sempro::where('status', 'Diterima')
            ->where('periode_id', $periode_id)
            ->get();
        $this->dosens = Dosen::all();
        $this->js("document.getElementById('body-data').setAttribute('class', 'pace-done sidebar-enable')");
        $this->js("document.getElementById('body-data').setAttribute('data-sidebar-size', 'sm')");
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

    public function editTable($index)
    {
        if (!isset($this->editState[$index])) {
            $this->editState[$index] = true;
        } else {
            $this->editState[$index] = !$this->editState[$index];
        }

        $existingData = JadwalSempro::where('periode_id', $this->periode_id)
            ->where('user_id', $index)
            ->first();
        if ($existingData) {
            $this->editData[$index]['penguji_1'] = $existingData->penguji_1;
            $this->editData[$index]['penguji_2'] = $existingData->penguji_2;
            $this->editData[$index]['tanggal_sempro'] = $existingData->tanggal_sempro;
            $this->editData[$index]['waktu_mulai'] = $existingData->waktu_mulai;
            $this->editData[$index]['waktu_selesai'] = $existingData->waktu_selesai;
            $this->editData[$index]['ruangan'] = $existingData->ruangan;
        }
    }
    
    public function save($index, $pengajuan_id)
    {
        $jadwalSempro = JadwalSempro::where('periode_id', $this->periode_id)
            ->where('user_id', $index)
            ->first();
        
        if(!$jadwalSempro) {
            $create = JadwalSempro::create([
                'periode_id' => $this->periode_id,
                'pengajuan_ta_id' => $pengajuan_id,
                'user_id' => $index,
                'penguji_1' => isset($this->editData[$index]['penguji_1']) ? $this->editData[$index]['penguji_1'] : null,
                'penguji_2' => isset($this->editData[$index]['penguji_2']) ? $this->editData[$index]['penguji_2'] : null,
                'tanggal_sempro' => isset($this->editData[$index]['tanggal_sempro']) ? $this->editData[$index]['tanggal_sempro'] : null,
                'waktu_mulai' => isset($this->editData[$index]['waktu_mulai']) ? $this->editData[$index]['waktu_mulai'] : '',
                'waktu_selesai' => isset($this->editData[$index]['waktu_selesai']) ? $this->editData[$index]['waktu_selesai'] : '',
                'ruangan' => isset($this->editData[$index]['ruangan']) ? $this->editData[$index]['ruangan'] : '',
            ]);
            $sempro = Sempro::where('user_id', $index)->where('periode_id', $this->periode_id)->first();
            if ($sempro) {
                RiwayatPendaftaranSempro::create([
                    'user_id' => auth()->id(),
                    'sempro_id' => $sempro->id,
                    'pengajuan_ta_id' => $pengajuan_id,
                    'riwayat' => 'Jadwal Seminar Proposal',
                    'keterangan' => 'telah menetapkan jadwal Seminar Proposal Anda',
                    'status' => 'Jadwal Seminar Proposal'
                ]);
            }

            $this->addNotif(auth()->user()->id, $index, 'tendik-jadwal-sempro', [
                'user_id' => auth()->id(),
                'jadwal_id' => $create->id,
                'message' => 'telah menetapkan jadwal Seminar Proposal Anda'
            ]);
        } else {
            $create = JadwalSempro::where('periode_id', $this->periode_id)
                ->where('pengajuan_ta_id', $pengajuan_id)
                ->where('user_id', $index)
                ->update([
                'penguji_1' => isset($this->editData[$index]['penguji_1']) ? $this->editData[$index]['penguji_1'] : null,
                'penguji_2' => isset($this->editData[$index]['penguji_2']) ? $this->editData[$index]['penguji_2'] : null,
                'tanggal_sempro' => isset($this->editData[$index]['tanggal_sempro']) ? $this->editData[$index]['tanggal_sempro'] : null,
                'waktu_mulai' => isset($this->editData[$index]['waktu_mulai']) ? $this->editData[$index]['waktu_mulai'] : '',
                'waktu_selesai' => isset($this->editData[$index]['waktu_selesai']) ? $this->editData[$index]['waktu_selesai'] : '',
                'ruangan' => isset($this->editData[$index]['ruangan']) ? $this->editData[$index]['ruangan'] : '',
            ]);
        }

        $this->editTable($index);
    }

    public function render()
    {
        return view('livewire.jadwal.sempro.detail');
    }
}
