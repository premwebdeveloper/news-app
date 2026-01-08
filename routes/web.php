<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Models\Post;

Route::get('/', fn () => view('frontend.home'));

Route::get('/category/{slug}', function ($slug) {
    return view('frontend.category', ['category' => $slug]);
});

Route::get('/news/{slug}', function ($slug) {
    return view('frontend.news-detail');
});

Route::get('/news', function () {
    $posts = Post::where('status','published')->latest()->get();
    return view('frontend.news.index', compact('posts'));
});

Route::get('/news/{slug}', function ($slug) {
    $post = Post::where('slug',$slug)->where('status','published')->firstOrFail();
    return view('frontend.news.detail', compact('post'));
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth','admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', fn () => view('admin.dashboard'))->name('dashboard');
    Route::resource('users', UserController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('posts', PostController::class);
});

require __DIR__.'/auth.php';
