<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Auth;
use App\Providers\AppServiceProvider;
return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'admin' => \App\Http\Middleware\KiemTraAdmin::class,
        ]);

        $middleware-> redirectUsersTo(function (){ // Kiểm tra vai trò của người dùng và chuyển hướng tương ứng
            if (Auth::user()) { // Kiểm tra nếu người dùng đã đăng nhập
                if (Auth::user()->role == 'admin') { 
                    return AppServiceProvider::ADMIN; // Chuyển hướng đến trang admin nếu là admin
                } else {
                    return AppServiceProvider::USER; // Chuyển hướng đến trang user nếu là khách hàng
                }
            }
            return AppServiceProvider::HOME;
        });
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
