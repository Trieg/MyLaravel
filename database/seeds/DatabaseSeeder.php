<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\helpers; //なぜかヘルパー関数が読み込まれない対策

//php artisan db:seed
//php artisan migrate:refresh --seed
//php artisan db:seed --class=UserTableSeeder
//php artisan db:seed --class=MicropostTableSeeder

class DatabaseSeeder extends Seeder{

	public function run(){

		Model::unguard();

		$this -> call( 'UserTableSeeder' );
		//$this -> call( 'MicropostTableSeeder' );

		Model::reguard();

	}

}

class UserTableSeeder extends Seeder{

	public function run(){

		//Query Builderを使って、Articlesテーブルのレコードを全て削除
		//DB::table( 'users' ) -> delete();
		//DB::table( 'users' ) ->truncate();

		$faker = Faker\Factory::create( 'ja_JP' ); //Fakerを使用してダミーデータを作成

		for( $i = 0; $i < 15; $i ++ ){ //作成条件
			App\User::create( [
				'name'		 => $faker -> unique() -> name, //tableのunique属性を合わせる
				'email'		 => $faker -> unique() -> email, //tableのunique属性を合わせる
				'password'	 => bcrypt( str_random( 10 ) ),
			] );
		}

	}

}

class MicropostTableSeeder extends Seeder{

	public function run(){

		//DB::table( 'user' ) -> delete(); 

		$faker = Faker\Factory::create( 'ja_JP' );

		for( $i = 0; $i < 30; $i ++ ){
			App\Micropost::create( [
				//'user_id'	 => $faker -> numberBetween( $min = 1, $max	= 10 ),
				'title'		 => $faker -> sentence,
				'content'	 => $faker -> paragraph,
			] );
		}

	}

}
