<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePinjamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pinjams', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('jumlah_pinjaman');
            $table->integer('jangka');
            $table->integer('bungapersen');
            $table->enum('type', ['Anuitas','Flat']);
            $table->integer('total_bunga');
            $table->integer('total_pokok');
            $table->text('keterangan');
            $table->foreignId('kontak_id')->constrained('kontaks');
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
        Schema::dropIfExists('pinjams');
    }
}
