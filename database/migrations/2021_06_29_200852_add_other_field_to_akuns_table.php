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
            $table->enum('level', ['Aktiva', 'Modal', 'Kewajiban'])->after('name');
            $table->bigInteger('debit')->nullable()->after('level');
            $table->bigInteger('kredit')->nullable()->after('debit');
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
            $table->dropColumn(['level', 'debit', 'kredit']);
        });
    }
}
