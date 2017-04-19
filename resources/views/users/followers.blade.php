<?php //タブページ-followers ?>

@extends('layouts.p_show')
@section('tab')

<?php
//var_dump( $wers_users );
?>

<?php /*
@foreach ($wers_users as $f_user)

<li class="media">

	<div class="media-left">
		<img class="media-object img-rounded" src="{{ Gravatar::src($f_user->email, 50) }}" alt="">
	</div>

	<div class="media-body">

		<div>
			{{ $f_user->name }}
		</div>

		<div>
			<p>{!! link_to_route('users.show', 'View profile', ['id' => $f_user->id]) !!}</p>
		</div>

	</div>

</li>
@endforeach


@endsection


