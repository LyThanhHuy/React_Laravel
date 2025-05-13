<?php

namespace App\Http\Middleware;

use Closure;
// use Symfony\Component\HttpFoundation\Response;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class AdminMiddleware extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, Closure $next)
    // {
    //     // Kiểm tra nếu người dùng chưa đăng nhập với guard 'admin'
    //     if (!Auth::guard('admin')->check()) {
    //         // Nếu chưa đăng nhập, chuyển hướng đến trang đăng nhập admin
    //         return redirect()->route('admin.login');
    //     }

    //     return $next($request); // Nếu đã đăng nhập, tiếp tục xử lý yêu cầu
    // }

    protected function redirectTo($request): ?string
    {
        // Nếu client không yêu cầu JSON (tức là không phải API)
        if (! $request->expectsJson()) {
            // Trả về route login mặc định (bạn có thể đổi thành route('admin.login'))
            return route('admin.login');
        }

        return null;
    }
}
