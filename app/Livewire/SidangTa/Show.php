<?php

namespace App\Livewire\SidangTa;

use App\Models\JadwalSempro;
use App\Models\JadwalTA;
use App\Models\Periode;
use App\Models\RiwayatPendaftaranSempro;
use App\Models\RiwayatPendaftaranSidangTA;
use App\Models\RiwayatPengajuan;
use App\Models\Sempro;
use App\Models\SidangTA;
use App\Traits\NotifikasiTraits;
use App\Traits\PeriodeTraits;
use App\Traits\UpdateDeleteTraits;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;

class Show extends Component
{
    use WithFileUploads, UpdateDeleteTraits, NotifikasiTraits, PeriodeTraits;
    public $isPeriodeActive = false;
    public $addModal = false;
    public $lembar_revisi;
    public $draft_ta;
    public $bukti_plagiasi;
    public $sempros;
    public $sidang;
    public $displayError;
    public $periodeActive;
    public $riwayats = [];
    public $isApprovePembimbing1;
    public $isApprovePembimbing2;
    public $jadwalSeminar;
    public $jadwalSidang;
    public $isAccRevisi;
    public $isAccSidang;
    public $editableLembar = false;
    public $editableDraft = false;
    public $editableBukti = false;

    public function mount()
    {
        $this->refresh();
        $this->checkRevisi();
        $this->checkSidang();
    }

    public function refresh()
    {
        $this->sempros = Sempro::where('user_id', auth()->id())->get();
        $isDitolak = SidangTA::where('user_id', auth()->id())->where('status', 'Ditolak')->first();
        if ($isDitolak) {
            $this->sidang = SidangTA::where('user_id', auth()->id())->where('periode_id', $this->getSidangActive())->first();
        } else {
            $this->sidang = SidangTA::where('user_id', auth()->id())->first();
        }
        if (auth()->user()->mahasiswa->pengajuanTA) {
            $this->riwayats = RiwayatPendaftaranSidangTA::where('pengajuan_ta_id', auth()->user()->mahasiswa->pengajuanTA->id)->orderBy('created_at', 'DESC')->get();

            $riwayat1 = RiwayatPengajuan::where('pengajuan_ta_id', auth()->user()->mahasiswa->pengajuanTA->id)
                ->where('user_id', auth()->user()->mahasiswa->pengajuanTA->pembimbing_1)
                ->where('status', 'Disetujui Pembimbing')
                ->first();
            $riwayat2 = RiwayatPengajuan::where('pengajuan_ta_id', auth()->user()->mahasiswa->pengajuanTA->id)
                ->where('user_id', auth()->user()->mahasiswa->pengajuanTA->pembimbing_2)
                ->where('status', 'Disetujui Pembimbing')
                ->first();
            
        }
        if ($this->sempros->first()) {
            $this->jadwalSeminar = JadwalSempro::where('user_id', auth()->id())->where('periode_id', $this->sempros->first()->periode_id)->first();
        } 
        if ($this->sidang) {
            $this->jadwalSidang = JadwalTA::where('user_id', auth()->id())->where('periode_id', $this->sidang->periode_id)->first();
        }

        $this->periodeActive = Periode::where('status', 'Active')
            ->where('type', 'TA')
            ->first();
        $this->isPeriodeActive = $this->periodeActive ? false : true;
    }

    public function checkRevisi()
    {
        $sempro = $this->sempros->first();
        $this->isAccRevisi = $sempro && $sempro->revisi_pembimbing_1 && $sempro->revisi_pembimbing_2 && $sempro->revisi_penguji_1 && $sempro->revisi_penguji_2;
    }
    
    public function checkSidang()
    {
        $sempro = $this->sempros->first();
        $this->isAccSidang = $sempro && $sempro->approve_pembimbing_1 && $sempro->approve_pembimbing_2;
    }

