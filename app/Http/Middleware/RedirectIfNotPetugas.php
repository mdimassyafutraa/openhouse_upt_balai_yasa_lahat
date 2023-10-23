<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotPetugas
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && (Auth::user()->role != 0 && Auth::user()->role != 1)) {
            return back()->with('error', 'Anda tidak memiliki izin untuk mengakses halaman ini.');
        }

        return $next($request);
    }
}
