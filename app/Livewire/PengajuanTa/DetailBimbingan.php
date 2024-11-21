<?php

namespace App\Livewire\PengajuanTa;

use App\Models\Bimbingan;
use App\Models\User;
use App\Traits\NotifikasiTraits;
use Livewire\Component;

class DetailBimbingan extends Component
{
    use NotifikasiTraits;
    public $bimbingans;
    public $user;
    public $userId;
    public $setujuModal = false;
    public $bimbinganId;

    public function openModalSetuju($id)
    {
        $this->bimbinganId = $id;
        $this->setujuModal = true;
        $this->js("document.getElementById('js-display-modal').setAttribute('class', 'modal-backdrop fade show')");
    }

    public function closeModalSetuju()
    {
        $this->setujuModal = false;
        $this->js("document.getElementById('js-display-modal').setAttribute('class', '')");
    }

    public function mount($id)
    {
        $this->userId = $id;
        $this->refresh();
        $this->user = User::where('id', $id)->first();
    }

    public function setuju()
    {
        Bimbingan::where('id', $this->bimbinganId)->update([
            'status' => 'Approved'
        ]);

        $this->addNotif(auth()->id(), $this->user->id, 'bimbingan-disetujui', [
            'bimbingan_id' => $this->bimbinganId,
            'message' => 'Bimbingan telah di setujui',
            'status' => 'setuju'
        ]);
        $this->dispatch('alert:data', state: 'success', message: 'Bimbingan telah disetujui');
        $this->closeModalSetuju();
        $this->refresh();
    }

    public function refresh()
    {
        $this->bimbingans = Bimbingan::where('user_id', $this->userId)
            ->where('dosen', auth()->id())
            ->orderBy('tanggal', 'ASC')
            ->get();
    }
    
    public function render()
    {
        return view('livewire.pengajuan-ta.detail-bimbingan');
    }
}
