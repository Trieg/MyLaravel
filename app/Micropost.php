<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Micropost extends Model {

	protected $table = 'microposts';
	protected $fillable = ['content', 'user_id', 'title', 'status'];

	//Micropostを持つUserは1人なので、function user()のように単数形userでメソッドを定義

	public function user() {
		return $this->belongsTo(User::class); //依存性の構築
	}

}
