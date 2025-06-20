<?php

namespace App\Livewire\PengajuanTa;

use App\Models\Bimbingan as ModelsBimbingan;
use App\Models\JadwalSempro;
use App\Models\PengajuanTA;
use App\Models\PenilaianSempro;
use App\Models\RiwayatPendaftaranSempro;
use App\Models\RiwayatPengajuan;
use App\Models\Sempro;
use App\Traits\NotifikasiTraits;
use Livewire\Attributes\Url;
use Livewire\Component;
use Carbon\Carbon;

class SeminarProposal extends Component
{
    use NotifikasiTraits;
    public $pengajuans;
    public $setujuiModal = false;
    public $setujuiRevisiModal = false;
    public $nilaiModal = false;
    public $editNilaiModal = false;
    public $mahasiswaId;
    public $detailMahasiswa = false;
    public $pengajuanId;
    public $dataPengajuan;
    public $isApprovePembimbing1;
    public $isApprovePembimbing2;
    public $sempro;
    public $semproId;
    public $jadwal;
    public $media_presentasi;
    public $komunikasi;
    public $penguasaan_materi;
    public $isi_laporan_ta;
    public $struktur_penulisan;
    public $total_nilai;
    public $workingDaysInfo;

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
            })->get();
        } else {
            $this->pengajuans = PengajuanTA::where('pembimbing_1', auth()->id())
                ->orWhere('pembimbing_2', auth()->id())
                ->get();
        }
    }

    public function setujui()
    {
        $pengajuan1 = PengajuanTA::where('mahasiswa_id', $this->mahasiswaId)
            ->where('pembimbing_1', auth()->id())
            ->first();
        $pengajuan2 = PengajuanTA::where('mahasiswa_id', $this->mahasiswaId)
            ->where('pembimbing_2', auth()->id())
            ->first();
        
        $userId = null;

        if ($pengajuan1) {
            PengajuanTA::where('id', $pengajuan1->id)->update([
                'approve_pembimbing1' => true
            ]);
            $userId = $pengajuan1->mahasiswa->user_id;
            RiwayatPendaftaranSempro::create([
                'user_id' => auth()->id(),
                'sempro_id' => $pengajuan1->mahasiswa->user->sempro->id ?? null,
                'pengajuan_ta_id' => $pengajuan1->id,
                'riwayat' => 'Seminar Proposal Diizinkan',
                'keterangan' => 'mengizinkan untuk mendaftar seminar proposal',
                'status' => 'Disetujui Seminar Proposal'
            ]);
        }
        if ($pengajuan2) {
            PengajuanTA::where('id', $pengajuan2->id)->update([
                'approve_pembimbing2' => true
            ]);
            $userId = $pengajuan2->mahasiswa->user_id;
            RiwayatPendaftaranSempro::create([
                'user_id' => auth()->id(),
                'sempro_id' => $pengajuan2->mahasiswa->user->sempro->id ?? null,
                'pengajuan_ta_id' => $pengajuan2->id,
                'riwayat' => 'Seminar Proposal Diizinkan',
                'keterangan' => 'mengizinkan untuk mendaftar seminar proposal',
                'status' => 'Disetujui Seminar Proposal'
            ]);
        }
        

        $this->addNotif(auth()->id(), $userId, 'seminar-proposal-disetujui', [
            'message' => 'mengizinkan untuk Seminar Proposal',
            'status' => 'setuju'
        ]);

        $this->closeModal();
        $this->refresh();
        $this->dispatch('alert:data', state: 'success', message: 'Anda telah menyetujui seminar proposal');
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
            Sempro::where('id', $pengajuan1->mahasiswa->user->sempro->id)->update([
                'revisi_pembimbing_1' => true
            ]);
            $userId = $pengajuan1->mahasiswa->user_id;
            RiwayatPendaftaranSempro::create([
                'user_id' => auth()->id(),
                'sempro_id' => $pengajuan1->mahasiswa->user->sempro->id,
                'pengajuan_ta_id' => $pengajuan1->id,
                'riwayat' => 'Lembar Revisi Disetujui',
                'keterangan' => 'menyetujui hasil revisi seminar proposal anda',
                'status' => 'Lembar Revisi Seminar Proposal Disetujui'
            ]);
        }
        if ($pengajuan2) {
            Sempro::where('id', $pengajuan2->mahasiswa->user->sempro->id)->update([
                'revisi_pembimbing_2' => true
            ]);
            $userId = $pengajuan2->mahasiswa->user_id;
            RiwayatPendaftaranSempro::create([
                'user_id' => auth()->id(),
                'sempro_id' => $pengajuan2->mahasiswa->user->sempro->id,
                'pengajuan_ta_id' => $pengajuan2->id,
                'riwayat' => 'Lembar Revisi Disetujui',
                'keterangan' => 'menyetujui hasil revisi seminar proposal anda',
                'status' => 'Lembar Revisi Seminar Proposal Disetujui'
            ]);
        }
        
        if ($penguji1) {
            Sempro::where('id', $penguji1->mahasiswa->user->sempro->id)->update([
                'revisi_penguji_1' => true
            ]);
            $userId = $penguji1->mahasiswa->user_id;
            RiwayatPendaftaranSempro::create([
                'user_id' => auth()->id(),
                'sempro_id' => $penguji1->mahasiswa->user->sempro->id,
                'pengajuan_ta_id' => $penguji1->id,
                'riwayat' => 'Lembar Revisi Disetujui',
                'keterangan' => 'menyetujui hasil revisi seminar proposal anda',
                'status' => 'Lembar Revisi Seminar Proposal Disetujui'
            ]);
        }

        if ($penguji2) {
            Sempro::where('id', $penguji2->mahasiswa->user->sempro->id)->update([
                'revisi_penguji_2' => true
            ]);
            $userId = $penguji2->mahasiswa->user_id;
            RiwayatPendaftaranSempro::create([
                'user_id' => auth()->id(),
                'sempro_id' => $penguji2->mahasiswa->user->sempro->id,
                'pengajuan_ta_id' => $penguji2->id,
                'riwayat' => 'Lembar Revisi Disetujui',
                'keterangan' => 'menyetujui hasil revisi seminar proposal anda',
                'status' => 'Lembar Revisi Seminar Proposal Disetujui'
            ]);
        }

        $this->addNotif(auth()->id(), $userId, 'revisi-seminar-disetujui', [
            'message' => 'menyetujui hasil revisi Seminar Proposal anda',
            'status' => 'setuju'
        ]);

        $this->closeRevisiModal();
        $this->refresh();
        $this->dispatch('alert:data', state: 'success', message: 'Anda telah menyetujui hasil revisi Seminar Proposal');
    }

    public function openModal($mahasiswaId)
    {
        $this->mahasiswaId = $mahasiswaId;
        $this->setujuiModal = true;
        $this->js("document.getElementById('js-display-modal').setAttribute('class', 'modal-backdrop fade show')");
    }
    public function closeModal()
    {
        $this->setujuiModal = false;
        $this->js("document.getElementById('js-display-modal').setAttribute('class', '')");
    }

    public function openRevisiModal($mahasiswaId)
    {
        $this->mahasiswaId = $mahasiswaId;          
        $this->workingDaysInfo = $this->calculateWorkingDays($mahasiswaId);
        $this->setujuiRevisiModal = true;
        $this->js("document.getElementById('js-display-modal').setAttribute('class', 'modal-backdrop fade show')");
    }
    public function closeRevisiModal()
    {
        $this->setujuiRevisiModal = false;
        $this->js("document.getElementById('js-display-modal').setAttribute('class', '')");
    }

    public function openNilaiModal($mahasiswaId, $semproId)
    {
        $this->mahasiswaId = $mahasiswaId;
        $this->semproId = $semproId;
        $this->nilaiModal = true;
        $this->js("document.getElementById('js-display-modal').setAttribute('class', 'modal-backdrop fade show')");
    }
    public function closeNilaiModal()
    {
        $this->nilaiModal = false;
        $this->js("document.getElementById('js-display-modal').setAttribute('class', '')");
    }
    public function openEditNilaiModal($semproId)
    {
        $nilai = PenilaianSempro::where('user_id', auth()->id())
            ->where('sempro_id', $semproId)
            ->first();
        $this->semproId = $semproId;
        $this->media_presentasi = $nilai->media_presentasi;
        $this->komunikasi = $nilai->komunikasi;
        $this->penguasaan_materi = $nilai->penguasaan_materi;
        $this->isi_laporan_ta = $nilai->isi_laporan_ta;
        $this->struktur_penulisan = $nilai->struktur_penulisan;
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
                 
        $this->isApprovePembimbing1 = $riwayat1 ? true : false;
        $this->isApprovePembimbing2 = $riwayat2 ? true : false;
        $this->sempro = $this->dataPengajuan->mahasiswa->user->sempro;
        $this->detailMahasiswa = true;

        // Jadwal
        if ($this->sempro) {
            $this->jadwal = JadwalSempro::where('user_id', $this->dataPengajuan->mahasiswa->user->id)
                ->where('periode_id', $this->sempro->periode_id)
                ->first();
        } else {
            $this->jadwal = null;
        }
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

            $this->total_nilai = ($total1 * 50 / 100) + ($total2 * 50 / 100);
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

        return ($total1 * 50 / 100) + ($total2 * 50 / 100);
    }

    public function isNumber($value)
    {
        return $value !== '' && is_numeric($value);
    }

    public function submitNilai()
    {
        $this->validate([
            'media_presentasi' => 'required|numeric|max:100|min:0',
            'komunikasi' => 'required|numeric|max:100|min:0',
            'penguasaan_materi' => 'required|numeric|max:100|min:0',
            'isi_laporan_ta' => 'required|numeric|max:100|min:0',
            'struktur_penulisan' => 'required|numeric|max:100|min:0',
        ]);

        PenilaianSempro::create([
            'sempro_id' => $this->semproId,
            'user_id' => auth()->id(),
            'media_presentasi' => $this->media_presentasi,
            'komunikasi' => $this->komunikasi,
            'penguasaan_materi' => $this->penguasaan_materi,
            'isi_laporan_ta' => $this->isi_laporan_ta,
            'struktur_penulisan' => $this->struktur_penulisan,
        ]);

        $dataSempro = Sempro::where('id', $this->semproId)->first();

        RiwayatPendaftaranSempro::create([
            'user_id' => auth()->id(),
            'sempro_id' => $this->semproId,
            'pengajuan_ta_id' => $dataSempro->user->mahasiswa->pengajuanTA->id,
            'riwayat' => 'Penilaian Telah Diberikan',
            'keterangan' => 'memberikan nilai pada Seminar Proposal anda',
            'status' => 'Seminar Proposal Dinilai'
        ]);

        $this->addNotif(auth()->id(), $dataSempro->user_id, 'penilaian-sempro', [
            'message' => 'memberikan nilai pada Seminar Proposal anda',
            'status' => 'setuju'
        ]);
        $this->closeNilaiModal();
        $this->refresh();
        $this->dispatch('alert:data', state: 'success', message: 'Anda telah memberikan penilaian');
    }

    public function submitEditNilai()
    {
        $this->validate([
            'media_presentasi' => 'required|numeric|max:100|min:0',
            'komunikasi' => 'required|numeric|max:100|min:0',
            'penguasaan_materi' => 'required|numeric|max:100|min:0',
            'isi_laporan_ta' => 'required|numeric|max:100|min:0',
            'struktur_penulisan' => 'required|numeric|max:100|min:0',
        ]);

        PenilaianSempro::where('user_id', auth()->id())
            ->where('sempro_id', $this->semproId)
            ->update([
            'media_presentasi' => $this->media_presentasi,
            'komunikasi' => $this->komunikasi,
            'penguasaan_materi' => $this->penguasaan_materi,
            'isi_laporan_ta' => $this->isi_laporan_ta,
            'struktur_penulisan' => $this->struktur_penulisan,
        ]);

        $this->closeEditNilaiModal();
        $this->refresh();
        $this->dispatch('alert:data', state: 'success', message: 'nilai telah di update');
    }

    public function render()
    {
        if ($this->type === 'mahasiswa-uji') {
            return view('livewire.pengajuan-ta.seminar-proposal-uji');
        }
        return view('livewire.pengajuan-ta.seminar-proposal');
    }

    public function calculateWorkingDays($mahasiswaId)
    {

        // Ambil user_id dari mahasiswa_id
        $mahasiswa = \DB::table('mahasiswas')->where('id', $mahasiswaId)->first();
        
        if (!$mahasiswa) {
            return ['jadwal_ada' => false, 'pesan' => 'Data mahasiswa tidak ditemukan'];
        }

        // Ambil jadwal seminar proposal mahasiswa ini
        $jadwal = \DB::table('jadwal_sempros')
            ->where('user_id', $mahasiswa->user_id)  // ← ini yang penting
            ->first();
        
        if (!$jadwal) {
            return [
                'jadwal_ada' => false,
                'pesan' => 'Jadwal seminar proposal belum ditentukan'
            ];
        }
        
        $tanggalSetuju = \Carbon\Carbon::now();
        $tanggalSeminar = \Carbon\Carbon::parse($jadwal->tanggal_sempro);
        
        // Hitung hari kerja dari H+1 setelah seminar sampai tanggal setuju
        $hPlusOne = $tanggalSeminar->copy()->addDay();
        $workingDays = 0;
        $currentDate = $hPlusOne->copy();
        
        while ($currentDate->lte($tanggalSetuju)) {
            if ($currentDate->isWeekday()) { // Senin-Jumat saja
                $workingDays++;
            }
            $currentDate->addDay();
        }
        
        // Tentukan status
        if ($tanggalSetuju->lt($hPlusOne)) {
            $status = 'terlalu_cepat';
            $pesan = "⚠️ Belum H+1 setelah jadwal seminar proposal";
        } elseif ($workingDays <= 20) {
            $status = 'normal';
            $pesan = "✅ Dalam batas waktu normal ($workingDays hari kerja setelah seminar)";
        } else {
            $status = 'terlambat';
            $pesan = "⚠️ Sudah lewat batas maksimal ($workingDays hari kerja, maks 20 hari kerja)";
        }
        
        return [
            'jadwal_ada' => true,
            'tanggal_setuju' => $tanggalSetuju->format('d/m/Y'),
            'tanggal_seminar' => $tanggalSeminar->format('d/m/Y'),
            'waktu_seminar' => $jadwal->waktu_mulai . ' - ' . $jadwal->waktu_selesai,
            'ruangan' => $jadwal->ruangan,
            'hari_kerja' => $workingDays,
            'status' => $status,
            'pesan' => $pesan
        ];
    }

}
