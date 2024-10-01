<?php

namespace App\Http\Controllers;
use App\Models\Siswa;
use App\Models\Buku;
use App\Models\DetailPeminjaman;
use App\Models\Peminjaman;
use App\Models\Kelas;
use App\Models\DetailPengembalian;
use App\Models\Pengembalian;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $peminjaman_hari_ini = Peminjaman::whereDate('created_at', Carbon::today())->count();
        $siswa = Siswa::count();
        $buku = Buku::count();
        return view('pages.dashboard', compact('siswa', 'buku', 'peminjaman_hari_ini'));
    }


    // <------------------------ Awal Dashboard Siswa ------------------------>

    public function data()
    {
        $siswa = Siswa::all();
        return view('pages.siswa.siswa', compact('siswa'));
    }

    // <------------------------ Akhir Dashboard Siswa ------------------------>

    // <------------------------ Awal Dashboard Pengembalian ------------------------>

    public function dataPengembalian()
    {
        $pengembalian = Pengembalian::all();
        Log::info('Jumlah data pengembalian: ' . $pengembalian->count());
        return view('pages.pengembalian.pengembalian', compact('pengembalian'));
    }

    // <------------------------ Akhir Dashboard Pengembalian ------------------------>

    // <------------------------ Awal Dashboard Peminjaman ------------------------>

    public function dataPeminjaman()
    {
        $peminjaman = Peminjaman::with('siswa')->get();
        return view('pages.peminjaman.peminjaman', compact('peminjaman'));
    }

    public function editPeminjaman($id)
    {
        $peminjaman = Peminjaman::with(['siswa', 'detailPeminjaman.buku'])->findOrFail($id);
        return view('pages.peminjaman.editPeminjaman', compact('peminjaman'));
    }
    
    public function storePeminjaman(Request $request)
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

    public function updatePeminjaman(Request $request, $id)
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
    
            // Hapus detail peminjaman yang lama
            $peminjaman->detailPeminjaman()->delete();
    
            // Buat detail peminjaman yang baru
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

    public function hapusPeminjaman($id)
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

    public function detailPeminjaman($id)
    {
        $peminjaman = Peminjaman::with(['siswa', 'detailPeminjaman.buku'])->findOrFail($id);
        return view('pages.peminjaman.detailPeminjaman', compact('peminjaman'));
    }

    public function selesai($id)
    {
        try {
            DB::beginTransaction();

            $peminjaman = Peminjaman::findOrFail($id);
            
            // Create a new Pengembalian record
            $pengembalian = new Pengembalian();
            $pengembalian->nisn = $peminjaman->nisn;
            $pengembalian->tanggal_kembali = now();
            $pengembalian->save();

            // Update the peminjaman status
            $peminjaman->status = 'selesai';
            $peminjaman->save();

            DB::commit();
            return redirect()->route('pages.peminjaman.index')->with('success', 'Peminjaman berhasil diselesaikan dan data pengembalian telah ditambahkan');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error dalam fungsi selesai: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // <------------------------ Akhir Dashboard Peminjaman ------------------------>

    // <------------------------ Awal Dashboard Buku ------------------------>



    // <------------------------ Akhir Dashboard Buku ------------------------>

    // <------------------------ Awal Dashboard User ------------------------>

    public function tambahSiswa()
    {
        $kelas = Kelas::all();
        return view('pages.siswa.tambahSiswa', compact('kelas'));
    }

    public function prosesTBSiswa(Request $request)
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

    public function editSiswa(Siswa $siswa)
    {
        $kelas = Kelas::all();
        return view('pages.siswa.editSiswa', compact('siswa', 'kelas'));
    }

    public function prosesUPDSiswa(Request $request, $nisn)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required|numeric',
            'kode_kelas' => 'required|exists:kelas,kode_kelas',
            'username' => 'required|unique:siswas,username,'.$nisn.',nisn',
            'password' => 'nullable|min:8',
            'role' => 'required',
        ]);
    
        $siswa = Siswa::findOrFail($nisn);
        $data = $request->except('password');
        
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }
    
        $siswa->update($data);
    
        return redirect()->route('pages.siswa.index')->with('success', 'Data siswa berhasil diperbarui!');
    }

    public function hapusSiswa($nisn)
    {
        $siswa = Siswa::findOrFail($nisn);
        $siswa->delete();

        return redirect()->route('pages.siswa.index')->with('success', 'Data siswa berhasil dihapus!');
    }

    public function getSiswaByNisn(Request $request, $nisn)
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

    // <------------------------ Akhir Dashboard User ------------------------>
}