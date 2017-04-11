<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;

//Router で設定した getLogin や postLogin の実体は、
//AuthenticatesAndRegistersUsers -> AuthenticatesUsers
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;


class AuthController extends Controller
{

    protected $redirectTo = '/'; //追加
	
    protected $loginPath = '/login'; // 追加
	
	
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

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;
	

    /**
     * 新しい認証コントローラインスタンスの生成
     *
     * @return void
     */
	
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * やって来た登録リクエストに対するバリデターを取得
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
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
	
	//methodのcreate アクションとは違って、 Userをcreate(save) する。User版のstoreみたいな
	
    protected function create(array $data)
    {
		
		//modelのuserの静的メソッドの呼び出し
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
