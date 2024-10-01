<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{

    public function index()
    {
        $bukus = Buku::all();
        return view('pages.buku.buku', compact('bukus'));
    }

    public function show($kode_buku)
    {
        $book = Buku::where('kode_buku', $kode_buku)->firstOrFail();
        return view('pages.tampilan_awal.halaman_buku', compact('book'));
    }


    public function create()
    {
        return view('pages.buku.tambahBuku');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
               'kode_buku' => 'required|unique:bukus,kode_buku',
               'judul' => 'required',
               'penerbit' => 'required',
               'tahun_terbit' => 'required|numeric',
               'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
               'deskripsi' => 'required',
            ], [
                'kode_buku.required' => 'Kode buku harus diisi',
                'kode_buku.unique' => 'Kode buku sudah digunakan',
                'judul.required' => 'Judul buku harus diisi',
                'penerbit.required' => 'Penerbit harus diisi',
                'tahun_terbit.required' => 'Tahun terbit harus diisi',
                'tahun_terbit.numeric' => 'Tahun terbit harus berupa angka',
                'foto.required' => 'Foto harus diisi',
                'foto.image' => 'Foto harus berupa gambar',
                'foto.mimes' => 'Foto harus berupa gambar dengan format jpeg, png, jpg, atau gif',
                'foto.max' => 'Foto harus berukuran maksimal 2MB',
                'deskripsi.required' => 'Deskripsi harus diisi',
            ]);

            $buku = new Buku();
            $buku->kode_buku = $request->kode_buku;
            $buku->judul = $request->judul;
            $buku->penerbit = $request->penerbit;
            $buku->tahun_terbit = $request->tahun_terbit;
            $buku->deskripsi = $request->deskripsi;
            $buku->total_favorit = 0; // Inisialisasi total_favorit dengan 0

            if ($request->hasFile('foto')) {
                $foto = $request->file('foto');
                $fotoName = time().'.'.$foto->getClientOriginalExtension();
                $foto->move(public_path('gambar'), $fotoName);
                $buku->foto = 'gambar/' . $fotoName;
            }

            $buku->save();

            return redirect()->route('pages.buku.index')->with('success', 'Buku berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->route('pages.buku.tambah')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function edit($kode_buku)
    {
        $buku = Buku::where('kode_buku', $kode_buku)->firstOrFail();
        return view('pages.buku.editBuku', compact(var_name: 'buku'));
    }

    public function update(Request $request, $kode_buku)
    {
        $request->validate([
           'judul' => 'required',
           'penerbit' => 'required',
           'tahun_terbit' => 'required|numeric',
           'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
           'deskripsi' => 'required',
        ], [
            'judul.required' => 'Judul buku harus diisi',
            'penerbit.required' => 'Penerbit harus diisi',
            'tahun_terbit.required' => 'Tahun terbit harus diisi',
            'tahun_terbit.numeric' => 'Tahun terbit harus berupa angka',
            'foto.image' => 'Foto harus berupa gambar',
            'foto.mimes' => 'Foto harus berupa gambar dengan format jpeg, png, jpg, atau gif',
            'foto.max' => 'Foto harus berukuran maksimal 2MB',
            'deskripsi.required' => 'Deskripsi harus diisi',
        ]);

        $buku = Buku::where('kode_buku', $kode_buku)->firstOrFail();
        $buku->judul = $request->judul;
        $buku->penerbit = $request->penerbit;
        $buku->tahun_terbit = $request->tahun_terbit;
        $buku->deskripsi = $request->deskripsi;

        if ($request->hasFile('foto')) {
            if ($buku->foto) {
                Storage::delete('public/' . $buku->foto);
            }

            $foto = $request->file('foto');
            $fotoName = time().'.'.$foto->getClientOriginalExtension();
            $fotoPath = $foto->storeAs('public/books', $fotoName);
            $buku->foto = 'books/' . $fotoName;
        }

        $buku->save();
        return redirect()->route('pages.buku.index')->with('success', 'Buku berhasil diperbarui');
    }

    public function destroy($kode_buku)
    {
        $buku = Buku::where('kode_buku', $kode_buku)->firstOrFail();
        
        if ($buku->foto && file_exists(public_path($buku->foto))) {
            unlink(public_path($buku->foto));
        }

        $buku->delete();

        return redirect()->route('pages.buku.index')->with('success', 'Buku berhasil dihapus');
    }

    public function getBukuByKode(Request $request, $kode_buku)
    {
        $buku = Buku::where('kode_buku', $kode_buku)->first();
        if ($buku) {
            return response()->json([
                'judul' => $buku->judul,
                'penerbit' => $buku->penerbit,
                'tahun_terbit' => $buku->tahun_terbit
            ]);
        }
        return response()->json(['error' => 'Buku tidak ditemukan'], 404);
    }
}
