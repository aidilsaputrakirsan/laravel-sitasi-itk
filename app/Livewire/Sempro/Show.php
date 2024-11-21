<?php

namespace App\Livewire\Sempro;

use App\Models\JadwalSempro;
use App\Models\Periode;
use App\Models\RiwayatPendaftaranSempro;
use App\Models\RiwayatPengajuan;
use App\Models\Sempro;
use App\Traits\NotifikasiTraits;
use App\Traits\UpdateDeleteTraits;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;

class Show extends Component
{
    use WithFileUploads, UpdateDeleteTraits, NotifikasiTraits;
    public $isPeriodeActive = false;
    public $addModal = false;
    public $form_ta012;
    public $bukti_plagiasi;
    public $proposal_ta;
    public $sempros;
    public $riwayats = [];
    public $isApprovePembimbing1 = false;
    public $isApprovePembimbing2 = false;
    public $displayError;
    public $editableLembar = false;
    public $editablePlagiasi = false;
    public $editableProposal = false;
    public $periodeActive;
    public $jadwalSeminar;

    public function mount()
    {
        $this->refresh();
    }

    public function refresh()
    {
        $this->periodeActive = Periode::where('status', 'Active')
            ->where('type', 'Sempro')
            ->first();
        $isDitolak = Sempro::where('user_id', auth()->id())->where('status', 'Ditolak')->first();
        if ($isDitolak) {
            $this->sempros = Sempro::where('user_id', auth()->id())->where('periode_id', $this->periodeActive->id)->get();
        } else {
            $this->sempros = Sempro::where('user_id', auth()->id())->get();
        }
        if (auth()->user()->mahasiswa->pengajuanTA) {
            $this->riwayats = RiwayatPendaftaranSempro::where('pengajuan_ta_id', auth()->user()->mahasiswa->pengajuanTA->id)->orderBy('created_at', 'DESC')->get();

            $riwayat1 = RiwayatPengajuan::where('pengajuan_ta_id', auth()->user()->mahasiswa->pengajuanTA->id)
                ->where('user_id', auth()->user()->mahasiswa->pengajuanTA->pembimbing_1)
                ->where('status', 'Disetujui Pembimbing')
                ->first();
            $riwayat2 = RiwayatPengajuan::where('pengajuan_ta_id', auth()->user()->mahasiswa->pengajuanTA->id)
                ->where('user_id', auth()->user()->mahasiswa->pengajuanTA->pembimbing_2)
                ->where('status', 'Disetujui Pembimbing')
                ->first();
            
            $this->isApprovePembimbing1 = $riwayat1 ? true : false;
            $this->isApprovePembimbing2 = $riwayat2 ? true : false;
        }
        if ($this->sempros->first()) {
            $this->jadwalSeminar = JadwalSempro::where('user_id', auth()->id())->where('periode_id', $this->periodeActive->id)->first();
        }
        
        $this->isPeriodeActive = $this->periodeActive ? false : true;
    }

