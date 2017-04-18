<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder{

	public function run(){

		Model::unguard();

		$this -> call( 'UserTableSeeder' );

		Model::reguard();

	}

}

class UserTableSeeder extends Seeder{

	public function run(){

		//DB::table( 'user' ) -> delete(); //Query Builderを使って、Articlesテーブルのレコードを全て削除

		$faker = Faker::create( 'ja_JP' ); //Fakerを使用してダミーデータを作成

		for( $i = 0; $i < 10; $i ++ ){ //作成条件
			App\User::create( [
				'name'		 => $faker -> name,
				'body'		 => $faker -> safeEmail,
				'password'	 => bcypt( str_random( 10 ) ),
			] );
		}

	}

}

/*
		'name'		 => $faker -> name,
		'email'		 => $faker -> safeEmail,
		'password'	 => bcrypt( str_random( 10 ) ),
		//'star_id'	 => numberBetween( $min		 = 1, $max		 = 10 )
		//'remember_token' => str_random( 10 ),
 * 
 */