<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $siswa = Siswa::all();
        return view('pages.siswa.siswa', compact('siswa'));
    }

    public function create()
    {
        $kelas = Kelas::all();
        return view('pages.siswa.tambahSiswa', compact('kelas'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nisn' => 'required|unique:siswas,nisn',
            'nama' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required|numeric',
            'kode_kelas' => 'required',
            'username' => 'required|unique:siswas,username',
            'password' => 'required|min:8',
            'role' => 'required',
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);

        Siswa::create($validatedData);

        return redirect()->route('pages.siswa.index')->with('success', 'Data siswa berhasil ditambahkan!');
    }

    public function edit(Siswa $siswa)
    {
        $kelas = Kelas::all();
        return view('pages.siswa.editSiswa', compact('siswa', 'kelas'));
    }

    public function update(Request $request, $nisn)
    {
        $request->validate([
            'current_password' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
            'role' => 'required',
            'kode_kelas' => 'required',
            'username' => 'required|unique:siswas,username,' . $nisn . ',nisn',
            'password' => 'nullable|min:6',
        ]);

        $siswa = Siswa::findOrFail($nisn);

        // Verifikasi password saat ini
        if (!Hash::check($request->current_password, $siswa->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini tidak cocok.'])->withInput();
        }

        $siswa->nama = $request->nama;
        $siswa->alamat = $request->alamat;
        $siswa->no_telp = $request->no_telp;
        $siswa->role = $request->role;
        $siswa->kode_kelas = $request->kode_kelas;
        $siswa->username = $request->username;

        if ($request->filled('password')) {
            $siswa->password = Hash::make($request->password);
        }

        $siswa->save();

        return redirect()->route('pages.siswa.index')->with('success', 'Data siswa berhasil diperbarui!');
    }

    public function destroy($nisn)
    {
        $siswa = Siswa::findOrFail($nisn);
        
        $hasPeminjaman = Peminjaman::where('nisn', $nisn)->exists();
        
        if ($hasPeminjaman) {
            return redirect()->route('pages.siswa.index')->with('error', 'Tidak dapat menghapus siswa karena masih memiliki peminjaman aktif.');
        }
        
        try {
            $siswa->delete();
            return redirect()->route('pages.siswa.index')->with('success', 'Data siswa berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('pages.siswa.index')->with('error', 'Gagal menghapus siswa. Error: ' . $e->getMessage());
        }
    }

    public function getSiswaByNisn($nisn)
    {
        $siswa = Siswa::where('nisn', $nisn)->first();
        if ($siswa) {
            return response()->json([
                'nama' => $siswa->nama,
                'kode_kelas' => $siswa->kode_kelas
            ]);
        }
        return response()->json(['error' => 'Siswa tidak ditemukan'], 404);
    }
}
