<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePiutangBuysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('piutang_buys', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pemasok_id');
            $table->unsignedBigInteger('faktur_id');
            $table->bigInteger('total_hutang');
            $table->bigInteger('lunas')->nullable();
            $table->bigInteger('sisa')->nullable();
            $table->enum('status', ['0', '1']);
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
        Schema::dropIfExists('piutang_buys');
    }
}