    public function submit()
    {
        $periodeActive = Periode::where('status', 'Active')
            ->where('type', 'Sempro')
            ->first();
        $this->isPeriodeActive = $periodeActive ? false : true;

        if ($this->isPeriodeActive) {
            return;
        }

        if (!$this->isApprovePembimbing1 && !$this->isApprovePembimbing2) {
            $this->displayError = "Tidak dapat mendaftar, karena berkas belum lengkap";
            return;
        }

        if (auth()->user()->mahasiswa->pengajuanTA && !auth()->user()->mahasiswa->pengajuanTA->approve_pembimbing1 && !auth()->user()->mahasiswa->pengajuanTA->approve_pembimbing2) {
            $this->displayError = "Tidak dapat mendaftar, karena berkas belum lengkap";
            return;
        }

        $this->validate([
            'form_ta012' => 'required',
            'bukti_plagiasi' => 'required',
            'proposal_ta' => 'required',
        ],[
            'form_ta012.required' => 'Form. TA-012 Wajib di isi',
            'bukti_plagiasi.required' => 'Bukti Plagiasi Wajib di isi',
            'proposal_ta.required' => 'Proposal TA Wajib di isi',
        ]);

        $create = Sempro::create([
            'user_id' => auth()->id(),
            'periode_id' => $periodeActive->id,
            'tanggal' => Carbon::now()->format('Y-m-d'),
            'form_ta_012' => $this->form_ta012->store('uploads/sempro', 'public'),
            'bukti_plagiasi' => $this->bukti_plagiasi->store('uploads/sempro', 'public'),
            'proposal_ta' => $this->proposal_ta->store('uploads/sempro', 'public'),
        ]);
        $this->form_ta012 = null;
        $this->bukti_plagiasi = null;
        $this->proposal_ta = null;

        $notifikasi = RiwayatPendaftaranSempro::create([
            'user_id' => auth()->id(),
            'sempro_id' => $create->id,
            'pengajuan_ta_id' => auth()->user()->mahasiswa->pengajuanTA->id,
            'riwayat' => 'Mendaftar Seminar Proposal',
            'keterangan' => 'telah mendaftar seminar proposal',
            'status' => 'Proses Pendaftaran'
        ]);


        $this->addNotif(auth()->user()->id, auth()->user()->mahasiswa->pengajuanTA->pembimbing_1, 'notifikasi', [
            'user_id' => auth()->id(),
            'sempro_id' => $create->id,
            'message' => 'telah mendaftar Seminar Proposal'
        ]);

        $this->addNotif(auth()->user()->id, auth()->user()->mahasiswa->pengajuanTA->pembimbing_2, 'notifikasi', [
            'user_id' => auth()->id(),
            'sempro_id' => $create->id,
            'message' => 'telah mendaftar Seminar Proposal'
        ]);

        // Notifikasi Tendik
        $this->addNotif(auth()->user()->id, null, 'tendik-seminar-proposal', [
            'user_id' => auth()->id(),
            'sempro_id' => $create->id,
            'periode_id' => $periodeActive->id,
            'message' => 'telah mendaftar Seminar Proposal'
        ]);

        $this->dispatch('alert:data', state: 'success', message: 'Data Sempro telah di update');
        
        $this->refresh();
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

    public function toggleEditLembar()
    {
        $this->editableLembar = !$this->editableLembar;
    }
    public function toggleEditPlagiasi()
    {
        $this->editablePlagiasi = !$this->editablePlagiasi;
    }
    public function toggleEditProposal()
    {
        $this->editableProposal = !$this->editableProposal;
    }

    public function saveLembar()
    {
        $this->validate([
            'form_ta012' => 'required',
        ], [
            'form_ta012.required' => 'Form. TA-012 Wajib di isi'
        ]);

        Sempro::where('id', $this->sempros->first()->id)->update([
            'form_ta_012' => $this->form_ta012->store('uploads/sempro', 'public'),
            'status' => 'on_process'
        ]);

        RiwayatPendaftaranSempro::create([
            'user_id' => auth()->id(),
            'sempro_id' => $this->sempros->first()->id,
            'pengajuan_ta_id' => auth()->user()->mahasiswa->pengajuanTA->id,
            'riwayat' => 'Mengupdate berkas Seminar Proposal',
            'keterangan' => 'memperbarui berkas seminar proposal',
            'status' => 'Update Berkas Seminar Proposal'
        ]);

        // Notifikasi Tendik
        $this->addNotif(auth()->user()->id, null, 'tendik-update-seminar-proposal', [
            'user_id' => auth()->id(),
            'sempro_id' => $this->sempros->first()->id,
            'periode_id' => $this->periodeActive->id,
            'message' => 'mengupdate berkas Form. TA-012 pada Seminar Proposal'
        ]);

        $this->dispatch('alert:data', state: 'success', message: 'Data Sempro telah di perbarui');
        $this->toggleEditLembar();
        $this->form_ta012 = null;
        $this->refresh();
    }
    public function savePlagiasi()
    {
        $this->validate([
            'bukti_plagiasi' => 'required',
        ], [
            'bukti_plagiasi.required' => 'Bukti Plagiasi Wajib di isi'
        ]);

        Sempro::where('id', $this->sempros->first()->id)->update([
            'bukti_plagiasi' => $this->bukti_plagiasi->store('uploads/sempro', 'public'),
            'status' => 'on_process'
        ]);

        RiwayatPendaftaranSempro::create([
            'user_id' => auth()->id(),
            'sempro_id' => $this->sempros->first()->id,
            'pengajuan_ta_id' => auth()->user()->mahasiswa->pengajuanTA->id,
            'riwayat' => 'Mengupdate berkas Seminar Proposal',
            'keterangan' => 'memperbarui berkas seminar proposal',
            'status' => 'Update Berkas Seminar Proposal'
        ]);

        $this->addNotif(auth()->user()->id, null, 'tendik-update-seminar-proposal', [
            'user_id' => auth()->id(),
            'sempro_id' => $this->sempros->first()->id,
            'periode_id' => $this->periodeActive->id,
            'message' => 'mengupdate berkas Bukti Plagiasi pada Seminar Proposal'
        ]);

        $this->dispatch('alert:data', state: 'success', message: 'Data Sempro telah di perbarui');
        $this->toggleEditPlagiasi();
        $this->bukti_plagiasi = null;
        $this->refresh();
    }
    public function saveProposal()
    {
        $this->validate([
            'proposal_ta' => 'required',
        ], [
            'proposal_ta.required' => 'Proposal TA Wajib di isi'
        ]);

        Sempro::where('id', $this->sempros->first()->id)->update([
            'proposal_ta' => $this->proposal_ta->store('uploads/sempro', 'public'),
            'status' => 'on_process'
        ]);

        RiwayatPendaftaranSempro::create([
            'user_id' => auth()->id(),
            'sempro_id' => $this->sempros->first()->id,
            'pengajuan_ta_id' => auth()->user()->mahasiswa->pengajuanTA->id,
            'riwayat' => 'Mengupdate berkas Seminar Proposal',
            'keterangan' => 'memperbarui berkas seminar proposal',
            'status' => 'Update Berkas Seminar Proposal'
        ]);

        $this->addNotif(auth()->user()->id, null, 'tendik-update-seminar-proposal', [
            'user_id' => auth()->id(),
            'sempro_id' => $this->sempros->first()->id,
            'periode_id' => $this->periodeActive->id,
            'message' => 'mengupdate berkas draft Proposal TA pada Seminar Proposal'
        ]);

        $this->dispatch('alert:data', state: 'success', message: 'Data Sempro telah di perbarui');
        $this->toggleEditProposal();
        $this->proposal_ta = null;
        $this->refresh();
    }

    public function render()
    {
        return view('livewire.sempro.show');
    }
}
