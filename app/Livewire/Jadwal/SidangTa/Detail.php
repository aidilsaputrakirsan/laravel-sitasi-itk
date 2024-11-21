<?php

namespace App\Livewire\Jadwal\SidangTa;

use App\Models\Dosen;
use App\Models\JadwalTA;
use App\Models\RiwayatPendaftaranSidangTA;
use App\Models\SidangTA;
use App\Traits\NotifikasiTraits;
use Livewire\Component;
use Livewire\WithPagination;

class Detail extends Component
{
    use WithPagination, NotifikasiTraits;
    public $addModal = false;
    public $periode_id;
    public $mahasiswas;
    public $editable = false;
    public $editState = [];
    public $editData = [];

    public function mount($periode_id)
    {
        $this->periode_id = $periode_id;
        $this->mahasiswas = SidangTA::where('status', 'Diterima')
            ->where('periode_id', $periode_id)
            ->get();
        $this->jsSidebarClose();
    }
    
    public function openModal()
    {
        $this->addModal = true;
        $this->jsOpenModal();
    }

    public function closeModal()
    {
        $this->addModal = false;
        $this->jsCloseModal();
    }

    public function editTable($index)
    {
        if (!isset($this->editState[$index])) {
            $this->editState[$index] = true;
        } else {
            $this->editState[$index] = !$this->editState[$index];
        }

        $existingData = JadwalTA::where('periode_id', $this->periode_id)
            ->where('user_id', $index)
            ->first();
        if ($existingData) {
            $this->editData[$index]['tanggal_sidang'] = $existingData->tanggal_sidang;
            $this->editData[$index]['waktu_mulai'] = $existingData->waktu_mulai;
            $this->editData[$index]['waktu_selesai'] = $existingData->waktu_selesai;
            $this->editData[$index]['ruangan'] = $existingData->ruangan;
        }
    }

    public function save($index, $pengajuan_id)
    {
        $jadwalSempro = JadwalTA::where('periode_id', $this->periode_id)
            ->where('user_id', $index)
            ->first();
        
        if(!$jadwalSempro) {
            $create = JadwalTA::create([
                'periode_id' => $this->periode_id,
                'pengajuan_ta_id' => $pengajuan_id,
                'user_id' => $index,
                'tanggal_sidang' => isset($this->editData[$index]['tanggal_sidang']) ? $this->editData[$index]['tanggal_sidang'] : null,
                'waktu_mulai' => isset($this->editData[$index]['waktu_mulai']) ? $this->editData[$index]['waktu_mulai'] : '',
                'waktu_selesai' => isset($this->editData[$index]['waktu_selesai']) ? $this->editData[$index]['waktu_selesai'] : '',
                'ruangan' => isset($this->editData[$index]['ruangan']) ? $this->editData[$index]['ruangan'] : '',
            ]);
            $sidang = SidangTA::where('user_id', $index)->where('periode_id', $this->periode_id)->first();
            if ($sidang) {
                RiwayatPendaftaranSidangTA::create([
                    'user_id' => auth()->id(),
                    'sidang_ta_id' => $sidang->id,
                    'pengajuan_ta_id' => $pengajuan_id,
                    'riwayat' => 'Jadwal Sidang TA',
                    'keterangan' => 'telah menetapkan jadwal Sidang TA Anda',
                    'status' => 'Jadwal Sidang TA'
                ]);
            }

            $this->addNotif(auth()->user()->id, $index, 'tendik-jadwal-sidang-ta', [
                'user_id' => auth()->id(),
                'jadwal_id' => $create->id,
                'message' => 'telah menetapkan jadwal Sidang TA Anda'
            ]);
        } else {
            $create = JadwalTA::where('periode_id', $this->periode_id)
                ->where('pengajuan_ta_id', $pengajuan_id)
                ->where('user_id', $index)
                ->update([
                'tanggal_sidang' => isset($this->editData[$index]['tanggal_sidang']) ? $this->editData[$index]['tanggal_sidang'] : null,
                'waktu_mulai' => isset($this->editData[$index]['waktu_mulai']) ? $this->editData[$index]['waktu_mulai'] : '',
                'waktu_selesai' => isset($this->editData[$index]['waktu_selesai']) ? $this->editData[$index]['waktu_selesai'] : '',
                'ruangan' => isset($this->editData[$index]['ruangan']) ? $this->editData[$index]['ruangan'] : '',
            ]);
        }

        $this->editTable($index);
    }

    public function render()
    {
        return view('livewire.jadwal.sidang-ta.detail');
    }
}
