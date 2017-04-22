<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    //
	protected $table	 = 'like';
	protected $fillable	 = [ 'user_id', 'like_id',];
}
