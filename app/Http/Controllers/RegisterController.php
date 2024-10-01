<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use App\Models\Kelas;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        $kelas = Kelas::all(); // Or however you want to query your classes
        return view('pages.register', compact('kelas'));
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'nisn' => 'required|string|max:12|unique:siswas,nisn',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_telp' => 'required|string|max:15',
            'kode_kelas' => 'required|string|max:10',
            'username' => 'required|string|max:255|unique:siswas,username',
            'password' => 'required|string|min:8',
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);
        $validatedData['role'] = 'Siswa'; // Set default role to 'Siswa'

        $siswa = Siswa::create($validatedData);

        // You can add additional logic here, such as logging in the student automatically

        return redirect()->route('login')->with('success', 'Pendaftaran berhasil. Silakan login.');
    }
}