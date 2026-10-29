<?php

use App\Http\Controllers\MesinController;
use Illuminate\Support\Facades\Route;

// Mengarahkan halaman utama langsung ke sistem laundry Anda
Route::get('/', [MesinController::class, 'index'])->name('mesin.index');
Route::post('/laundry/simpan', [MesinController::class, 'simpan'])->name('mesin.simpan');
Route::delete('/laundry/hapus/{id}', [MesinController::class, 'hapus'])->name('mesin.hapus');
