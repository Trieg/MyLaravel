<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\task; //modelのエイリアス追加。以降、ファサードとして使用できる

class ContTask extends Controller {

	//modelから仕入れてきたデータの、仲介用変数
	protected $TaskContent;

	//::all()で、[配列]で全インスタンスを入れる役割にもなるし、
	//::find($id)で、1インスタンスを入れる役割にもなるし、
	//newで、新しいインスタンス（new record）が入る役割にもなる
	//view側の変数「'v_TaskContent'」
	//この子も、どんな役割にもなれる、万能選手

	public function index() {
		//TopPage
		$TaskContent = task::all();
		//view(path, variable)
		return view('test.index', ['v_TaskContent' => $TaskContent,]);
	}

	public function show($id) {
		//idの引数を渡す。Route側でURL分岐
		$TaskContent = task::find($id);
		return view('test.show', ['v_TaskContent' => $TaskContent,]);
	}

	public function create() {
		//入力フォームなのでmodelのインスタンスを作る
		$TaskContent = new task;
		return view('test.create', ['v_TaskContent' => $TaskContent,]);
	}

	public function edit($id) {
		//id でメッセージレコードを検索
		$TaskContent = task::find($id);
		//getしたインスタンスをview側に代入
		return view('test.edit', ['v_TaskContent' => $TaskContent,]);
	}
	

	//コントローラーのアクションメソッドに Illuminate\Http\Request をタイプヒントしておけば
	//LaravelがRequestインスタンスを注入してくれる

	use Illuminate\Http\Request;

	public function index(Request $request) {
		//cookie check
		$cookie = $request->cookie('xxxxx');
		if (!$cookie) {
			return 'クッキーが存在しません．';
		} else {
			return 'クッキーが存在します．';
		}
	}
	

	public function store(Request $request) {
		//Validation A
		//columnにNG条件を代入してみて、Trueだったら発動Stop。Falseだったら進行
		//自動的に「$errors」がview側に作成される（viewのエラー画面に利用）
		$this->validate($request, [
			'content'	 => 'required|max:255',
			'title'		 => 'required|max:255', // colum対応
			'status'	 => 'required|max:10', // colum対応
		]);

		//modelインスタンスに送られて来たデータは$requestに入る
		//連想配列で入っているので、keyを指定して取り出しと、新規インスタンスへの再代入、最後にDB保存
		$TaskContent = new task;

		$TaskContent->content	 = $request->content;
		$TaskContent->title		 = $request->title;	// colum対応
		$TaskContent->status	 = $request->status;	// colum対応
		$TaskContent->save();

		//view無し
		return redirect('/');
	}

	public function update(Request $request, $id) {
		//Validation A
		$this->validate($request, [
			'content'	 => 'required|max:255',
			'title'		 => 'required|max:255', // colum対応
			'status'	 => 'required|max:10', // colum対応
		]);

		//新規ではないので、DBを検索
		$TaskContent			 = task::find($id);
		//連想配列で入っているので、$requestからkeyを指定して取り出し、インスタンスへの再代入、最後にDB保存
		$TaskContent->content	 = $request->content;
		$TaskContent->title		 = $request->title;	// colum対応
		$TaskContent->status	 = $request->status;	// colum対応
		$TaskContent->save();

		//App\Message::where('id', 1)->update(['content' => 'updated'])
		//view無し
		return redirect('/');
	}

	public function destroy($id) {
		//新規ではないので、DBを検索
		$TaskContent = task::find($id);
		$TaskContent->delete();

		//view無し
		return redirect('/');
	}

}
