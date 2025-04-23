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

Route::middleware('guest:admin')->group(function () {
    Route::get('admin/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('admin/login', [LoginController::class, 'login']);
});

Route::post('admin//logout', [LoginController::class, 'logout'])->name('admin.logout');


Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Category
    Route::get('category', [CategoryController::class, 'index'])->name('category');
});
