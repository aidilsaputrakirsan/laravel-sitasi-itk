<?php

namespace App\Livewire\PengajuanTa;

use Livewire\Component;
use App\Traits\NotifikasiTraits;
use App\Models\Dosen;
use App\Models\PengajuanTA;
use App\Models\RiwayatPengajuan;

class Show extends Component
{
    use NotifikasiTraits;
    public $pengajuan;
    public $judul;
    public $bidang_penelitian;
    public $pembimbing1;
    public $pembimbing2;
    public $saveAble = false;

    public $status = "Silahkan ajukan judul";
    public $editable = false;
    public $riwayats = [];
    public $isRejectedPembimbing1 = true;
    public $isRejectedPembimbing2 = true;

    public function mount()
    {
        if (!auth()->user()->isMahasiswa()) {
            return redirect()->route('dashboard');
        }

        $this->refresh();
    }

    public function updatedJudul()
    {
        $this->saveAble = true;
    }

    public function updatedBidangPenelitian()
    {
        $this->saveAble = true;
    }

    public function updatedPembimbing1()
    {
        $this->saveAble = true;
    }
    public function updatedPembimbing2()
    {
        $this->saveAble = true;
    }

    public function refresh()
    {
        $pengajuan = PengajuanTA::where('mahasiswa_id', auth()->user()->mahasiswa->id)->first();
        if ($pengajuan) {
            $this->pengajuan = $pengajuan;
            $this->status = $pengajuan->status;
            $this->judul = $pengajuan->judul;
            $this->bidang_penelitian = $pengajuan->bidang_penelitian;
            $this->pembimbing1 = $pengajuan->pembimbing_1;
            $this->pembimbing2 = $pengajuan->pembimbing_2;
            $this->editable = $pengajuan->status === 'Revisi Judul' ? false : true;

            if ($pengajuan->status == 'Judul Ditolak') {
                $this->editable = false;
            }

            $this->riwayats = RiwayatPengajuan::where('pengajuan_ta_id', $this->pengajuan->id)->orderBy('created_at', 'DESC')->get();
            
            $riwayat1 = RiwayatPengajuan::where('pengajuan_ta_id', $pengajuan->id)
                ->where('user_id', $pengajuan->pembimbing_1)
                ->where('status', 'Ditolak Pembimbing')
                ->first();
            $riwayat2 = RiwayatPengajuan::where('pengajuan_ta_id', $pengajuan->id)
                ->where('user_id', $pengajuan->pembimbing_2)
                ->where('status', 'Ditolak Pembimbing')
                ->first();
            $this->isRejectedPembimbing1 = $riwayat1 ? true : false;
            $this->isRejectedPembimbing2 = $riwayat2 ? true : false;
        }
    }

    public function submit()
    {
        if (!$this->saveAble) {
            return;
        }
        $this->validate([
            'judul' => 'required',
            'bidang_penelitian' => 'required',
            'pembimbing1' => 'required',
            'pembimbing2' => 'required',
        ], [
            'judul.required' => 'Judul Wajib di isi',
            'bidang_penelitian.required' => 'Bidang Penelitian Wajib di isi',
            'pembimbing1.required' => 'Pembimbing 1 Wajib di isi',
            'pembimbing2.required' => 'Pembimbing 2 Wajib di isi'
        ]);

        $pengajuan = PengajuanTA::where('mahasiswa_id', auth()->user()->mahasiswa->id)->first();
        if (!$pengajuan) {
            $pengajuan = PengajuanTA::create([
                'judul' => $this->judul,
                'bidang_penelitian' => $this->bidang_penelitian,
                'mahasiswa_id' => auth()->user()->mahasiswa->id,
                'pembimbing_1' => $this->pembimbing1,
                'pembimbing_2' => $this->pembimbing2,
                'status' => 'Dalam Proses Pengajuan',
            ]);
            
            $riwayat = RiwayatPengajuan::create([
                'pengajuan_ta_id' => $pengajuan->id,
                'riwayat' => 'Mengajukan Judul',
                'user_id' => auth()->id(),
                'status' => 'Dalam Proses Pengajuan'
            ]);

            $this->addNotif(auth()->user()->id, $this->pembimbing1, 'notifikasi', [
                'user_id' => auth()->id(),
                'message' => 'mengajukan judul TA'
            ]);
            $this->addNotif(auth()->user()->id, $this->pembimbing2, 'notifikasi', [
                    'user_id' => auth()->id(),
                    'message' => 'mengajukan judul TA'
            ]);

        } else {
            PengajuanTA::where('id', $pengajuan->id)
                ->update([
                    'judul' => $this->judul,
                    'bidang_penelitian' => $this->bidang_penelitian,
                    'pembimbing_1' => $this->pembimbing1,
                    'pembimbing_2' => $this->pembimbing2,
                    'status' => $pengajuan->status === 'Judul TA Ditolak' ? 'Dalam Proses Pengajuan' : $pengajuan->status,
                ]);
            if ($pengajuan->status === 'Judul TA Ditolak') {
                $riwayat = RiwayatPengajuan::create([
                    'pengajuan_ta_id' => $pengajuan->id,
                    'riwayat' => 'mengubah judul',
                    'user_id' => auth()->id(),
                    'status' => 'Dalam Proses Pengajuan'
                ]);
            } else {
                $riwayat = RiwayatPengajuan::create([
                    'pengajuan_ta_id' => $pengajuan->id,
                    'riwayat' => 'mengupdate data pengajuan',
                    'user_id' => auth()->id(),
                    'status' => 'Mengupdate Data Pengajuan'
                ]);
            }


            $this->addNotif(auth()->user()->id, $this->pembimbing1, 'notifikasi', [
                'user_id' => auth()->id(),
                'message' => 'mengupdate data pengajuan TA'
            ]);
            $this->addNotif(auth()->user()->id, $this->pembimbing2, 'notifikasi', [
                    'user_id' => auth()->id(),
                    'message' => 'mengupdate data pengajuan TA'
            ]);
        }
        $this->dispatch('alert:data', state: 'success', message: 'Data Pengajuan TA telah diupdate');
        $this->refresh();
        $this->saveAble = false;
        $this->editable = true;
    }
    public function render()
    {
        
        $dosens = Dosen::get();
        return view('livewire.pengajuan-ta.show',[
            'dosens' => $dosens
        ]);
    }
}
