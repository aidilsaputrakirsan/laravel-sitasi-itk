<?php

namespace App\Imports;

use App\Models\Dosen;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class DosenImport implements ToCollection, WithStartRow
{
    /**
    * @param Collection $rows
    */
    public function collection(Collection $rows)
    {
        foreach($rows as $row)
        {
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

                $dosen = Dosen::where('user_id', $user->id)->first();

                if (!$dosen) {
                    Dosen::create([
                        'nama_dosen' => $row[1],
                        'nip' => $row[2],
                        'email' => $row[3],
                        'user_id' => $user->id,
                    ]);
                }

                $defaultRole = ['dosen'];
                $roles = [];
                if ($row[4] !== '') {
                    $roleCodes = preg_split('/[,.]/', $row[4]);

                    foreach ($roleCodes as $role) {
                        switch (trim($role)) {
                            case '1':
                                $roles[] = 'koorpro';
                                break;
                            case '2':
                                $roles[] = 'tendik';
                                break;
                        }
                    }
                }
                $roles = array_merge($defaultRole, $roles);
                $roles = array_unique($roles);
                $roles = array_values($roles);
                $user->syncRoles($roles);
            }
        }
    }

    public function startRow(): int
    {
        return 4;
    }
}
