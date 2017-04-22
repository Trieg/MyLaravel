

@if (Auth::user()->id != $user->id) 

	<?php //querybuilderでboolの判定 ?>
    @if (Auth::user()->is_like($user->id))
	
        {!! Form::open(['route' => ['like.delete', $user->id], 'method' => 'delete']) !!}
            {!! Form::submit('Unfollow', ['class' => "btn btn-danger btn-block"]) !!}
        {!! Form::close() !!}
		
    @else
	
        {!! Form::open(['route' => ['like.store', $user->id]]) !!}
            {!! Form::submit('Follow', ['class' => "btn btn-primary btn-block"]) !!}
        {!! Form::close() !!}
		
    @endif
	
@endif