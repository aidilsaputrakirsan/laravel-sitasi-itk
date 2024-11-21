<?php

namespace App\Livewire\DataPengajuan;

use App\Models\Notifikasi;
use App\Models\PengajuanTA;
use App\Models\RiwayatPengajuan;
use App\Traits\NotifikasiTraits;
use Livewire\Component;

class Judul extends Component
{
    use NotifikasiTraits;
    public $juduls;
    public $setujuModal;
    public $tolakModal;

    public $pengajuanId;
    public $alasan;

    public function mount()
    {
        $this->refresh();
    }

    public function refresh()
    {
        $this->juduls = PengajuanTA::where('pembimbing_1', auth()->id())
        ->orWhere('pembimbing_2', auth()->id())
        ->orderBy('created_at', 'DESC')
        ->get();
    }

    public function setPengajuanId($id)
    {
        $this->pengajuanId = $id;
    }

    public function setuju()
    {
        $pengajuan = PengajuanTA::where('id', $this->pengajuanId)->first();
        RiwayatPengajuan::create([
            'pengajuan_ta_id' => $pengajuan->id,
            'riwayat' => 'Menyetujui Judul',
            'user_id' => auth()->id(),
            'status' => 'Disetujui Pembimbing'
        ]);
        $this->addNotif(auth()->id(), $pengajuan->mahasiswa->user->id, 'judul-disetujui', [
            'pengajuan_id' => $this->pengajuanId,
            'message' => 'Menyetujui Judul Anda',
            'status' => 'setuju'
        ]);

        $this->dispatch('alert:data', state: 'success', message: 'Anda telah menyetujui judul '. $pengajuan->judul);

        $pembimbing1 = Notifikasi::where('data->pengajuan_id', $pengajuan->id)
            ->where('from_id', $pengajuan->pembimbing_1)
            ->where('type', 'judul-disetujui')
            ->first();
        $pembimbing2 = Notifikasi::where('data->pengajuan_id', $pengajuan->id)
            ->where('from_id', $pengajuan->pembimbing_2)
            ->where('type', 'judul-disetujui')
            ->first();

        if ($pembimbing1 && $pembimbing2) {
            Notifikasi::create([
                'from_id' => null,
                'to_id' => $pengajuan->mahasiswa->user->id,
                'type' => 'pengajuan-judul-disetujui',
                'data' => [
                    'pengajuan_id' => $this->pengajuanId,
                    'message' => 'Judul anda telah diterima kedua pembimbing',
                    'status' => 'setuju',
                ],
                'created_at' => now()->addSeconds(2),
            ]);
            PengajuanTA::where('id', $this->pengajuanId)
                ->update(['status' => 'Judul TA Diterima']);
        }
        $this->closeModalSetuju();
        $this->refresh();
    }

    public function tolak()
    {
        $pengajuan = PengajuanTA::where('id', $this->pengajuanId)->first();
        RiwayatPengajuan::create([
            'pengajuan_ta_id' => $pengajuan->id,
            'riwayat' => 'Judul Ditolak',
            'user_id' => auth()->id(),
            'keterangan' => $this->alasan,
            'status' => 'Ditolak Pembimbing'
        ]);
        $this->addNotif(auth()->id(), $pengajuan->mahasiswa->user->id, 'judul-ditolak', [
            'pengajuan_id' => $this->pengajuanId,
            'message' => 'Menolak Judul Anda',
            'status' => 'ditolak',
            'keterangan' => $this->alasan,
        ]);
        PengajuanTA::where('id', $this->pengajuanId)
                ->update(['status' => 'Judul Ditolak']);

        $this->dispatch('alert:data', state: 'success', message: 'Anda telah menolak judul ');
        $this->closeModalTolak();
        $this->refresh();
    }

    public function openModalSetuju($id)
    {
        $this->pengajuanId = $id;
        $this->setujuModal = true;
        $this->js("document.getElementById('js-display-modal').setAttribute('class', 'modal-backdrop fade show')");
    }

    public function closeModalSetuju()
    {
        $this->setujuModal = false;
        $this->js("document.getElementById('js-display-modal').setAttribute('class', '')");
    }

    public function openModalTolak($id)
    {
        $this->pengajuanId = $id;
        $this->tolakModal = true;
        $this->js("document.getElementById('js-display-modal').setAttribute('class', 'modal-backdrop fade show')");
    }

    public function closeModalTolak()
    {
        $this->tolakModal = false;
        $this->js("document.getElementById('js-display-modal').setAttribute('class', '')");
    }

    public function render()
    {
        return view('livewire.data-pengajuan.judul');
    }
}
