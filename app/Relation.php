<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Relation extends Model{

	protected $table	 = 'relation';
	protected $fillable	 = [ 'user_id', 'other_id', 'follow', 'star' ];

}
