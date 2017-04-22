<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Star extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('star', function (Blueprint $table) {

            $table->increments('id');
			
            $table->integer('user_id')->unsigned()->index();
            $table->integer('star_id')->unsigned()->index();
			
            $table->timestamps();
            
			//二重の防止
			//$table->unique(['user_id', 'star_id']);
			
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('star');
    }
}

