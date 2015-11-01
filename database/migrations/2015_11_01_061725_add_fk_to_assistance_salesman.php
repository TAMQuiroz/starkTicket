<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkToAssistanceSalesman extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       
          
       Schema::table('assistance', function (Blueprint $table) {
            $table->foreign('salesman_id')
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
          Schema::table('assistance', function (Blueprint $table) {
            $table->dropForeign('assistance_salesman_id_foreign');
        });



    }
}
