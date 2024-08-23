<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\PostCatalogueServiceInterface  as PostCatalogueService;
use App\Repositories\Interfaces\PostCatalogueRepositoryInterface  as PostCatalogueRepository;
use App\Http\Requests\StorePostCatalogueRequest;
use App\Http\Requests\UpdatePostCatalogueRequest;
class PostCatalogueController extends Controller
{
    protected $postCatalogueService;
    protected $postCatalogueRepository;
    public function __construct(
        PostCatalogueService $postCatalogueService,
        PostCatalogueRepository $postCatalogueRepository,
    ){
        $this->postCatalogueService = $postCatalogueService;
        $this->postCatalogueRepository = $postCatalogueRepository;
    }
    public function index(Request $request)
    {
        $postCatalogues = $this->postCatalogueService->paginate($request);
        $config = [
            'js' => [
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
                '/Admin/js/plugins/switchery/switchery.js'
            ],
            'css' => [
                '/Admin/css/plugins/switchery/switchery.css'
            ]
        ];
        $config['seo'] = config('apps.postcatalogue');
        $template = 'backend.post.catalogue.index';
        return view(
            'backend.dashboard.layout',
            compact(
                'template',
                'config',
                'postCatalogues'
            )
        );
    }
    public function create()
    {
        $config = $this->configData();
        $config['seo'] = config('apps.postcatalogue');
        $config['method'] = 'create';
        $template = 'backend.post.catalogue.store';
        return view('backend.dashboard.layout',
            compact(
                'template',
                'config',
            )
        );
    }
    public function store(StorepostCatalogueRequest $request){
        if($this->postCatalogueService->create($request)){
            return redirect()->route('post.catalogue.index')->with('success', "Thêm ngôn ngữ thành công");    
        }
        return redirect()->route('post.catalogue.index')->with('error', "Thêm ngôn ngữ thất bại");    
    }
    public function edit($id){
        $postCatalogue = $this->postCatalogueRepository->findById($id);
        $config = $this->configData();
        $config['seo'] = config('apps.postCatalogue');
        $config['method'] = 'edit'; 
        $template = 'backend.postCatalogue.store';
        return view('backend.dashboard.layout',
            compact(
                'template',
                'config',
                'postCatalogue'
            )
        );
    }
    public function update($id, UpdatepostCatalogueRequest $request){
        if($this->postCatalogueService->update($id, $request)){
            return redirect()->route('post.catalogue.index')->with('success', "Sửa thành công");    
        }
        return redirect()->route('post.catalogue.index')->with('error', "Sửa thất bại");    
    }
    public function delete($id){
        $postCatalogue = $this->postCatalogueRepository->findById($id);
        $template = 'backend.post.catalogue.delete';
        $config['seo'] = config('apps.postcatalogue');
        return view('backend.dashboard.layout',
            compact(
                'template',
                'postCatalogue',
                'config'
            )
        );
    }
    public function destroy($id) {
        if($this->postCatalogueService->destroy($id)){
            return redirect()->route('postCatalogue.index')->with('success', "Xoá thành công");    
        }
        return redirect()->route('postCatalogue.index')->with('error', "Xoá thất bại");    
    }
    private function configData(){
        return [
                'js' => [
                    '/Admin/plugins/ckfinder_2/ckfinder.js',
                    '/Admin/plugins/ckeditor/ckeditor.js',
                    '/Admin/library/finder.js',
                    'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
                ],
                'css' => [
                    'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet'
                ]
            ];
    }
}
