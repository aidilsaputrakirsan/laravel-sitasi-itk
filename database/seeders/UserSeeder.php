<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            ['name' => 'User Mahasiswa', 'email' => 'mahasiswa@example.com', 'username' => 'mahasiswa', 'role' => 'mahasiswa'],
            ['name' => 'User Dosen', 'email' => 'dosen@example.com', 'username' => 'dosen', 'role' => 'dosen'],
            ['name' => 'User Tenaga Kependidikan', 'email' => 'tendik@example.com', 'username' => 'tendik', 'role' => 'tendik'],
            ['name' => 'User Koordinator Program Studi', 'email' => 'koorpro@example.com', 'username' => 'koorpro', 'role' => 'koorpro']
        ];

        foreach ($users as $userData) {
            $user = User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'username' => $userData['username'],
                'password' => Hash::make('12345678')
            ]);

            $user->assignRole($userData['role']);
        }
    }
}
