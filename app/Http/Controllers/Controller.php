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

	public function init_var( int $view_user ): array{

		$auth				 = \Auth::user(); //the model
		$auth_id			 = \Auth::user() -> id; //int
		$auth_id_relation	 = Relation::where( 'user_id', $auth_id ); //collection

		$your				 = User::find( $view_user ); //the model
		$your_id			 = $your -> id; //int
		$your_id_relation	 = Relation::where( 'user_id', $your_id ); //collection
		//authidとyouridのマッチした行の抽出
		$match_id_relation	 = $auth_id_relation -> where( 'other_id', $your_id );
		//followの抽出
		$match_follow		 = $match_id_relation -> where( 'follow', 1 );

		return $date = compact(
				'auth', 'auth_id', 'auth_id_relation', 'your', 'your_id', 'your_id_relation', 'match_id_relation', 'match_follow'
		);

	}

	//ユーザーの照合の分岐
	public function is_relation( int $view_user ): array{

		extract( $this -> init_var( $view_user ) );

		//
		if( in_array( $auth_id, $your_id_relation ) ){
			$date = [
				'bool_follow'	 => ( bool )$match_id_relation -> follow,
				'bool_star'		 => ( bool )$match_id_relation -> star,
			];
			return $date;
			//
		}else{
			$date = [];
			return $date;
		}

	}

	public function toggle_relation_done( $view_user ){

		extract( $this -> init_var( $view_user ) );

		//何度もフォローさせない && 自分自身をフォローさせない
		if( $auth_id != $your_id ){
			if( ! in_array( $your_id, $auth_id_relation ) ){
				//true処理
				Relation::create( [
					'user_id'	 => $auth_id,
					'other_id'	 => $your_id,
					'follow'	 => 'ture'
				] );
				return $myid = 'followをtureしたよ';
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

	public function count( $viwe_user ){
		
		$count_micropost		 = $viwe_user -> micropost() -> count();
		$count_auth_to_you_like	 = $viwe_user -> auth_to_you_like() -> count();
		$count_you_to_auth_like	 = $viwe_user -> you_to_auth_like() -> count();

		return $data = compact(
				'count_micropost', 'count_auth_to_you_like', 'count_you_to_auth_like'
		);

	}

}
