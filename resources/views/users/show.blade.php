<?php
//name タブページ-micropost
?>

@extends('layouts.p_show')
@section('tab')

			<?php //microposts  ?>
			@if (count($microposts) > 0)
			
			@include('microposts.show_microposts', ['microposts' => $microposts])
			@endif
			

@endsection

