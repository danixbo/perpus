<?php

namespace App\Http\Controllers;

use App\Models\Buku;

class HomeController extends Controller
{
    public function index()
    {
        $books = Buku::latest()->paginate(8);
        return view('pages.tampilan_awal.home', compact('books'));
    }
}
