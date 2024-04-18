<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class isGuest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            // Jika pengguna sudah terautentikasi, alihkan mereka ke rute dashboard
            return redirect()->route('dashboard')->with('notAllowed', 'You have logged in!');
        }

        // Jika pengguna belum terautentikasi, lanjutkan eksekusi ke middleware atau controller berikutnya
        return $next($request);
    }
}
