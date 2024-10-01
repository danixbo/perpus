<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('detail_pengembalians', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pengembalian');
            $table->string('kode_buku');
            $table->integer('jumlah');
            $table->timestamps();

            $table->foreign('id_pengembalian')->references('id')->on('pengembalians');
            $table->foreign('kode_buku')->references('kode_buku')->on('bukus');
        });
    }

    public function down()
    {
        Schema::dropIfExists('detail_pengembalians');
    }
};