<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkToSeatsFunctionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seats_function', function (Blueprint $table) {
            $table->foreign('seat_id')
                  ->references('id')
                  ->on('seats')->onDelete('cascade');
            $table->foreign('function_id')
                  ->references('id')
                  ->on('functions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('seats_function', function (Blueprint $table) {
            $table->dropForeign('seats_function_seat_id_foreign');
            $table->dropForeign('seats_function_function_id_foreign');
        });
    }
}
