<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;

class NewsController extends Controller
{
    public function show($slug)
    {
        // Menu ke liye categories
        $categories = Category::where('status', 1)->get();

        // Single post
        $post = Post::with(['category','seo'])
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        return view('frontend.news-detail', compact(
            'categories',
            'post'
        ));
    }
}
