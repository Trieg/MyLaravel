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
		//
		$this -> call( 'UserTableSeeder' );
		$this -> call( 'MicropostTableSeeder' );
		$this -> call( 'RelationTableSeeder' );

		//ModelFactoryの方のデータを利用
		//factory(App\User::class, 10)->create();
		//factory(App\Micropost::class, 10)->create();
		//
		Model::reguard();

	}

}

class UserTableSeeder extends Seeder{

	public function run(){

		DB::table( 'users' ) -> delete(); //クエリービルダー

		$faker = Faker\Factory::create( 'ja_JP' );

		for( $i = 0; $i < 15; $i ++ ){
			App\User::create( [
				'name'		 => $faker -> unique() -> name, //tableのunique属性を合わせる
				'email'		 => $faker -> unique() -> safeEmail, //tableのunique属性を合わせる
				'password'	 => bcrypt( str_random( 10 ) ),
			] );
		}

	}

}

class MicropostTableSeeder extends Seeder{

	public function run(){

		$temp	 = DB::table( 'users' ) -> lists( 'id' );
		$min_id	 = ( int )min( $temp );
		$max_id	 = ( int )max( $temp );

		$faker = Faker\Factory::create( 'ja_JP' );

		for( $i = 0; $i < 200; $i ++ ){
			App\Micropost::create( [
				//
				//外部キーで縛られてるuser_idには、親側に存在しないintを入れるとエラー
				'user_id'	 => $faker -> numberBetween( $min		 = $min_id, $max		 = $max_id ),
				'title'		 => $faker -> sentence,
				'content'	 => $faker -> paragraph,
			] );
		}

	}

}

class RelationTableSeeder extends Seeder{

	public function run(){

		$temp	 = DB::table( 'users' ) -> lists( 'id' );
		$min_id	 = ( int )min( $temp );
		$max_id	 = ( int )max( $temp );

		$bool = ( bool )random_int( 0, 1 );

		$faker = Faker\Factory::create();

		for( $i = 0; $i < 100; $i ++ ){
			App\Relation::create( [
				'user_id'	 => $faker -> numberBetween( $min		 = $min_id, $max		 = $max_id ),
				'other_id'	 => $faker -> numberBetween( $min		 = $min_id, $max		 = $max_id ),
				'follow' => random_int( 0, 1 ),
				'star'	 => random_int( 0, 1 ),
			] );
		}

	}

}

//php artisan db:seed
//php artisan migrate:refresh --seed
//php artisan db:seed --class=UserTableSeeder
//php artisan db:seed --class=MicropostTableSeeder


/*
        'name' => $faker->name,
        'password' => $faker->password,
        'country' => $faker->country,
        'prefecture' => $faker->prefecture,
        'city' => $faker->city,
        'postcode' => $faker->postcode,
        'address' => $faker->address,
        'streetAddress' => $faker->streetAddress,
        'phoneNumber' => $faker->phoneNumber,
        'email' => $faker->email,
        'safeEmail' => $faker->safeEmail,   // (実在しないアドレスのため処理とかで使っても安心)
        'company' => $faker->company,
        'iso8601' => $faker->iso8601($max = 'now'),
        'dateTimeBetween' => $faker->dateTimeBetween($startDate = '-110 years', $endDate = 'now')->format('Y年m月d日'),
        'numberBetween' => $faker->numberBetween($min = 100, $max = 200),
        'title' => $faker->title,
        'realText' => $faker->realText($maxNbChars = 50, $indexSize = 2),
        'randomNumber' => $faker->randomNumber($nbDigits = NULL),
        'randomFloat' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = NULL),
        'randomElement' => $faker->randomElement($array = ['男性', '女性']),
        'lexify' => $faker->lexify($string = '??????'),
        'hexcolor' => $faker->hexcolor,
        'ipv4' => $faker->ipv4,
        'url' => $faker->url,
        'imageUrl' => $faker->imageUrl($width = 640, $height = 480, $category = 'cats', $randomize = true, $word = null),
        'userAgent' => $faker->userAgent,
        'creditCardType' => $faker->creditCardType,
        'creditCardNumber' => $faker->creditCardNumber,
        'creditCardExpirationDate' => $faker->creditCardExpirationDate,
        'isbn13' => $faker->isbn13,
        'isbn10' => $faker->isbn10
 * 
 */