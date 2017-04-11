<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class Authenticate
{
    /**
     * Guardの実装
     *
     * @var Guard
     */
    protected $auth;

    /**
     * 新しいミドルウェアインスタンス
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * 送られてきたリクエストの処理
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
     
//authが呼ばれた時に、毎回呼ばれるメソッド
//app/Http/Middleware/Authenticate.php

    public function handle($request, Closure $next)
    {
        if ($this->auth->guest()) {
            //ログイン無しの場合、 $this->auth->guest() が true
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest(route('login.get')); //しゅうせ
            }
        }

        return $next($request);
    }
}