<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssistance extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       

           Schema::create('assistance', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tipo');
            $table->timestamp('datetime');
            $table->integer('salesman_id')->unsigned();
            $table->timestamps();
           


        });



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
              Schema::drop('assistance');
    }
}
