<?php

namespace App\Http\Controllers;

use App\User; //model
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


		$auth_user	 = \Auth::user();
		$followers	 = $auth_user -> followers();
		$user		 = User::find( $id );

		$microposts = $user -> microposts() -> orderBy( 'created_at', 'desc' ) -> paginate( 10 );

		//

		$count_microposts = $user -> microposts() -> count();

		$data = [
			'auth_user'			 => $auth_user,
			'followers'			 => $followers,
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
