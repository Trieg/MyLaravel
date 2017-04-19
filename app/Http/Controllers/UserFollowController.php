<?php

namespace App\Http\Controllers;

use App\User; //model
use App\Relation; //model
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserFollowController extends Controller{

	public function store( Request $request, $id ){
		
		$date= $this -> user_branch( $id ); //引数の$idは、オブジェクトでなく、intだった（検証済み）
	
		return $date;
		
		//$date = [ 'date' => $test ];
		//return (isset( $date )) ? view( 'test', $date ) : view( 'test' );

	}

}
