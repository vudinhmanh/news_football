<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\PermissionServiceInterface as permissionService;
use App\Repositories\Interfaces\PermissionRepositoryInterface as permissionRepository;
use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
class PermissionController extends Controller
{
    protected $permissionService;
    protected $permissionRepository;
    public function __construct(
        permissionService $permissionService,
        permissionRepository $permissionRepository,
    ) {
        $this->permissionService = $permissionService;
        $this->permissionRepository = $permissionRepository;
    }
    public function index(Request $request)
    {
        $this->authorize('modules', 'permission.index');
        $permissions = $this->permissionService->paginate($request);
        $config = [
            'js' => [
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
                '/Admin/js/plugins/switchery/switchery.js'
            ],
            'css' => [
                '/Admin/css/plugins/switchery/switchery.css'
            ]
        ];
        $config['seo'] = __('messages.permission');
        $template = 'backend.permission.index';
        return view(
            'backend.dashboard.layout',
            compact(
                'template',
                'config',
                'permissions'
            )
        );
    }
    public function create()
    {
        $this->authorize('modules', 'permission.create');
        $config = $this->configData();
        $config['seo'] = __('messages.permission');
        $config['method'] = 'create';
        $template = 'backend.permission.store';
        return view(
            'backend.dashboard.layout',
            compact(
                'template',
                'config',
            )
        );
    }
    public function store(StorePermissionRequest $request)
    {
        if ($this->permissionService->create($request)) {
            return redirect()->route('permission.index')->with('success', "Thêm quyền thành công");
        }
        return redirect()->route('permission.index')->with('error', "Thêm quyền thất bại");
    }
    public function edit($id)
    {
        $this->authorize('modules', 'permission.update');
        $permission = $this->permissionRepository->findById($id);
        $config = $this->configData();
        $config['seo'] = __('messages.permission');
        $config['method'] = 'edit';
        $template = 'backend.permission.store';
        return view(
            'backend.dashboard.layout',
            compact(
                'template',
                'config',
                'permission'
            )
        );
    }
    public function update($id, UpdatePermissionRequest $request)
    {
        if ($this->permissionService->update($id, $request)) {
            return redirect()->route('permission.index')->with('success', "Sửa thành công");
        }
        return redirect()->route('permission.index')->with('error', "Sửa thất bại");
    }
    public function delete($id)
    {
        $this->authorize('modules', 'permission.destroy');
        $permission = $this->permissionRepository->findById($id);
        $template = 'backend.permission.delete';
        $config['seo'] = __('messages.permission');
        return view(
            'backend.dashboard.layout',
            compact(
                'template',
                'permission',
                'config'
            )
        );
    }
    public function destroy($id)
    {
        if ($this->permissionService->destroy($id)) {
            return redirect()->route('permission.index')->with('success', "Xoá thành công");
        }
        return redirect()->route('permission.index')->with('error', "Xoá thất bại");
    }
    private function configData()
    {
        return [
        ];
    }
}
