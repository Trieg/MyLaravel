<?php //タブページ ?>

@extends('layouts.app')
@section('content')

<?php
//$auth_user = 0;
?>

<?php //dd( $auth_user );?>
<?php //var_dump( $followings );?>
<?php //var_dump( $test );?>
<?php //dd( $user );?>

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



			<?php //tab  ?>
			<ul class="nav nav-tabs">
                <li>
					<a href="{{ route('users.show', ['id' => $user->id]) }}">Microposts
						<span class="badge">{{ $count_microposts }}</span></a></li>
                <li>
					<a href="{{ route('users.followings', ['id' => $user->id]) }}">Followings
						<span class="badge">{{ $count_followings }}</span></a></li>
                <li>
					<a href="{{ route('users.followers', ['id' => $user->id]) }}">Followers
						<span class="badge">{{ $count_followers }}</span></a></li>
            </ul>

			@yield('tab')

		</ul>

	</div>

</div>

@endsection

