<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(Request $request, $categorySlug)
    {
        // Active categories (menu ke liye)
        $categories = Category::where('status', 1)->get();

        // Current category
        $category = Category::where('slug', $categorySlug)
            ->where('status', 1)
            ->firstOrFail();

        // Category ke posts
        // $posts = Post::with('category')
        //     ->where('category_id', $category->id)
        //     ->where('status', 'published')
        //     ->latest()
        //     ->paginate(15);

        $posts = Post::with(['category:id,name,slug'])
            ->where('category_id', $category->id)
            ->where('status', 'published')
            ->latest()
            ->select('id','title','slug','image','content','category_id','created_at')
            ->paginate(15);

        // AJAX request ke liye sirf posts HTML return karo
        if ($request->ajax()) {
            return view('frontend.partials.category-posts', compact('posts'))->render();
        }

        return view('frontend.category', compact(
            'categories',
            'category',
            'posts'
        ));
    }
}
