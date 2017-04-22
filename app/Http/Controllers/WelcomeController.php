<?php

namespace App\Http\Controllers;

use App\User; //model

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class WelcomeController extends Controller
{

    public function index()
    {
				
		//viewで使う時は、連想配列のキーを、ダイレクトに使える
		//controller側 : $date->user
		//view側 : $user
		
        $data = [];
		
        if (\Auth::check()) {
			
            $user = \Auth::user();
			$microposts = $user->micropost()->orderBy('created_at', 'desc')->paginate(5);

            $data = [
                'user' => $user,
                'microposts' => $microposts,

            ];
        }
        return view('welcome', $data);
    }
	
}
