<?php
namespace App\Http\Middleware\Backend;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AuthenticateMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (!Auth::check()) {
            return redirect()->route('auth.login')->with('error', 'Bạn cần phải đăng nhập để sử dụng chức năng này');
        }
        // Kiểm tra xem user_catalogue_id có lớn hơn 0 không
        if (Auth::user()->user_catalogue_id == 0) {
            return redirect()->route('auth.login')->with('error', 'Bạn không có quyền truy cập vào chức năng này');
        }
        return $next($request);
    }
}
