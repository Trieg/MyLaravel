<?php

namespace App;

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

	
	//user modelのインスタンスで、Micropostsのtableを取得できるようになる
	//例えば、$user->microposts()->all()
	public function microposts(){

		return $this -> hasMany( Micropost::class );

	}

	//第一引数に得られる Model クラス (User::class) を指定
	//第二引数に中間テーブルを指定
	//第三引数に中間テーブルに保存されている自分の id を示すカラム名
	//第四引数に中間テーブルに保存されている関係先の id を示すカラム名
	
	//$user->followings
	public function followings(){
		return $this -> belongsToMany( User::class, 'relation', 'user_id', 'follow_id' ) -> withTimestamps();

	}

	//$user->followers
	public function followers(){
		return $this -> belongsToMany( User::class, 'relation', 'follow_id', 'user_id' ) -> withTimestamps();

	}
	
	//withTimestamps() は中間テーブルにも created_at と updated_at を保存するためのmodelメソッド

	
	public function follow($userId)
    {
        // 既にフォローしているかの確認
        $exist = $this->is_following($userId);
        // 自分自身ではないかの確認
        $its_me = $this->id == $userId;
        
        if ($exist || $its_me) {
            // 既にフォローしていれば何もしない
            return false;
        } else {
            // 未フォローであればフォローする
            $this->followings()->attach($userId); //中間テーブルのレコードを保存／削除
            return true;
        }
    }
	
	public function unfollow($userId)
    {
        // 既にフォローしているかの確認
        $exist = $this->is_following($userId);
        // 自分自身ではないかの確認
        $its_me = $this->id == $userId;
        
        if ($exist && !$its_me) {
            // 既にフォローしていればフォローを外す
            $this->followings()->detach($userId); //中間テーブルのレコードを保存／削除
            return true;
        } else {
            // 未フォローであれば何もしない
            return false;
        }
    }
    
    public function is_following($userId) {
        return $this->followings()->where('follow_id', $userId)->exists();
    }
	
}
