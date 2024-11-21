<?php

namespace Tests\Feature;

use App\Models\Periode;
use App\Models\Sempro;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class SeminarProposalTest extends TestCase
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

    public function test_kunjungi_halaman_daftar_seminar_proposal()
    {
        $path = route('data-pengajuan:judul-ta');
        $response = $this->actingAs($this->user)->get($path);
        $response->assertStatus(200);
    }

    public function test_daftar_seminar_proposal()
    {
        $periode = Periode::create([
            'semester' => 'test',
            'periode' => 'test',
            'gelombang' => 'test',
            'type' => 'Sempro'
        ]);

        $data = [
            'user_id' => $this->user->id,
            'periode_id' => $periode->id,
            'tanggal' => Carbon::now()->format('Y-m-d'),
            'form_ta_012' => 'test',
            'bukti_plagiasi' => 'test',
            'proposal_ta' => 'test',
        ];

        $sempro = Sempro::create($data);

        $this->assertDatabaseHas('sempros', $data);
    }
}
