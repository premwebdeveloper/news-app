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

        // Get politics news
        $politics = Post::with(['category','seo'])
            ->where(['status' => 'published', 'category_id' => 1])
            ->latest()
            ->take(6)
            ->get();

        // Get Sports news
        $sports = Post::with(['category','seo'])
            ->where(['status' => 'published', 'category_id' => 2])
            ->latest()
            ->take(9)
            ->get();

        // Get Technology news
        $technology = Post::with(['category','seo'])
            ->where(['status' => 'published', 'category_id' => 3])
            ->latest()
            ->take(8)
            ->get();

        // Get Entertainment news
        $entertainment = Post::with(['category','seo'])
            ->where(['status' => 'published', 'category_id' => 4])
            ->latest()
            ->take(10)
            ->get();
        
        // Get Business news
        $business = Post::with(['category','seo'])
            ->where(['status' => 'published', 'category_id' => 5])
            ->latest()
            ->take(1)
            ->first();
        
        // Get Jobs news
        $jobs = Post::with(['category','seo'])
            ->where(['status' => 'published', 'category_id' => 6])
            ->latest()
            ->take(2)
            ->get();

        return view('frontend.home', compact('categories', 'posts', 'politics', 'sports', 'technology', 'entertainment', 'business', 'jobs'));
    }
}
