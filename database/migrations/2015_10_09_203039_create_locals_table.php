<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         Schema::create('locals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('capacity');
            $table->string('address');
            $table->string('district');
            $table->string('province');
            $table->string('state');
            $table->string('image');
            $table->integer('row');
            $table->integer('column');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
