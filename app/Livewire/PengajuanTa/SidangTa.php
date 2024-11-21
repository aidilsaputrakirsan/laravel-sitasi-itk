<?php

namespace App\Livewire\PengajuanTa;

use App\Models\Bimbingan;
use App\Models\JadwalSempro;
use App\Models\JadwalTA;
use App\Models\PengajuanTA;
use App\Models\PenilaianSidangTa;
use App\Models\RiwayatPendaftaranSempro;
use App\Models\RiwayatPendaftaranSidangTA;
use App\Models\RiwayatPengajuan;
use App\Models\Sempro;
use App\Models\User;
use App\Traits\NotifikasiTraits;
use Livewire\Attributes\Url;
use Livewire\Component;

class SidangTa extends Component
{
    use NotifikasiTraits;
    public $pengajuans;
    public $setujuiSidangModal = false;
    public $setujuiRevisiModal = false;
    public $editNilaiModal = false;
    public $mahasiswaId;
    public $detailMahasiswa = false;
    public $nilaiModal = false;
    public $nilaiData;
    public $pengajuanId;
    public $dataPengajuan;
    public $isApprovePembimbing1;
    public $isApprovePembimbing2;
    public $sempro;
    public $sidang;
    public $sidangId;
    public $jadwal;
    public $jadwalSidang;
    public $media_presentasi;
    public $komunikasi;
    public $penguasaan_materi;
    public $isi_laporan_ta;
    public $struktur_penulisan;
    public $sikap_kinerja;
    public $total_nilai;

    #[Url]
    public $type;

    public function mount()
    {
        $this->refresh();
    }

    public function refresh()
    {
        if ($this->type === 'mahasiswa-uji') {
            $this->pengajuans = PengajuanTA::whereHas('jadwal', function ($query) {
                $query->where('penguji_1', auth()->id())
                    ->orWhere('penguji_2', auth()->id());
            })
            ->whereHas('mahasiswa', function($query) {
                $query->whereHas('user.sempro', function($query) {
                    $query->where('status', '!=', 'Ditolak');
                });
            })
            ->get();
        } else {
            $this->pengajuans = PengajuanTA::whereHas('mahasiswa', function($query) {
                    $query->whereHas('user.sempro', function($query) {
                        $query->where('status', '!=', 'Ditolak');
                    });
                })
                ->where(function($query) {
                    $query->where('pembimbing_1', auth()->id())
                        ->orWhere('pembimbing_2', auth()->id());
                })
                ->get();
        }
    }

    public function openSidangModal($mahasiswaId)
    {
        $this->mahasiswaId = $mahasiswaId;
        $this->setujuiSidangModal = true;
        $this->js("document.getElementById('js-display-modal').setAttribute('class', 'modal-backdrop fade show')");
    }
    public function closeSidangModal()
    {
        $this->setujuiSidangModal = false;
        $this->js("document.getElementById('js-display-modal').setAttribute('class', '')");
    }

    public function openNilaiModal($mahasiswaId, $sidangId)
    {
        $this->mahasiswaId = $mahasiswaId;
        $this->sidangId = $sidangId;
        $this->nilaiData = \App\Models\SidangTA::where('id', $this->sidangId)->first();
        $this->nilaiModal = true;
        $this->js("document.getElementById('js-display-modal').setAttribute('class', 'modal-backdrop fade show')");
    }
    public function closeNilaiModal()
    {
        $this->nilaiModal = false;
        $this->js("document.getElementById('js-display-modal').setAttribute('class', '')");
    }

