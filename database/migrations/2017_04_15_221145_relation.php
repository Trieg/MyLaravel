<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Relation extends Migration{

	public function up(){
		Schema::create( 'relation', function (Blueprint $table){

			//primary
			$table -> increments( 'id' );

			$table -> integer( 'user_id' ) -> unsigned() -> index();
			$table -> foreign( 'user_id' ) -> references( 'id' ) -> on( 'users' ) -> onDelete( 'cascade' );

			$table -> integer( 'other_id' ) -> unsigned() -> index();

			$table -> boolean( 'follow' );
			$table -> boolean( 'star' );

			$table -> timestamps();
		} );

	}

	public function down(){

		Schema::drop( 'user_follow' );

	}

}
