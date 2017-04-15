@extends('layouts.app')
@section('content')

<?php //タブページ ?>

<?php
//使える変数一覧
?>

@section('content')
<div class="row">

	<?php //写真部分  ?>
	<aside class="col-xs-4">
		<div class="panel panel-default">

			<div class="panel-heading">
				<h3 class="panel-title">{{ $user->name }}</h3>
			</div>
			<div class="panel-body">
				<img class="media-object img-rounded img-responsive" src="{{ Gravatar::src($user->email, 500) }}" alt="">
			</div>

			<?php //follow button  ?>
			@include('user_follow.follow_button', ['user' => $user])

		</div>
	</aside>

	<div class="col-xs-8">

		<ul class="nav nav-tabs nav-justified">

			<?php
			///users/{id} という URL の場合には、 class="active" にするコードです。 Bootstrapのタブに使う
			//Request::is はその判定のために使用しています。
			?>

			<ul class="nav nav-tabs nav-justified">
                <li role="presentation" class="{{ Request::is('users/' . $user->id) ? 'active' : '' }}"><a href="{{ route('users.show', ['id' => $user->id]) }}">Microposts <span class="badge">{{ $count_microposts }}</span></a></li>
                <li role="presentation" class="{{ Request::is('users/*/followings') ? 'active' : '' }}"><a href="{{ route('users.followings', ['id' => $user->id]) }}">Followings <span class="badge">{{ $count_followings }}</span></a></li>
                <li role="presentation" class="{{ Request::is('users/*/followers') ? 'active' : '' }}"><a href="{{ route('users.followers', ['id' => $user->id]) }}">Followers <span class="badge">{{ $count_followers }}</span></a></li>
            </ul>

		</ul>

		<?php //follow button  ?>
		@include('user_follow.follow_button', ['user' => $user])

		@if (count($microposts) > 0)

		@include('microposts.show_microposts', ['microposts' => $microposts])

		@endif
	</div>

</div>

@endsection