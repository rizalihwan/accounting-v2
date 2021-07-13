<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesananBuysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesanan_buys', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('kode', 8);
            $table->unsignedBigInteger('pemasok_id');
            $table->unsignedBigInteger('penawaran_id')->nullable();
            $table->unsignedBigInteger('akun_id')->nullable();
            $table->bigInteger('total');
            $table->enum('status', [0, 1])->default(1);
            $table->foreign('pemasok_id')->references('id')->on('kontaks')->onDelete('cascade');
            $table->foreign('penawaran_id')->references('id')->on('penawaran_buys')->onDelete('cascade');
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
        Schema::dropIfExists('pesanan_buys');
    }
}
