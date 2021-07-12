<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\{Schema, DB};

class EditStatusDefaultOnSales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE `penawaran_sales` CHANGE `status` `status` ENUM('0','1') NOT NULL DEFAULT '0'");
        DB::statement("ALTER TABLE `pesanan_sales` CHANGE `status` `status` ENUM('0','1') NOT NULL DEFAULT '0'");
        DB::statement("ALTER TABLE `pengiriman_sales` CHANGE `status` `status` ENUM('0','1') NOT NULL DEFAULT '0'");
        DB::statement("ALTER TABLE `faktur_sales` CHANGE `status` `status` ENUM('0','1') NOT NULL DEFAULT '0'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE `penawaran_sales` CHANGE `status` `status` ENUM('0','1') NOT NULL DEFAULT '1'");
        DB::statement("ALTER TABLE `pesanan_sales` CHANGE `status` `status` ENUM('0','1') NOT NULL DEFAULT '1'");
        DB::statement("ALTER TABLE `pengiriman_sales` CHANGE `status` `status` ENUM('0','1') NOT NULL DEFAULT '1'");
        DB::statement("ALTER TABLE `faktur_sales` CHANGE `status` `status` ENUM('0','1') NOT NULL DEFAULT '1'");
    }
}
