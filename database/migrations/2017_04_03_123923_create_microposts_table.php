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

			//負の値になることは無いので、unsigned()
			$table -> integer( 'user_id' ) -> unsigned() -> index();
			
			$table -> string( 'title' );
			$table -> string( 'content' );
			$table -> string( 'status' );

			$table -> timestamps();

			// 外部キー制約
			// 
			//外部キー制約を設定した場合、親テーブルのカラムの値は子テーブルから参照されることになります。
			//そこで親テーブル側のカラムの値を更新したり削除したりする場合には注意が必要
			//
            //user_idを親

			$table -> foreign( 'user_id' ) -> references( 'id' ) -> on( 'users' );


			//onDelete()
			//親テーブルに対して更新を行うと子テーブルで同じ値を持つカラムの値も合わせて更新される
		} );

	}

	public function down(){
		//同じtable名があった時用
		Schema::drop( 'microposts' );

	}

}
