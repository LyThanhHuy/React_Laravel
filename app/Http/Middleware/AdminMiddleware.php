<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Kiểm tra nếu người dùng chưa đăng nhập với guard 'admin'
        if (!Auth::guard('admin')->check()) {
            // Nếu chưa đăng nhập, chuyển hướng đến trang đăng nhập admin
            return redirect()->route('admin.login');
        }

        return $next($request); // Nếu đã đăng nhập, tiếp tục xử lý yêu cầu
    }
}
