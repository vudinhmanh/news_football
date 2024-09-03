<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\Interfaces\UserServiceInterface as UserService;
use App\Repositories\Interfaces\ProvinceRepositoryInterface as ProvideRepository;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
class UserController extends Controller
{
    protected $userService;
    protected $provideRepository;
    protected $userRepository;
    // Constructor Injection
    public function __construct(UserService $userService, ProvideRepository $provideRepository, UserRepository $userRepository)
    {
        $this->userService = $userService;
        $this->provideRepository = $provideRepository;
        $this->userRepository = $userRepository;
    }
    public function index(Request $request)
    {
        $users = $this->userService->paginate($request);
        $config = [
            'js' => [
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
                '/Admin/js/plugins/switchery/switchery.js'
            ],
            'css' => [
                '/Admin/css/plugins/switchery/switchery.css'
            ]
        ];
        $config['seo'] = config('apps.user');
        $template = 'backend.user.user.index';
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
        $config = $this->configData();
        $config['seo'] = config('apps.user');
        $config['method'] = 'create';
        $template = 'backend.user.user.store';
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
    public function edit($id){
        $user = $this->userRepository->findById($id);
        // dd($user);
        $provinces = $this->provideRepository->all();
        $config = $this->configData();
        $config['seo'] = config('apps.user');
        $config['method'] = 'edit';
        $template = 'backend.user.user.store';
        return view('backend.dashboard.layout',
            compact(
                'template',
                'config',
                'provinces',
                'user'
            )
        );
    }
    public function update($id, UpdateUserRequest $request){
        if($this->userService->update($id, $request)){
            return redirect()->route('user.index')->with('success', "Sửa thành công");    
        }
        return redirect()->route('user.index')->with('error', "Sửa thất bại");    
    }
    public function delete($id){
        $user = $this->userRepository->findById($id);
        $template = 'backend.user.user.delete';
        $config['seo'] = config('apps.user');
        $config['method'] = 'delete';
        return view('backend.dashboard.layout',
            compact(
                'template',
                'user',
                'config'
            )
        );
    }
    public function destroy($id) {
        if($this->userService->destroy($id)){
            return redirect()->route('user.index')->with('success', "Xoá thành công");    
        }
        return redirect()->route('user.index')->with('error', "Xoá thất bại");    
    }
    private function configData(){
        return [
            'css' => [  
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet'
            ],
            'js' => [
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
                '/Admin/library/location.js',
                '/Admin/plugins/ckfinder_2/ckfinder.js',
                '/Admin/library/finder.js'
            ]
        ];
    }
}
