
#modelでする事

・optionは割愛

#tableと対のclass extends model を作る（1テーブル、1モデル）

#tableとmodelの依存性を記述

#user ID との依存性を記述

#「::」演算子を使うために、namespace useの宣言をcontroller側に記述


--------------------------------------------------

#DateBase

make DB from GUI app
php artisan tinker
DB::connection();

--------------------------------------------------

#Table

Create a new migration file、--createで新規、tableで更新
php artisan make:migration MigrationClassName --create=TableName
php artisan make:migration table2-17-0410 --create=new_table
	
php artisan make:migration MigrationClassName --table=TableName
php artisan make:migration add_microposts04111903 --table=microposts

$table->string('content'); 直接、必要なcolumnを追加

php artisan migrate
php artisan migrate:status

--------------------------------------------------

#Model

Create a new Eloquent model class
php artisan make:model ModelName

--------------------------------------------------

#artisan

・Interact with your application
php artisan tinker

・List all registered routes
php artisan route:list

・Restart queue worker daemons after their current job
php artisan queue:restart

・Display this laravel application version
php artisan --version OR -V

・Serve the application on the PHP development server
php artisan serve

・Change the default port
php artisan serve --port 8080

・Flush the application cache（バージョンアップの時に使った方がいいかな？！）
php artisan cache:clear

--------------------------------------------------

#middleware, service, request の雛形
Create a new middleware class
php artisan make:middleware name

Create a new service provider class
php artisan make:provider name

Create a new form request class
php artisan make:request name

