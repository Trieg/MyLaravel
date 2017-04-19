<?php

//---------------------AuthController---------------------
// signup（登録）
Route::get( 'signup', 'Auth\AuthController@getRegister' ) -> name( 'signup.get' );
Route::post( 'signup', 'Auth\AuthController@postRegister' ) -> name( 'signup.post' );

// login（ログイン）
Route::get( 'login', 'Auth\AuthController@getLogin' ) -> name( 'login.get' );
Route::post( 'login', 'Auth\AuthController@postLogin' ) -> name( 'login.post' );

//logout（ログアウト）
Route::get( 'logout', 'Auth\AuthController@getLogout' ) -> name( 'logout.get' );


//---------------------WelcomeController---------------------

Route::get( '/', 'WelcomeController@index' ) -> name( 'root.index' );

//---------------------UserController, MicropostController---------------------

Route::group( [ 'middleware' => 'auth' ], function (){
	
	Route::get('users/all', 'UsersController@all') -> name( 'users.all' );
	Route::get('users/{id}/show', 'UsersController@show') -> name( 'users.show' );

	//ホームリダイレクト、既存URLの場合はresourceを使ってもokとする
	Route::resource( 'microposts', 'MicropostsController', [ 'only' => [ 'store', 'destroy', 'edit', 'update' ] ] );

	//prefix/URL
	Route::group( [ 'prefix' => 'users/{id}' ], function (){
		
		Route::post( 'follow', 'UserFollowController@store' ) -> name( 'follow.store' );
		
		Route::delete( 'unfollow', 'UserFollowController@delete' ) -> name( 'follow.delete' );
		
		//下記はホントにいるURLなの？？？
		Route::get( 'followings', 'UsersController@followings' ) -> name( 'users.followings' );
		Route::get( 'followers', 'UsersController@followers' ) -> name( 'users.followers' );
	} );
} );