    public function openEditNilaiModal($sidangId)
    {
        $nilai = PenilaianSidangTa::where('user_id', auth()->id())
            ->where('sidang_ta_id', $sidangId)
            ->first();
        $this->sidangId = $sidangId;
        $this->nilaiData = \App\Models\SidangTA::where('id', $this->sidangId)->first();
        $this->media_presentasi = $nilai->media_presentasi;
        $this->komunikasi = $nilai->komunikasi;
        $this->penguasaan_materi = $nilai->penguasaan_materi;
        $this->isi_laporan_ta = $nilai->isi_laporan_ta;
        $this->struktur_penulisan = $nilai->struktur_penulisan;
        $this->sikap_kinerja = $nilai->sikap_kinerja;
        $this->calculateNilai();
        $this->editNilaiModal = true;
        $this->js("document.getElementById('js-display-modal').setAttribute('class', 'modal-backdrop fade show')");
    }
    public function closeEditNilaiModal()
    {
        $this->media_presentasi = null;
        $this->komunikasi = null;
        $this->penguasaan_materi = null;
        $this->isi_laporan_ta = null;
        $this->struktur_penulisan = null;
        $this->sikap_kinerja = null;
        $this->editNilaiModal = false;
        $this->js("document.getElementById('js-display-modal').setAttribute('class', '')");
    }

    public function openDetail($id)
    {
        $this->pengajuanId = $id;
        $this->dataPengajuan = PengajuanTA::where('id', $this->pengajuanId)->first();
        $riwayat1 = RiwayatPengajuan::where('pengajuan_ta_id', $this->dataPengajuan->id)
                ->where('user_id', $this->dataPengajuan->pembimbing_1)
                ->where('status', 'Disetujui Pembimbing')
                ->first();
        $riwayat2 = RiwayatPengajuan::where('pengajuan_ta_id', $this->dataPengajuan->id)
                ->where('user_id', $this->dataPengajuan->pembimbing_2)
                ->where('status', 'Disetujui Pembimbing')
                ->first();
        $this->sempro = $this->dataPengajuan->mahasiswa->user->sempro->first();
        $this->sidang = $this->dataPengajuan->mahasiswa->user->sidang;
        $this->detailMahasiswa = true;

        // Set data penguji
        if ($this->sempro) {
            $this->jadwal = JadwalSempro::where('user_id', $this->dataPengajuan->mahasiswa->user->id)
                ->where('periode_id', $this->sempro->periode_id)
                ->first();
        } else {
            $this->jadwal = null;
        }

        // Set Jadwal
        if ($this->sidang) {
            $this->jadwalSidang = JadwalTA::where('user_id', $this->dataPengajuan->mahasiswa->user->id)
                ->where('periode_id', $this->sidang->periode_id)
                ->first();
        } else {
            $this->jadwalSidang = null;
        }
    }

    public function setujuiSidang()
    {
        $pengajuan1 = PengajuanTA::where('mahasiswa_id', $this->mahasiswaId)
            ->where('pembimbing_1', auth()->id())
            ->first();
        $pengajuan2 = PengajuanTA::where('mahasiswa_id', $this->mahasiswaId)
            ->where('pembimbing_2', auth()->id())
            ->first();
        
        $userId = null;

        if ($pengajuan1) {
            Sempro::where('id', $pengajuan1->mahasiswa->user->sempro->id)->update([
                'approve_pembimbing_1' => true
            ]);
            $userId = $pengajuan1->mahasiswa->user_id;
            RiwayatPendaftaranSempro::create([
                'user_id' => auth()->id(),
                'sempro_id' => $pengajuan1->mahasiswa->user->sempro->id,
                'pengajuan_ta_id' => $pengajuan1->id,
                'riwayat' => 'Sidang TA Disetujui',
                'keterangan' => 'menyetujui untuk mendaftar Sidang TA',
                'status' => 'Sidang TA Disetujui'
            ]);
        }

        if ($pengajuan2) {
            Sempro::where('id', $pengajuan2->mahasiswa->user->sempro->id)->update([
                'approve_pembimbing_2' => true
            ]);
            $userId = $pengajuan2->mahasiswa->user_id;
            RiwayatPendaftaranSempro::create([
                'user_id' => auth()->id(),
                'sempro_id' => $pengajuan2->mahasiswa->user->sempro->id,
                'pengajuan_ta_id' => $pengajuan2->id,
                'riwayat' => 'Sidang TA Disetujui',
                'keterangan' => 'menyetujui untuk mendaftar Sidang TA',
                'status' => 'Sidang TA Disetujui'
            ]);
        }

        $this->addNotif(auth()->id(), $userId, 'sidang-ta-disetujui', [
            'message' => 'menyetujui anda untuk mendaftar sidang TA',
            'status' => 'setuju'
        ]);

        $this->closeSidangModal();
        $this->refresh();
        $this->dispatch('alert:data', state: 'success', message: 'Anda telah menyetujui mahasiswa mendaftar sidang TA');
    }

