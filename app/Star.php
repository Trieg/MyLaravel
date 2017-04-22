<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Star extends Model
{
    //
	protected $table	 = 'star';
	protected $fillable	 = [ 'user_id', 'star_id', ];
}
