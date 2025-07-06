<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporansTable extends Migration
{
    public function up()
    {
        Schema::create('laporans', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('jurusan');
            $table->string('judul');
            $table->string('kategori');
            $table->text('deskripsi');
            $table->string('lokasi');
            $table->json('bukti')->nullable();
            $table->string('hubungan');
            $table->string('identitas');
            $table->string('status')->default('Menunggu');
            $table->timestamp('tanggal_masuk')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('laporans');
    }
}
