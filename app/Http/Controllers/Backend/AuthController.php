<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        // Kiểm tra người dùng đã đăng nhập và user_catalogue_id > 0
        if (Auth::check()) {
            if (Auth::user()->user_catalogue_id > 0) {
                return redirect()->route('admin.dashboard');
            } else {
                // Nếu user_catalogue_id = 0, đăng xuất người dùng và thông báo lỗi
                Auth::logout();
                return redirect()->route('auth.login')->with('error', 'Tài khoản của bạn không có quyền truy cập');
            }
        }
        return view('backend.auth.login');
    }

    public function login(AuthRequest $request)
    {
        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ];

        // Kiểm tra xác thực người dùng
        if (Auth::attempt($credentials)) {
            // Kiểm tra user_catalogue_id sau khi đăng nhập
            if (Auth::user()->user_catalogue_id > 0) {
                return redirect()->route('admin.dashboard')->with('success', 'Đăng nhập thành công');
            } else {
                // Đăng xuất nếu user_catalogue_id = 0 và thông báo lỗi
                Auth::logout();
                return redirect()->route('auth.login')->with('error', 'Tài khoản của bạn không có quyền truy cập');
            }
        }

        return redirect()->route('auth.login')->with('error', 'Email hoặc mật khẩu không đúng');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('auth.login');
    }
}
