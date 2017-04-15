<?php

namespace App\Http\Controllers;

use App\User; //model

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UsersController extends Controller {

	public function index() {

		$users = User::paginate(5);

		return view('users.index', [
			'users' => $users,
		]);
	}

	//------------------------------

    public function show($id)
    {
        $user = User::find($id);
        $microposts = $user->microposts()->orderBy('created_at', 'desc')->paginate(10);
        $count_microposts = $user->microposts()->count();
        
        $data = [
            'user' => $user,
            'microposts' => $microposts,
			'count_microposts' => $count_microposts,
        ];
        
        $data += $this->counts($user);
        
        return view('users.show', $data);
    }
}
