<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckProfileCompletion
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && !auth()->user()->hasRole('admin')) {
            $user = auth()->user();
            
            // Check if name is still default (User XXXX) or null
            // Check if no_wa is null or empty or too short
            $isNameDefault = str_starts_with($user->name, 'User ') && strlen($user->name) <= 10;
            $isWaIncomplete = empty($user->no_wa) || strlen($user->no_wa) < 10;
            
            if ($isWaIncomplete || $isNameDefault || empty($user->name)) {
                if (!$request->routeIs('profile') && !$request->routeIs('logout')) {
                    $reason = $isWaIncomplete ? 'Nomor WhatsApp Anda belum valid.' : 'Nama Anda masih menggunakan nama default.';
                    return redirect()->route('profile')->with('profile_incomplete', "PENTING: $reason Silakan lengkapi profil Anda (Nama & Nomor WhatsApp) terlebih dahulu untuk dapat menggunakan fitur aplikasi.");
                }
            }
        }

        return $next($request);
    }
}
