<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeatsFunctionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seats_function', function (Blueprint $table) {
            $table->integer('seat_id')->index('seats_function_seat_id_foreign');
            $table->integer('function_id')->index('seats_function_function_id_foreign');
            $table->integer('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('seats_function');
    }
}
