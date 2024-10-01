<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\Auth;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\PengembalianController;
use App\Http\Middleware\Auth as AuthMiddleware;

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

Route::get('/halaman_buku/{kode_buku}', [BukuController::class, 'show'])->name('halaman_buku');

// <------------------------ Akhir Tampilan User ------------------------>

// <------------------------ Awal Dashboard ------------------------>

Route::middleware(['auth', 'dashboard.access'])->prefix('dashboard')->group(function () {
    // Route dashboard di sini
    Route::get('/', [DashboardController::class, 'index'])->name('pages.dashboard');

    // Siswa routes
    Route::get('/siswa', [SiswaController::class, 'index'])->name('pages.siswa.index');
    Route::get('/tambah/siswa', [SiswaController::class, 'create'])->name('pages.siswa.tambah');
    Route::post('/tambah/siswa', [SiswaController::class, 'store'])->name('pages.siswa.store');
    Route::get('/siswa/{siswa}/edit', [SiswaController::class, 'edit'])->name('pages.siswa.edit');
    Route::post('/siswa/{siswa}', [SiswaController::class, 'update'])->name('pages.siswa.update');
    Route::delete('/siswa/{siswa}', [SiswaController::class, 'destroy'])->name('pages.siswa.hapus');

    // Buku routes
    Route::get('/buku', [BukuController::class, 'index'])->name('pages.buku.index');
    Route::get('/tambah/buku', [BukuController::class, 'create'])->name('pages.buku.tambah');
    Route::post('/tambah/buku', [BukuController::class, 'store'])->name('pages.buku.store');
    Route::get('/edit/buku/{kode_buku}', [BukuController::class, 'edit'])->name('pages.buku.edit');
    Route::put('/buku/{kode_buku}', [BukuController::class, 'update'])->name('pages.buku.update');
    Route::delete('/hapus/buku/{kode_buku}', [BukuController::class, 'destroy'])->name('pages.buku.hapus');

    // Peminjaman routes
    Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('pages.peminjaman.index');
    Route::get('/tambah/peminjaman', [PeminjamanController::class, 'create'])->name('pages.peminjaman.tambah');
    Route::post('/tambah/peminjaman', [PeminjamanController::class, 'store'])->name('pages.peminjaman.store');
    Route::get('/peminjaman/{id}/edit', [PeminjamanController::class, 'edit'])->name('pages.peminjaman.edit');
    Route::put('/peminjaman/{id}', [PeminjamanController::class, 'update'])->name('pages.peminjaman.update');
    Route::delete('/peminjaman/{id}', [PeminjamanController::class, 'destroy'])->name('pages.peminjaman.hapus');
    Route::get('/peminjaman/{id}/detail', [PeminjamanController::class, 'show'])->name('pages.peminjaman.detail');
    Route::get('/peminjaman/{id}', [PeminjamanController::class, 'show'])->name('pages.peminjaman.show');
    Route::post('/peminjaman/{id_peminjaman}/selesai', [PeminjamanController::class, 'selesai'])->name('pages.peminjaman.selesai');

    // Pengembalian routes
    Route::get('/pengembalian', [PengembalianController::class, 'index'])->name('pages.pengembalian.index');
    Route::get('/tambah/pengembalian', [PengembalianController::class, 'create'])->name('pages.pengembalian.tambah');
    Route::get('/edit/pengembalian', [PengembalianController::class, 'edit'])->name('pages.pengembalian.edit');
    Route::get('/hapus/pengembalian', [PengembalianController::class, 'destroy'])->name('pages.pengembalian.hapus');

    // Tambahan routes yang ada di dalam grup dashboard
    Route::get('/siswa/{nisn}', [SiswaController::class, 'getSiswaByNisn'])->name('siswa.getByNisn');
    Route::get('/buku/{kode_buku}', [BukuController::class, 'getBukuByKode'])->name('buku.getByKode');
    Route::post('/peminjaman/{id}/selesai', [PeminjamanController::class, 'selesai'])->name('peminjaman.selesai');
});

// <------------------------ Akhir Dashboard ------------------------>

Route::fallback(function () {
    return 'Route tidak ditemukan. URL: ' . request()->url();
});