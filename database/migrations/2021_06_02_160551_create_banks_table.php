<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banks', function (Blueprint $table) {
            $table->id();
            $table->string('kode');
            $table->string('nama_bank');
            $table->longText('alamat')->nullable();
            $table->string('kota')->nullable();
            $table->string('telepon')->nullable();
            $table->string('fax')->nullable();
            $table->string('kontak')->nullable();
            $table->string('kontak_jabatan')->nullable();
            $table->string('catatan')->nullable();
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
        Schema::dropIfExists('banks');
    }
}
