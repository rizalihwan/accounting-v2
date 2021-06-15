<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJurnalumumdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jurnalumumdetails', function (Blueprint $table) {
            $table->id();
            $table->foreignId('akun_id')->constrained();
            $table->foreignId('jurnalumum_id')->constrained();
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
        Schema::dropIfExists('jurnalumumdetails');
    }
}
