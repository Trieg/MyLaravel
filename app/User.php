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

	//オブジェクトが2つでcollection。オブジェクトが１つで、builder（hasmanyもbuilder）（クエリービルダー）
	//hasmany の取り除き型。get、first、findなど。getは、運用できる用に、皮を剥ぐかんじです
	//分解（builder）すれば、$user->name;もOK

	public function follow(){

		$auth_id		 = \Auth::user() -> id; //authのidを取り出して
		$myid_objects	 = Relation::where( 'user_id', $auth_id ) -> get();
		$myid			 = Relation::where( 'user_id', $auth_id ) -> lists( 'other_id' ) -> toarray();
		//$yourid = $instance->id;
		$yourid			 = User::find( 85 ) -> id;

		//何度もフォローさせない && 自分自身をフォローさせない

		if( $yourid != $myid ){
			if( ! in_array( $yourid, $myid ) ){
				//true処理
				Relation::create( [
					'user_id'	 => $auth_id,
					'other_id'	 => $yourid,
					'follow'	 => 'ture'
				] );
				return $myid = 'followをtureしたよ'; //たぶん出来た。後でテストして！！
			}else{
				//false処理
				$yourid -> delete();
				return $myid = 'followをfalseたよ';
			}
		}else{
			//エラー用の処理
			return $myid = 'エラーだよ';
		}

		return $myid;

	}

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
 
 