    public function submit()
    {
        $periodeActive = Periode::where('status', 'Active')
            ->where('type', 'TA')
            ->first();
        $this->isPeriodeActive = $periodeActive ? false : true;

        if ($this->isPeriodeActive) {
            return;
        }

        if (!$this->isAccRevisi) {
            $this->displayError = "Tidak dapat mendaftar, karena berkas belum lengkap";
            return;
        }

        if (!$this->isAccSidang) {
            $this->displayError = "Tidak dapat mendaftar, karena berkas belum lengkap";
            return;
        }

        $this->validate([
            'lembar_revisi' => 'required|file|mimes:pdf|max:5120',      // 5MB
            'draft_ta' => 'required|file|mimes:pdf|max:14336',          // 14MB (khusus draft TA)
            'bukti_plagiasi' => 'required|file|mimes:pdf|max:10240',    // 10MB
        ], [
            'lembar_revisi.required' => 'Lembar Revisi Wajib di isi',
            'lembar_revisi.file' => 'Lembar Revisi harus berupa file',
            'lembar_revisi.mimes' => 'Lembar Revisi harus berupa file PDF',
            'lembar_revisi.max' => 'Lembar Revisi maksimal 5MB',
            
            'draft_ta.required' => 'Draft TA Wajib di isi',
            'draft_ta.file' => 'Draft TA harus berupa file',
            'draft_ta.mimes' => 'Draft TA harus berupa file PDF',
            'draft_ta.max' => 'Draft TA maksimal 14MB',
            
            'bukti_plagiasi.required' => 'Bukti Plagiasi Wajib di isi',
            'bukti_plagiasi.file' => 'Bukti Plagiasi harus berupa file',
            'bukti_plagiasi.mimes' => 'Bukti Plagiasi harus berupa file PDF',
            'bukti_plagiasi.max' => 'Bukti Plagiasi maksimal 10MB',
        ]);

        $create = SidangTA::create([
            'user_id' => auth()->id(),
            'periode_id' => $periodeActive->id,
            'tanggal' => Carbon::now()->format('Y-m-d'),
            'lembar_revisi' => $this->lembar_revisi->store('uploads/sidang', 'public'),
            'draft_ta' => $this->draft_ta->store('uploads/sidang', 'public'),
            'bukti_plagiasi' => $this->bukti_plagiasi->store('uploads/sidang', 'public'),
        ]);

        $this->lembar_revisi = null;
        $this->draft_ta = null;
        $this->bukti_plagiasi = null;

        $notifikasi = RiwayatPendaftaranSidangTA::create([
            'user_id' => auth()->id(),
            'sidang_ta_id' => $create->id,
            'pengajuan_ta_id' => auth()->user()->mahasiswa->pengajuanTA->id,
            'riwayat' => 'Mendaftar Sidang TA',
            'keterangan' => 'telah mendaftar sidang TA',
            'status' => 'Proses Pendaftaran'
        ]);

        $this->addNotif(auth()->user()->id, auth()->user()->mahasiswa->pengajuanTA->pembimbing_1, 'notifikasi', [
            'user_id' => auth()->id(),
            'sidang_ta_id' => $create->id,
            'message' => 'telah mendaftar Sidang TA'
        ]);

        $this->addNotif(auth()->user()->id, auth()->user()->mahasiswa->pengajuanTA->pembimbing_2, 'notifikasi', [
            'user_id' => auth()->id(),
            'sidang_ta_id' => $create->id,
            'message' => 'telah mendaftar Sidang TA'
        ]);

        // Notifikasi Tendik
        $this->addNotif(auth()->user()->id, null, 'tendik-sidang-ta', [
            'user_id' => auth()->id(),
            'sidang_ta' => $create->id,
            'periode_id' => $periodeActive->id,
            'message' => 'telah mendaftar Sidang TA'
        ]);

        $this->dispatch('alert:data', state: 'success', message: 'Data Sidang telah di update');
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

    public function toggleEditDraft()
    {
        $this->editableDraft = !$this->editableDraft;
    }

    public function toggleEditBukti()
    {
        $this->editableBukti = !$this->editableBukti;
    }

    public function saveLembar()
    {
        $this->validate([
            'lembar_revisi' => 'required|file|mimes:pdf|max:5120',
        ], [
            'lembar_revisi.required' => 'Lembar Revisi Wajib di isi',
            'lembar_revisi.file' => 'Lembar Revisi harus berupa file',
            'lembar_revisi.mimes' => 'Lembar Revisi harus berupa file PDF',
            'lembar_revisi.max' => 'Lembar Revisi maksimal 5MB',
        ]);

        SidangTA::where('id', $this->sidang->id)->update([
            'lembar_revisi' => $this->lembar_revisi->store('uploads/sidang', 'public'),
            'status' => 'on_process',
        ]);

        RiwayatPendaftaranSidangTA::create([
            'user_id' => auth()->id(),
            'sidang_ta_id' => $this->sidang->id,
            'pengajuan_ta_id' => auth()->user()->mahasiswa->pengajuanTA->id,
            'riwayat' => 'Mengupdate berkas Sidang TA',
            'keterangan' => 'memperbarui berkas seminar proposal',
            'status' => 'Update Berkas Sidang TA'
        ]);

        // Notikasi Tendik
        $this->addNotif(auth()->user()->id, null, 'tendik-update-sidang-ta', [
            'user_id' => auth()->id(),
            'sidang_ta_id' => $this->sidang->id,
            'periode_id' => $this->periodeActive->id,
            'message' => 'mengupdate berkas Lembar Revisi pada Sidang TA'
        ]);

        $this->dispatch('alert:data', state: 'success', message: 'Data Sidang TA telah di perbarui');
        $this->toggleEditLembar();
        $this->lembar_revisi = null;
        $this->refresh();
    }

    public function saveDraft()
    {
        $this->validate([
            'draft_ta' => 'required|file|mimes:pdf|max:14336',
        ], [
            'draft_ta.required' => 'Draft TA Wajib di isi',
            'draft_ta.file' => 'Draft TA harus berupa file',
            'draft_ta.mimes' => 'Draft TA harus berupa file PDF',
            'draft_ta.max' => 'Draft TA maksimal 14MB',
        ]);

        SidangTA::where('id', $this->sidang->id)->update([
            'draft_ta' => $this->draft_ta->store('uploads/sidang', 'public'),
            'status' => 'on_process',
        ]);

        RiwayatPendaftaranSidangTA::create([
            'user_id' => auth()->id(),
            'sidang_ta_id' => $this->sidang->id,
            'pengajuan_ta_id' => auth()->user()->mahasiswa->pengajuanTA->id,
            'riwayat' => 'Mengupdate berkas Sidang TA',
            'keterangan' => 'memperbarui berkas seminar proposal',
            'status' => 'Update Berkas Sidang TA'
        ]);

        // Notikasi Tendik
        $this->addNotif(auth()->user()->id, null, 'tendik-update-sidang-ta', [
            'user_id' => auth()->id(),
            'sidang_ta_id' => $this->sidang->id,
            'periode_id' => $this->periodeActive->id,
            'message' => 'mengupdate berkas Draft TA pada Sidang TA'
        ]);

        $this->dispatch('alert:data', state: 'success', message: 'Data Sidang TA telah di perbarui');
        $this->toggleEditDraft();
        $this->draft_ta = null;
        $this->refresh();
    }

    public function saveBukti()
    {
        $this->validate([
            'bukti_plagiasi' => 'required|file|mimes:pdf|max:10240',
        ], [
            'bukti_plagiasi.required' => 'Bukti Plagiasi Wajib di isi',
            'bukti_plagiasi.file' => 'Bukti Plagiasi harus berupa file',
            'bukti_plagiasi.mimes' => 'Bukti Plagiasi harus berupa file PDF',
            'bukti_plagiasi.max' => 'Bukti Plagiasi maksimal 10MB',
        ]);

        SidangTA::where('id', $this->sidang->id)->update([
            'bukti_plagiasi' => $this->bukti_plagiasi->store('uploads/sidang', 'public'),
            'status' => 'on_process',
        ]);

        RiwayatPendaftaranSidangTA::create([
            'user_id' => auth()->id(),
            'sidang_ta_id' => $this->sidang->id,
            'pengajuan_ta_id' => auth()->user()->mahasiswa->pengajuanTA->id,
            'riwayat' => 'Mengupdate berkas Sidang TA',
            'keterangan' => 'memperbarui berkas seminar proposal',
            'status' => 'Update Berkas Sidang TA'
        ]);

        // Notikasi Tendik
        $this->addNotif(auth()->user()->id, null, 'tendik-update-sidang-ta', [
            'user_id' => auth()->id(),
            'sidang_ta_id' => $this->sidang->id,
            'periode_id' => $this->periodeActive->id,
            'message' => 'mengupdate berkas Bukti Plagiasi pada Sidang TA'
        ]);

        $this->dispatch('alert:data', state: 'success', message: 'Data Sidang TA telah di perbarui');
        $this->toggleEditBukti();
        $this->bukti_plagiasi = null;
        $this->refresh();
    }

    public function render()
    {
        return view('livewire.sidang-ta.show');
    }
}
