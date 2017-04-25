<?php

namespace App\Http\Controllers;

use App\User; //model
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class WelcomeController extends Controller{

	public function index(){

		//viewで使う時は、連想配列のキーを、ダイレクトに使える
		//controller側 : $date->user
		//view側 : $user

		$data = [];
		if( \Auth::check() ){
			$auth_user		 = \Auth::user();
			$microposts	 = $auth_user -> feed_microposts() -> orderBy( 'created_at', 'desc' ) -> paginate( 10 );

			$data = [
				'auth_user'		 => $auth_user,
				'microposts' => $microposts,
			];
		}
		return view( 'welcome', $data );

	}

}
