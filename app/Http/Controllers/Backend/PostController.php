<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\PostServiceInterface  as PostService;
use App\Repositories\Interfaces\PostRepositoryInterface  as PostRepository;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Classes\Nestedsetbie;
use App\Services\BaseService;
class PostController extends Controller
{
    protected $postService;
    protected $postRepository;
    protected $language;
    public function __construct(
        PostService $postService,
        PostRepository $postRepository,
    ){
        $this->postService = $postService;
        $this->postRepository = $postRepository;
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
        $posts = $this->postService->paginate($request);
        $config = [
            'js' => [
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
                '/Admin/js/plugins/switchery/switchery.js'
            ],
            'css' => [
                '/Admin/css/plugins/switchery/switchery.css'
            ]
        ];
        $config['seo'] = config('apps.post');
        $template = 'backend.post.post.index';
        return view(
            'backend.dashboard.layout',
            compact(
                'template',
                'config',
                'posts'
            )
        );
    }
    public function create()
    {
        $config = $this->configData();
        $config['seo'] = config('apps.post');
        $config['method'] = 'create';
        $dropdown = $this->netedset->Dropdown();
        $template = 'backend.post.post.store';
        return view('backend.dashboard.layout',
            compact(
                'template',
                'config',
                'dropdown'
            )
        );
    }
    public function store(StorePostRequest $request){
        if($this->postService->create($request)){
            return redirect()->route('post.index')->with('success', "Thêm thành công");    
        }
        return redirect()->route('post.index')->with('error', "Thêm ngữ thất bại");    
    }
    public function edit($id){
        $post = $this->postRepository->getpostById(
            $id, 
            $this->language
        );
        // dd($post);
        $config = $this->configData();
        $config['seo'] = config('apps.post');
        $config['method'] = 'edit'; 
        $dropdown = $this->netedset->Dropdown();
        $catalogue = $this->catalogue($post);
        $template = 'backend.post.post.store';
        return view('backend.dashboard.layout',
            compact(
                'template',
                'config',
                'post',
                'dropdown'
            )
        );
    }
    public function update($id, UpdatePostRequest $request){
        if($this->postService->update($id, $request)){
            return redirect()->route('post.index')->with('success', "Sửa thành công");    
        }
        return redirect()->route('post.index')->with('error', "Sửa thất bại");    
    }
    public function delete($id){
        $post = $this->postRepository->getpostById($id, $this->language);
        $template = 'backend.post.post.delete';
        $config['seo'] = config('apps.post');
        return view('backend.dashboard.layout',
            compact(
                'template',
                'post',
                'config'
            )
        );
    }
    public function destroy($id) {
        if($this->postService->destroy($id)){
            return redirect()->route('post.index')->with('success', "Xoá thành công");    
        }
        return redirect()->route('post.index')->with('error', "Xoá thất bại");    
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
    private function catalogue(){

    }
}
