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
		'name'			 => $faker -> name,
		'email'			 => $faker -> safeEmail,
		'password'		 => bcrypt( str_random( 10 ) ),
		'remember_token' => str_random( 10 ),
	];
} );



//以下は、App\Userモデルをのデータを10個つくる、という意味になります。

//php artisan tinker
//factory(App\User::class, 10)->create();
//App\User::count(); → 10

