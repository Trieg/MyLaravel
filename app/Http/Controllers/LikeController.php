<?php

namespace App\Http\Controllers;

use App\User; //model
use App\Relation; //model
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class LikeController extends Controller{

	public function store( Request $request, $id ){
		\Auth::user() -> do_like( $id );
		return redirect() -> back();

	}

	public function destroy( $id ){
		\Auth::user() -> not_like( $id );
		return redirect() -> back();

	}

	//--------------------WelcomeController--------------------
	
	public function auth_to_you_like( $id ){

		$user				 = User::find( $id );
		$auth_to_you_like	 = $user -> auth_to_you_like() -> paginate( 10 );

		$data = [
			'user'	 => $user,
			'users'	 => $auth_to_you_like,
		];

		$data += $this -> count( $user );

		return view( 'users.followings', $data );

	}

	public function you_to_auth_like( $id ){

		$user				 = User::find( $id );
		$you_to_auth_like	 = $user -> you_to_auth_like() -> paginate( 10 );

		$data = [
			'user'	 => $user,
			'users'	 => $you_to_auth_like,
		];

		$data += $this -> count( $user );

		return view( 'users.followers', $data );

	}

}
