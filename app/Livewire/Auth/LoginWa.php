<?php

namespace App\Livewire\Auth;

use App\Models\Otp;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class LoginWa extends Component
{
    public $no_wa;
    public $otp_input;
    public $step = 1; // 1: Input Number, 2: Input OTP
    public $errorMessage;

    protected $rules = [
        'no_wa' => 'required|numeric|min:10',
    ];

    private function sendWhatsapp($no_wa, $message)
    {
        $token = config('services.fonnte.token');
        
        if (!$token || $token == 'your_token_here') {
            Log::error('WhatsApp Token not set in .env or config');
            return false;
        }

        // Clean Number for Fonnte (International Format: 628...)
        // Remove spaces, dashes, etc.
        $no_wa = preg_replace('/[^0-9]/', '', $no_wa);
        
        // Convert 08... to 628...
        if (strpos($no_wa, '0') === 0) {
            $no_wa = '62' . substr($no_wa, 1);
        }
        
        // If it starts with 8..., assume it's Indonesian and add 62
        if (strpos($no_wa, '8') === 0) {
            $no_wa = '62' . $no_wa;
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => $token
            ])->post('https://api.fonnte.com/send', [
                'target' => $no_wa,
                'message' => $message,
                'delay' => '2',
            ]);

            // Log response if failed for easier debugging
            if (!$response->successful()) {
                Log::error('Fonnte API Failure: ' . $response->body());
            }

            return $response->successful();
        } catch (\Exception $e) {
            Log::error('Whatsapp Login Error: ' . $e->getMessage());
            return false;
        }
    }

    public function sendOtp()
    {
        $this->validate();

        $otp = rand(100000, 999999);
        
        Otp::create([
            'no_wa' => $this->no_wa,
            'otp' => $otp,
            'valid_until' => Carbon::now()->addMinutes(5),
        ]);

        $message = "Kode OTP Login Absen Halaqah Anda adalah: *$otp*. Berlaku selama 5 menit.";
        
        $sent = $this->sendWhatsapp($this->no_wa, $message);

        if ($sent) {
            $this->step = 2;
            $this->errorMessage = null;
        } else {
            $this->errorMessage = "Gagal mengirim OTP. Pastikan token Fonnte di .env sudah benar.";
        }
    }

    public function verifyOtp()
    {
        $this->validate([
            'otp_input' => 'required|numeric|digits:6',
        ]);

        $otpRecord = Otp::where('no_wa', $this->no_wa)
                        ->where('otp', $this->otp_input)
                        ->where('valid_until', '>', Carbon::now())
                        ->whereNull('used_at')
                        ->latest()
                        ->first();

        if ($otpRecord) {
            $otpRecord->update(['used_at' => Carbon::now()]);

            $user = User::where('no_wa', $this->no_wa)->first();

            if (!$user) {
                $user = User::create([
                    'name' => 'User ' . substr($this->no_wa, -4),
                    'email' => $this->no_wa . '@wa.login',
                    'no_wa' => $this->no_wa,
                    'role' => 'anggota',
                    'password' => null,
                ]);
            }

            Auth::login($user);

            if ($user->hasRole('admin')) {
                return redirect()->intended(route('admin.kehadiran'));
            }

            return redirect()->intended(route('hadir'));
        } else {
            $this->errorMessage = "Kode OTP salah atau sudah kedaluwarsa.";
        }
    }

    public function backToStep1()
    {
        $this->step = 1;
        $this->otp_input = null;
        $this->errorMessage = null;
    }

    public function render()
    {
        return view('livewire.auth.login-wa')->extends('layouts.auth');
    }
}
