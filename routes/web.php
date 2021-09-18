<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RoleController;

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


Route::get('/login', [AuthController::class, 'index'])->name('auth');
Route::post('login/check', [AuthController::class, 'login'])->name('login'); 
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware(['auth', 'web'])->group(function () {
    Route::prefix('admin-panel')->group(function () {

        Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

        Route::resource('/user', UserController::class)->except('show');

        Route::resource('/role', RoleController::class)->except('show');
        Route::get('/role/access/{id}', [RoleController::class, 'roleAccess'])->name('role.access');
        Route::post('role/proses_role_access', [RoleController::class, 'proses_role_access'])->name('role.proses');
    });
});