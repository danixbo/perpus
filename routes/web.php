<?php

// name() =  memberi nama unik pada setiap route dan juga memudahkan dalam pemanggilan route tanpa ada kendala atau error

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\Auth;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PeminjamanController;

// Mendaftarkan middleware
Route::aliasMiddleware('auth', Auth::class);

Route::get('/layout-dashboard', function () {
    return view('layout.layout-dashboard');
})->name('layout.dashboard');

Route::get('/layout-home', function () {
    return view('layout.layout-home');
})->name('layout.home');


// <------------------------ Awal Tampilan User ------------------------>

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Routes untuk tampilan buku di halaman awal
Route::get('/halaman_buku', [BukuController::class, 'index'])->name('buku');
Route::get('/halaman_buku/{kode_buku}', [BukuController::class, 'show'])->name('halaman_buku');

// <------------------------ Akhir Tampilan User ------------------------>


// <------------------------ Awal Dashboard ------------------------>

Route::middleware(['auth'])->group(function () {
    Route::prefix('dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('pages.dashboard');
        Route::get('/siswa', [DashboardController::class, 'data'])->name('pages.siswa.index');
        Route::get('/buku', [BukuController::class, 'index'])->name('pages.buku.index');
        Route::get('/peminjaman', [DashboardController::class, 'dataPeminjaman'])->name('pages.peminjaman.index');
        Route::get('/pengembalian', [DashboardController::class, 'dataPengembalian'])->name('pages.pengembalian.index');

        // Dashboard User
        Route::get('/tambah/siswa', [DashboardController::class, 'tambahSiswa'])->name('pages.siswa.tambah');
        Route::post('/tambah/siswa', [DashboardController::class, 'prosesTBSiswa'])->name('pages.siswa.tambah');
        Route::get('/siswa/{siswa}/edit', [DashboardController::class, 'editSiswa'])->name('pages.siswa.edit');
        Route::post('/siswa/{siswa}', [DashboardController::class, 'prosesUPDSiswa'])->name('pages.siswa.update');
        Route::delete('/siswa/{siswa}', [DashboardController::class, 'hapusSiswa'])->name('pages.siswa.hapus');

        // Dashboard Buku
        Route::get('/tambah/buku', [BukuController::class, 'create'])->name('pages.buku.tambah');
        Route::post('/tambah/buku', [BukuController::class, 'store'])->name('pages.buku.store');
        Route::get('/edit/buku/{kode_buku}', [BukuController::class, 'edit'])->name('pages.buku.edit');
        Route::put('/edit/buku/{kode_buku}', [BukuController::class, 'update'])->name('pages.buku.update');
        Route::delete('/hapus/buku/{kode_buku}', [BukuController::class, 'destroy'])->name('pages.buku.hapus');

        // Dashboard Peminjaman
        Route::get('/tambah/peminjaman', function () {
            return view('pages.peminjaman.tambahPeminjaman');
        })->name('pages.peminjaman.tambah');
        Route::get('/edit/peminjaman', function () {
            return view('pages.peminjaman.editPeminjaman');
        })->name('pages.peminjaman.edit');
        Route::get('/hapus/peminjaman', function () {
            return view('pages.peminjaman.hapusPeminjaman');
        })->name('pages.peminjaman.hapus');

        // Dashboard Pengembalian
        Route::get('/tambah/pengembalian', function () {
            return view('pages.pengembalian.tambahPengembalian');
        })->name('pages.pengembalian.tambah');
        Route::get('/edit/pengembalian', function () {
            return view('pages.pengembalian.editPengembalian');
        })->name('pages.pengembalian.edit');
        Route::get('/hapus/pengembalian', function () {
            return view('pages.pengembalian.hapusPengembalian');
        })->name('pages.pengembalian.hapus');
    });

    // Added routes to the auth middleware group
    Route::get('/siswa/{nisn}', [DashboardController::class, 'getSiswaByNisn'])->name('siswa.getByNisn');
    Route::get('/buku/{kode_buku}', [BukuController::class, 'getBukuByKode'])->name('buku.getByKode');

    Route::post('/peminjaman/store', [DashboardController::class, 'storePeminjaman'])->name('peminjaman.store');

    Route::get('/peminjaman/{id}/detail', [DashboardController::class, 'detailPeminjaman'])->name('pages.peminjaman.detail');
    Route::get('/peminjaman/{id}/edit', [DashboardController::class, 'editPeminjaman'])->name('pages.peminjaman.edit');
    Route::put('/peminjaman/{id}', [DashboardController::class, 'updatePeminjaman'])->name('pages.peminjaman.update');
    Route::delete('/peminjaman/{id}', [DashboardController::class, 'hapusPeminjaman'])->name('pages.peminjaman.hapus');
    Route::post('/peminjaman/{id}/selesai', [DashboardController::class, 'selesai'])->name('peminjaman.selesai');
});

// <------------------------ Akhir Dashboard ------------------------>



// <------------------------ Awal Tampilan Buku ------------------------>

// Hapus atau komentari bagian ini karena sudah dipindahkan ke atas
// Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
// Route::post('/register', [RegisterController::class, 'register']);

// Route::get('/buku', function () {
//     return view('pages.tampilan_awal.halaman_buku');
// })->name('buku');

// Route::get('/buku/{kode_buku}', [BukuController::class, 'show'])->name('halaman_buku');

// Route::get('/siswa/{nisn}', [DashboardController::class, 'getSiswaByNisn'])->name('siswa.getByNisn');
// Route::get('/buku/{kode_buku}', [BukuController::class, 'getBukuByKode'])->name('buku.getByKode');

// Route::post('/peminjaman/store', [DashboardController::class, 'storePeminjaman'])->name('peminjaman.store');

// Route::get('/peminjaman/{id}/detail', [DashboardController::class, 'detailPeminjaman'])->name('pages.peminjaman.detail');
// Route::get('/peminjaman/{id}/edit', [DashboardController::class, 'editPeminjaman'])->name('pages.peminjaman.edit');
// Route::put('/peminjaman/{id}', [DashboardController::class, 'updatePeminjaman'])->name('pages.peminjaman.update');
// Route::delete('/peminjaman/{id}', [DashboardController::class, 'hapusPeminjaman'])->name('pages.peminjaman.hapus');
