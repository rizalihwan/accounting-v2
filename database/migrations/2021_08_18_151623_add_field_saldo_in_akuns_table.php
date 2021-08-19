<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldSaldoInAkunsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('akuns', function (Blueprint $table) {
            $table->bigInteger('saldo_awal')->nullable()->default(0)->after('level');
            $table->bigInteger('saldo_akhir')->nullable()->default(0)->after('kredit');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('akuns', function (Blueprint $table) {
            $table->dropColumn('saldo_awal');
            $table->dropColumn('saldo_akhir');
        });
    }
}
