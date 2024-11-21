<?php

namespace App\Http\Controllers;

use App\Models\Bimbingan;
use App\Models\Notifikasi;
use Illuminate\Http\Request;

class BimbinganController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required',
            'dosen' => 'required|string',
            'ket_bimbingan' => 'required|string',
            'hasil_bimbingan' => 'required|string',
        ]);
        
        Bimbingan::create([
            'user_id' => auth()->user()->id,
            'tanggal' => $request->tanggal,
            'dosen' => $request->dosen,
            'ket_bimbingan' => $request->ket_bimbingan,
            'hasil_bimbingan' => $request->hasil_bimbingan,
        ]);

        Notifikasi::create([
            'from_id' => auth()->id(),
            'to_id' => $request->dosen,
            'type' => 'pengajuan-bimbingan',
            'data' => [
                'status' => 'pengajuan-bimbingan',
                'message' => 'Menambahkan data bimbingan'
            ]
        ]);

        return redirect()->back()->with('success', 'Hasil Bimbingan Telah Dimasukkan!');
    }

    public function edit($id)
    {
        return view('bimbingan.edit-bimbingan')->with(['Bimbingan' => Bimbingan::findOrFail($id)]);
    }


    public function update(Request $request, $id)
    {
        $bimbingan = Bimbingan::findOrFail($id);

        $request->validate([
            'tanggal' => 'required',
            'dosen' => 'required|string',
            'ket_bimbingan' => 'required|string',
            'hasil_bimbingan' => 'required|string',
        ]);

        $bimbingan->update([
            'tanggal' => $request->tanggal,
            'dosen' => $request->dosen,
            'ket_bimbingan' => $request->ket_bimbingan,
            'hasil_bimbingan' => $request->hasil_bimbingan,
        ]);

        return redirect()->back()->with('success', 'Hasil Bimbingan Telah Diubah!');
    }

    public function destroy(Bimbingan $bimbingan, $id)
    {
        $bimbingan = Bimbingan::find($id);

        $bimbingan->delete();
        return redirect()->back()->with('success', 'Hasil Bimbingan Telah Dihapus');
    }
}
