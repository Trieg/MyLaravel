<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;  //ここだけは通常のmodelクリエイトでもあった
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract{

	use Authenticatable,
	 Authorizable,
	 CanResetPassword;

	//bcrypt() はで暗号化、Hash::check() で復号化
	//パスワードを、暗号化してからデータベースに保存、ログイン認証時に復号化して、boolを調べる
	//
	//機械が読むコードでなく、人が読むコードへ
	//owns
	//canEdit
	//isPublished
	//isAdmin

	/**
	 * モデルで使用するデータベーステーブル
	 *
	 * @var string
	 */
	//modelとtableの関連付け
	protected $table = 'users';

	/**
	 * 複数代入を行う属性
	 *
	 * @var array
	 */
	//create() を使って、一気にデータを代入し保存するときには、配列をcolumnで宣言する
	protected $fillable = [ 'name', 'email', 'password' ];

	/**
	 * モデルのJSON形式に含めない属性
	 *
	 * @var array
	 */
	//秘匿化。単に表示を消しているだけ。つまり表示の効率化なので、下記のように明示すれば見れる
	//User::first()->password と明示すれば見れる

	protected $hidden = [ 'password', 'remember_token' ];

}
