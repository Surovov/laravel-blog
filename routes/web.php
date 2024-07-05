<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\AdminCommentsController;
use App\Http\Controllers\Admin\AdminSubscriptionsController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubsController;
use App\Http\Controllers\TestMailController;

use App\Http\Middleware\AdminMiddleware;


Route::get('/', [HomeController::class, 'index']);
Route::get('/post/{slug}', [HomeController::class, 'show'])->name('post.show');
Route::get('/tag/{slug}', [HomeController::class, 'tag'])->name('tag.show');
Route::get('/category/{slug}', [HomeController::class, 'category'])->name('category.show');
Route::post('/subscribe/', [SubsController::class, 'subscribe'])->name('subscribe');
// test email
Route::get('/send-test-mail', [TestMailController::class, 'sendTestMail']);
Route::get('/verify/{token}', [SubsController::class, 'verify'])->name('verify');

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
    Route::post('/comment', [CommentsController::class, 'store']);
    

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
        Route::get('/comments', [AdminCommentsController::class, 'index'])->name('comments.index');
        Route::get('/comments/toggle/{id}', [AdminCommentsController::class, 'toggle'])->name('comments.toggle');
        Route::delete('/comments/{id}/destroy', [AdminCommentsController::class, 'destroy'])->name('comments.destroy');
        Route::resource('/subscriptions', AdminSubscriptionsController::class);
    });
});

