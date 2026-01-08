<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Politics',
            'Sports',
            'Technology',
            'Entertainment',
            'Business',
            'Jobs',
        ];

        foreach ($categories as $cat) {
            Category::updateOrCreate(
                ['name' => $cat],
                [
                    'slug' => Str::slug($cat),
                    'status' => 1,
                ]
            );
        }
    }
}
