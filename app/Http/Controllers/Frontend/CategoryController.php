<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;

class CategoryController extends Controller
{
    public function show($categorySlug)
    {
        // Active categories (menu ke liye)
        $categories = Category::where('status', 1)->get();

        // Current category
        $category = Category::where('slug', $categorySlug)
            ->where('status', 1)
            ->firstOrFail();

        // Category ke posts
        $posts = Post::with('category')
            ->where('category_id', $category->id)
            ->where('status', 'published')
            ->latest()
            ->paginate(9);

        return view('frontend.category', compact(
            'categories',
            'category',
            'posts'
        ));
    }
}
