<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as LaravelAuth;
use Symfony\Component\HttpFoundation\Response;

class Auth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!LaravelAuth::check()) {
            // Jika pengguna belum login, arahkan ke halaman login
            return redirect()->route('login');
        }

        $user = LaravelAuth::user();
        
        if ($user->role === 'Admin' || $user->role === 'Petugas') {
            // Jika pengguna adalah Admin atau Petugas, izinkan akses
            return $next($request);
        } elseif ($user->role === 'Siswa') {
            // Jika pengguna adalah Siswa, arahkan ke halaman home
            return redirect()->route('home');
        }

        // Jika role tidak dikenali, arahkan ke halaman login
        LaravelAuth::logout();
        return redirect()->route('login')->with('error', 'Unauthorized access.');
    }
}
