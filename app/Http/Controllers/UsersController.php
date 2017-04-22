<?php

namespace App\Http\Controllers;

use App\User; //model
use App\Micropost; //model
use App\Relation; //model
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UsersController extends Controller{

	public function all(){

		$users = User::paginate( 5 );

		$date = [
			'users' => $users
		];
		return view( 'users.show_user_all', $date );

	}

	public function show( $id ){


		extract( $this -> init_var( $id ) );

		extract( $this -> count( $your ) );

		//RULE 全て単数形で統一（日本人の英語感覚を優先する）
		//TODO複数形をリファクタリング
		$microposts = $your -> micropost() -> orderBy( 'created_at', 'desc' ) -> paginate( 10 );

		//viewへの変数渡しはcompact()しないで、変数名を独立させて、リファクタリングを楽にする
		$data = [
			'auth_user'						 => $auth,
			'user'							 => $your,
			'microposts'					 => $microposts,
			'count_micropost'				 => $count_micropost,
			'count_auth_to_you_like'		 => $count_auth_to_you_like,
			'count_you_to_auth_like'	 => $count_you_to_auth_like,
				//'count_star'		 => $count_star,
		];

		return view( 'users.show_user', $data );

	}

	public function auth_to_you_like( $id ){

		$user				 = User::find( $id );
		$auth_to_you_like	 = $user -> auth_to_you_like() -> paginate( 10 );

		$data = [
			'user'	 => $user,
			'users'	 => $auth_to_you_like,
		];

		$data += $this -> counts( $user );

		return view( 'users.followings', $data );

	}

	public function you_to_auth_like( $id ){

		$user				 = User::find( $id );
		$you_to_auth_like	 = $user -> you_to_auth_like() -> paginate( 10 );

		$data = [
			'user'	 => $user,
			'users'	 => $you_to_auth_like,
		];

		$data += $this -> counts( $user );

		return view( 'users.followers', $data );

	}

}
