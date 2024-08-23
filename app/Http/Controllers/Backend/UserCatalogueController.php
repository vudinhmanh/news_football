<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\UserCatalogueServiceInterface  as UserCatalogueService;
use App\Repositories\Interfaces\UserCatalogueRepositoryInterface  as UserCatalogueRepository;
use App\Http\Requests\StoreUserCatalogueRequest;

class UserCatalogueController extends Controller
{
    protected $userCatalogueService;
    protected $userCatalogueRepository;
    public function __construct(
        UserCatalogueService $userCatalogueService,
        UserCatalogueRepository $userCatalogueRepository,
    ){
        $this->userCatalogueService = $userCatalogueService;
        $this->userCatalogueRepository = $userCatalogueRepository;
    }
    public function index(Request $request)
    {
        $userCatalogues = $this->userCatalogueService->paginate($request);
        $config = [
            'js' => [
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
                '/Admin/js/plugins/switchery/switchery.js'
            ],
            'css' => [
                '/Admin/css/plugins/switchery/switchery.css'
            ]
        ];
        $config['seo'] = config('apps.usercatalogue');
        $template = 'backend.user.catalogue.index';
        return view(
            'backend.dashboard.layout',
            compact(
                'template',
                'config',
                'userCatalogues'
            )
        );
    }
    public function create()
    {
        $config['seo'] = config('apps.usercatalogue');
        $config['method'] = 'create';
        $template = 'backend.user.catalogue.store';
        return view('backend.dashboard.layout',
            compact(
                'template',
                'config',
            )
        );
    }
    public function store(StoreUserCatalogueRequest $request){
        if($this->userCatalogueService->create($request)){
            return redirect()->route('user.catalogue.index')->with('success', "Thêm nhóm thành viên thành công");    
        }
        return redirect()->route('user.catalogue.index')->with('error', "Thêm nhóm thành viên thất bại");    
    }
    public function edit($id){
        $userCatalogue = $this->userCatalogueRepository->findById($id);
        $config['seo'] = config('apps.usercatalogue');
        $config['method'] = 'edit';
        $template = 'backend.user.catalogue.store';
        return view('backend.dashboard.layout',
            compact(
                'template',
                'config',
                'userCatalogue'
            )
        );
    }
    public function update($id, StoreUserCatalogueRequest $request){
        if($this->userCatalogueService->update($id, $request)){
            return redirect()->route('user.catalogue.index')->with('success', "Sửa thành công");    
        }
        return redirect()->route('user.catalogue.index')->with('error', "Sửa thất bại");    
    }
    public function delete($id){
        $userCatalogue = $this->userCatalogueRepository->findById($id);
        $template = 'backend.user.catalogue.delete';
        $config['seo'] = config('apps.usercatalogue');
        return view('backend.dashboard.layout',
            compact(
                'template',
                'userCatalogue',
                'config'
            )
        );
    }
    public function destroy($id) {
        if($this->userCatalogueService->destroy($id)){
            return redirect()->route('user.catalogue.index')->with('success', "Xoá thành công");    
        }
        return redirect()->route('user.catalogue.index')->with('error', "Xoá thất bại");    
    }
}
