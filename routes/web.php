<?php

use App\Http\Controllers\Ajax\LocationController;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\PostCatalogueController;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\Backend\PermissionController;
use App\Http\Controllers\Backend\UserCatalogueController;
use App\Models\Permission;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Backend\AuthenticateMiddleware;
use App\Http\Middleware\Backend\LoginMiddleware;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Http\Controllers\Ajax\DashboardController as AjaxDashboardController;
use App\Http\Controllers\Backend\LanguageController;
use \App\Http\Controllers\Frontend\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('login', [HomeController::class, 'login'])->name('home.login');
Route::get('logout', [HomeController::class, 'logout'])->name('home.logout')->middleware('user');
Route::get('google/callback', [HomeController::class, 'googleCallback'])->name('home.google_callback');
Route::get('categories/{id}', [HomeController::class, 'singleCategory'])->name('home.single_category');
Route::get('news/{id}', [HomeController::class, 'singleNew'])->name('home.single_new');
Route::post('comment', [HomeController::class, 'comment'])->name('home.comment')->middleware('user');
Route::post('delete-comment/{id}', [HomeController::class, 'deleteComment'])->name('home.delete_comment')->middleware('user');
Route::post('save_post', [HomeController::class, 'savePost'])->name('home.save_post')->middleware('user');
Route::get('profile', [HomeController::class, 'profile'])->name('home.profile')->middleware('user');
Route::post('profile', [HomeController::class, 'editProfile'])->name('home.edit_profile')->middleware('user');

// ADMIN ROUTES
Route::get('dashboard/index', [DashboardController::class, 'index'])->name('admin.dashboard')->middleware('admin', 'locale');
Route::get('admin/login', [AuthController::class, 'index'])->name('auth.login')->middleware(LoginMiddleware::class);
Route::post('login', [AuthController::class, 'login'])->name('auth.logged');

//USER
Route::group(['prefix' => 'user'], function(){
    Route::get('index', [UserController::class, 'index'])->name('user.index')->middleware('admin', 'locale');
    Route::get('create', [UserController::class, 'create'])->name('user.create')->middleware('admin', 'locale');
    Route::post('store', [UserController::class, 'store'])->name('user.store')->middleware('admin', 'locale');
    Route::get('edit/{id}', [UserController::class, 'edit'])->where(['id'], '[0-9]+')
                                                            ->name('user.edit')->middleware('admin', 'locale');
    Route::post('update/{id}', [UserController::class, 'update'])
                                                            ->where(['id'], '[0-9]+')
                                                            ->name('user.update')->middleware('admin', 'locale');
    Route::get('delete/{id}', [UserController::class, 'delete'])
                                                            ->where(['id'], '[0-9]+')
                                                            ->name('user.delete')->middleware('admin', 'locale');
    Route::delete('destroy/{id}', [UserController::class, 'destroy'])
                                                            ->where(['id'], '[0-9]+')
                                                            ->name('user.destroy')->middleware('admin', 'locale');
});

//USER CATALOGUE
Route::group(['prefix' => 'user/catalogue'], function(){
    Route::get('index', [UserCatalogueController::class, 'index'])->name('user.catalogue.index')->middleware('admin', 'locale');
    Route::get('create', [UserCatalogueController::class, 'create'])->name('user.catalogue.create')->middleware('admin', 'locale');
    Route::post('store', [UserCatalogueController::class, 'store'])->name('user.catalogue.store')->middleware('admin', 'locale');
    Route::get('edit/{id}', [UserCatalogueController::class, 'edit'])->where(['id'], '[0-9]+')
                                                            ->name('user.catalogue.edit')->middleware('admin', 'locale');
    Route::post('update/{id}', [UserCatalogueController::class, 'update'])
                                                            ->where(['id'], '[0-9]+')
                                                            ->name('user.catalogue.update')->middleware('admin', 'locale');
    Route::get('delete/{id}', [UserCatalogueController::class, 'delete'])
                                                            ->where(['id'], '[0-9]+')
                                                            ->name('user.catalogue.delete')->middleware('admin', 'locale');
    Route::delete('destroy/{id}', [UserCatalogueController::class, 'destroy'])
                                                            ->where(['id'], '[0-9]+')
                                                            ->name('user.catalogue.destroy')->middleware('admin', 'locale');
    Route::get('permission', [UserCatalogueController::class, 'permission'])->name('user.catalogue.permission')->middleware('admin', 'locale');

    Route::post('updatePermission', [UserCatalogueController::class, 'updatePermission'])->name('user.catalogue.updatePermission')->middleware('admin', 'locale');
});


