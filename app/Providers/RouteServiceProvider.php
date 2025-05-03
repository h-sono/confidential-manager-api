<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Laravelがルート定義をどのように読み込むか定義
        $this->routes(function () {
            // 'api' ミドルウェアと 'api' プレフィックスを適用（api.phpが読み込まれる）
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            // 'web' ミドルウェアを適用　⇒web.phpが読み込まれるが使用しないのでコメントアウト
            // Route::middleware('web')
            //     ->group(base_path('routes/web.php'));
        });
    }
}
