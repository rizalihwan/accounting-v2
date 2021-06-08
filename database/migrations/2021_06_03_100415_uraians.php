<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Uraians extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uraians', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rekening_id')->index('rekening_id');
            $table->unsignedBigInteger('bkk_id')->index('bkk_id');
            $table->integer('jml_uang');
            $table->string('catatan');
            $table->enum('uang',['RP','USD']);
            $table->timestamps();
            $table->foreign('rekening_id')->references('id')->on('rekenings')->onDelete('cascade');
            $table->foreign('bkk_id')->references('id')->on('bkks')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('uraians');
    }
}
