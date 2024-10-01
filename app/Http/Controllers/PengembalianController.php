<?php

namespace App\Http\Controllers;

use App\Models\Pengembalian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Routing\Controller;

class PengembalianController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $pengembalian = Pengembalian::all();
        Log::info('Jumlah data pengembalian: ' . $pengembalian->count());
        return view('pages.pengembalian.pengembalian', compact('pengembalian'));
    }

}
