<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Like extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('like', function (Blueprint $table) {
			
            $table->increments('id');
			
            $table->integer('user_id')->unsigned()->index();
            $table->integer('like_id')->unsigned()->index();
			
            $table->timestamps();
            
			//二重の防止
			//$table->unique(['user_id', 'like_id']);
			
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('like');
    }
}
