<?php

use App\Http\Controllers\Ajax\LocationController;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Backend\AuthenticateMiddleware;
use App\Http\Middleware\Backend\LoginMiddleware;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

Route::get('/', function () {
    return view('welcome');
});

// ADMIN ROUTES
Route::get('dashboard/index', [DashboardController::class, 'index'])->name('admin.dashboard')->middleware('admin');
Route::get('admin/login', [AuthController::class, 'index'])->name('auth.login')->middleware(LoginMiddleware::class); 
Route::post('login', [AuthController::class, 'login'])->name('auth.logged');

//CRUD USER
Route::group(['prefix' => 'user'], function(){
    Route::get('index', [UserController::class, 'index'])->name('user.index')->middleware('admin');
    Route::get('create', [UserController::class, 'create'])->name('user.create')->middleware('admin');
    Route::post('store', [UserController::class, 'store'])->name('user.store')->middleware('admin');
});
//AJAX
Route::get('ajax/location/getLocation', [LocationController::class, 'getLocation'])->name('ajax.location.getLocation');

// LOGIN LOGOUT ADMIN ROUTES
Route::group(['prefix' => 'user'], function(){
    Route::get('login', [AuthController::class, 'index'])->name('auth.login')->middleware(LoginMiddleware::class);    
    Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');
});