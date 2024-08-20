<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\Interfaces\UserServiceInterface as UserService;
use App\Repositories\Interfaces\ProvinceRepositoryInterface as ProvideService;
use App\Http\Requests\StoreUserRequest;
class UserController extends Controller
{
    protected $userService;
    protected $provideRepository;
    // Constructor Injection
    public function __construct(UserService $userService, ProvideService $provideRepository)
    {
        $this->userService = $userService;
        $this->provideRepository = $provideRepository;
    }
    public function index()
    {
        $users = $this->userService->paginate();
        $config = [
            'js' => [
                '/Admin/js/plugins/switchery/switchery.js'
            ],
            'css' => [
                '/Admin/css/plugins/switchery/switchery.css'
            ]
        ];
        $config['seo'] = config('apps.user');
        $template = 'backend.user.index';
        return view(
            'backend.dashboard.layout',
            compact(
                'template',
                'config',
                'users'
            )
        );
    }
    public function create()
    {
        $provinces = $this->provideRepository->all();
        // dd($provinces);
        $config = [
            'css' => [
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet'
            ],
            'js' => [
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
                '/Admin/library/location.js',
            ]
        ];
        $config['seo'] = config('apps.user');
        $template = 'backend.user.create';
        return view('backend.dashboard.layout',
            compact(
                'template',
                'config',
                'provinces'
            )
        );
    }
    public function store(StoreUserRequest $request){
        if($this->userService->create($request)){
            return redirect()->route('user.index')->with('success', "Thêm nhân viên thành công");    
        }
        return redirect()->route('user.index')->with('error', "Thêm nhân viên thất bại");    
    }
}
