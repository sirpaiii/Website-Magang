<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\LowonganController;
use App\Http\Controllers\LamaranController;

Route::get('/', function () {
    return view('landing');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {

    // Dashboard untuk Mahasiswa dan Perusahaan
    Route::get('/mahasiswa/dashboard', [DashboardController::class, 'mahasiswa']);
    Route::get('/perusahaan/dashboard', [DashboardController::class, 'perusahaan']);
    Route::get('/dashboard/perusahaan', [DashboardController::class, 'perusahaan'])->name('dashboard.perusahaan');
    Route::get('/dashboard/mahasiswa', [DashboardController::class, 'mahasiswa'])->name('dashboard.mahasiswa');


    // Profil Mahasiswa
    Route::get('/mahasiswa/profil', [MahasiswaController::class, 'show'])->name('mahasiswa.profil');
    Route::put('/mahasiswa/profil', [MahasiswaController::class, 'update'])->name('mahasiswa.update');
    Route::get('/mahasiswa/filter', [MahasiswaController::class, 'filter'])->name('mahasiswa.filter');

    // Profil Perusahaan
    Route::get('/perusahaan/profil', [PerusahaanController::class, 'show'])->name('perusahaan.profil');
    Route::put('/perusahaan/profil', [PerusahaanController::class, 'update'])->name('perusahaan.update');

    // Lowongan
    Route::get('/lowongan', [LowonganController::class, 'index'])->name('lowongan.index');
    Route::get('/lowongan/create', [LowonganController::class, 'create'])->name('lowongan.create');
    Route::post('/lowongan', [LowonganController::class, 'store'])->name('lowongan.store');
    Route::delete('/lowongan/{id}', [LowonganController::class, 'destroy'])->name('lowongan.destroy');


    // Lamaran
    Route::get('/lamaran/mahasiswa', [LamaranController::class, 'indexMahasiswa'])->name('lamaran.mahasiswa');
    Route::get('/lamaran/perusahaan', [LamaranController::class, 'indexPerusahaan'])->name('lamaran.perusahaan');
    Route::post('/lamaran/{lowongan}/kirim', [LamaranController::class, 'lamar'])->name('lamaran.kirim');
    Route::patch('/lamaran/{lamaran}/status', [LamaranController::class, 'updateStatus'])->name('lamaran.status');
});
