<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * マイグレーション実行
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
			
			//laravelでは、incrementsは、unsigned() -> index()が設定されてる
			//外部keyはincrementsだけにする、ってのは割りと安心感はある
            $table->increments('id');
			
            $table->string('name')-> unique()-> index();
            $table->string('email')->unique()-> index();
			
            $table->string('password', 60);
			
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * マイグレーションを戻す
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
