<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTerimaBuyDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('terima_buy_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('terima_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('jumlah');
            $table->foreign('terima_id')->references('id')->on('terima_buys')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
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
        Schema::dropIfExists('terima_buy_details');
    }
}
