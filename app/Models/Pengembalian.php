<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    use HasFactory;

    protected $table = 'pengembalians';

    protected $fillable = ['nisn', 'tanggal_pinjam', 'tanggal_kembali'];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'nisn', 'nisn');
    }

    public function detailPengembalian()
    {
        return $this->hasMany(DetailPengembalian::class, 'id_pengembalian');
    }
}