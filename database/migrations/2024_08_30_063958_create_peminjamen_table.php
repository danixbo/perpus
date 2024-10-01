<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('peminjamen', function (Blueprint $table) {
            $table->id();
            $table->string('nisn');
            $table->date('tanggal_pinjam');
            $table->date('tanggal_kembali');
            $table->timestamps();

            $table->foreign('nisn')->references('nisn')->on('siswas');
        });
    }

    public function down()
    {
        Schema::dropIfExists('peminjamen');
    }
};