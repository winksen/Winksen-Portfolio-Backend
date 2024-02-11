<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Blog;
use App\Models\Content;

class BlogSeeder extends Seeder
{
    public function run()
    {
        // Create sample blogs
        $blogs = Blog::factory()->count(5)->create();

        // Create content for each blog
        $blogs->each(function ($blog) {
            $contents = [
                // Define content for each blog here, for example:
                ['type' => 'paragraph', 'content' => ['Sample paragraph content']],
                ['type' => 'quote', 'content' => 'Sample quote content'],
                // Add more content sections as needed
            ];

            foreach ($contents as $contentData) {
                $blog->contents()->create([
                    'type' => $contentData['type'],
                    'content' => json_encode($contentData),
                ]);
            }
        });
    }
}
