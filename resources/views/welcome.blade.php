
@extends('layouts.app')
@section('content')

<?php //ゲスト or 登録ユーザーのboolチェック  ?>
@if (Auth::check())

<div class="row">
	<aside class="col-xs-4" id="title">

		<?php //編集のbool(false)チェック ?>

		@if(! isset($auth_bool))

		{!! Form::open(['route' => 'microposts.store']) !!}

		@include('microposts.form_microposts')

		{!! Form::submit('Post', ['class' => 'btn btn-primary btn-block']) !!}
		{!! Form::close() !!}

		@endif

		<?php //編集のbool(true)チェック  ?>
		@if(isset($auth_bool))

		{!! Form::model($micropost, ['route' => ['microposts.update', $micropost->id], 'method' => 'put']) !!}

		@include('microposts.form_microposts')

		{!! Form::submit('Update', ['class' => 'btn btn-primary btn-info']) !!}
		{!! Form::close() !!}

		<?php //destoroy ?>
		<br>
		{!! Form::model($micropost, ['route' => ['microposts.destroy', $micropost->id], 'method' => 'delete']) !!}
		{!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
		{!! Form::close() !!}
		@endif

	</aside>

	<?php //show micropost  ?>
	<aside class="col-xs-8">

		<ul>

			@foreach ($microposts as $micropost)

			<li class="media">

				<div class="media-left">
					<img class="media-object img-rounded" src="{{ Gravatar::src($user->email, 50) }}" alt="">
				</div>

				<div class="media-body">

					<div>
						<?php //ユーザー名 ?>
						{!! link_to_route('users.show', $user->name, ['id' => $user->id]) !!} 
						<span class="text-muted">created at {{ $micropost->created_at }}</span>
					</div>

					<div>
						<p>
							{!! nl2br(e($micropost->title)) !!}
						</p>
						<p>
							{!! nl2br(e($micropost->content)) !!}
						</p>
						<p>
							{!! nl2br(e($micropost->status)) !!}
						</p>
					</div>

					<div>
						<?php //update  ?>

						@if (Auth::user()->id == $micropost->user_id)

						{!! Form::open(['route' => ['microposts.edit', $micropost->id], 'method' => 'get']) !!}
						{!! Form::submit('Update', ['class' => 'btn btn-info btn-xs']) !!}
						{!! Form::close() !!}

						@endif
					</div>
				</div>
			</li>

			@endforeach

		</ul>

		<?php //ペジネーション ?>
		{!! $microposts->render() !!}

	</aside>

</div>
@endif


<?php //ゲスト、登録ユーザーのboolチェック  ?>
@if (! Auth::check())

<div class="center jumbotron">

	<div class="text-center">

		<h1>Welcome to the Microposts</h1>

		{!! link_to_route('signup.get', 'Sign up now!', null, ['class' => 'btn btn-lg btn-primary']) !!}

	</div>

</div>
@endif


@endsection