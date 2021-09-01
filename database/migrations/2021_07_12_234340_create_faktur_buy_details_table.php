<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFakturBuyDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faktur_buy_details', function (Blueprint $table) {
            $table->unsignedBigInteger('faktur_id');
            $table->unsignedBigInteger('product_id');
            $table->string('satuan');
            $table->bigInteger('harga');
            $table->bigInteger('jumlah');
            $table->bigInteger('total');
            $table->foreign('faktur_id')->references('id')->on('faktur_buys')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faktur_buy_details');
    }
}
