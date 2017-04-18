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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
				'name'		 => $faker -> unique() -> name, //tableのunique属性を合わせる
				'email'		 => $faker -> unique() -> safeEmail, //tableのunique属性を合わせる
				'password'	 => bcrypt( str_random( 10 ) ),
    ];
});



$factory->define(App\Micropost::class, function (Faker\Generator $faker) {
    return [
				'user_id'	 => $faker -> numberBetween( $min = 1, $max	= 10 ),
				'title'		 => $faker -> sentence,
				'content'	 => $faker -> paragraph,
    ];
});

