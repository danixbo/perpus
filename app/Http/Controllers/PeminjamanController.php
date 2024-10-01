<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Auth;
use App\Models\Peminjaman;
use App\Models\DetailPeminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Routing\Controller;
use App\Models\Pengembalian;
use App\Models\DetailPengembalian;
use Illuminate\Support\Facades\Log;

class PeminjamanController extends Controller
{
    public function __construct()
    {
        $this->middleware(Auth::class);
    }

    public function index()
    {
        $peminjaman = Peminjaman::with('siswa')->get();
        return view('pages.peminjaman.peminjaman', compact('peminjaman'));
    }

    public function create()
    {
        return view('pages.peminjaman.tambahPeminjaman');
    }

    public function edit($id)
    {
        $peminjaman = Peminjaman::with(['siswa', 'detailPeminjaman.buku'])->findOrFail($id);
        return view('pages.peminjaman.editPeminjaman', compact('peminjaman'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nisn' => 'required',
            'tanggal_pinjam' => 'required|date',
            'buku_list' => 'required|array',
            'buku_list.*.kode_buku' => 'required',
            'buku_list.*.jumlah' => 'required|integer|min:1',
        ]);

        try {
            DB::beginTransaction();

            $tanggalKembali = Carbon::now()->addDays(7);

            $peminjaman = Peminjaman::create([
                'nisn' => $request->nisn,
                'tanggal_pinjam' => $request->tanggal_pinjam,
                'tanggal_kembali' => $tanggalKembali,
            ]);

            foreach ($request->buku_list as $buku) {
                DetailPeminjaman::create([
                    'id_peminjaman' => $peminjaman->id,
                    'kode_buku' => $buku['kode_buku'],
                    'jumlah' => $buku['jumlah'],
                ]);
            }

            DB::commit();
            return response()->json(['message' => 'Peminjaman berhasil disimpan'], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Gagal menyimpan peminjaman: ' . $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date',
            'buku_list' => 'required|array',
            'buku_list.*.kode_buku' => 'required',
            'buku_list.*.jumlah' => 'required|integer|min:1',
        ]);
    
        try {
            DB::beginTransaction();
    
            $peminjaman = Peminjaman::findOrFail($id);
            $peminjaman->update([
                'tanggal_pinjam' => $request->tanggal_pinjam,
                'tanggal_kembali' => $request->tanggal_kembali,
            ]);
    
            $peminjaman->detailPeminjaman()->delete();
    
            foreach ($request->buku_list as $buku) {
                DetailPeminjaman::create([
                    'id_peminjaman' => $peminjaman->id,
                    'kode_buku' => $buku['kode_buku'],
                    'jumlah' => $buku['jumlah'],
                ]);
            }
    
            DB::commit();
            return response()->json(['message' => 'Peminjaman berhasil diperbarui'], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Gagal memperbarui peminjaman: ' . $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $peminjaman = Peminjaman::findOrFail($id);
            $peminjaman->detailPeminjaman()->delete();
            $peminjaman->delete();
            DB::commit();
            return response()->json(['message' => 'Peminjaman berhasil dihapus'], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Gagal menghapus peminjaman: ' . $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        $peminjaman = Peminjaman::with(['detailPeminjaman.buku', 'siswa'])->findOrFail($id);
        return view('pages.peminjaman.detailPeminjaman', compact('peminjaman'));
    }

    public function selesai(Request $request, $id_peminjaman)
    {
        Log::info('Selesai method called for peminjaman ID: ' . $id_peminjaman);
        Log::info('Request data: ', $request->all());

        $pengembalian = Pengembalian::create([
            'nis' => $request->nis,
            'tanggal_kembali' => $request->tanggal_kembali,
        ]);

        $id_pengembalian = $pengembalian->id;

        for ($i = 0; $i < count($request->kode_buku); $i++) {
            DetailPengembalian::create([
                'kode_buku' => $request->kode_buku[$i],
                'id_pengembalian' => $id_pengembalian,
                'jumlah' => $request->jumlah[$i]
            ]);
        }

        $selectedBooks = $request->input('selected_books', []);
        Log::info('Selected books: ', $selectedBooks);

        DetailPeminjaman::where('id_peminjaman', $id_peminjaman)
            ->whereIn('kode_buku', $selectedBooks)
            ->delete();

        $remainingDetails = DetailPeminjaman::where('id_peminjaman', $id_peminjaman)->count();
        Log::info('Remaining details: ' . $remainingDetails);

        if ($remainingDetails == 0) {
            Peminjaman::where('id', $id_peminjaman)->delete();
        }

        return redirect()->route('pages.peminjaman.index')->with('success', 'Buku berhasil dikembalikan.');
    }
}
