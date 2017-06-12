<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableBannersAddApplyBanners extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE banners MODIFY COLUMN `type` ENUM('landing','home','occasion','theme', 'apply_retailer', 'apply_driver')");
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE banners MODIFY COLUMN `type` ENUM('landing','home','occasion','theme')");
    }
}
