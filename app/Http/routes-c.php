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

//--------------------------------------------------------------------------
//App\Providers\RouteServiceProviderクラスによりロード
//正規表現はこちらに記載
link_to(Applications / MAMP / htdocs / l51_003 / microposts / app / Providers / RouteServiceProvider . php);

//--------------------------------------------------------------------------
//「/」をindexアクションと呼ぶ
Route::get('/', function () {
	return view('welcome');
});



//一番基本的なLaravelのルートは、URIとClosureを指定
Route::get('/', function () {
	return view('welcome');
});

Route::match(['get', 'post'], '/', function () {
	return 'Hello World';
});

Route::any('/', function () {
	return 'Hello World';
});

//--------------------------------------------------------------------------
//アプリケーションのルートに対するURLを生成
//TODO
$postId		 = url('foo');
$commentId	 = "foo2";

//ルートパラメータの作成。{}で括る
Route::get('user/{id}', function ($id) {
	return 'User ' . $id;
});

//パラメーターは、URLにも使えるし、クロージャーにも使える
Route::get('posts/{post}/comments/{comment}', function ($postId, $commentId) {
	//
});

//必須ではないパラメーター{param?}でOK
Route::get('user/{name?}', function ($name = null) {
	return $name;
});


//--------------------------------------------------------------------------

//viewのヘルパー関数は、route.phpで設定したルーティングに基づいてリンクを生成してくれる関数
//link_to_route('ViTask.show', $list->id, ['id' => $list->id])
//この第3引数の'id'が、下記の{id}に相当

//'id'は文字列でなく、連想配列のkeyなので、key元を替える場合はlinkも変更、逆にkey元を変えない場合はlink側は固定で使用
//下記のコードの{id}は、連想配列のkeyである。

//
//Route::get('messages/{id}', 'MessagesController@show');
//Route::post('messages', 'MessagesController@store');
//Route::put('messages/{id}', 'MessagesController@update');
//Route::delete('messages/{id}', 'MessagesController@destroy');
//Route::get('messages', 'MessagesController@index');
//Route::get('messages/create', 'MessagesController@create');
//Route::get('messages/{id}/edit', 'MessagesController@edit');
//