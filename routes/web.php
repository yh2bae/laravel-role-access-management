<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CkeditorController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\CategoryProductController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\ConfigWebController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ServiceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('login/check', [AuthController::class, 'login'])->name('login.check'); 
Route::get('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');


Route::middleware(['auth', 'web'])->group(function () {
    Route::prefix('admin-panel')->group(function () {

        // CKeditor Upload
        Route::post('/ckeditor/upload', [CkeditorController::class, 'upload'])->name('upload');

        Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

        Route::resource('/user', UserController::class)->except('show');

        Route::resource('/role', RoleController::class)->except('show');
        Route::get('/role/access/{id}', [RoleController::class, 'roleAccess'])->name('role.access');
        Route::post('role/proses_role_access', [RoleController::class, 'proses_role_access'])->name('role.proses');

        // Configuration 
        Route::resource('/config', ConfigWebController::class)->shallow()->only(['index', 'update']);

        // ABOUT 
        Route::resource('/about', AboutController::class)->shallow()->only(['index', 'update']);

        // Product
        Route::resource('/category-product', CategoryProductController::class)->except(['show']);
        Route::resource('/product', ProductController::class)->except(['show']);

        // Service
        Route::resource('/service', ServiceController::class)->except(['show']);

        // Client
        Route::resource('/client', ClientController::class)->except(['show']);
    });
});