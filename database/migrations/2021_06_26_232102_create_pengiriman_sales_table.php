<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengirimanSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengiriman_sales', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('kode', 8);
            $table->unsignedBigInteger('pelanggan_id');
            $table->unsignedBigInteger('pesanan_id')->nullable();
            $table->unsignedBigInteger('akun_id')->nullable();
            $table->bigInteger('total');
            $table->enum('status', [0, 1])->default(1);
            $table->foreign('pelanggan_id')->references('id')->on('kontaks')->onDelete('cascade');
            $table->foreign('pesanan_id')->references('id')->on('pesanan_sales')->onDelete('cascade');
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
        Schema::dropIfExists('pengiriman_sales');
    }
}
