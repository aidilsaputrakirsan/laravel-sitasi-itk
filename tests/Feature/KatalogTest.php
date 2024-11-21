<?php

namespace Tests\Feature;

use App\Models\Katalog;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class KatalogTest extends TestCase
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

    public function test_kunjungi_halaman_katalog()
    {
        $path = route('katalog:index');
        $response = $this->actingAs($this->user)->get($path);
        $response->assertStatus(200);
    }

    public function test_tambah_katalog()
    {
        $data = [
            'nama' => 'test',
            'nim' => 'test',
            'judul' => 'judul',
            'abstrak' => 'test'
        ];

        Katalog::create($data);

        $this->assertDatabaseHas('katalogs', $data);
    }
}
