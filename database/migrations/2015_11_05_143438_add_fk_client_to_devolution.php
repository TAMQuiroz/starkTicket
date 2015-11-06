<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkClientToDevolution extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('devolutions', function (Blueprint $table) {
            $table->foreign('client_id')
                  ->references('id')
                  ->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('devolutions', function (Blueprint $table) {
            $table->dropForeign('devolutions_client_id_foreign');
        });
    }
}
