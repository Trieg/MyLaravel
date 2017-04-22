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
		return $this -> belongsToMany( User::class, 'like', 'user_id', 'like_id' ) -> withTimestamps();

	}

	//$user->you_to_auth
	public function you_to_auth_like(){
		return $this -> belongsToMany( User::class, 'like', 'like_id', 'user_id' ) -> withTimestamps();

	}

	//--------------------
	
	public function is_like( $user_id ){
		
		return $this -> auth_to_you_like()-> where( 'like_id', $user_id ) -> exists();

	}

	public function do_like( $user_id ){
		// 既にフォローしているかの確認
		$exist	 = $this -> is_like( $user_id );
		// 自分自身ではないかの確認
		$its_me	 = $this -> id == $user_id;

		if( $exist || $its_me ){
			// 既にフォローしていれば何もしない
			return false;
		}else{
			// 未フォローであればフォローする
			$this -> auth_to_you_like() -> attach( $user_id ); //attach = save
			return true;
		}

	}

	public function not_like( $user_id ){
		// 既にフォローしているかの確認
		$exist	 = $this -> is_like( $user_id );
		// 自分自身ではないかの確認
		$its_me	 = $this -> id == $user_id;

		if( $exist && ! $its_me ){
			// 既にフォローしていればフォローを外す
			$this -> auth_to_you_like() -> detach( $user_id ); //detach = delete
			return true;
		}else{
			// 未フォローであれば何もしない
			return false;
		}

	}

}
