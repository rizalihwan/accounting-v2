<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveSubklasifikasiIdOnAkunsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('akuns', function (Blueprint $table) {
            $table->dropConstrainedForeignId('subklasifikasi_id');
            $table->string('subklasifikasi');
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
            $table->unsignedBigInteger('subklasifikasi_id')->after('name');
            $table->foreign('subklasifikasi_id')->references('id')->on('subklasifikasis')->onDelete('cascade');
            $table->dropColumn('subklasifikasi');
        });
    }
}
