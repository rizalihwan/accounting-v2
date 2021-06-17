<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditFieldDebitAndKreditToJurnalumumdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jurnalumumdetails', function (Blueprint $table) {
            $table->bigInteger('debit')->default(0)->change();
            $table->bigInteger('kredit')->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jurnalumumdetails', function (Blueprint $table) {
            $table->bigInteger('debit')->nullable(false)->default(null)->change();
            $table->bigInteger('kredit')->nullable(false)->default(null)->change();
        });
    }
}
