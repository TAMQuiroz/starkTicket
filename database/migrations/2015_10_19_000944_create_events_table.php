<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('category_id')->unsigned();
            $table->integer('place_id')->unsigned();
            $table->integer('organizer_id')->unsigned();
            $table->string('description', 65535);
            $table->string('image', 65535);
            $table->timestamps();       
            $table->softDeletes();
            $table->timestamp('publication_date');
            $table->timestamp('selling_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('events');
    }
}
