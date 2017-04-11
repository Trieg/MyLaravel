<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class WelcomeController extends Controller
{

    public function index()
    {
		
		//$dateをviewに渡してる
        $data = [];
		
        if (\Auth::check()) {
			
            $user = \Auth::user();
			$microposts = $user->microposts()->orderBy('created_at', 'desc')->paginate(10);
			//$todos = $user->todos()->orderBy('title')->paginate(5);

            $data = [
                'user' => $user,
                'microposts' => $microposts,
				//'todos' => $todos
            ];
        }
        return view('welcome', $data);
    }
	
}
