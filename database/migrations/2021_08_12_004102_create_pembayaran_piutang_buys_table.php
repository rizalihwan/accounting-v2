<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembayaranPiutangBuysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayaran_piutang_buys', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('kode', 8);
            $table->bigInteger('total');
            $table->unsignedBigInteger('pemasok_id');
            $table->unsignedBigInteger('akun_id');
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
        Schema::dropIfExists('pembayaran_piutang_buys');
    }
}
