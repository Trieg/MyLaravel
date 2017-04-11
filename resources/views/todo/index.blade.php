@extends('layouts.core')
@section('article')

<?php
//$v_TaskContent = 全インスタンス
$list;
?>

<div class=article-layout>
    <div class=article-layout__hero card-panel hoverable>
        <p>1 of 1 columns</p>
    </div>
    <div class=article-layout__sidebar>
        <p>1 of 1 columns below 786px<br/>2 of 5 columns above</p>
    </div>
    <div class=article-layout__main>
        <p>1 of 1 columns below 786px<br/>3 of 5 columns above</p>
    </div>
</div>

<div class=article-layout-2>
    <div class=under-menu>
        <p>top</p>
    </div>
        <div class=under-menu>
        <p>top</p>
    </div>
        <div class=under-menu>
        <p>top</p>
    </div>
        <div class=under-menu>
        <p>top</p>
    </div>
        <div class=under-menu>
        <p>top</p>
    </div>
</div>

@endsection