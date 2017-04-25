<?php //タブページ-following ?>

@extends('layouts.p_show')
@section('tab')

			

@foreach ($users as $user)

    <li class="media">
		
        <div class="media-left">
            <img class="media-object img-rounded" src="{{ Gravatar::src($user->email, 50) }}" alt="">
        </div>
		
        <div class="media-body">
			
            <div>
                {{ $user->name }}
            </div>
			
            <div>
                <p>{!! link_to_route('users.show', 'View profile', ['id' => $user->id]) !!}</p>
            </div>
			
        </div>
		
    </li>
	
@endforeach

<?php //ペジネーション ?>
{!! $users->render() !!}

@endsection
