<?php

use App\Http\Livewire\Obats;
use App\Http\Livewire\Kasirs;
use App\Http\Livewire\Reseps;
use App\Http\Livewire\Dokters;
use App\Http\Livewire\Invoice;
use App\Http\Livewire\Pasiens;
use App\Http\Livewire\Rekammediks;
use Illuminate\Support\Facades\Route;

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



Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['auth:sanctum', 'verified']], function() {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('pasien', Pasiens::class)->name('pasien');
    Route::get('dokter', Dokters::class)->name('dokter');
    Route::get('obat', Obats::class)->name('obat');
    Route::get('rekammedik', Rekammediks::class)->name('rekammedik');
    Route::get('resep', Reseps::class)->name('resep');
    Route::get('kasir', Kasirs::class)->name('kasir');

    Route::get('invoice/{pilih}', Invoice::class)->name('invoice');
});