<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class KiemTraAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Kiểm tra xem người dùng đã đăng nhập chưa
        if (Auth::check()) {
            // 2. Nếu đã đăng nhập, kiểm tra xem role có phải là 'admin' không
            if (Auth::user()->role == 'admin') {
                return $next($request);
            }
            // Nếu không phải admin, chuyển hướng về trang chủ với thông báo lỗi
            return redirect()->route('frontend.home')->with('error', 'Bạn không có quyền truy cập khu vực quản trị!');
        }

        // 3. Nếu chưa đăng nhập, bắt buộc phải đăng nhập
        return redirect()->route('login');
    }
}
