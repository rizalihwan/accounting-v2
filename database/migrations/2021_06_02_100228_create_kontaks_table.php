<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKontaksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kontaks', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email');
            $table->string('telepon')->nullable();
            $table->boolean('pelanggan');
            $table->boolean('pemasok');
            $table->boolean('karyawan');
            $table->longText('alamat')->nullable();
            $table->string('kota')->nullable();
            $table->string('kode_pos')->nullable();
            $table->string('negara')->nullable();
            $table->boolean('setel_alamat_pengiriman');
            $table->string('kode_kontak');
            $table->string('mata_uang')->nullable();
            $table->string('nik')->nullable();
            $table->string('kontak_person')->nullable();
            $table->string('website')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kontaks');
    }
}
