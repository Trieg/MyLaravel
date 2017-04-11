
@extends('layouts.app')

@section('content')
<div class="row">

	<aside class="col-xs-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">{{ $user->name }}</h3>
			</div>
			<div class="panel-body">
				<img class="media-object img-rounded img-responsive" src="{{ Gravatar::src($user->email, 500) }}" alt="">
			</div>
		</div>
	</aside>

	<div class="col-xs-8">

		<ul class="nav nav-tabs nav-justified">

			<?php
			///users/{id} という URL の場合には、 class="active" にするコードです。 
			//Bootstrap のタブでは class="active" を付与することで、このタブが今開いているページだとわかりやすくなります。 
			//Request::is はその判定のために使用しています。
			//routeを採用した理由
			//理由は、 <span class="badge">{{ $count_microposts }}</span> を含めたリンク名うまく表示されなかったから
			?>

			<li role="presentation" class="{{ Request::is('users/' . $user->id) ? 'active' : '' }}">
				<a href="{{ route('users.show', ['id' => $user->id]) }}">Microposts 
					<span class="badge">{{ $count_microposts }}</span>
				</a></li>
			<li><a href="#">Followings</a></li>
			<li><a href="#">Followers</a></li>
		</ul>

		@if (count($microposts) > 0)
		
		@include('microposts.show_microposts', ['microposts' => $microposts])
		
		@endif
	</div>

</div>
@endsection