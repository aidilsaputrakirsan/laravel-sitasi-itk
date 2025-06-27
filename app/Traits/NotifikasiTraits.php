<?php

namespace App\Traits;

use App\Models\Notifikasi;

trait NotifikasiTraits 
{
    public function addNotif($from, $to, $type, $data)
    {
        Notifikasi::create([
            'from_id' => $from,
            'to_id' => $to,
            'type' => $type,
            'data' => $data,
        ]);
    }

    public function readFromNotif($id)
    {
        Notifikasi::where('to_id', $id)->update(['read' => 1]);
    }

    public function readTendik()
    {
        // Update: Tambahkan 'tendik-katalog-ta' ke dalam list notification tendik
        Notifikasi::whereIn('type', [
            'tendik-seminar-proposal', 
            'tendik-update-seminar-proposal', 
            'tendik-sidang-ta', 
            'tendik-update-sidang-ta',
            'tendik-katalog-ta'  // NEW: notification katalog
        ])->update(['read' => 1]);
    }

    public function jsSidebarClose()
    {
        $this->js("document.getElementById('body-data').setAttribute('class', 'pace-done sidebar-enable')");
        $this->js("document.getElementById('body-data').setAttribute('data-sidebar-size', 'sm')");
    }

    public function jsOpenModal()
    {
        $this->js("document.getElementById('js-display-modal').setAttribute('class', 'modal-backdrop fade show')");
    }

    public function jsCloseModal()
    {
        $this->js("document.getElementById('js-display-modal').setAttribute('class', '')");
    }
}