<?php

namespace App\Http\Controllers;

use App\Micropost; //model
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App;

class MicropostController extends Controller{

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store( Request $request ){

		$this -> validate( $request, [
			'title'		 => 'required|max:255',
			'content'	 => 'required|max:255',
			'status'	 => 'required|max:255',
		] );

		$request -> user() -> micropost() -> create( [
			'title'		 => $request -> title,
			'content'	 => $request -> content,
			'status'	 => $request -> status,
		] );
		
		//$user->fill($request->all())->save();

		return redirect( '/' );

	}

	public function edit( $id ){


		$data = [];

		if( \Auth::check() ){

			$user		 = \Auth::user();
			$micropost	 = $user -> micropost() -> orderBy( 'created_at', 'desc' ) -> paginate( 10 );

			$aaa = Micropost::find( $id );

			$data = [
				'user'		 => $user,
				'microposts' => $micropost,
				'micropost'	 => $aaa,
				'auth_bool'	 => true,
			];
		}
		
		return view( 'welcome', $data );

	}

	public function update( Request $request, $id ){

		if( isset( $id ) ){

			$instance = Micropost::find( $id );
			//連想配列で入っているので、$requestからkeyを指定して取り出し、インスタンスへの再代入、最後にDB保存

			$instance -> content	 = $request -> content;
			$instance -> title	 = $request -> title;
			$instance -> status	 = $request -> status;

			$instance -> save();
		}

		return redirect( '/' );

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy( $id ){

		$instance = Micropost::find( $id );

		if( \Auth::user() -> id === $instance -> user_id ){

			$instance -> delete();
		}

		return redirect( '/' );

	}

}
