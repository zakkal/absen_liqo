<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    /** @var string */
    public $email = '';

    /** @var string */
    public $password = '';

    /** @var bool */
    public $remember = false;

    protected $rules = [
        'email' => ['required', 'email'],
        'password' => ['required'],
    ];

    public function authenticate()
    {
        $this->validate();

        // Coba login
        if (!Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            $this->addError('email', trans('auth.failed'));
            return;
        }

        // Ambil data user yang login
        $user = Auth::user();

        // CEK ROLE
        if ($user->role === 'admin') {
            return redirect()->route('admin.kehadiran'); // ganti sesuai route kamu
        }

        if ($user->role === 'anggota') {
            return redirect()->route('datatemen'); // route default user
        }

        // Jika role tidak dikenal
        return redirect()->route('home'); // fallback
    }

    public function render()
    {
        return view('livewire.auth.login')->extends('layouts.auth');
    }
}
