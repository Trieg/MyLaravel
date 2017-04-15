
#routeの呼び出し順序

App\Providers\RouteServiceProviderクラスによりロード
link_to(Applications / MAMP / htdocs / l51_003 / microposts / app / Providers / RouteServiceProvider . php);

RouteServiceProviderに、正規表現が記載されている

#routeでする事

・namespaceもuseもいらない

#Route::をまとめる、php artisan route:list で全貌の確認

#URLに対してmiddlewereで、権限の検閲を作る

#リンク用のname()を作る

(URL.method)
(user.store)
(logout.get)

