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

Route::get( '/', 'WelcomeController@index' );

//---------------------UserController, MicropostController---------------------

Route::group( [ 'middleware' => 'auth' ], function (){

	Route::resource( 'users', 'UsersController', [ 'only' => [ 'index', 'show' ] ] );
	Route::resource( 'microposts', 'MicropostsController', [ 'only' => [ 'store', 'destroy', 'edit', 'update' ] ] );

	//prefix/URL
	Route::group( [ 'prefix' => 'users/{id}' ], function (){
		Route::post( 'follow', 'UserFollowController@store' ) -> name( 'user.follow' );
		Route::delete( 'unfollow', 'UserFollowController@destroy' ) -> name( 'user.unfollow' );
		
		Route::get( 'followings', 'UsersController@followings' ) -> name( 'users.followings' );
		Route::get( 'followers', 'UsersController@followers' ) -> name( 'users.followers' );
	} );
} );

//users.index
//users.show

//microposts.store 
//microposts.update
//microposts.destroy 
//microposts.edit

