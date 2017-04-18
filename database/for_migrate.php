<?php


Schema::create('parent_table', function($table)
{
    // $table->engine = 'InnoDB'; // テーブル単位でもストレージエンジン指定は出来る。
    $table->increments('id');
    $table->string('title')->nullable();
    $table->string('body')->nullable();
    $table->timestamps();
});
 
 
Schema::create('child_table', function($table)
{
    // $table->engine = 'InnoDB'; // テーブル単位でもストレージエンジン指定は出来る。
    $table->increments('id');
    $table->integer('parent_id')->nullable()->unsigned(); //インクリメントの主キーは、unsigned型！！
    // 最初からuint型でもOK！
    // $table->unsignedInteger('parent_id');
    $table->string('title')->nullable();
    $table->string('body')->nullable();
    $table->timestamps();
 
    //文字列の外部キー参照元はindexが無いとダメ！
    $table->foreign('parent_id')->references('id')->on('parent_table');    
 
});
 
 
 
// 文字列型でもリレーションシップ生成できるが、文字列の外部キー参照元はindexが無いとダメ！
// 親テーブル
$table->string('school_number', 7)->unique(); //->index();でもOK
 
// 子テーブル
$table->string('student_number', 7)->unique();
$table->foreign('student_number')->references('id')->on('school_number');  