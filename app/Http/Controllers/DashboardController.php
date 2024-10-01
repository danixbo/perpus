<?php

namespace App\Http\Controllers;
use App\Models\Siswa;
use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
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
}