    public function openRevisiModal($mahasiswaId)
    {
        $this->mahasiswaId = $mahasiswaId;
        $this->setujuiRevisiModal = true;
        $this->js("document.getElementById('js-display-modal').setAttribute('class', 'modal-backdrop fade show')");
    }
    public function closeRevisiModal()
    {
        $this->setujuiRevisiModal = false;
        $this->js("document.getElementById('js-display-modal').setAttribute('class', '')");
    }

    public function setujuiRevisi()
    {
        $pengajuan1 = PengajuanTA::where('mahasiswa_id', $this->mahasiswaId)
            ->where('pembimbing_1', auth()->id())
            ->first();
        $pengajuan2 = PengajuanTA::where('mahasiswa_id', $this->mahasiswaId)
            ->where('pembimbing_2', auth()->id())
            ->first();
        $penguji1 = PengajuanTA::where('mahasiswa_id', $this->mahasiswaId)->whereHas('jadwal', function($query) {
            $query->where('penguji_1', auth()->id());
        })->first();
        $penguji2 = PengajuanTA::where('mahasiswa_id', $this->mahasiswaId)->whereHas('jadwal', function($query) {
            $query->where('penguji_2', auth()->id());
        })->first();
        
        $userId = null;

        if ($pengajuan1) {
            \App\Models\SidangTA::where('id', $pengajuan1->mahasiswa->user->sidang->id)->update([
                'revisi_pembimbing_1' => true
            ]);
            $userId = $pengajuan1->mahasiswa->user_id;
            RiwayatPendaftaranSidangTA::create([
                'user_id' => auth()->id(),
                'sidang_ta_id' => $pengajuan1->mahasiswa->user->sidang->id,
                'pengajuan_ta_id' => $pengajuan1->id,
                'riwayat' => 'Lembar Revisi Disetujui',
                'keterangan' => 'menyetujui hasil revisi sidang TA anda',
                'status' => 'Lembar Revisi Sidang TA Disetujui'
            ]);
        }
        if ($pengajuan2) {
            \App\Models\SidangTA::where('id', $pengajuan2->mahasiswa->user->sidang->id)->update([
                'revisi_pembimbing_2' => true
            ]);
            $userId = $pengajuan2->mahasiswa->user_id;
            RiwayatPendaftaranSidangTA::create([
                'user_id' => auth()->id(),
                'sidang_ta_id' => $pengajuan2->mahasiswa->user->sidang->id,
                'pengajuan_ta_id' => $pengajuan2->id,
                'riwayat' => 'Lembar Revisi Disetujui',
                'keterangan' => 'menyetujui hasil revisi sidang TA anda',
                'status' => 'Lembar Revisi Sidang TA Disetujui'
            ]);
        }
        
        if ($penguji1) {
            \App\Models\SidangTA::where('id', $penguji1->mahasiswa->user->sidang->id)->update([
                'revisi_penguji_1' => true
            ]);
            $userId = $penguji1->mahasiswa->user_id;
            RiwayatPendaftaranSidangTA::create([
                'user_id' => auth()->id(),
                'sidang_ta_id' => $penguji1->mahasiswa->user->sidang->id,
                'pengajuan_ta_id' => $penguji1->id,
                'riwayat' => 'Lembar Revisi Disetujui',
                'keterangan' => 'menyetujui hasil revisi sidang TA anda',
                'status' => 'Lembar Revisi Sidang TA Disetujui'
            ]);
        }

        if ($penguji2) {
            \App\Models\SidangTA::where('id', $penguji2->mahasiswa->user->sidang->id)->update([
                'revisi_penguji_2' => true
            ]);
            $userId = $penguji2->mahasiswa->user_id;
            RiwayatPendaftaranSidangTA::create([
                'user_id' => auth()->id(),
                'sidang_ta_id' => $penguji2->mahasiswa->user->sidang->id,
                'pengajuan_ta_id' => $penguji2->id,
                'riwayat' => 'Lembar Revisi Disetujui',
                'keterangan' => 'menyetujui hasil revisi sidang TA anda',
                'status' => 'Lembar Revisi Sidang TA Disetujui'
            ]);
        }

        $this->addNotif(auth()->id(), $userId, 'revisi-sidang-ta-disetujui', [
            'message' => 'menyetujui hasil revisi Sidang TA anda',
            'status' => 'setuju'
        ]);

        $this->closeRevisiModal();
        $this->refresh();
        $this->dispatch('alert:data', state: 'success', message: 'Anda telah menyetujui hasil revisi Sidang TA');
    }

