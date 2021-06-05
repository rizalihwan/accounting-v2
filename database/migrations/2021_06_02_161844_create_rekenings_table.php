<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRekeningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rekenings', function (Blueprint $table) {
            $table->id();
            $table->char('nomor', 4)->unique('nomor');
            $table->string('nama');
            $table->enum('level', ['1', '2', '3'])->comment('1, 2, 3');
            $table->enum('d_c', ['D', 'C'])->comment('D/C');
            $table->enum('g_d', ['G', 'D'])->comment('G/D');
            $table->enum('mata_uang', ['Rp', "USD"])->comment('Rp/USD');
            $table->unsignedBigInteger('bank_id')->index('bank_id');
            $table->enum('kategori', ['Aktiva', 'Hutang', 'Modal', 'Pendapatan', 'Biaya'])
                ->comment('Aktiva, Hutang, Modal, Pendapatan, Biaya');
            $table->string('ac_bank');
            $table->unsignedBigInteger('divisi_id')->index('divisi_id');
            $table->boolean('aktif')->default(true);
            $table->boolean('piutang')->default(false);
            $table->boolean('kas_bank')->default(false);
            $table->char('level_1', 4);
            $table->char('level_2', 4)->nullable();
            $table->char('level_3', 4)->nullable();
            $table->timestamps();

            $table->foreign('divisi_id')->references('id')->on('divisis')->onDelete('cascade');
            $table->foreign('bank_id')->references('id')->on('banks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rekenings');
    }
}
