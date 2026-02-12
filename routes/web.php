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
use App\Livewire\Auth\LoginWa;
use App\Livewire\Auth\Passwords\Confirm;
use App\Livewire\Auth\Passwords\Email;
use App\Livewire\Auth\Passwords\Reset;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\Verify;
use App\Livewire\Anggota\Muthabaah as AnggotaMuthabaah;
use App\Livewire\Admin\Muthabaah as AdminMuthabaah;
use App\Livewire\Profile;
use App\Http\Controllers\Auth\SocialiteController;
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

Route::get('auth/google', [SocialiteController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [SocialiteController::class, 'handleGoogleCallback']);

Route::middleware('guest')->group(function () {
    Route::get('login', Login::class)
        ->name('login');
    
    Route::get('login-wa', LoginWa::class)
        ->name('login.wa');
});

Route::middleware('auth')->group(function () {
    Route::get('email/verify', Verify::class)
        ->middleware('throttle:6,1')
        ->name('verification.notice');
});

Route::middleware('auth')->group(function () {
    Route::get('email/verify/{id}/{hash}', EmailVerificationController::class)
        ->middleware('signed')
        ->name('verification.verify');

    Route::post('logout', LogoutController::class)
        ->name('logout');
    
    Route::get('profile', Profile::class)->name('profile');
});

// Routes untuk Anggota (User/Member)
Route::prefix('anggota')
->middleware(['auth', 'role:anggota', 'profile.complete'])
->group(function () {
    Route::get('hadir', Kehadiran::class)->name('hadir');
    Route::get('datatemen', Datateman::class)->name('datatemen');
    Route::get('pengumuman', AnggotaPengumuman::class)->name('umum');
    Route::get('petugas', AnggotaPetugas::class)->name('tugas');
    Route::get('muthabaah', AnggotaMuthabaah::class)->name('anggota.muthabaah');
    Route::redirect('muthabaah-redirect', 'anggota/muthabaah')->name('muthabaah');
    
});

// Routes untuk Admin
Route::prefix('admin')
->middleware(['auth', 'role:admin'])
->group(function () {
    Route::get('kehadiran', AdminKehadiran::class)->name('admin.kehadiran');
    Route::get('pengumuman', Pengumuman::class)->name('pengumuman');
   Route::get('grafik', Grafik::class)->name('grafik');
    Route::get('petugas', Petugas::class)->name('admin.petugas');
    Route::get('muthabaah', AdminMuthabaah::class)->name('admin.muthabaah');
});