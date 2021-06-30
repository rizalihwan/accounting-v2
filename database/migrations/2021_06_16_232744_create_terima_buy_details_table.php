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
            $table->unsignedBigInteger('product_id')->nullable();
            $table->unsignedBigInteger('akun_id')->nullable();
            $table->integer('service_desk')->nullable();
            $table->integer('jumlah');
            $table->integer('satuan');
            $table->integer('harga_satuan');
            $table->integer('total');
            $table->foreign('terima_id')->references('id')->on('terima_buys')->onDelete('cascade');
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
        Schema::dropIfExists('terima_buy_details');
    }
}
