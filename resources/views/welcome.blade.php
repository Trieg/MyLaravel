@extends('layouts.app')


@section('content')

@if (Auth::check())

<?php $user = Auth::user(); ?>
<div class="row">


	<aside class="col-xs-4" id="title">
		{!! Form::open(['route' => 'microposts.store']) !!}

		<div class="form-group">
			{!! Form::textarea('title', old('title'),
			['class' => 'form-control', 'rows' => '1']
			) !!}
		</div>

		<div class="form-group">
			{!! Form::textarea('content', old('content'),
			['class' => 'form-control', 'rows' => '3']
			) !!}
		</div>

		<div class="form-group">
			{!! Form::select('status', ['いまやる' => 'いまやる', 'すぐやる' => 'すぐやる', 'もう3秒たったぞ！' 
			=> '3秒後にやる'], null, ['placeholder' => '上司「いつやるの？」']
			) !!}

		</div>

		{!! Form::submit('Post', ['class' => 'btn btn-primary btn-block']) !!}
		{!! Form::close() !!}
	</aside>



	<aside class="col-xs-8">
		@include('microposts.show_microposts')
	</aside>



</div>

@else

<div class="center jumbotron">

	<div class="text-center">
		<h1>Welcome to the Microposts</h1>

		<?php
		//1 viewのpath（routeのnameでも通る）、2 コンテンツ、
		//3 URLの末尾「?」を「第3引数名」で分岐、4 ['class' => 'btn btn-primary']) 
		?>

		{!! link_to_route('signup.get', 'Sign up now!', null, ['class' => 'btn btn-lg btn-primary']) !!}
	</div>

</div>
@endif

@endsection