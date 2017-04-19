<?php

namespace App\Http\Controllers;

use App\User; //model
use App\Micropost; //model
use App\Relation; //model
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UsersController extends Controller{

	//------------------------------

	public function all(){

		$users = User::paginate( 5 );

		$date = [
			'users'=>$users
		];
		return view( 'users.all', $date);
	}

	//------------------------------

	public function show( $id ){

		$auth_user	 = \Auth::user();// -> id;
		$user		 = User::find( $id );

		//$microposts			 = Micropost::wherein( 'user_id', $followings ) -> orderBy( 'created_at', 'desc' ) -> paginate( 10 );
		$microposts			 = $user -> microposts() -> orderBy( 'created_at', 'desc' ) -> paginate( 10 );
		$count_microposts	 = $user -> microposts() -> count();

		$data = [
			//'followers'		 => $followers,
			//'followings'		 => $followings,
			'auth_user'			 => $auth_user,
			'user'				 => $user,
			'microposts'		 => $microposts,
			'count_microposts'	 => $count_microposts,
		];

		return view( 'users.show', $data );

	}
}
	//------------------------------

/*
	  public function followings( $id ){
		  
	  $user		 = User::find( $id );
	  
	  $followings	 = 0;

	  $data = [
	  'user'			 => $user,
	  'wings_users'	 => $followings,
	  ];

	  //$data += $this -> counts( $user );

	  return view( 'users.followings', $user );

	  }

	  public function followers( $id ){
	  $user		 = User::find( $id );
	  $followers	 = 0;

	  $data = [
	  'user'		 => $user,
	  'wers_users' => $followers,
	  ];

	  $data += $this -> counts( $user );

	  return view( 'users.followers', $data );

	  }


	//------------------------------

}