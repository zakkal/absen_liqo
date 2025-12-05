<?php

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LogoutController;
use App\Livewire\Admin\Kehadiran as AdminKehadiran;
use App\Livewire\Anggota\Kehadiran;
use App\Livewire\Anggota\Datateman;
use App\Livewire\Admin\Grafik;
use App\Livewire\Admin\Pengumuman;
use App\Livewire\Anggota\Pengumuman as AnggotaPengumuman;
use App\Livewire\Admin\Petugas;
use App\Livewire\Anggota\Petugas as AnggotaPetugas;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Passwords\Confirm;
use App\Livewire\Auth\Passwords\Email;
use App\Livewire\Auth\Passwords\Reset;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\Verify;
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

Route::view('/', 'welcome')->name('home');

Route::middleware('guest')->group(function () {
    Route::get('login', Login::class)
        ->name('login');

    Route::get('register', Register::class)
        ->name('register');
});

Route::get('password/reset', Email::class)
    ->name('password.request');

Route::get('password/reset/{token}', Reset::class)
    ->name('password.reset');

Route::middleware('auth')->group(function () {
    Route::get('email/verify', Verify::class)
        ->middleware('throttle:6,1')
        ->name('verification.notice');

    Route::get('password/confirm', Confirm::class)
        ->name('password.confirm');
});

Route::middleware('auth')->group(function () {
    Route::get('email/verify/{id}/{hash}', EmailVerificationController::class)
        ->middleware('signed')
        ->name('verification.verify');

    Route::post('logout', LogoutController::class)
        ->name('logout');
});

// Routes untuk Anggota (User/Member)
Route::prefix('anggota')
->middleware(['auth', 'role:admin'])
->group(function () {
    Route::get('hadir', Kehadiran::class)->name('hadir');
    Route::get('datatemen', Datateman::class)->name('datatemen');
    Route::get('pengumuman', AnggotaPengumuman::class)->name('umum');
    Route::get('petugas', AnggotaPetugas::class)->name('tugas');
    
});

// Routes untuk Admin
Route::prefix('admin')
->middleware(['auth', 'role:anggota'])
->group(function () {
    Route::get('kehadiran', AdminKehadiran::class)->name('admin.kehadiran');
    Route::get('pengumuman', Pengumuman::class)->name('pengumuman');
   Route::get('grafik', Grafik::class)->name('grafik');
    Route::get('petugas', Petugas::class)->name('admin.petugas');
});