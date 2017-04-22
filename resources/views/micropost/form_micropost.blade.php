<div class="form-group">
	{!! Form::label('title', 'Todo:') !!}
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
	{!! Form::select('status', ['impotant' => 'impotant', 
	'nomal' => 'nomal', 
	'NOT to do' => 'NOT to do'], null, ['placeholder' => '優先度']
	) !!}

</div>
