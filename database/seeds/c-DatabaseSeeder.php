<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder{

	//function runの実行
	//php artisan db:seed
	//
	//特定のclassのみ実行
	//php artisan db:seed --class=UserTableSeeder
	//
	//migrateと同時に実行
	//php artisan migrate:refresh --seed
	//
	//このクラスからcallメソッドを使い他の初期値設定クラスを呼び出すことで、値を設定する順番をコントロールできる
	//function runは、db:seed Artisanコマンドが実行された時に実行

	public function run(){
		//guard()は、マスアサインメント（create()でfillableを使って保存）を使う
		//マスアサインメントでは fillableで宣言した項目のみに許可を与え、それ以外をガードしている
		//
        Model::unguard();

		$this -> call( 'ArticlesTableSeeder' );  // ②

		Model::reguard();

	}

}

//テーブル毎にSeederの派生クラスを作成すると、管理しやすくする

class ArticlesTableSeeder extends Seeder{

	public function run(){

		DB::table( 'articles' ) -> delete();  //Query Builderを使って、Articlesテーブルのレコードを全て削除

		$faker = Faker::create( 'en_US' );  //Fakerを使用してダミーデータを作成

		for( $i = 0; $i < 10; $i ++ ){  //作成条件
			Article::create( [
				'title'			 => $faker -> sentence(),
				'body'			 => $faker -> paragraph(),
				'published_at'	 => Carbon::today()
			] );
		}

	}

}

/*
Profile::create( [
	'user_id'			 => $faker -> unique() -> numberBetween( $min = 1, $max= 50 ),
	'name'				 => $faker -> firstNameMale,
	'value_added_tax'	 => $faker -> randomDigit,
	'city'				 => $faker -> city,
	'post_code'			 => $faker -> postcode,
	'country'			 => $faker -> country,
	'phone'				 => $faker -> phoneNumber,
	'img_src'			 => $faker -> imageUrl( $width	= 200, $height = 200 )
] );
*/