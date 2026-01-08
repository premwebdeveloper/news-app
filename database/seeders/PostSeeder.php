<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all();

        foreach ($categories as $category) {
            for ($i = 1; $i <= 4; $i++) {

                $title = $category->name . " News Headline " . $i;

                Post::create([
                    'category_id' => $category->id,
                    'title' => $title,
                    'slug' => Str::slug($title) . '-' . uniqid(),
                    'short_description' => '<p>This is a short description for '.$title.'</p>',
                    'content' => '<p>This is <strong>dummy content</strong> for '.$title.'. It is added using seeder for testing purpose.</p>',
                    'status' => 'published',
                ]);
            }
        }
    }
}
