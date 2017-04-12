@extends('layouts.app')
@section('content')


@if (Auth::check())

<?php
/*
  if (isset($bool)) {
  var_dump($instance);
  }
 */
$user = Auth::user();
?>

<div class="row">
	<aside class="col-xs-4" id="title">

		@if(isset($bool))


		{!! Form::model($micropost, ['route' => ['microposts.update', $micropost->id], 'method' => 'put']) !!}

		<?php //echo $micropost->id; ?>

		<div class="form-group">
			{!! Form::label('title', 'タスク名:') !!}
			{!! Form::textarea('title', null,
			['class' => 'form-control', 'rows' => '1']
			) !!}
		</div>

		<div class="form-group">
			{!! Form::label('content', '内容:') !!}
			{!! Form::textarea('content', null,
			['class' => 'form-control', 'rows' => '3']
			) !!}
		</div>

		<div class="form-group">
			{!! Form::select('status', ['いまやる' => 'いまやる', 'すぐやる' => 'すぐやる', 'もう3秒たったぞ！' 
			=> '3秒後にやる'], null, ['placeholder' => '上司「いつやるの？」']
			) !!}

		</div>

		{!! Form::submit('Update', ['class' => 'btn btn-primary btn-info']) !!}
		{!! Form::close() !!}

		@endif
		
		<?php //destoroy  ?>

		@if(isset($micropost))

		<?php //echo 'debug id---'."$micropost->id"; ?>
		<br>
		<?php //echo gettype($micropost) ?>
		<?php //echo is_object($micropost) ?>
		<?php //echo 'debug array---'."$micropost[id]" ?>

		{!! Form::model($micropost, ['route' => ['microposts.destroy', $micropost->id], 'method' => 'delete']) !!}
		{!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
		{!! Form::close() !!}
		@endif


		
		@if(! isset($bool))

		{!! Form::open(['route' => 'microposts.store']) !!}


		<div class="form-group">
			{!! Form::label('title', 'タスク名:') !!}
			{!! Form::textarea('title', old('title'),
			['class' => 'form-control', 'rows' => '1']
			) !!}
		</div>

		<div class="form-group">
			{!! Form::label('content', '内容:') !!}
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

		@endif
		
	</aside>

	<aside class="col-xs-8">
		@include('microposts.show_microposts')
	</aside>



</div>

@else

<div class="center jumbotron">

	<div class="text-center">
		
		<h1>Welcome to the Microposts</h1>

		{!! link_to_route('signup.get', 'Sign up now!', null, ['class' => 'btn btn-lg btn-primary']) !!}
		
	</div>

</div>
@endif

@endsection