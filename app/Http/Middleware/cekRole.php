<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class cekRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Pastikan pengguna sudah terautentikasi
        if (!Auth::check()) {
            return redirect()->route('auth');
        }
        
        // Periksa apakah pengguna memiliki peran yang diizinkan
        if (in_array($request->user()->role, $roles)) {
            return $next($request);
        }

        // Jika tidak, alihkan mereka ke rute error atau rute yang sesuai
        return redirect()->route('error');
    }
}
