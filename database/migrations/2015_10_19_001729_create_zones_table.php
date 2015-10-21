<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('event_id')->unsigned();
            $table->timestamps(); 
            $table->string('name');
            $table->integer('max_capacity');
            $table->integer('slots_availables');
            $table->integer('columns')->nullable();
            $table->integer('rows')->nullable();
            $table->integer('start_column')->nullable();
            $table->integer('start_row')->nullable();
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('zones');
    }
}
