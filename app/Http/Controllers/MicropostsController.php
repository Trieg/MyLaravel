<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;

use App;

use App\Micropost; //modelのエイリアス追加

class MicropostsController extends Controller {

	

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		
		$this->validate($request, [
			'title' => 'required|max:255',
			'content' => 'required|max:255',
			'status' => 'required|max:255',
		]);

		$request->user()->microposts()->create([
			'title' => $request->title,
			'content' => $request->content,
			'status' => $request->status,
		]);

		return redirect('/');
	}

	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		
		$micropost = Micropost::find($id);
		

		if (\Auth::user()->id === $micropost->user_id) {
			$micropost->delete();
		}


		return redirect()->back();
	}

}
