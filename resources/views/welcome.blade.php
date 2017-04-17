<?php //トップページ ?>

@extends('layouts.app')
@section('content')

<?php
//使える変数一覧
?>

<?php //ゲスト、登録ユーザーのboolチェック  ?>
@if (Auth::check())

<?php
$user = Auth::user();
?>

<div class="row">
	<aside class="col-xs-4" id="title">

		<?php //編集のboolチェック  ?>

		@if(! isset($auth_bool))

		{!! Form::open(['route' => 'microposts.store']) !!}

		@include('microposts.form_microposts')

		{!! Form::submit('Post', ['class' => 'btn btn-primary btn-block']) !!}
		{!! Form::close() !!}

		@endif

		<?php //編集のboolチェック  ?>
		@if(isset($auth_bool))

		{!! Form::model($micropost, ['route' => ['microposts.update', $micropost->id], 'method' => 'put']) !!}

		<?php //echo $micropost->id; ?>

		@include('microposts.form_microposts')

		{!! Form::submit('Update', ['class' => 'btn btn-primary btn-info']) !!}
		{!! Form::close() !!}

		@endif

		<?php //destoroy  ?>

		@if(isset($micropost))
		<br>
		{!! Form::model($micropost, ['route' => ['microposts.destroy', $micropost->id], 'method' => 'delete']) !!}
		{!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
		{!! Form::close() !!}
		@endif

	</aside>

	<aside class="col-xs-8">
		<?php //show micropost  ?>
		@include('microposts.show_microposts')
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