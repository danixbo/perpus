<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Siswa;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('pages.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        $siswa = Siswa::where('username', $credentials['username'])->first();

        if ($siswa && Auth::guard('web')->attempt($credentials)) {
            $request->session()->regenerate();

            if ($siswa->role === 'Admin' || $siswa->role === 'Petugas') {
                return redirect()->intended('dashboard');
            } elseif ($siswa->role === 'Siswa') {
                return redirect()->route('home');
            }
        }

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('username'));
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
