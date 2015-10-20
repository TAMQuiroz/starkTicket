<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZonePublicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('public_zone', function (Blueprint $table) {
            $table->integer('public_id')->unsigned()->index('public_zone_public_id_foreign');
            $table->integer('zone_id')->unsigned()->index('public_zone_zone_id_foreign');
            $table->float('price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('public_zone');
    }
}
