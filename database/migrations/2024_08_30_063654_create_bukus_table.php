<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('bukus', function (Blueprint $table) {
            $table->string('kode_buku')->primary();
            $table->string('judul');
            $table->string('foto');
            $table->text('deskripsi');
            $table->string('penerbit');
            $table->integer('total_favorit');
            $table->year('tahun_terbit');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bukus');
    }
};