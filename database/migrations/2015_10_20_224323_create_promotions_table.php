<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //


           Schema::create('promotions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamp('startday');
            $table->timestamp('endday');
            $table->text('description');
            $table->float('desc');
            $table->timestamps();
            $table->softDeletes();
            $table->integer('event_id')->unsigned();
          
        });




    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::drop('promotions');
    }
}