//LANGUAGE
Route::group(['prefix' => 'language'], function(){
    Route::get('index', [LanguageController::class, 'index'])->name('language.index')->middleware('admin', 'locale');
    Route::get('create', [LanguageController::class, 'create'])->name('language.create')->middleware('admin', 'locale');
    Route::post('store', [LanguageController::class, 'store'])->name('language.store')->middleware('admin', 'locale');
    Route::get('edit/{id}', [LanguageController::class, 'edit'])->where(['id'], '[0-9]+')
                                                            ->name('language.edit')->middleware('admin', 'locale');
    Route::post('update/{id}', [LanguageController::class, 'update'])
                                                            ->where(['id'], '[0-9]+')
                                                            ->name('language.update')->middleware('admin', 'locale');
    Route::get('delete/{id}', [LanguageController::class, 'delete'])
                                                            ->where(['id'], '[0-9]+')
                                                            ->name('language.delete')->middleware('admin', 'locale');
    Route::delete('destroy/{id}', [LanguageController::class, 'destroy'])
                                                            ->where(['id'], '[0-9]+')
                                                            ->name('language.destroy')->middleware('admin', 'locale');
});
//POST CATALOGUE
Route::group(['prefix' => 'post/catalogue'], function(){
    Route::get('index', [PostCatalogueController::class, 'index'])->name('post.catalogue.index')->middleware('admin', 'locale');
    Route::get('create', [PostCatalogueController::class, 'create'])->name('post.catalogue.create')->middleware('admin', 'locale');
    Route::post('store', [PostCatalogueController::class, 'store'])->name('post.catalogue.store')->middleware('admin', 'locale');
    Route::get('edit/{id}', [PostCatalogueController::class, 'edit'])->where(['id'], '[0-9]+')
                                                            ->name('post.catalogue.edit')->middleware('admin', 'locale');
    Route::post('update/{id}', [PostCatalogueController::class, 'update'])
                                                            ->where(['id'], '[0-9]+')
                                                            ->name('post.catalogue.update')->middleware('admin', 'locale');
    Route::get('delete/{id}', [PostCatalogueController::class, 'delete'])
                                                            ->where(['id'], '[0-9]+')
                                                            ->name('post.catalogue.delete')->middleware('admin', 'locale');
    Route::delete('destroy/{id}', [PostCatalogueController::class, 'destroy'])
                                                            ->where(['id'], '[0-9]+')
                                                            ->name('post.catalogue.destroy')->middleware('admin', 'locale');
});
//POST
Route::group(['prefix' => 'post'], function(){
    Route::get('index', [PostController::class, 'index'])->name('post.index')->middleware('admin', 'locale');
    Route::get('create', [PostController::class, 'create'])->name('post.create')->middleware('admin', 'locale');
    Route::post('store', [PostController::class, 'store'])->name('post.store')->middleware('admin', 'locale');
    Route::get('edit/{id}', [PostController::class, 'edit'])->where(['id'], '[0-9]+')
                                                            ->name('post.edit')->middleware('admin', 'locale');
    Route::post('update/{id}', [PostController::class, 'update'])
                                                            ->where(['id'], '[0-9]+')
                                                            ->name('post.update')->middleware('admin', 'locale');
    Route::get('delete/{id}', [PostController::class, 'delete'])
                                                            ->where(['id'], '[0-9]+')
                                                            ->name('post.delete')->middleware('admin', 'locale');
    Route::delete('destroy/{id}', [PostController::class, 'destroy'])
                                                            ->where(['id'], '[0-9]+')
                                                            ->name('post.destroy')->middleware('admin', 'locale');
    Route::get('{id}/switch', [LanguageController::class, 'switchBackendLanguage'])
                                                            ->where(['id'], '[0-9]+')
                                                            ->name('language.switch');
});

//PERMISSION
Route::group(['prefix' => 'permission'], function(){
    Route::get('index', [PermissionController::class, 'index'])->name('permission.index')->middleware('admin', 'locale');
    Route::get('create', [PermissionController::class, 'create'])->name('permission.create')->middleware('admin', 'locale');
    Route::post('store', [PermissionController::class, 'store'])->name('permission.store')->middleware('admin', 'locale');
    Route::get('edit/{id}', [PermissionController::class, 'edit'])->where(['id'], '[0-9]+')
                                                            ->name('permission.edit')->middleware('admin', 'locale');
    Route::post('update/{id}', [PermissionController::class, 'update'])
                                                            ->where(['id'], '[0-9]+')
                                                            ->name('permission.update')->middleware('admin', 'locale');
    Route::get('delete/{id}', [PermissionController::class, 'delete'])
                                                            ->where(['id'], '[0-9]+')
                                                            ->name('permission.delete')->middleware('admin', 'locale');
    Route::delete('destroy/{id}', [PermissionController::class, 'destroy'])
                                                            ->where(['id'], '[0-9]+')
                                                            ->name('permission.destroy')->middleware('admin', 'locale');
});
//AJAX
Route::get('ajax/location/getLocation', [LocationController::class, 'getLocation'])->name('ajax.location.getLocation')->middleware('admin', 'locale');;
Route::post('ajax/dashboard/changeStatus', [AjaxDashboardController::class, 'changeStatus'])->name('ajax.dashboard.changeStatus')->middleware('admin', 'locale');;
Route::post('ajax/dashboard/changeStatusAll', [AjaxDashboardController::class, 'changeStatusAll'])->name('ajax.dashboard.changeStatusAll')->middleware('admin', 'locale');;

// LOGIN LOGOUT ADMIN ROUTES
Route::group(['prefix' => 'user'], function(){
    Route::get('login', [AuthController::class, 'index'])->name('auth.login')->middleware(LoginMiddleware::class);
    Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');
});

