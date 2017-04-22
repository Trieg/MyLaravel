<?php

//--------------------AuthController--------------------
// signup（登録）
Route::get( 'signup', 'Auth\AuthController@getRegister' ) -> name( 'signup.get' );
Route::post( 'signup', 'Auth\AuthController@postRegister' ) -> name( 'signup.post' );

// login（ログイン）
Route::get( 'login', 'Auth\AuthController@getLogin' ) -> name( 'login.get' );
Route::post( 'login', 'Auth\AuthController@postLogin' ) -> name( 'login.post' );

//logout（ログアウト）
Route::get( 'logout', 'Auth\AuthController@getLogout' ) -> name( 'logout.get' );

//--------------------WelcomeController--------------------

Route::get( '/', 'WelcomeController@index' ) -> name( 'root.index' );


//--------------------UserController, MicropostController--------------------

Route::group( [ 'middleware' => 'auth' ], function (){
	
	//RULE nameは必ず付ける、name名はURL.methodで記述
	Route::get('users/all', 'UsersController@all') -> name( 'users.all' );
	Route::get('users/{id}/show', 'UsersController@show') -> name( 'users.show' );

	//RULE viewに飛ばない場合はresourceを使ってもOKとする
	Route::resource( 'micropost', 'MicropostController', [ 'only' => [ 'store', 'destroy', 'edit', 'update' ] ] );

	//prefix/URL
	Route::group( [ 'prefix' => 'users/{id}' ], function (){
		
        Route::post('like', 'UserFollowController@store')->name('like.store');
        Route::delete('like', 'UserFollowController@destroy')->name('like.delete');
		
        Route::get('like', 'UsersController@auth_to_you_like')->name('like.auth_to_you_likeh');
        Route::get('like', 'UsersController@you_to_auth_like')->name('lile.you_to_auth_like');
	} );
} );

