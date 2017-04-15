<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Relation extends Migration
{
    public function up()
    {
        Schema::create('relation', function (Blueprint $table) {
			
			//primary
            $table->increments('id');
			
            $table->integer('user_id')->unsigned()->index();
            $table->integer('follow_id')->unsigned()->index();
			$table->integer('star_id')->unsigned()->index();
            $table->timestamps();
            
            // 外部キー設定
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('follow_id')->references('id')->on('users');
			$table->foreign('star_id')->references('id')->on('users');

            //何度もフォローできないようにする
			//ユニークキー制約が設定されたカラムには重複する値は格納
            $table->unique(['user_id', 'follow_id','star_id']);
			
        });
    }

    public function down()
    {
        Schema::drop('user_follow');
    }
}
