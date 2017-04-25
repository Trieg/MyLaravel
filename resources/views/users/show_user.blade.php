
@extends('layouts.p_show')
@section('tab')


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

		</div>

	</li>

	@endforeach

</ul>

<?php //ペジネーション ?>
{!! $microposts->render() !!}

@endsection
