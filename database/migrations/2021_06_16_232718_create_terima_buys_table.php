<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTerimaBuysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('terima_buys', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pemasok_id');
            $table->unsignedBigInteger('no_pesanan');
            $table->date('tanggal');
            $table->text('desc');
            $table->integer('total')->nullable();
            $table->enum('status', [0, 1])->default(1);
            $table->foreign('pemasok_id')->references('id')->on('kontaks')->onDelete('cascade');
            $table->foreign('no_pesanan')->references('id')->on('pesanan_buys')->onDelete('cascade');
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
        Schema::dropIfExists('terima_buys');
    }
}
