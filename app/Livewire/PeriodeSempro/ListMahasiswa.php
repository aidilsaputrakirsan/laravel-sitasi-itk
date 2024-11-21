<?php

namespace App\Livewire\PeriodeSempro;

use App\Models\Periode;
use App\Models\RiwayatPendaftaranSempro;
use App\Models\Sempro;
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
        $this->list = Sempro::where('periode_id', $this->periodId)->get();
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
            Sempro::where('id', $this->listId)->update([
                'status' => $status,
            ]);
            $user = User::where('id', $this->userId)->first();
            RiwayatPendaftaranSempro::create([
                'user_id' => auth()->id(),
                'pengajuan_ta_id' => $user->mahasiswa->pengajuanTA->id,
                'sempro_id' => $this->listId,
                'riwayat' => 'Menerima berkas Seminar Proposal',
                'keterangan' => 'Berkas Seminar Proposal Disetujui',
                'status' => 'Terima Seminar Proposal'
            ]);

            $this->addNotif(auth()->user()->id, $this->userId, 'tendik-terima-sempro', [
                'user_id' => auth()->id(),
                'message' => 'menerima berkas seminar proposal anda'
            ]);
            $this->refresh();
            $this->dispatch('alert:data', state: 'success', message: 'Seminar di terima ');
        }
    }

    public function tolakSempro()
    {
        Sempro::where('id', $this->listId)->update([
            'status' => 'Ditolak',
        ]);
        $user = User::where('id', $this->userId)->first();
        RiwayatPendaftaranSempro::create([
            'user_id' => auth()->id(),
            'pengajuan_ta_id' => $user->mahasiswa->pengajuanTA->id,
            'sempro_id' => $this->listId,
            'riwayat' => 'Menolak berkas Seminar Proposal',
            'keterangan' => 'Silahkan mendaftar di gelombang selanjutnya',
            'status' => 'Tolak Seminar Proposal'
        ]);

        $this->addNotif(auth()->user()->id, $this->userId, 'tendik-tolak-sempro', [
            'user_id' => auth()->id(),
            'message' => 'menolak berkas seminar proposal anda'
        ]);
        $this->refresh();
        $this->closeTolakModal();
        $this->dispatch('alert:data', state: 'success', message: 'Seminar di tolak ');
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
        RiwayatPendaftaranSempro::create([
            'user_id' => auth()->id(),
            'pengajuan_ta_id' => $user->mahasiswa->pengajuanTA->id,
            'sempro_id' => $this->listId,
            'riwayat' => 'Merevisi Pengajuan TA',
            'keterangan' => $this->alasan,
            'status' => 'Revisi Pengajuan'
        ]);
        Sempro::where('id', $this->listId)->update([
            'status' => 'Revisi',
        ]);
        $this->addNotif(auth()->user()->id, $this->userId, 'tendik-revisi-sempro', [
            'user_id' => auth()->id(),
            'message' => 'meminta melakukan revisi'
        ]);
        $this->refresh();
        $this->closeRevisiModal();
        $this->dispatch('alert:data', state: 'success', message: 'Seminar di revisi ');
    }
    
    public function render()
    {
        return view('livewire.periode-sempro.list-mahasiswa');
    }
}
