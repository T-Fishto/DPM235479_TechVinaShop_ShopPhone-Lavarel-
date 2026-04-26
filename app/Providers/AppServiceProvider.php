<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public const HOME = '/home'; // Đường dẫn sau khi đăng nhập thành công
    public const ADMIN = '/admin'; // Đường dẫn sau khi đăng nhập thành công cho admin
    public const USER = '/user'; // Đường dẫn sau khi đăng nhập thành công cho user
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
