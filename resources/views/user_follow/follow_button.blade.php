

@if (Auth::user()->id != $user->id) 

    @if (Auth::user()->is_following($user->id))
	
        {!! Form::open(['route' => ['like.store', $user->id], 'method' => 'delete']) !!}
            {!! Form::submit('Unfollow', ['class' => "btn btn-danger btn-block"]) !!}
        {!! Form::close() !!}
		
    @else
	
        {!! Form::open(['route' => ['like.delete', $user->id]]) !!}
            {!! Form::submit('Follow', ['class' => "btn btn-primary btn-block"]) !!}
        {!! Form::close() !!}
		
    @endif
	
@endif