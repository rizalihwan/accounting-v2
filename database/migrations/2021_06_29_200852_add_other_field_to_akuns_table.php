<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOtherFieldToAkunsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('akuns', function (Blueprint $table) {
            $table->string('level')->nullable()->after('status');
            $table->bigInteger('saldo_awal')->nullable()->after('level');
            $table->bigInteger('saldo_berjalan')->nullable()->after('saldo_awal');
            $table->bigInteger('saldo_akhir')->nullable()->after('saldo_berjalan');
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
            $table->dropColumn('level');
            $table->dropColumn('saldo_awal');
            $table->dropColumn('saldo_berjalan');
            $table->dropColumn('saldo_akhir');
        });
    }
}
