

@if (Auth::user()->id != $user->id) 

{!! Form::open(['route' => ['follow.store', $user->id], 'method' => 'post']) !!}

{!! Form::submit('follow', ['class' => "btn btn-danger btn-block"]) !!}

{!! Form::close() !!}

@endif
