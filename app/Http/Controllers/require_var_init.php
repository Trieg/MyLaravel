<?php

$auth				 = \Auth::user();
$auth_id			 = \Auth::user() -> id;
//$myid_objects_relation	 = Relation::where( 'user_id', $auth_id ) -> get();
$auth_id_relation	 = Relation::where( 'user_id', $auth_id ) -> lists( 'other_id' ) -> toarray();

//$your_id			 = User::find( 85 ) -> id;
$your				 = User::find( $view_user );
$your_id			 = $your -> id;
$your_id_relation	 = Relation::where( 'user_id', $your_id ) -> lists( 'other_id' ) -> toarray();

//array_serch 指定した値があった場合、その配列キーを返します
$match_id_relation = Relation::where( 'user_id', array_search( $auth_id, $your_id_relation ) );

//dd($match_id_relation);
