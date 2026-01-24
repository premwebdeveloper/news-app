<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use App\Models\Post;
use App\Models\Category;

class ImportHindiNews extends Command
{
    protected $signature = 'news:import-hindi';
    protected $description = 'Import Hindi news from GNews API (India)';

    public function handle()
    {
        $this->info('Hindi News import started at ' . now());

        $categories = Category::all();

        foreach ($categories as $category) {

            $response = Http::get(config('services.gnews.url'), [
                'token'   => config('services.gnews.key'),
                'country' => 'in',
                'lang'    => 'hi',
                'max'     => 10,
                'topic'   => $category->slug, 
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

                if (empty($article['title']) || empty($article['image'])) {
                    continue;
                }

                $slug = Str::slug($article['title']);

                // if (Post::where('slug', $slug)->exists()) {
                //     continue;
                // }

                // if (Post::where('source_url', $article['url'])->exists()) {
                //     continue;
                // }

                if (
                    Post::where('slug', $slug)
                        ->orWhere('source_url', $article['url'])
                        ->exists()
                ) {
                    continue;
                }

                Post::create([
                    'category_id'       => $category->id,
                    'title'             => $article['title'],
                    'slug'              => $slug,
                    'short_description' => $article['description'] ?? null,
                    'content'           => $article['content'] ?? null,
                    'image'             => $article['image'],
                    'source_url' => $article['url'] ?? null,
                    'status'            => 'published',
                ]);
            }
        }

        $this->info('Hindi News import completed at ' . now());
    }
}
