<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\URL;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $urls = [];

        // Home page
        $urls[] = [
            'loc' => route('home'),
            'lastmod' => now()->toAtomString(),
            'changefreq' => 'daily',
            'priority' => '1.0',
        ];

        // Categories
        $categories = Category::where('status', 1)->get();
        foreach ($categories as $category) {
            $urls[] = [
                'loc' => route('category.show', $category->slug),
                'lastmod' => optional($category->updated_at ?? $category->created_at)->toAtomString(),
                'changefreq' => 'daily',
                'priority' => '0.8',
            ];
        }

        // All news posts (with a valid category)
        $posts = Post::with('category')
            ->whereHas('category')
            ->orderByDesc('updated_at')
            ->get();

        foreach ($posts as $post) {
            $urls[] = [
                'loc' => route('news.show', [
                    'category' => $post->category->slug,
                    'slug' => $post->slug,
                ]),
                'lastmod' => optional($post->updated_at ?? $post->created_at)->toAtomString(),
                'changefreq' => 'hourly',
                'priority' => '0.9',
            ];
        }

        $xml = view('frontend.sitemap', [
            'urls' => $urls,
            'host' => URL::to('/'),
        ])->render();

        return response($xml, 200)->header('Content-Type', 'application/xml');
    }
}

