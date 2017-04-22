<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Relation extends Migration{

	public function up(){
		Schema::create( 'relation', function (Blueprint $table){

			//primary
			$table -> increments( 'id' );

			$table -> integer( 'user_id' ) -> unsigned() -> index();
			$table -> integer( 'other_id' ) -> unsigned() -> index();

			$table -> string( 'dm' );
			$table -> boolean('done');

			$table -> timestamps();
		} );

	}

	public function down(){

		Schema::drop( 'relation' );

	}

}
