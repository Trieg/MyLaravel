<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreateMicropostTable extends Migration{

	/**
	 * マイグレーション実行
	 *
	 * @return void
	 */
	public function up(){

		Schema::create( 'micropost', function (Blueprint $table){

			$table -> increments( 'id' );

			$table -> integer( 'user_id' ) -> unsigned() -> index();
			//$table -> foreign( 'user_id' ) -> references( 'id' ) -> on( 'users' ) -> onDelete( 'cascade' );

			$table -> string( 'title' );
			$table -> string( 'content' );
			$table -> string( 'status' );

			$table -> timestamps();
		} );

	}

	public function down(){

		Schema::drop( 'micropost' );

	}

}
