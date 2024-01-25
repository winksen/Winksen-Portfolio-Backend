<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class GalleriesTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 20) as $index) {
            DB::table('galleries')->insert([
                'imageUrl' => '/images/Malaysia.jpg',
                'title' => 'Malaysia 2023',
                'link' => '/portfolio/gallery/malaysia-2023',
                'description' => 'Here are the biggest enterprise technology acquisitions of 2021 so far, in reverse chronological order.',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
