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
            $table->unsignedBigInteger('product_id');
            $table->integer('jumlah');
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
        Schema::dropIfExists('penawaran_buy_details');
    }
}
