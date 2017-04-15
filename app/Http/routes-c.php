<?php

/*
  |--------------------------------------------------------------------------
  | アプリケーションのルート
  |--------------------------------------------------------------------------
  |
  | ここでアプリケーションのルートを全て登録することが可能です。
  | 簡単です。ただ、Laravelへ対応するURIと、そのURIがリクエスト
  | されたときに呼び出されるコントローラを指定してください。
  |
 */


//-------------------------------------------------------------------------
//「/」をindexアクションと呼ぶ
Route::get('/', function () {
	return view('welcome');
});

//Route::method(URL, Controllerのpath,)->name(view側で使える、ルート名称)

//URLの生成は、view側から、単一のstringを{}に渡すしかない


//--------------------------------------------------------------------------

//ログイン認証付きのルーティング
//app/Http/Middleware/Authenticate.php の handle()でリダイレクトのパスの書き換え

Route::group(['middleware' => 'auth'], function () {

});


//-------------------------------------------------------------------------

//MethodNotAllowedHttpException in RouteCollection.php line 218:

//get		@show
//post		@store
//put		@update
//delete	@destroy
//get		@index
//get		@create
//get		@edit

//--------------------------------------------------------------------------
//routeのif分岐

$defaultRoutes = function(){
    Route::get('/hogehoge', 'HogeController@index');
};

if (strpos(url(), config('app.test_domain'))) {
    Route::group(['middleware' => 'auth'], $defaultRoutes);
} else {
    $defaultRoutes();
}

//内容的にはこちら、上記はclosureかけてある

if (strpos(url(), config('app.test_domain'))) {
    Route::group(['middleware' => 'auth'], function () {
        defaultRoutes();
    });
} else {
    defaultRoutes();
}

//--------------------------------------------------------------------------