<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Relation extends Model{

	protected $table	 = 'relation';
	protected $fillable	 = [ 'user_id', 'other_id', 'follow', 'star' ];

	//belongsToManyで中間テーブルの場合は、子側は何も記述しない

	public function user(){
		return $this -> belongsTo( User::class ); //依存性（hasManyに対応）

	}

}
