<?php
//$v_TaskContent = findしてきた単体インスタンス
?>

    {!! link_to_route('ViTask.index', 'ホームに戻る', null, ['class' => 'btn btn-primary']) !!}
    <hr>

    <table class="table table-bordered">
        <tr>
            <th>id</th>
            <td>{{ $v_TaskContent->id }}</td>
        </tr>
        <tr>
            <th>タイトル</th>
            <td>{{ $v_TaskContent->title }}</td>
        </tr>
        <tr>
            <th>メッセージ</th>
            <td>{{ $v_TaskContent->content }}</td>
        </tr>
    </table>

    {!! link_to_route('ViTask.edit', 'このメッセージ編集', ['id' => $v_TaskContent->id], ['class' => 'btn btn-default']) !!}

    {!! Form::model($v_TaskContent, ['route' => ['ViTask.destroy', $v_TaskContent->id], 'method' => 'delete']) !!}
	
        {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
		
    {!! Form::close() !!}


@endsection
