<?php

namespace App\Livewire;

use App\Models\Notifikasi;
use App\Traits\NotifikasiTraits;
use Livewire\Component;

class Notification extends Component
{
    use NotifikasiTraits;
    public $show = false;

    public function toggle()
    {
        $this->show = !$this->show;
        $this->readFromNotif(auth()->id());
        if (auth()->user()->isTendik()) {
            $this->readTendik();
        }
    }

    public function close()
    {
        $this->show = false;
    }

    public function render()
    {
        $jumlahNotifikasi = Notifikasi::where('to_id', auth()->id())->where('read', 0)->count();
        $notifikasi = Notifikasi::where('to_id', auth()->id())->orderBy('created_at', 'DESC');
        if (auth()->user()->isTendik()) {
            $jumlahNotif = Notifikasi::whereIn('type', ['tendik-seminar-proposal', 'tendik-sidang-ta', 'tendik-update-sidang-ta'])
                ->where('read', 0)
                ->count();
            $jumlahNotifikasi += $jumlahNotif;
            $notifikasi = $notifikasi->union(
                Notifikasi::whereIn('type', ['tendik-seminar-proposal', 'tendik-update-seminar-proposal', 'tendik-sidang-ta', 'tendik-update-sidang-ta'])
                    ->orderBy('created_at', 'DESC')
            );
        }
        return view('livewire.notification', [
            'count' => $jumlahNotifikasi,
            'notifikasi' => $notifikasi->orderBy('created_at','DESC')->get(),
        ]);
    }
}
