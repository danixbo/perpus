<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';
    protected $primaryKey = 'kode_kelas';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $connection = 'mysql';

    protected $fillable = [
        'kode_kelas',
        'tingkat',
        'jurusan',
    ];

    public function siswas()
    {
        return $this->hasMany(Siswa::class, 'kode_kelas', 'kode_kelas');
    }
}