<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $table = 'bukus';
    protected $primaryKey = 'kode_buku';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['kode_buku', 'judul', 'penerbit', 'tahun_terbit', 'deskripsi', 'foto'];

    public function detailPeminjaman()
    {
        return $this->hasMany(DetailPeminjaman::class, 'kode_buku', 'kode_buku');
    }

    public function detailPengembalian()
    {
        return $this->hasMany(DetailPengembalian::class, 'kode_buku', 'kode_buku');
    }

    
}