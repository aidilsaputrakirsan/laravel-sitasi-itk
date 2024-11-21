<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;
    public function test_bisa_kunjungi_halaman_login()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_bisa_login()
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

        $response = $this->post('/login', [
            'username' => $user->username,
            'password' => '12345678',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect('/dashboard');
    }

    public function test_login_gagal_dengan_password_salah()
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

        $this->post('/login', [
            'username' => $user->username,
            'password' => 'passwordsalah',
        ]);

        $this->assertGuest();
    }
}
