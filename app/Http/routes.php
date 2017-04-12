<?php


//---------------------
//Route::method(URL, Controllerのpath,)->name(view側で使える、ルート名称)
// signup（登録）
Route::get('signup', 'Auth\AuthController@getRegister')->name('signup.get');
Route::post('signup', 'Auth\AuthController@postRegister')->name('signup.post');

// login（ログイン）
Route::get('login', 'Auth\AuthController@getLogin')->name('login.get');
Route::post('login', 'Auth\AuthController@postLogin')->name('login.post');

//logout（ログアウト）
Route::get('logout', 'Auth\AuthController@getLogout')->name('logout.get');


//---------------------

Route::get('/', 'WelcomeController@index');

//---------------------
//ログイン認証付きのルーティング
//app/Http/Middleware/Authenticate.php の handle()でリダイレクトのパスの書き換え

Route::group(['middleware' => 'auth'], function () {

	//ユーザ一覧(index)、ユーザ詳細(show)

	Route::resource('users', 'UsersController', ['only' => ['index', 'show']]);
		

	Route::resource('microposts', 'MicropostsController', ['only' => ['store', 'destroy', 'edit', 'update']]);
});


//ここでmethodとfuncttion先が合わないと
//MethodNotAllowedHttpException in RouteCollection.php line 218:
//
//get@show
//post@store
//put@update
//delete@destroy
//get@index
//get@create
//get@edit
//