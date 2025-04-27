<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Nếu người dùng chưa đăng nhập, xác định URL cần redirect đến.
     */
    protected function redirectTo($request): ?string
    {
        // Nếu client không yêu cầu JSON (tức là không phải API)
        if (! $request->expectsJson()) {
            // Trả về route login mặc định (bạn có thể đổi thành route('admin.login'))
            return route('login');
        }

        return null;
    }
}
