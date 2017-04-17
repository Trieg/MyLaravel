<?php

namespace App\Http\Controllers;

use App\User; //model
use App\Micropost; //model
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UsersController extends Controller{

	//------------------------------

	public function index(){

		$users = User::paginate( 5 );

		//name ユーザー一覧
		return view( 'users.users', [
			'users' => $users,
				] );

	}

	//------------------------------

	public function show( $id ){

		//PHPの配列はcopy on writeなので書き換えれば複製される

		$auth_user	 = \Auth::user();
		$followers	 = $auth_user -> followers;
		
		
		$followings = $auth_user -> followings -> lists( 'id' )->toarray();

		//上記で出来た配列に、自分の id も追加。自分自身のマイクロポストも表示させるため
		$followings += $auth_user -> lists( 'id' )->toarray();
		
		$microposts = Micropost::wherein('user_id',$followings )->orderBy( 'created_at', 'desc' ) -> paginate( 10 );
		//$bbb = (array)$followings;
		//aaa = array_values($bbb);

		//$microposts = Micropost::whereIn( 'user_id', $aaa );
		

		

			

		//->fetch('attributes.id')
		//search - get
		//fetch('attributes.id');
		//fetch($key)
		//attributes
		//$test		 = array_flatten( $followings );
		//$test = array_divide($followings);


		$user = User::find( $id );

		//$microposts = $user -> microposts() ->orderBy( 'created_at', 'desc' ) -> paginate( 10 );

		//

		$count_microposts = $user -> microposts() -> count();

		$data = [
			//'test'				 => $test,
			'auth_user'			 => $auth_user,
			'followers'			 => $followers,
			'followings'		 => $followings,
			'user'				 => $user,
			'microposts'		 => $microposts,
			'count_microposts'	 => $count_microposts,
		];

		$data += $this -> counts( $user );

		//name タブページ
		return view( 'users.show', $data );

	}

	//------------------------------

	public function followings( $id ){
		$user		 = User::find( $id );
		$followings	 = $user -> followings() -> paginate( 10 );

		$data = [
			'user'			 => $user,
			'wings_users'	 => $followings,
		];

		$data += $this -> counts( $user );

		return view( 'users.followings', $data );

	}

	public function followers( $id ){
		$user		 = User::find( $id );
		$followers	 = $user -> followers() -> paginate( 10 );

		$data = [
			'user'		 => $user,
			'wers_users' => $followers,
		];

		$data += $this -> counts( $user );

		return view( 'users.followers', $data );

	}

	//------------------------------

}
