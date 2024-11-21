<?php

namespace App\Imports;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class MahasiswaImport implements ToCollection, WithStartRow
{
    /**
    * @param Collection $rows
    */
    public function collection(Collection $rows)
    {
        foreach($rows as $row) {
            if ($row[1] !== '' && $row[1] !== null) {
                $user = User::where('email', $row[3])->first();

                if (!$user) {
                    $user = User::create([
                        'name' => $row[1],
                        'email' => $row[3],
                        'username' => $row[3],
                        'password' => Hash::make($row[2]),
                    ]);
                }

                $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();
                if (!$mahasiswa) {
                    Mahasiswa::create([
                        'nama' => $row[1],
                        'nim' => $row[2],
                        'email' => $row[3],
                        'nomor_telepon' => $row[4],
                        'user_id' => $user->id,
                    ]);
                }

                $defaultRole = ['mahasiswa'];
                $user->syncRoles($defaultRole);
            }
        }
    }

    public function startRow(): int
    {
        return 4;
    }
}
