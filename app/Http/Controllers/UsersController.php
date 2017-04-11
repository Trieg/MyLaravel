<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User; //modelのエイリアス追加。以降、ファサードとして使用できる


class UsersController extends Controller {

	public function index() {

		$users = User::paginate(10); //$users = User::all();はつらい。ページネーションを採用

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
