<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\ProfileController;



Route::get('/', [HomeController::class, 'index']);
Route::get('/post/{slug}', [HomeController::class, 'show'])->name('post.show');
Route::get('/tag/{slug}', [HomeController::class, 'tag'])->name('tag.show');
Route::get('/category/{slug}', [HomeController::class, 'category'])->name('category.show');


// Группа маршрутов для гостей (незарегистрированных пользователей)
Route::middleware(['guest'])->group(function () {
    Route::get('/register', [AuthController::class, 'registerForm'])->name('register.form');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::get('/login', [AuthController::class, 'loginForm'])->name('login.form');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});

// Маршрут для выхода, доступный только для аутентифицированных пользователей
Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile', [ProfileController::class, 'store']);


});


// Route::get('/', function () {
//     return view('welcome');
// });
Route::middleware([AdminMiddleware::class])->group(function () {
    Route::group(['prefix' => 'admin', 'namespace' => 'App\Http\Controllers\Admin'], function () {
        Route::get('/', [DashboardController::class, 'index']);
        Route::resource('/categories', CategoriesController::class)->except(['show']);
        Route::resource('/tags', TagsController::class)->except(['show']);
        Route::resource('/users', UsersController::class)->except(['show']);
        Route::resource('/posts', PostsController::class)->except(['show']);
    });
});

