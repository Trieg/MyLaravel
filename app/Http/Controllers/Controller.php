<?php

namespace App\Http\Controllers;

use App\User; //model
use App\Micropost; //model
use App\Relation; //model
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class Controller extends BaseController{

	use AuthorizesRequests,
	 DispatchesJobs,
	 ValidatesRequests;
	
	//明日のテスト
	//class直下に変数を置いて、クロージャーでアドレス渡しする。

	//ユーザーの照合の分岐
	public function user_branch( $view_user ){

		//request('/app/Http/Controllers/require_var_init.php'); //NG

		$auth				 = \Auth::user();
		$auth_id			 = \Auth::user() -> id;
		//$myid_objects_relation	 = Relation::where( 'user_id', $auth_id ) -> get();
		$auth_id_relation	 = Relation::where( 'user_id', $auth_id ) -> lists( 'other_id' ) -> toarray();

		//$your_id			 = User::find( 85 ) -> id;
		$your				 = User::find( $view_user );
		$your_id			 = $your -> id;
		$your_id_relation	 = Relation::where( 'user_id', $your_id ) -> lists( 'other_id' ) -> toarray();

		//行の抽出
		$match_id_relation = Relation::where( 'user_id', array_search( $auth_id, $your_id_relation ) );

		//状態の伝達（follow, star,などbool関係）
		if( in_array( $auth_id, $your_id_relation ) ){
			//relationがあれば、boolを返す
			$date = [
				'bool_follow'	 => ( bool )$match_id_relation -> follow,
				'bool_star'		 => ( bool )$match_id_relation -> star,
			];
			return $date;
		}else{
			//何もなし
			$date = [ 'bool_no_relation' => true ];
			return $date;
		}

	}

	public function toggle_follow( $view_user ){

		$auth				 = \Auth::user();
		$auth_id			 = \Auth::user() -> id;
		//$myid_objects_relation	 = Relation::where( 'user_id', $auth_id ) -> get();
		$auth_id_relation	 = Relation::where( 'user_id', $auth_id ) -> lists( 'other_id' ) -> toarray();

		//$your_id			 = User::find( 85 ) -> id;
		$your				 = User::find( $view_user );
		$your_id			 = $your -> id;
		$your_id_relation	 = Relation::where( 'user_id', $your_id ) -> lists( 'other_id' ) -> toarray();

		//array_serch 指定した値があった場合、その配列キーを返します
		$match_id_relation = Relation::where( 'user_id', array_search( $auth_id, $your_id_relation ) );

		//何度もフォローさせない && 自分自身をフォローさせない
		if( $auth_id != $your_id ){
			if( ! in_array( $your_id, $auth_id_relation ) ){
				//true処理
				Relation::create( [
					'user_id'	 => $auth_id,
					'other_id'	 => $your_id,
					'follow'	 => 'ture'
				] );
				return $myid = 'followをtureしたよ'; //たぶん出来た。後でテストして！！
			}else{
				//false処理
				//$yourid -> delete();
				return $myid = 'followをfalseたよ';
			}
		}else{
			//エラー用の処理
			return $myid = 'エラーだよ';
		}

	}


	public function counts( $user ){
		$count_microposts = $user -> microposts() -> count();
		//$count_followings = $user->followings()->count();
		//$count_followers = $user->followers()->count();

		return [
			'count_microposts' => $count_microposts,
				//'count_followings' => $count_followings,
				//'count_followers' => $count_followers,
		];

	}

}
