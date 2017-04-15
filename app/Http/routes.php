<?php

//---------------------AuthController---------------------

// signup（登録）
Route::get('signup', 'Auth\AuthController@getRegister')->name('signup.get');
Route::post('signup', 'Auth\AuthController@postRegister')->name('signup.post');

// login（ログイン）
Route::get('login', 'Auth\AuthController@getLogin')->name('login.get');
Route::post('login', 'Auth\AuthController@postLogin')->name('login.post');

//logout（ログアウト）
Route::get('logout', 'Auth\AuthController@getLogout')->name('logout.get');


//---------------------WelcomeController---------------------

Route::get('/', 'WelcomeController@index');

//---------------------UserController, MicropostController---------------------

Route::group(['middleware' => 'auth'], function () {

	Route::resource('users', 'UsersController', ['only' => ['index', 'show']]);
		
	Route::resource('microposts', 'MicropostsController', ['only' => ['store', 'destroy', 'edit', 'update']]);
	
});