    public function updatedMediaPresentasi()
    {
        $this->calculateNilai();
    }

    public function updatedKomunikasi()
    {
        $this->calculateNilai();
    }
    public function updatedPenguasaanMateri()
    {
        $this->calculateNilai();
    }

    public function updatedIsiLaporanTa()
    {
        $this->calculateNilai();
    }

    public function updatedStrukturPenulisan()
    {
        $this->calculateNilai();
    }
    public function updatedSikapKinerja()
    {
        $this->calculateNilai();
    }
    public function calculateNilai()
    {
        if ($this->isNumber($this->media_presentasi) && 
            $this->isNumber($this->komunikasi) && 
            $this->isNumber($this->penguasaan_materi) &&
            $this->isNumber($this->isi_laporan_ta) && 
            $this->isNumber($this->struktur_penulisan)) {
            $total1 = 0;
            $total1 += $this->media_presentasi * 20 / 100;
            $total1 += $this->komunikasi * 40 / 100;
            $total1 += $this->penguasaan_materi * 40 / 100;

            $total2 = 0;
            $total2 += $this->isi_laporan_ta * 60 / 100;
            $total2 += $this->struktur_penulisan * 40 / 100;

            if ($this->nilaiData->user->mahasiswa->pengajuanTA->pembimbing_1 === auth()->id() || $this->nilaiData->user->mahasiswa->pengajuanTA->pembimbing_2 === auth()->id()) {
                if($this->isNumber($this->sikap_kinerja)) {
                    $this->total_nilai = ($total1 * 33 / 100) + ($total2 * 34 / 100) + ($this->sikap_kinerja * 33 / 100);
                }
            } else {
                $this->total_nilai = ($total1 * 50 / 100) + ($total2 * 50 / 100);
            }
        }
    }

    public function displayNilai($nilai)
    {
        $total1 = 0;
        $total1 += $nilai->media_presentasi * 20 / 100;
        $total1 += $nilai->komunikasi * 40 / 100;
        $total1 += $nilai->penguasaan_materi * 40 / 100;

        $total2 = 0;
        $total2 += $nilai->isi_laporan_ta * 60 / 100;
        $total2 += $nilai->struktur_penulisan * 40 / 100;

        if ($this->nilaiData->user->mahasiswa->pengajuanTA->pembimbing_1 === auth()->id() || $this->nilaiData->user->mahasiswa->pengajuanTA->pembimbing_2 === auth()->id()) {
            if($this->isNumber($this->sikap_kinerja)) {
                return ($total1 * 33 / 100) + ($total2 * 34 / 100) + ($this->sikap_kinerja * 33 / 100);
            } else {
                return 0;
            }
        } else {
            return ($total1 * 50 / 100) + ($total2 * 50 / 100);
        }
    }

    public function isNumber($value)
    {
        return $value !== '' && is_numeric($value);
    }

