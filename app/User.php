<?php

namespace App;

use App\Micropost; //model
use App\Relation; //model
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract{

	use Authenticatable,
	 Authorizable,
	 CanResetPassword;

	protected $table	 = 'users';
	protected $fillable	 = [ 'name', 'email', 'password' ];
	protected $hidden	 = [ 'password', 'remember_token' ];

	//$user->micropost()
	public function micropost(){

		return $this -> hasMany( Micropost::class );

	}

	//$user->relation()
	public function relation(){

		return $this -> hasMany( Relation::class );

	}

	//$user->auth_to_you
	public function auth_to_you_like(){
		return $this -> belongsToMany( User::class, 'follow', 'user_id', 'follow_id' ) -> withTimestamps();

	}

	//$user->you_to_auth
	public function you_to_auth_like(){
		return $this -> belongsToMany( User::class, 'follow', 'follow_id', 'user_id' ) -> withTimestamps();

	}

	//--------------------
	
	public function is_following( $userId ){
		return $this -> auth_to_you_like() -> where( 'follow_id', $userId ) -> exists();

	}

	public function do_like( $userId ){
		// 既にフォローしているかの確認
		$exist	 = $this -> is_following( $userId );
		// 自分自身ではないかの確認
		$its_me	 = $this -> id == $userId;

		if( $exist || $its_me ){
			// 既にフォローしていれば何もしない
			return false;
		}else{
			// 未フォローであればフォローする
			$this -> followings() -> attach( $userId ); //attach = save
			return true;
		}

	}

	public function not_like( $userId ){
		// 既にフォローしているかの確認
		$exist	 = $this -> is_following( $userId );
		// 自分自身ではないかの確認
		$its_me	 = $this -> id == $userId;

		if( $exist && ! $its_me ){
			// 既にフォローしていればフォローを外す
			$this -> followings() -> detach( $userId ); //detach = delete
			return true;
		}else{
			// 未フォローであれば何もしない
			return false;
		}

	}

}
