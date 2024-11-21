<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DataUserController extends Controller
{
    public function dosenPage()
    {
        return view('pages.data-user.dosen.list');
    }

    public function store(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            $user = User::create([
                'name' => $request->name,
                'username' => $request->email,
                'email' => $request->email,
                'password' => Hash::make($request->nip),
            ]);

            $user->assignRole('dosen');
            $roles = $request->roles;
            if ($roles !== '' || $roles !== null) {
                $expRoles = explode(",", $roles);
                foreach($expRoles as $role) {
                    $user->assignRole($role);
                }
            }
        }

        $dosen = Dosen::where('email', $request->email)->first();
        if (!$dosen) {
            Dosen::create([
                'nama_dosen' => $request->name,
                'email' => $request->email,
                'nip' => $request->nip,
                'user_id' => $user->id,
            ]);

            return back()->with('success', 'Data telah dibuat');
        }

        return back()->with('error', 'Data dosen sudah ada');
    }

    public function mahasiswaPage()
    {
        return view('pages.data-user.mahasiswa.list');
    }

    public function storeMahasiswa(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            $user = User::create([
                'name' => $request->name,
                'username' => $request->email,
                'email' => $request->email,
                'password' => Hash::make($request->nim),
            ]);

            $user->assignRole('mahasiswa');
        }

        $mahasiswa = Mahasiswa::where('email', $request->email)->first();
        if (!$mahasiswa) {
            Mahasiswa::create([
                'nama' => $request->name,
                'email' => $request->email,
                'nim' => $request->nim,
                'nomor_telepon' => $request->nomor_telepon,
                'user_id' => $user->id,
            ]);

            return back()->with('success', 'Data telah dibuat');
        }

        return back()->with('error', 'Data mahasiswa sudah ada');
    }
}
