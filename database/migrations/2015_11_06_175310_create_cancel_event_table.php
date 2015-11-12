<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCancelEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cancel_events', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->integer('presentation_id');
            $table->integer('user_id')->unsigned();
            $table->string('reason');
            $table->integer('duration');
            $table->boolean('authorized');
            $table->timestamp('date_refund');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cancel_events');
    }
}
