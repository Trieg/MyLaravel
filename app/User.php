<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract {

	use Authenticatable,
	 Authorizable,
	 CanResetPassword;

	protected $table = 'users';
	protected $fillable = ['name', 'email', 'password'];
	protected $hidden = ['password', 'remember_token'];
	
	
	//UserからMicropostをみたとき、複数存在するので、function microposts()のように複数形micropostsでメソッドを定義
	public function microposts()
    {
		
        return $this->hasMany(Micropost::class); //依存性の構築
		
		//User のインスタンスが自分のMicropostsを取得することができます。
		//$user->microposts()->all() もしくは簡単に $user->microposts で取得できます。
		
    }
	

}

