<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$guards): Response
    {
        // Nếu không truyền guard → mặc định là [null]
        $guards = empty($guards) ? [null] : $guards;

        // Duyệt qua từng guard (vd: admin, web)
        foreach ($guards as $guard) {
            // Nếu đã đăng nhập với guard đó
            if (Auth::guard($guard)->check()) {

                // Nếu là admin → redirect về dashboard admin
                if ($guard === 'admin') {
                    return redirect()->route('admin.dashboard');
                }

                // Nếu là người dùng thường → redirect về /home
                return redirect('/home');
            }
        }

        // Nếu chưa đăng nhập → tiếp tục xử lý request bình thường
        return $next($request);
    }
}
