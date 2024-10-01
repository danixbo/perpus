<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Siswa extends Authenticatable
{
    use Notifiable;

    protected $table = 'siswas';
    protected $primaryKey = 'nisn';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nisn', 'nama', 'alamat', 'no_telp', 'kode_kelas', 'username', 'password', 'role'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}