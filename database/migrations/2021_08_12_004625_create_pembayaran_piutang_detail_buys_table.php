<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembayaranPiutangDetailBuysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayaran_piutang_detail_buys', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pembayaran_piutang_buy_id');
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
        Schema::dropIfExists('pembayaran_piutang_detail_buys');
    }
}
