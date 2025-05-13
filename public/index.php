<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

// define() dùng để định nghĩa một hằng số (constant) trong PHP.
// Laravel định nghĩa hằng số LARAVEL_START.
// Dùng để tính thời gian thực thi toàn bộ request → phục vụ đo hiệu suất (performance).
define('LARAVEL_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Check If The Application Is Under Maintenance
|--------------------------------------------------------------------------
|
| If the application is in maintenance / demo mode via the "down" command
| we will load this file so that any pre-rendered content can be shown
| instead of starting the framework, which could cause an exception.
|
*/

// Nếu file storage/framework/maintenance.php tồn tại:
// Ứng dụng đang bảo trì (php artisan down bật).
// Sẽ không khởi chạy Laravel framework, thay vào đó trả sẵn response bảo trì.

// Giúp tránh lỗi hệ thống khi deploy hoặc bảo trì.
if (file_exists($maintenance = __DIR__ . '/../storage/framework/maintenance.php')) {
    require $maintenance;
}

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| this application. We just need to utilize it! We'll simply require it
| into the script here so we don't need to manually load our classes.
|
*/

// Load tất cả thư viện đã cài qua Composer (vendor/ folder).

// Gồm:
// Core Laravel framework
// Các package (Guzzle, Carbon, Socialite, Passport...)
require __DIR__ . '/../vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request using
| the application's HTTP kernel. Then, we will send the response back
| to this client's browser, allowing them to enjoy our application.
|
*/

$app = require_once __DIR__ . '/../bootstrap/app.php';
// Khởi tạo instance của Illuminate\Foundation\Application.

// Đây là Application Container của Laravel:
// Quản lý binding service
// Quản lý lifecycle của hệ thống



$kernel = $app->make(Kernel::class);
// Kernel = trung tâm điều phối:
// Nhận Request
// Chạy Middleware
// Gửi Request đến Router
// Nhận Response trả về


$response = $kernel->handle(
    $request = Request::capture()
)->send();
// Capture request từ client (browser/API).
// Handle qua Middleware → Route → Controller.
// Send response về cho client (HTML, JSON, file...).



$kernel->terminate($request, $response);
// Một số middleware (ví dụ: session save, logging request) cần xử lý sau khi response đã gửi đi.
// terminate() sẽ chạy chúng.