
@extends('layouts.app')

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

			<li role="presentation" class="{{ Request::is('users/' . $user->id) ? 'active' : '' }}">
				<a href="{{ route('users.show', ['id' => $user->id]) }}">Microposts 
					<span class="badge">{{ $count_microposts }}</span>
				</a></li>
			<li><a href="#">Followings</a></li>
			<li><a href="#">Followers</a></li>
		</ul>
		
		<?php //follow button  ?>
		@include('user_follow.follow_button', ['user' => $user])

		@if (count($microposts) > 0)

		@include('microposts.show_microposts', ['microposts' => $microposts])

		@endif
	</div>

</div>
@endsection