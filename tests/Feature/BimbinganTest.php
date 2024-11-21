<?php

namespace Tests\Feature;

use App\Models\Bimbingan;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\PengajuanTA;
use App\Models\Periode;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class BimbinganTest extends TestCase
{
    use RefreshDatabase;
    private $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = $this->setUserAuth();
    }

    private function setUserAuth()
    {
        $user = User::where('name', 'test')->first();
        if (!$user) {
            $user = User::create([
                'name' => 'test',
                'username' => 'test',
                'email' => 'test@email.com',
                'password' => Hash::make('12345678'),
            ]);
        }

        $this->actingAs($user);

        return $user;
    }

    public function test_kunjungi_halaman_tambah_bimbingan()
    {
        $dosen = Dosen::create([
            'nama_dosen' => 'test',
            'nip' => 'test',
            'email' => 'test',
            'user_id' => $this->user->id
        ]);
        $periode = Periode::create([
            'semester' => 'test',
            'periode' => 'test',
            'gelombang' => 'test',
            'type' => 'Sempro'
        ]);

        $mahasiswa = Mahasiswa::create([
            'nama' => 'test',
            'nim' => 'test',
            'email' => 'test@email.com',
            'nomor_telepon' => 'test',
            'user_id' => $this->user->id,
        ]);

        $pembimbing1 = User::create([
            'name' => 'pembimbing1',
            'username' => 'pembimbing1',
            'email' => 'pembimbing1@email.com',
            'password' => Hash::make('12345678'),
        ]);

        $pembimbing2 = User::create([
            'name' => 'pembimbing2',
            'username' => 'pembimbing2',
            'email' => 'pembimbing2@email.com',
            'password' => Hash::make('12345678'),
        ]);

        $penguji1 = User::create([
            'name' => 'penguji1',
            'username' => 'penguji1',
            'email' => 'penguji1@email.com',
            'password' => Hash::make('12345678'),
        ]);

        $penguji2 = User::create([
            'name' => 'penguji2',
            'username' => 'penguji2',
            'email' => 'penguji2@email.com',
            'password' => Hash::make('12345678'),
        ]);

        $pengajuanTA = PengajuanTA::create([
            'judul' => 'Test judul',
            'bidang_penelitian' => 'Bidang Test',
            'mahasiswa_id' => $mahasiswa->id,
            'pembimbing_1' => $pembimbing1->id,
            'pembimbing_2' => $pembimbing2->id,
            'status' => 'on_process'
        ]);

        $path = route('ta:bimbingan');
        $response = $this->actingAs($this->user)->get($path);
        $response->assertStatus(200);
    }

    public function test_tambah_bimbingan()
    {
        $periode = Periode::create([
            'semester' => 'test',
            'periode' => 'test',
            'gelombang' => 'test',
            'type' => 'Sempro'
        ]);

        $dosen = User::create([
            'name' => 'dosen',
            'username' => 'dosen',
            'email' => 'dosen@email.com',
            'password' => Hash::make('12345678'),
        ]);

        $data = [
            'user_id' => $this->user->id,
            'tanggal' => Carbon::now()->format('Y-m-d'),
            'dosen' => $dosen->id,
            'ket_bimbingan' => 'test',
            'hasil_bimbingan' => 'test',
        ];

        Bimbingan::create($data);

        $this->assertDatabaseHas('bimbingans', $data);
    }
}
