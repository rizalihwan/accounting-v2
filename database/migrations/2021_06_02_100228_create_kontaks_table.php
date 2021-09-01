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
            $table->string('email')->nullable();
            $table->string('telepon')->nullable();
            $table->boolean('pelanggan')->default(false);
            $table->boolean('pemasok')->default(false);
            $table->boolean('karyawan')->default(false);
            $table->boolean('nasabah')->default(false);
            $table->boolean('petugas')->default(false);
            $table->longText('alamat')->nullable();
            $table->string('kota')->nullable();
            $table->string('kode_pos')->nullable();
            $table->string('kode_kontak')->nullable();
            $table->string('mata_uang')->nullable();
            $table->string('nik')->nullable();
            $table->string('kontak_person')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('website')->nullable();
            $table->boolean('aktif')->default(true);
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
