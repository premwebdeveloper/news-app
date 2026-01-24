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

        $images = [
            'politics' => 'https://images.unsplash.com/photo-1529107386315-e1a2ed48a620',
            'sports' => 'https://images.unsplash.com/photo-1508609349937-5ec4ae374ebf',
            'technology' => 'https://images.unsplash.com/photo-1518770660439-4636190af475',
            'entertainment' => 'https://images.unsplash.com/photo-1497032628192-86f99bcd76bc',
            'business' => 'https://images.unsplash.com/photo-1507679799987-c73779587ccf',
            'jobs' => 'https://images.unsplash.com/photo-1521737604893-d14cc237f11d', // 👈 JOB IMAGE
        ];

        foreach ($categories as $category) {

            $catSlug = Str::slug($category->name);
            $image = $images[$catSlug] ?? $images['business'];

            for ($i = 1; $i <= 4; $i++) {

                // 👇 Job category ke liye alag title
                if ($catSlug === 'jobs') {
                    $title = "Latest Job Opening ".$i." – Apply Now";
                } else {
                    $title = $category->name." Breaking News ".$i;
                }

                // Post::create([
                //     'category_id' => $category->id,
                //     'title' => $title,
                //     'slug' => Str::slug($title).'-'.uniqid(),
                //     'short_description' =>
                //         $catSlug === 'jobs'
                //         ? '<p><strong>Job Location:</strong> India | <strong>Experience:</strong> 0–3 Years</p>'
                //         : '<p>This is a short description for <strong>'.$title.'</strong>.</p>',

                //     'content' =>
                //         $catSlug === 'jobs'
                //         ? '<p><strong>Job Description:</strong></p>
                //         <ul>
                //             <li>Good communication skills</li>
                //             <li>Relevant technical knowledge</li>
                //             <li>Freshers can apply</li>
                //         </ul>
                //         <p><strong>How to Apply:</strong> Apply online before last date.</p>'
                //         : '<p>This is full news content for <strong>'.$title.'</strong>.</p>',

                //     'image' => $image,
                //     'status' => 'published',
                // ]);
            }
        }
    }
}
