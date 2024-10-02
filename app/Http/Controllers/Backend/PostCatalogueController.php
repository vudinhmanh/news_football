<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\PostCatalogueServiceInterface  as PostCatalogueService;
use App\Repositories\Interfaces\PostCatalogueRepositoryInterface  as PostCatalogueRepository;
use App\Http\Requests\StorePostCatalogueRequest;
use App\Http\Requests\UpdatePostCatalogueRequest;
use App\Classes\Nestedsetbie;
use App\Http\Requests\DeletePostCatalogueRequest;
use App\Services\BaseService;
class PostCatalogueController extends Controller
{
    protected $postCatalogueService;
    protected $postCatalogueRepository;
    protected $language;
    public function __construct(
        PostCatalogueService $postCatalogueService,
        PostCatalogueRepository $postCatalogueRepository,
    ){
        $this->postCatalogueService = $postCatalogueService;
        $this->postCatalogueRepository = $postCatalogueRepository;
        $this->netedset = new Nestedsetbie(
            [
              'table' => 'post_catalogues',
              'foreignkey' => 'post_catalogue_id',
              'language_id' => 1,
            ]
          );
        $this->language = $this->currentLanguage();
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
        $config['seo'] = __('messages.postCatalogue');
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
        $config['seo'] = __('messages.postCatalogue');
        $config['method'] = 'create';
        $dropdown = $this->netedset->Dropdown();
        $template = 'backend.post.catalogue.store';
        return view('backend.dashboard.layout',
            compact(
                'template',
                'config',
                'dropdown'
            )
        );
    }
    public function store(StorepostCatalogueRequest $request){
        if($this->postCatalogueService->create($request)){
            return redirect()->route('post.catalogue.index')->with('success', "Thêm thành công");    
        }
        return redirect()->route('post.catalogue.index')->with('error', "Thêm ngữ thất bại");    
    }
    public function edit($id){
        $postCatalogue = $this->postCatalogueRepository->getPostCatalogueById(
            $id, 
            $this->language
        );
        $config = $this->configData();
        $config['seo'] = __('messages.postCatalogue');
        $config['method'] = 'edit'; 
        $dropdown = $this->netedset->Dropdown();
        $template = 'backend.post.catalogue.store';
        return view('backend.dashboard.layout',
            compact(
                'template',
                'config',
                'postCatalogue',
                'dropdown'
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
        $postCatalogue = $this->postCatalogueRepository->getPostCatalogueById($id, $this->language);
        $template = 'backend.post.catalogue.delete';
        $config['seo'] = __('messages.postCatalogue');
        return view('backend.dashboard.layout',
            compact(
                'template',
                'postCatalogue',
                'config'
            )
        );
    }
    public function destroy($id, DeletePostCatalogueRequest $request) {
        if($this->postCatalogueService->destroy($id)){
            return redirect()->route('post.catalogue.index')->with('success', "Xoá thành công");    
        }
        return redirect()->route('post.catalogue.index')->with('error', "Xoá thất bại");    
    }
    private function configData(){
        return [
                'js' => [
                    '/Admin/plugins/ckfinder_2/ckfinder.js',
                    '/Admin/plugins/ckeditor/ckeditor.js',
                    '/Admin/library/finder.js',
                    '/Admin/library/seo.js',
                    'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
                ],
                'css' => [
                    'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet'
                ]
            ];
    }
}
