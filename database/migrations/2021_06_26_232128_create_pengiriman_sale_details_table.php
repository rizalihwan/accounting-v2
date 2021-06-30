<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengirimanSaleDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengiriman_sale_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pengiriman_id');
            $table->unsignedBigInteger('product_id');
            $table->string('satuan');
            $table->bigInteger('harga');
            $table->bigInteger('jumlah');
            $table->bigInteger('total');
            $table->foreign('pengiriman_id')->references('id')->on('pengiriman_sales')->onDelete('cascade');
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
        Schema::dropIfExists('pengiriman_sale_details');
    }
}
