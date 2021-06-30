<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenawaranBuyDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penawaran_buy_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('penawaran_id');
            $table->unsignedBigInteger('product_id')->nullable();
            $table->unsignedBigInteger('akun_id')->nullable();
            $table->integer('service_desk')->nullable();
            $table->integer('jumlah');
            $table->integer('satuan');
            $table->integer('harga_satuan');
            $table->integer('total');
            $table->foreign('penawaran_id')->references('id')->on('penawaran_buys')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
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
        Schema::dropIfExists('penawaran_buy_details');
    }
}
