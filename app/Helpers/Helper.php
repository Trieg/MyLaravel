<?php

namespace App\Helpers;

class Helper{

	/**
	 * XXXする関数
	 *
	 * @param string $value
	 * @return string
	 */
	public static function create_counter(){
		$count	 = 0;
		$sum	 = function() use (&$count){ //無名関数で、スコープ外の変数を縛ると、メモリに残る！
			return ++ $count;
		};
		return $sum;
		//呼び出し側。$counter = Helper::create_counter(); //関数を変数に入れて、インスタンスを作る
	}

	public static function create_debug_js(){
		$string = '
		<link rel="stylesheet" href="highlight/styles/hybrid.css">
		<script src="highlight/highlight.pack.js"></script>
		';

		echo $string;
	}

	public static function dg( $var = null ){
		$debug_bool = true;
		
		$exist = isset($var);

		if( $debug_bool & $exist ){
			var_dump( $var );
		}else{
			return;
		}
	}

}
