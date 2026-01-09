<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;

class NewsController extends Controller
{
    public function show($category, $slug)
    {
        // Menu ke liye categories
        $categories = Category::where('status', 1)->get();

        // SEO-safe post fetch
        $post = Post::with(['category','seo'])
            ->where('slug', $slug)
            ->where('status', 'published')
            ->whereHas('category', function ($q) use ($category) {
                $q->where('slug', $category);
            })
            ->firstOrFail();

        return view('frontend.news-detail', compact(
            'categories',
            'post'
        ));
    }
}
