
・bladeでする事

#blade同士の依存性を作る

@include('フォルダ名.phpファイル名')
@include('microposts.microposts')


#普通のリンクを貼る

PCA！！！！！！！！

{!! link_to_route('viewのpath', 'html contents', URLの末尾?を「第3引数名」で分岐, ['class' => '']) !!}
{!! link_to_route('signup.get', 'Sign up now!', null, ['class' => '']) !!}

pathの記述パターン
・folder.phpName (view)
・URL.method (route)


#自動読込のリンクを貼る

{!! Form::open(['route' => 'microposts.store']) !!}

#Formを作る

<!--keyが表示画面、代入側がselect画面として表示。つまりkeyも代入も同じにしよう-->
{!! Form::select('status', ['いまやる' => 'いまやる', 'すぐやる' => 'すぐやる', 'もう3秒たったぞ！' 
=> '3秒後にやる'], null, ['placeholder' => '上司「いつやるの？」']) !!}

{!! Form::textarea('content', old('content'), ['class' => 'form-control', 'rows' => '5']) !!}

null or null(model) ofold('content')



編集
{!! Form::model($v_TaskContent, ['route' => ['ViTask.update', $v_TaskContent->id], 'method' => 'put']) !!}
削除
{!! Form::model($v_TaskContent, ['route' => ['ViTask.destroy', $v_TaskContent->id], 'method' => 'delete']) !!}

'method' => 'put'
'method' => 'delete'

#リンクを探す
'method' => 'delete



//SCSS自動コンパイル、initはcss-root直下
//compass init
//compass watch

