<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;

class KategoriController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $query = Buku::latest();
        
        if ($search) {
            $query->where('judul', 'LIKE', "%{$search}%");
        }
        
        $books = $query->get();
        
        return view('pages.tampilan_awal.kategori', compact('books', 'search'));
    }
}
