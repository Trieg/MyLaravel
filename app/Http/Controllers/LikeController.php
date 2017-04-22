<?php

namespace App\Http\Controllers;

use App\User; //model
use App\Relation; //model
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class LikeController extends Controller{

    public function store(Request $request, $id)
    {
        \Auth::user()->do_like($id);
        return redirect()->back();
    }

    public function destroy($id)
    {
        \Auth::user()->not_like($id);
        return redirect()->back();
    }

}


