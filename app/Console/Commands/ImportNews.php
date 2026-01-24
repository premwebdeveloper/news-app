<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use App\Models\Post;
use App\Models\Category;

class ImportNews extends Command
{
    protected $signature = 'news:import';
    protected $description = 'Import latest news from API category wise';

    public function handle()
    {
        $this->info('News import started at ' . now());

        $categories = Category::all();

        foreach ($categories as $category) {

            $response = Http::timeout(30)->get(config('services.newsapi.url'), [
                'apiKey'   => config('services.newsapi.key'),
                'q'        => trim($category->slug),
                'language' => 'en',
                'sortBy'   => 'publishedAt',
                'pageSize' => 20,
            ]);

            if (! $response->successful()) {
                $this->error("API failed for: {$category->slug}");
                continue;
            }

            $articles = $response->json('articles');

            if (empty($articles)) {
                continue;
            }

            foreach ($articles as $article) {

                if (empty($article['title']) || empty($article['urlToImage'])) {
                    continue;
                }

                $slug = Str::slug($article['title']);

                if (Post::where('slug', $slug)->exists()) {
                    continue;
                }

                Post::create([
                    'category_id'       => $category->id,
                    'title'             => $article['title'],
                    'slug'              => $slug,
                    'short_description' => $article['description'] ?? null,
                    'content'           => $article['content'] ?? null,
                    'image'             => $article['urlToImage'] ?? null,
                    'status'            => 'published',
                ]);
            }
        }

        $this->info('News import completed at ' . now());
    }
}
