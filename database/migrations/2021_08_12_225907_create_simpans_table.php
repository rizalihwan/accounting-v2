<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSimpansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('simpans', function (Blueprint $table) {
            $table->id();
            $table->longText('keterangan');
            $table->foreignId('kontak_id')->references('id')->on('kontaks')->onDelete('cascade');
            $table->string('jenis_simpanan'); //belum fix
            $table->string('no_rekening');
            $table->string('administrasi');
            $table->string('setoran');
            $table->string('petugas');
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
        Schema::dropIfExists('simpans');
    }
}
