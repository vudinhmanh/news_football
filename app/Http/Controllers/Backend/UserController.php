<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\Interfaces\UserServiceInterface as UserService;
class UserController extends Controller
{
    protected $userService; 
     // Constructor Injection
    public function __construct(UserService $userService){
        $this->userService = $userService;
    }
    public function index(){
        $users = $this->userService->paginate();
        // dd($users); 
        $config = $this->config();
        // echo 'Chuc nang quan ly nhom thanh vien';
        $template = 'backend.user.index';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'users'
        ));
    }
    private function config() {
        return [
                'js' => [
                    '/Admin/js/plugins/switchery/switchery.js'
                ],
                'css' => [
                    '/Admin/css/plugins/switchery/switchery.css'
                ]
            ];
    }
}
