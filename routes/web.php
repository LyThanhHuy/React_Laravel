<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('app');
});

// Trang login
Route::get('admin/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin/login', [LoginController::class, 'login'])->name('admin.login.submit');

// Dashboard
Route::get('admin/dashboard', function () {
    return view('admin.dashboard.index');
})->middleware('auth:admin')->name('admin.dashboard');


Route::prefix('admin')->middleware('auth:admin')->name('admin.')->group(function () {

    Route::get('categories', [CategoryController::class, 'index'])->name('categories');
    // Form tạo mới danh mục
    Route::get('categories/create', [CategoryController::class, 'create'])->name('categories.create');
    // Tạo mới danh mục
    Route::post('categories/store', [CategoryController::class, 'store'])->name('categories.store');
    // Form edit danh mục 
    Route::get('categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    // Gửi request edit danh mục
    Route::put('categories/{id}', [CategoryController::class, 'update'])->name('categories.update');

    
});

// Logout
Route::post('admin/logout', [LoginController::class, 'logout'])->name('admin.logout');
