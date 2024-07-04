<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoriesController;


use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/post/{slug}', [HomeController::class, 'show'])->name('post.show');
Route::get('/tag/{slug}', [HomeController::class, 'tag'])->name('tag.show');
Route::get('/category/{slug}', [HomeController::class, 'category'])->name('category.show');

// Route::get('/', function () {
//     return view('welcome');
// });

Route::group(['prefix' => 'admin', 'namespace' => 'App\Http\Controllers\Admin'], function () {
    Route::get('/', [DashboardController::class, 'index']);
    Route::resource('/categories', CategoriesController::class)->except(['show']);
    Route::resource('/tags', TagsController::class)->except(['show']);
    Route::resource('/users', UsersController::class)->except(['show']);
    Route::resource('/posts', PostsController::class)->except(['show']);
});
