
<ul class="media-list">


	<?php //Helper::dg( $microposts );?>

	@foreach ($microposts as $micropost)
	
	<?php
	/*
	  var_dump($microposts);

	  //id（複数）インスタンス
	  $user = $micropost->user;
	 */
	?>

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

