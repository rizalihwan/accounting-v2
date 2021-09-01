<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemplateJurnalDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('template_jurnal_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('template_id')->references('id')->on('template_jurnals')->onDelete('cascade');
            $table->foreignId('akun_id')->constrained();
            $table->bigInteger('debit');
            $table->bigInteger('kredit');
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
        Schema::dropIfExists('template_jurnal_details');
    }
}
