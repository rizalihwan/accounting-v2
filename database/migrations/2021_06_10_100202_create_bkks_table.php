<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBkksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bkks', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->unsignedBigInteger('kontak_id')->index('kontak_id');
            $table->text('desk');
            $table->unsignedBigInteger('rekening_id')->index('rekening_id');
            $table->biginteger('value');
            $table->enum('status',['BKM','BKK']);
            $table->timestamps();
            $table->foreign('kontak_id')->references('id')->on('kontaks')->onDelete('cascade');
            $table->foreign('rekening_id')->references('id')->on('akuns')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bkks');
    }
}
