<?php

namespace Tests\Feature;

use App\Models\JadwalSempro;
use App\Models\Mahasiswa;
use App\Models\PengajuanTA;
use App\Models\Periode;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class JadwalSeminarProposalTest extends TestCase
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

    public function test_kunjungi_halaman_tambah_jadwal_seminar_proposal()
    {
        $path = route('jadwal:sempro:index');
        $response = $this->actingAs($this->user)->get($path);
        $response->assertStatus(200);
    }

    public function test_tambah_jadwal_seminar_proposal()
    {
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

        $data = [
            'periode_id' => $periode->id,
            'pengajuan_ta_id' => $pengajuanTA->id,
            'user_id' => $this->user->id,
            'penguji_1' => $penguji1->id,
            'penguji_2' => $penguji2->id,
            'tanggal_sempro' => Carbon::now()->format('Y-m-d'),
            'waktu_mulai' => 'test',
            'waktu_selesai' => 'test',
            'ruangan' => 'test',
        ];

        $jadwalSempro = JadwalSempro::create($data);

        $this->assertDatabaseHas('jadwal_sempros', $data);
    }
}
