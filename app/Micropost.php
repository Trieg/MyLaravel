<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Micropost extends Model{

	protected $table	 = 'micropost';
	protected $fillable	 = [ 'user_id', 'title', 'content', 'status' ];

	public function user(){
		return $this -> belongsTo( User::class );

	}

}
