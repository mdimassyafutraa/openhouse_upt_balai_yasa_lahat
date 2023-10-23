<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified;

class VerifyEmail
{
    public function handle($request, Closure $next)
    {
        // Periksa apakah pengguna telah diverifikasi emailnya
        if (!$request->user() || ($request->user() && !$request->user()->hasVerifiedEmail())) {
            // Jika belum diverifikasi, arahkan ke halaman verifikasi email
            return redirect()->route('verification.notice');
        }

        return $next($request);
    }
}
