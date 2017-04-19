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

	//user modelのインスタンスで、Micropostsのtableを取得できるようになる。下記のように取得
	//$user->microposts()->column
	public function microposts(){

		return $this -> hasMany( Micropost::class );

	}

	//$user->relation()->column
	public function relation(){

		return $this -> hasMany( Relation::class );

	}

	//オブジェクトが2つでCollection。オブジェクトが１つでBuilder（hasmanyもbuilder）（クエリービルダー）
	//hasmany の取り除き型。get、first、findなど。
	//オブジェクトを1つにしてBuilderすれば、$user->nameでカラム取得もOK



}

//第一引数に得られる Model クラス (User::class) を指定
//第二引数に中間テーブルを指定
//第三引数に中間テーブルに保存されている自分の id を示すカラム名
//第四引数に中間テーブルに保存されている関係先の id を示すカラム名
//
////$user->followings
//public function followings(){
//return $this -> belongsToMany( User::class, 'relation', 'user_id', 'follow_id' ) -> withTimestamps();
//
//}
//
////$user->followers
//public function followers(){
//return $this -> belongsToMany( User::class, 'relation', 'follow_id', 'user_id' ) -> withTimestamps();
//
//}
//
//withTimestamps() は中間テーブルにも created_at と updated_at を保存するためのmodelメソッド
//また中間テーブルへの保存は、detach attachを使用する
 
 
