<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;


class AuthController extends Controller {
	/*
	  |--------------------------------------------------------------------------
	  | 登録／ログインコントローラ
	  |--------------------------------------------------------------------------
	  |
	  | このコントローラハンドラーは新ユーザーを登録し、同時に既存の
	  | ユーザーを認証します。デフォルトでこのコントローラは振る舞いを
	  | 追加するためにシンプルなトレイトを使用します。試してみませんか？
	  |
	 */

	//Router で設定した getLogin() や postLogin() の実体は、AuthenticatesAndRegistersUsers -> AuthenticatesUsers
	//trait（method含む）は、ここで調べた方が早い
	//https://laravel.com/api/5.1/search.html?search=AuthenticatesAndRegistersUsers

	use AuthenticatesAndRegistersUsers;
	use ThrottlesLogins;
	

	/**
	 * 新しい認証コントローラインスタンスの生成
	 *
	 * @return void
	 */
	
	
	//controllerにおけるconstructは、ミドルウェアを指定する
    //ミドルウェアは、ontroller にアクセスする前に事前に確認される条件
	
	public function __construct() {
		
		//常にguest -> 例外はlogout画面 -> id user はlogout画面のみ
		$this->middleware('guest', ['except' => 'getLogout']);
	}

	/**
	 * やって来た登録リクエストに対するバリデターを取得
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	protected function validator(array $data) {
		return Validator::make($data, [
					'name' => 'required|max:255',
					'email' => 'required|email|max:255|unique:users',
					'password' => 'required|confirmed|min:6',
		]);
	}

	/**
	 * 登録内容を確認後、新しいユーザーインスタンスを生成
	 *
	 * @param  array  $data
	 * @return User
	 */
	protected function create(array $data) {
		return User::create([
					'name' => $data['name'],
					'email' => $data['email'],
					'password' => bcrypt($data['password']),
		]);
	}

}
