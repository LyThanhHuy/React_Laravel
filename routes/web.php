<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
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

// Logout
Route::post('admin/logout', [LoginController::class, 'logout'])->name('admin.logout');

// Dashboard Admin
Route::get('admin/dashboard', function () {
    return view('admin.dashboard.index');
})->middleware('auth:admin')->name('admin.dashboard');


Route::prefix('admin')->middleware('admin:admin')->name('admin.')->group(function () {

    Route::get('categories', [CategoryController::class, 'index'])->name('categories');
    // Form tạo mới danh mục
    Route::get('categories/create', [CategoryController::class, 'create'])->name('categories.create');
    // Tạo mới danh mục
    Route::post('categories/store', [CategoryController::class, 'store'])->name('categories.store');
    // Form edit danh mục 
    Route::get('categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    // Gửi request edit danh mục
    Route::put('categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
    // Xóa danh mục
    Route::delete('categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    Route::get('products', [ProductController::class, 'index'])->name('products');
    // Form tạo mới products
    Route::get('products/create', [ProductController::class, 'create'])->name('products.create');
    // Tạo mới products
    Route::post('products/store', [ProductController::class, 'store'])->name('products.store');
    // Form edit products
    Route::get('products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    // Gửi request edit products
    Route::put('products/{product}/', [ProductController::class, 'update'])->name('products.update');
    // Xóa products
    Route::delete('products/{product}/', [ProductController::class, 'destroy'])->name('products.destroy');

    Route::get('orders', [OrderController::class, 'index'])->name('orders');
});


// Dashboard User
Route::get('/dashboard', [UserDashboardController::class, 'index']);