    public function submitNilai()
    {
        if ($this->nilaiData->user->mahasiswa->pengajuanTA->pembimbing_1 === auth()->id() || $this->nilaiData->user->mahasiswa->pengajuanTA->pembimbing_2 === auth()->id()) {
            $this->validate([
                'media_presentasi' => 'required|numeric|max:100|min:0',
                'komunikasi' => 'required|numeric|max:100|min:0',
                'penguasaan_materi' => 'required|numeric|max:100|min:0',
                'isi_laporan_ta' => 'required|numeric|max:100|min:0',
                'struktur_penulisan' => 'required|numeric|max:100|min:0',
                'sikap_kinerja' => 'required|numeric|max:100|min:0',
            ]);
        } else {
            $this->validate([
                'media_presentasi' => 'required|numeric|max:100|min:0',
                'komunikasi' => 'required|numeric|max:100|min:0',
                'penguasaan_materi' => 'required|numeric|max:100|min:0',
                'isi_laporan_ta' => 'required|numeric|max:100|min:0',
                'struktur_penulisan' => 'required|numeric|max:100|min:0',
            ]);
        }

        PenilaianSidangTa::create([
            'sidang_ta_id' => $this->sidangId,
            'user_id' => auth()->id(),
            'media_presentasi' => $this->media_presentasi,
            'komunikasi' => $this->komunikasi,
            'penguasaan_materi' => $this->penguasaan_materi,
            'isi_laporan_ta' => $this->isi_laporan_ta,
            'struktur_penulisan' => $this->struktur_penulisan,
            'sikap_kinerja' => $this->sikap_kinerja ?? 0,
        ]);

        $dataSidang = \App\Models\SidangTA::where('id', $this->sidangId)->first();

        RiwayatPendaftaranSidangTA::create([
            'user_id' => auth()->id(),
            'sidang_ta_id' => $this->sidangId,
            'pengajuan_ta_id' => $dataSidang->user->mahasiswa->pengajuanTA->id,
            'riwayat' => 'Penilaian Telah Diberikan',
            'keterangan' => 'memberikan nilai pada Sidang TA anda',
            'status' => 'Sidang TA Dinilai'
        ]);

        $this->addNotif(auth()->id(), $dataSidang->user_id, 'penilaian-sidang-ta', [
            'message' => 'memberikan nilai pada Sidang TA anda',
            'status' => 'setuju'
        ]);
        $this->closeNilaiModal();
        $this->refresh();
        $this->dispatch('alert:data', state: 'success', message: 'Anda telah memberikan penilaian');
    }

    public function submitEditNilai()
    {
        if ($this->nilaiData->user->mahasiswa->pengajuanTA->pembimbing_1 === auth()->id() || $this->nilaiData->user->mahasiswa->pengajuanTA->pembimbing_2 === auth()->id()) {
            $this->validate([
                'media_presentasi' => 'required|numeric|max:100|min:0',
                'komunikasi' => 'required|numeric|max:100|min:0',
                'penguasaan_materi' => 'required|numeric|max:100|min:0',
                'isi_laporan_ta' => 'required|numeric|max:100|min:0',
                'struktur_penulisan' => 'required|numeric|max:100|min:0',
                'sikap_kinerja' => 'required|numeric|max:100|min:0',
            ]);
        } else {
            $this->validate([
                'media_presentasi' => 'required|numeric|max:100|min:0',
                'komunikasi' => 'required|numeric|max:100|min:0',
                'penguasaan_materi' => 'required|numeric|max:100|min:0',
                'isi_laporan_ta' => 'required|numeric|max:100|min:0',
                'struktur_penulisan' => 'required|numeric|max:100|min:0',
            ]);
        }

        PenilaianSidangTa::where('user_id', auth()->id())
            ->where('sidang_ta_id', $this->sidangId)
            ->update([
                'media_presentasi' => $this->media_presentasi,
                'komunikasi' => $this->komunikasi,
                'penguasaan_materi' => $this->penguasaan_materi,
                'isi_laporan_ta' => $this->isi_laporan_ta,
                'struktur_penulisan' => $this->struktur_penulisan,
                'sikap_kinerja' => $this->sikap_kinerja ?? 0,
            ]);

        $this->closeEditNilaiModal();
        $this->refresh();
        $this->dispatch('alert:data', state: 'success', message: 'nilai telah diupdate');
    }

    public function render()
    {
        if ($this->type === 'mahasiswa-uji') {
            return view('livewire.pengajuan-ta.sidang-ta-uji');
        } else {
            return view('livewire.pengajuan-ta.sidang-ta');
        }
    }
}
