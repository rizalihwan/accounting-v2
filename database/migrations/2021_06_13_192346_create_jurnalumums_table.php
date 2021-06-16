<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJurnalumumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jurnalumums', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('kode_jurnal');
            $table->foreignId('kontak_id')->constrained();
            $table->foreignId('divisi_id')->references('id')->on('divisis')->onDelete('cascade');
            $table->string('uraian');
            $table->boolean('status');
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
        Schema::dropIfExists('jurnalumums');
    }
}
