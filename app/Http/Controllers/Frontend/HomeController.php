<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        // Header ke liye categories
        $categories = Category::where('status', 1)->get();

        // Home page ke latest posts
        $posts = Post::with(['category','seo'])
            ->where('status', 'published')
            ->latest()
            ->take(9)
            ->get();

        return view('frontend.home', compact('categories', 'posts'));
    }
}
