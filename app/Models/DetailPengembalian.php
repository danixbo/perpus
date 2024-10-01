<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class DetailPengembalian extends Model
{
    use HasFactory;

    protected $table = 'detail_pengembalians';

    protected $fillable = ['id_pengembalian', 'kode_buku', 'jumlah'];

    public function pengembalian()
    {
        return $this->belongsTo(Pengembalian::class, 'id_pengembalian');
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'kode_buku', 'kode_buku');
    }

    public function isValid()
    {
        $rules = [
            'id_pengembalian' => 'required|exists:pengembalians,id',
            'kode_buku' => 'required|exists:buku,kode_buku',
            'jumlah' => 'required|integer|min:1',
        ];

        $validator = Validator::make($this->attributes, $rules);

        if ($validator->fails()) {
            $this->errors = $validator->errors();
            return false;
        }

        return true;
    }

    public function errors()
    {
        return $this->errors;
    }
}