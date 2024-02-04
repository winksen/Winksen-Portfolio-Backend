<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ChangeLogsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 2) as $index) {
            DB::table('changelogs')->insert([
                'type' => 'pageImprovement',
                'name' => 'CHANGELOG',
                'href' => '/changelog',
                'version' => '0.1.66',
                'comment' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Tincidunt nunc ipsum tempor purus vitae id. Morbi in vestibulum nec varius. Et diam cursus quis sed purus nam.',
                'date' => '6d ago',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
