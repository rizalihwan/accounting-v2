<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTerimaBuysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('terima_buys', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('kode', 8);
            $table->unsignedBigInteger('pemasok_id');
            $table->unsignedBigInteger('pesanan_id')->nullable();
            $table->unsignedBigInteger('akun_id')->nullable();
            $table->bigInteger('total');
            $table->enum('status', [0, 1])->default(1);
            $table->foreign('pemasok_id')->references('id')->on('kontaks')->onDelete('cascade');
            $table->foreign('pesanan_id')->references('id')->on('pesanan_buys')->onDelete('cascade');
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
        Schema::dropIfExists('terima_buys');
    }
}
