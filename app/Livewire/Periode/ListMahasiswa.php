<?php

namespace App\Livewire\Periode;

use App\Models\Periode;
use App\Models\RiwayatPendaftaranSidangTA;
use App\Models\Sempro;
use App\Models\SidangTA;
use App\Models\User;
use App\Traits\NotifikasiTraits;
use Livewire\Component;

class ListMahasiswa extends Component
{
    use NotifikasiTraits;
    public $periodId;
    public $list;
    public $listId;
    public $period;
    public $revisiModal = false;
    public $tolakModal = false;
    public $revisi;
    public $userId;
    public $taId;
    public $alasan;

    public function mount($id)
    {
        $this->periodId = $id;
        $this->refresh();
    }

    public function refresh()
    {
        $this->list = SidangTA::where('periode_id', $this->periodId)->get();
        $this->period = Periode::where('id', $this->periodId)->first();
    }

    public function updateStatus($id, $listId, $status)
    {
        $this->userId = $id;
        $this->listId = $listId;
        if ($status === 'Revisi') {
            $this->revisiModal = true;
            $this->js("document.getElementById('js-display-modal').setAttribute('class', 'modal-backdrop fade show')");
        } else if($status === 'Ditolak') {
            $this->tolakModal = true;
            $this->js("document.getElementById('js-display-modal').setAttribute('class', 'modal-backdrop fade show')");
        } else {
            SidangTA::where('id', $this->listId)->update([
                'status' => $status,
            ]);
            $user = User::where('id', $this->userId)->first();
            RiwayatPendaftaranSidangTA::create([
                'user_id' => auth()->id(),
                'pengajuan_ta_id' => $user->mahasiswa->pengajuanTA->id,
                'sidang_ta_id' => $this->listId,
                'riwayat' => 'Menerima berkas Sidang TA',
                'keterangan' => 'Berkas Sidang TA Disetujui',
                'status' => 'Terima Sidang TA'
            ]);

            $this->addNotif(auth()->user()->id, $this->userId, 'tendik-terima-sidang-ta', [
                'user_id' => auth()->id(),
                'message' => 'menerima berkas sidang TA anda'
            ]);
            $this->refresh();
            $this->dispatch('alert:data', state: 'success', message: 'Sidang TA di terima ');
        }
    }

    public function tolakSidang()
    {
        SidangTA::where('id', $this->listId)->update([
            'status' => 'Ditolak',
        ]);
        $user = User::where('id', $this->userId)->first();
        RiwayatPendaftaranSidangTA::create([
            'user_id' => auth()->id(),
            'pengajuan_ta_id' => $user->mahasiswa->pengajuanTA->id,
            'sidang_ta_id' => $this->listId,
            'riwayat' => 'Menolak berkas Sidang TA',
            'keterangan' => 'Silahkan mendaftar di gelombang selanjutnya',
            'status' => 'Tolak Sidang TA'
        ]);

        $this->addNotif(auth()->user()->id, $this->userId, 'tendik-tolak-sidang-ta', [
            'user_id' => auth()->id(),
            'message' => 'menolak berkas sidang TA anda'
        ]);
        $this->refresh();
        $this->closeTolakModal();
        $this->dispatch('alert:data', state: 'success', message: 'Sidang TA di tolak ');
    }

    public function closeRevisiModal()
    {
        $this->revisiModal = false;
        $this->js("document.getElementById('js-display-modal').setAttribute('class', '')");
    }
    public function closeTolakModal()
    {
        $this->tolakModal = false;
        $this->js("document.getElementById('js-display-modal').setAttribute('class', '')");
    }

    public function submitRevisi()
    {
        $user = User::where('id', $this->userId)->first();
        RiwayatPendaftaranSidangTA::create([
            'user_id' => auth()->id(),
            'pengajuan_ta_id' => $user->mahasiswa->pengajuanTA->id,
            'sidang_ta_id' => $this->listId,
            'riwayat' => 'Merevisi Pengajuan Sidang TA',
            'keterangan' => $this->alasan,
            'status' => 'Revisi Pengajuan Sidang TA'
        ]);
        SidangTA::where('id', $this->listId)->update([
            'status' => 'Revisi',
        ]);
        $this->addNotif(auth()->user()->id, $this->userId, 'tendik-revisi-sidang-ta', [
            'user_id' => auth()->id(),
            'message' => 'meminta melakukan revisi'
        ]);
        $this->refresh();
        $this->closeRevisiModal();
        $this->dispatch('alert:data', state: 'success', message: 'Sidang TA di revisi ');
    }


    
    public function render()
    {
        return view('livewire.periode.list-mahasiswa');
    }
}
