<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoriesController;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin', 'namespace' => 'App\Http\Controllers\Admin'], function () {
    Route::get('/', [DashboardController::class, 'index']);
    Route::resource('/categories', CategoriesController::class)->except(['show']);
    Route::resource('/tags', TagsController::class)->except(['show']);
    Route::resource('/users', UsersController::class)->except(['show']);
    Route::resource('/posts', PostsController::class)->except(['show']);
});
