<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemplateJurnalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('template_jurnals', function (Blueprint $table) {
            $table->id();
            $table->string('nama_template');
            $table->string('keterangan');
            $table->enum('frekuensi', ['Harian', 'Bulanan', 'Tahunan']);
            $table->string('per_tanggal', 2);
            $table->enum('sumber', ['KM', 'KK', 'JU']);
            $table->foreignId('kontak_id')->constrained();
            $table->foreignId('divisi_id')->constrained();
            $table->string('uraian');
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
        Schema::dropIfExists('template_jurnals');
    }
}
