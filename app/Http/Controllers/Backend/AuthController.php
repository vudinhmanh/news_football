<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
class AuthController extends Controller
{
    public function __construct(){

    }
    public function index() {
        if(Auth::id() > 0) {
            return redirect()->route('admin.dashboard');
        }
        return view('backend.auth.login');
    }
    public function login(AuthRequest $request) {
        $credentials = [
            'name' => $request->input('username'),
            'password' => $request->input('password')
        ];
        if(Auth::attempt($credentials)) {
            return redirect()->route('admin.dashboard')->with('success', 'Đăng nhập thành công');
        }
        return redirect()->route('auth.login')->with('error','Email hoặc mật khẩu không đúng');
    }
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('auth.login');
    }
}
