<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('payment_date');
            $table->integer('reserve');
            $table->timestamp('refund_date')->nullable();
            $table->integer('cancelled');
            $table->integer('owner_id')->unsigned()->nullable();
            $table->integer('event_id')->unsigned();
            $table->integer('presentation_id')->unsigned();
            $table->integer('seat_id')->unsigned()->nullable();
            $table->integer('zone_id')->unsigned();
            $table->float('price');
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
        Schema::drop('tickets');
    }
}
