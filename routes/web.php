<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JamController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\JenisController;
use App\Http\Controllers\SlotController;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\Route;

//dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

// Jam
Route::get('/jam', [JamController::class, 'index'])->name('jam.index');
Route::post('/jam/tambah', [JamController::class, 'store']);
Route::get('/jam/hapus/{id}', [JamController::class, 'destroy'])->name('jam.hapus');

//Slot
Route::get('/slot', [SlotController::class, 'index'])->name('slot.index');
Route::post('/slot/tambah', [SlotController::class, 'store']);
Route::get('/slot/hapus/{id}', [SlotController::class, 'destroy'])->name('slot.hapus');

//pendaftaran
Route::get('/pendaftaran', [PendaftaranController::class, 'index'])->name('pendaftaran.index');
Route::post('/pendaftaran/tambah', [PendaftaranController::class, 'store']);
Route::post('/pendaftaran/edit', [PendaftaranController::class, 'update']);
Route::get('/pendaftaran/hapus/{id}', [PendaftaranController::class, 'destroy'])->name('pendaftaran.hapus');
Route::post('/pendaftaran/selesai', [PendaftaranController::class, 'selesai']);

// Jadwal
Route::get('/jadwal', [JamController::class, 'Jadwal'])->name('jadwal.index');
Route::get('/semua-jadwal', [JamController::class, 'SemuaJadwal'])->name('jadwal.semua');

// Jenis
Route::get('/jenis', [JenisController::class, 'index'])->name('jenis.index');
Route::post('/jenis/tambah', [JenisController::class, 'store']);
Route::get('/jenis/hapus/{id}', [JenisController::class, 'destroy'])->name('jenis.hapus');

//status
Route::get('/status', [PendaftaranController::class, 'prosesStatus'])->name('status.index');
