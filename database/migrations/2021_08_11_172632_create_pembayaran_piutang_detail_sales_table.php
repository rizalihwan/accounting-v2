<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembayaranPiutangDetailSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayaran_piutang_detail_sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pembayaran_piutang_sale_id');
            $table->unsignedBigInteger('faktur_id');
            $table->bigInteger('bayar');
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
        Schema::dropIfExists('pembayaran_piutang_detail_sales');
    }
}
