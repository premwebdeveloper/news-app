<?php

dd('ROUTES FILE HIT');


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

/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');

// Route::get('/category/{slug}', [FrontCategoryController::class, 'show'])
//     ->name('category.show');

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

        Route::get('/dashboard', fn () => view('admin.dashboard'))
            ->name('dashboard');

        Route::resource('users', UserController::class);
        Route::resource('categories', AdminCategoryController::class);
        Route::resource('posts', PostController::class);
});

/*
|--------------------------------------------------------------------------
| Auth Routes (Laravel Breeze / Fortify)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';


// SEO Friendly News Detail URL
// Is route ko file bilkul bottom me rakhna hai taake ye sabse last me match ho
Route::get('/{category}/{slug}', [NewsController::class, 'show'])
    ->name('news.show')
    ->where([
        'category' => '[a-z0-9\-]+',
        'slug' => '[a-z0-9\-]+'
    ]);

