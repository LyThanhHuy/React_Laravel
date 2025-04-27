<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    /**
     * Khởi tạo controller.
     * Dùng middleware guest:admin để ngăn truy cập trang login nếu đã đăng nhập.
     * Chỉ cho phép truy cập logout khi đã login.
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    /**
     * Hiển thị form đăng nhập dành cho admin.
     */
    public function showLoginForm()
    {
        // Trả về view chứa form đăng nhập admin
        return view('admin.auth.login');
    }

    /**
     * Xử lý đăng nhập admin
     */
    public function login(Request $request)
    {
        // Lấy thông tin email và password từ request gửi lên
        $credentials = $request->only('email', 'password');

        // Kiểm tra checkbox "remember me" có được chọn không
        $remember = $request->filled('remember');

        // Thử đăng nhập bằng guard 'admin'
        if (Auth::guard('admin')->attempt($credentials, $remember)) {
            // Nếu đăng nhập thành công, chuyển hướng tới dashboard admin
            return redirect()->intended(route('admin.dashboard'));
        }

        // Nếu đăng nhập thất bại, quay lại với lỗi
        return back()->withErrors(['email' => 'Sai tài khoản hoặc mật khẩu']);
    }

    /**
     * Đăng xuất tài khoản admin
     */
    public function logout()
    {
        // Gọi guard 'admin' logout
        Auth::guard('admin')->logout();

        // Chuyển hướng về trang login admin
        return redirect()->route('admin.login');
    }
}
