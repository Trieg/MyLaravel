<?php

/*
  |--------------------------------------------------------------------------
  | モデルファクトリー
  |--------------------------------------------------------------------------
  |
  | ここに全部のモデルファクトリーを定義してください。モデルファクトリーは
  | テストのためにデータベースの初期値を用意したモデルを作成する便利な方法です。
  | モデルがどのように見えれば良いのかをファクトリーに指示するだけです。
  |
 */

$factory -> define( App\User::class, function (Faker\Generator $faker){
	return [
		'name'		 => $faker -> name,
		'email'		 => $faker -> safeEmail,
		'password'	 => bcrypt( str_random( 10 ) ),
			//'remember_token' => str_random( 10 ),
	];
} );

$factory -> define( App\Micropost::class, function (Faker\Generator $faker){
	return [
		'user_id'	 => $faker -> numberBetween( $min = 1, $max= 10 ),
		'title'		 => $faker -> sentence,
		'content'	 => $faker -> paragraph,
	];
} );


//以下は、App\Userモデルをのデータを10個つくる、という意味になります。

//php artisan tinker
//factory(App\User::class, 10)->create();

//App\User::count(); → 10

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