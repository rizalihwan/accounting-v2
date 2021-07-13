<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFakturBuysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faktur_buys', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('kode', 8);
            $table->unsignedBigInteger('pemasok_id');
            $table->unsignedBigInteger('terima_id')->nullable();
            $table->unsignedBigInteger('akun_id')->nullable();
            $table->bigInteger('total');
            $table->enum('status', [0, 1])->default(1);
            $table->foreign('pemasok_id')->references('id')->on('kontaks')->onDelete('cascade');
            $table->foreign('terima_id')->references('id')->on('terima_buys')->onDelete('cascade');
            $table->foreign('akun_id')->references('id')->on('akuns')->onDelete('cascade');
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
        Schema::dropIfExists('faktur_buys');
    }
}
