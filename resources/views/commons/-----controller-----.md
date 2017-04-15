
#controllerでの考え方

機能的にはmodelに直で無名関数を宣言しているのと、全く同じ。

わかりやすいように、分けているだけで、見た目上の分離。

その証拠にcontroller側でのuseのメソッドに、route側からメソッドをcallしている。


#controllerでするべき事

#メソッドを分岐したfunctionを作る

#変数を、modelから引き出した数値を、view側に送る

#変数を、view（form）から引き出した数値を、model側に送る




//ここでは作成しませんが、ユーザが自分の名前を編集するアクション(edit, update)や、
//退会アクション(destroy)があっても良いし、更にユーザの登録情報（年齢や自己紹介など）を
//充実（users テーブルのカラム追加）させても良いと思います。


//Controller
//php artisan make:controller WelcomeController
//php artisan make:controller MicropostsController