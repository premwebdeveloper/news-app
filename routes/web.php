<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

// ================= FRONTEND CONTROLLERS =================
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\CategoryController as FrontCategoryController;
use App\Http\Controllers\Frontend\NewsController;

// ================= ADMIN CONTROLLERS ====================
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\PostController;

Route::get('/__route-test', function () {
    return 'ROUTE FILE LIVE';
});


/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| SEO Friendly News Detail URL (MUST COME FIRST)
|--------------------------------------------------------------------------
*/
Route::get('/{category}/{slug}', [NewsController::class, 'show'])
    ->name('news.show')
    ->where([
        'category' => '[a-z0-9\-]+',
        'slug' => '[a-z0-9\-]+',
    ]);

/*
|--------------------------------------------------------------------------
| Category Page (ALWAYS AFTER news route)
|--------------------------------------------------------------------------
*/
Route::get('/{category}', [FrontCategoryController::class, 'show'])
    ->name('category.show')
    ->where('category', '[a-z0-9\-]+');

/*
|--------------------------------------------------------------------------
| Authenticated User Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', fn () => view('admin.dashboard'))->name('dashboard');
        Route::resource('users', UserController::class);
        Route::resource('categories', AdminCategoryController::class);
        Route::resource('posts', PostController::class);
});

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
