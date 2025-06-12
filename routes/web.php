<?php

use App\Livewire\Auth\Login;
use App\Livewire\Data\GuruManager;
use App\Livewire\Data\KelasManager;
use App\Livewire\Data\SiswaManager;
use App\Livewire\Setting\Setting;
use App\Models\Data\Siswa;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::get('/login', Login::class)->name('login')->middleware('guest');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


     Route::middleware('role:Super Admin')->group(function () {
        Route::get('/kelas', KelasManager::class)->name('kelas.index');
        Route::get('/siswa', SiswaManager::class)->name('siswa.index');
        Route::get('/guru', GuruManager::class)->name('guru.index');
    });
    
    Route::get('/settings', Setting::class)->name('settings.index');
});
