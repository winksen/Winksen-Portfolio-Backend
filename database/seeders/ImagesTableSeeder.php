<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ImagesTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 20) as $index) {
            DB::table('images')->insert([
                'gallery_id' => '21',
                'imageUrl' => '/images/Malaysia.jpg',
                'title' => 'Malaysia 2023',
                'alt' => '/portfolio/gallery/malaysia-2023',
                'gallery' => 'Here are the biggest enterprise technology acquisitions of 2021 so far, in reverse chronological order.',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
