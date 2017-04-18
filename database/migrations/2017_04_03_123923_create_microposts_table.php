<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

//マイグレーション名をキャメルケースに変換したものがクラス名になる
class CreateMicropostsTable extends Migration{

	/**
	 * マイグレーション実行
	 *
	 * @return void
	 */
	public function up(){

		Schema::create( 'microposts', function (Blueprint $table){

			$table -> increments( 'id' );

			$table -> integer( 'user_id' ) -> unsigned() -> index();
			// 外部キー設定
			$table -> foreign( 'user_id' ) -> references( 'id' ) -> on( 'users' );
			
			
			$table -> string( 'user_name' ) ->unique() -> index();
			// 外部キー設定
			$table -> foreign( 'user_name' ) -> references( 'name' ) -> on( 'users' );
			

			$table -> string( 'user_email' ) ->unique() -> index();
			// 外部キー設定
			$table -> foreign( 'user_email' ) -> references( 'email' ) -> on( 'users' );

			$table -> string( 'title' );
			$table -> string( 'content' );
			$table -> string( 'status' );

			$table -> timestamps();

		} );

	}

	public function down(){
		//同じtable名があった時用
		Schema::drop( 'microposts' );

	}

}
