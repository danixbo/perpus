<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('siswas', function (Blueprint $table) {
            $table->string('nisn')->primary();
            $table->string('nama');
            $table->text('alamat');
            $table->string('no_telp');
            $table->string('kode_kelas');
            $table->string('username');
            $table->string('password');
            $table->enum('role', ['Siswa', 'Petugas', 'Admin'])->default('siswa');
            $table->timestamps();
            
            // Hapus baris ini
            // $table->foreign('kode_kelas')->references('kode_kelas')->on('kelas');
        });
    }

    public function down()
    {
        Schema::dropIfExists('siswas');
    }
};