<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameTableUraiansToBkkDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('uraians', 'bkk_details');

        Schema::table('bkk_details', function (Blueprint $table) {
            $table->dropColumn('uang');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('bkk_details', 'uraians');

        Schema::table('uraians', function (Blueprint $table) {
            $table->enum('uang',['RP','USD'])->after('catatan');
        });
    }
}
