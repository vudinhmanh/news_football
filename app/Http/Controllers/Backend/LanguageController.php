<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\LanguageServiceInterface  as LanguageService;
use App\Repositories\Interfaces\LanguageRepositoryInterface  as LanguageRepository;
use App\Http\Requests\StoreLanguageRequest;
use App\Http\Requests\UpdateLanguageRequest;
class LanguageController extends Controller
{
    protected $languageService;
    protected $languageRepository;
    public function __construct(
        LanguageService $languageCatalogueService,
        LanguageRepository $languageCatalogueRepository,
    ){
        $this->languageService = $languageCatalogueService;
        $this->languageRepository = $languageCatalogueRepository;
    }
    public function index(Request $request)
    {
        $languages = $this->languageService->paginate($request);
        $config = [
            'js' => [
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
                '/Admin/js/plugins/switchery/switchery.js'
            ],
            'css' => [
                '/Admin/css/plugins/switchery/switchery.css'
            ]
        ];
        $config['seo'] = __('messages.language');
        $template = 'backend.language.index';
        return view(
            'backend.dashboard.layout',
            compact(
                'template',
                'config',
                'languages'
            )
        );
    }
    public function create()
    {
        $config = $this->configData();
        $config['seo'] = __('messages.language');
        $config['method'] = 'create';
        $template = 'backend.language.store';
        return view('backend.dashboard.layout',
            compact(
                'template',
                'config',
            )
        );
    }
    public function store(StoreLanguageRequest $request){
        if($this->languageService->create($request)){
            return redirect()->route('language.index')->with('success', "Thêm ngôn ngữ thành công");    
        }
        return redirect()->route('language.index')->with('error', "Thêm ngôn ngữ thất bại");    
    }
    public function edit($id){
        $language = $this->languageRepository->findById($id);
        $config = $this->configData();
        $config['seo'] = __('messages.language');
        $config['method'] = 'edit'; 
        $template = 'backend.language.store';
        return view('backend.dashboard.layout',
            compact(
                'template',
                'config',
                'language'
            )
        );
    }
    public function update($id, UpdateLanguageRequest $request){
        if($this->languageService->update($id, $request)){
            return redirect()->route('language.index')->with('success', "Sửa thành công");    
        }
        return redirect()->route('language.index')->with('error', "Sửa thất bại");    
    }
    public function delete($id){
        $language = $this->languageRepository->findById($id);
        $template = 'backend.language.delete';
        $config['seo'] = __('messages.language');
        return view('backend.dashboard.layout',
            compact(
                'template',
                'language',
                'config'
            )
        );
    }
    public function destroy($id) {
        if($this->languageService->destroy($id)){
            return redirect()->route('language.index')->with('success', "Xoá thành công");    
        }
        return redirect()->route('language.index')->with('error', "Xoá thất bại");    
    }
    private function configData(){
        return [
                'js' => [
                    '/Admin/plugins/ckfinder_2/ckfinder.js',
                    '/Admin/library/finder.js'
                ]
            ];
    }
    public function switchBackendLanguage($id){
        $language = $this->languageRepository->findById($id);
        if($this->languageService->switch($id)){
            session(['app_locale' => $language->canonical]);
            \App::setLocale($language->canonical);
        }
        return redirect()->back(); 
    }
}
