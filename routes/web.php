<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PeriodeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\BimbinganController;
use App\Http\Controllers\DataUserController;
use App\Http\Controllers\PDFController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Auth Pages
Route::get('/login', [PagesController::class, 'loginPage'])->middleware('guest')->name('login');

// Auth Action
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/logout', [AuthController::class, 'logout'])->name('get:logout');

Route::middleware(['auth:sanctum'])->group(function() {
    Route::get('/', [PagesController::class, 'dashboardPage']);

    Route::prefix('ta')->group(function() {
        // Pengajuan 
        Route::get('pengajuan-ta', [PagesController::class, 'pengajuanTaPage'])->name('ta:pengajuan');
        // Bimbingan
        Route::get('/bimbingan', [PagesController::class, 'bimbinganPage'])->middleware('auth')->name('ta:bimbingan');
        Route::post('/tambah-bimbingan', [BimbinganController::class, 'store'])->name('ta:bimbingan:store');

        // Sempro
        Route::get('/sempro', [PagesController::class, 'semproPage'])->middleware('auth')->name('ta:sempro');
        // Sidang TA
        Route::get('/sidang-ta', [PagesController::class, 'sidangTa'])->middleware('auth')->name('ta:sidang-ta');

        // Penilaian
        Route::get('/penilaian', [PagesController::class, 'penilaianPage'])->middleware('auth')->name('ta:penilaian');
    });

    Route::prefix('data')->group(function() {
        // Data dosen
        Route::get('dosen', [DataUserController::class, 'dosenPage'])->name('data-dosen:index');
        Route::post('dosen', [DataUserController::class, 'store'])->name('data-dosen:store');

        // Data Mahasiswa
        Route::get('mahasiswa', [DataUserController::class, 'mahasiswaPage'])->name('data-mahasiswa:index');
        Route::post('mahasiswa', [DataUserController::class, 'storeMahasiswa'])->name('data-mahasiswa:store');
    });

    // user profile
    Route::get('user-profile', [PagesController::class, 'userProfilePage'])->name('user-profile:index');

    // Sistem
    Route::get('/dashboard', [PagesController::class, 'dashboardPage'])->middleware('auth')->name('dashboard');
    Route::get('/edit-bimbingan/{id}', [PagesController::class, 'editBimbinganPage'])->middleware('auth')->name('edit-bimbingan');
    Route::get('/sidang', [PagesController::class, 'sidangPage'])->middleware('auth')->name('sidang');
    Route::get('/penilaian', [PagesController::class, 'penilaianPage'])->middleware('auth')->name('penilaian');


    // For Dosen
    Route::prefix('data-pengajuan')->group(function() {
        // daftar judul
        Route::get('judul-ta', [PagesController::class, 'judulTaPage'])->name('data-pengajuan:judul-ta');

        // bimbingan
        Route::get('bimbingan', [PagesController::class, 'pengajuanBimbingan'])->name('data-pengajuan:bimbingan');
        Route::get('bimbingan/{id}', [PagesController::class, 'detailBimbingan'])->name('data-pengajuan:detail');

        // Seminar Proposal
        Route::get('seminar-proposal', [PagesController::class, 'pengajuanSeminarProposal'])->name('data-pengajuan:seminar-proposal');


        // Sidang TA
        Route::get('sidang-ta', [PagesController::class, 'pengajuanSidangTA'])->name('data-pengajuan:sidang-ta');
    });

    Route::get('/referensi', [PagesController::class, 'referensiPage'])->name('referensi:index');
    Route::get('/katalog-ta', [PagesController::class, 'katalogPage'])->name('katalog:index');
    Route::get('/prosedur', [PagesController::class, 'prosedurPage'])->name('prosedur:index');


    // For Tendik dan Korpro
    Route::prefix('jadwal')->group(function() {
        // Jadwal Sempro
        Route::get('sempro', [PagesController::class, 'jadwalSemproPage'])->name('jadwal:sempro:index');
        Route::get('sempro/{periode_id}', [PagesController::class, 'detailJadwalSemproPage'])->name('jadwal:sempro:detail');

        Route::get('sidang-ta', [PagesController::class, 'jadwalSidangPage'])->name('jadwal:sidang-ta:index');
        Route::get('sidang-ta/{periode_id}', [PagesController::class, 'detailJadwalSidangPage'])->name('jadwal:sidang-ta:detail');
    });

    // Periode TA dan SEMPRO
    Route::get('/periode-sempro', [PagesController::class, 'periodeSemproPage'])->name('periode-sempro');
    Route::post('/periode-sempro/create', [PeriodeController::class, 'storePeriodeSempro'])->name('periode-sempro:store');
    Route::get('/periode-sempro/{id}', [PagesController::class, 'listMahasiswaSempro'])->name('periode-sempro:list');

    Route::get('/periode-ta', [PagesController::class, 'periodePage'])->name('periode-ta');
    Route::post('/periode-ta/create', [PeriodeController::class, 'store'])->name('periode-ta:store');
    Route::get('/periode-ta/{id}', [PagesController::class, 'listMahasiswaPage'])->name('periode-ta:list');


    Route::prefix('pdf')->group(function() {
        Route::get('/form-ta-006', [PDFController::class, 'form_ta_006'])->name('pdf:form-ta-006');
        Route::get('/form-ta-001', [PDFController::class, 'form_ta_001'])->name('pdf:form-ta-001');
        Route::get('/form-ta-002', [PDFController::class, 'form_ta_002'])->name('pdf:form-ta-002');
        Route::get('/jadwal-seminar-proposal', [PDFController::class, 'jadwal_seminar_proposal'])->name('pdf:jadwal-seminar-proposal');
        Route::get('/lembar-persetujuan-revisi', [PDFController::class, 'lembar_persetujuan_revisi'])->name('pdf:lembar-persetujuan-revisi');
        Route::get('/fom-ta-007', [PDFController::class, 'form_ta_007'])->name('pdf:form-ta-007');
        Route::get('/fom-ta-008', [PDFController::class, 'form_ta_008'])->name('pdf:form-ta-008');
        Route::get('/jadwal-sidang-ta', [PDFController::class, 'jadwal_sidang_ta'])->name('pdf:jadwal-sidang-ta');
        Route::get('/berita-acara-sempro', [PDFController::class, 'berita_acara_sempro'])->name('pdf:berita-acara-sempro');
        Route::get('/berita-acara-sidang', [PDFController::class, 'berita_acara_sidang'])->name('pdf:berita-acara-sidang');
        Route::get('/kesanggupan-revisi', [PDFController::class, 'kesanggupan_revisi'])->name('pdf:kesanggupan-revisi');
    });

});
