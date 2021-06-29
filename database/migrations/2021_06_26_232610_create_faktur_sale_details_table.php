<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFakturSaleDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faktur_sale_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('faktur_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('harga');
            $table->integer('jumlah');
            $table->foreign('faktur_id')->references('id')->on('faktur_sales')->onDelete('cascade');
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
        Schema::dropIfExists('faktur_sale_details');
    }
}
