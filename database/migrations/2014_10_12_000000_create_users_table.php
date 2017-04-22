<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

//マイグレーション名をキャメルケースに変換したものがクラス名になる
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

//WHERE節（SELECT文）で条件に入れるカラムには、indexを作ったほうがよい
//ただし1000件以内は、たいして影響ないので、後で考えるでOK
//indexでまず絞り込み、その上であいまい検索などを行う

//INSERT（新規）が多くなるときは注意せよ。検索は早いが、更新は遅い

//副キーの存在
//index key（索引）、unique key（単一）

//Userが増えすぎた時のために、DBをスケールアウト出来る構築を考える
//つまり、UserとGlobalのDBは分ける。UserとGlobalでの依存関係を無くす。