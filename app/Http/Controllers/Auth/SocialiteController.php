<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    /**
     * Redirect the user to the Google authentication page.
     */
    public function redirectToGoogle()
    {
        $uri = config('services.google.redirect');
        Log::info('Google Login Attempted with URI: ' . $uri);
        
        try {
            return Socialite::driver('google')->redirect();
        } catch (\Exception $e) {
            Log::error('Google Redirect Error: ' . $e->getMessage());
            $msg = $e->getMessage();
            $uri = config('services.google.redirect');
            return "Gagal mengarahkan ke Google. <br>Pesan Error: $msg <br>Redirect URI di sistem: $uri <br><br><b>Saran:</b> Pastikan folder 'vendor/laravel/socialite' sudah ada di hosting.";
        }
    }

    /**
     * Obtain the user information from Google.
     */
    public function handleGoogleCallback()
    {
        try {
            Log::info('Google Callback Received');
            $googleUser = Socialite::driver('google')->user();
            
            // Find user by google_id or email
            $user = User::where('google_id', $googleUser->id)
                        ->orWhere('email', $googleUser->email)
                        ->first();

            if ($user) {
                // Update google_id and avatar if not set
                $user->update([
                    'google_id' => $googleUser->id,
                    'avatar' => $googleUser->avatar,
                ]);
            } else {
                // Create a new user
                $user = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'avatar' => $googleUser->avatar,
                    'role' => 'anggota', // Default role for new users
                    'password' => null, // Password nullable for Google users
                ]);
            }

            Auth::login($user);

            // Redirect based on role
            if ($user->hasRole('admin')) {
                return redirect()->intended(route('admin.kehadiran')); // Redirect admin to dashboard
            }

            return redirect()->intended(route('hadir')); // Redirect anggota to attendance page

        } catch (Exception $e) {
            Log::error('Google Callback Error: ' . $e->getMessage());
            return redirect()->route('login')->with('error', 'Gagal login menggunakan Google. Silakan coba lagi.');
        }
    }
}
