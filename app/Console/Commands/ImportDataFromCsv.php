<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Gallery;
use App\Models\Image;
use App\Models\Blog;
use App\Models\Content;

class ImportDataFromCsv extends Command
{
    protected $signature = 'import:data:csv';

    protected $description = 'Import data from CSV files';

    public function handle()
    {
        $this->importData(User::class, 'users.csv');
        $this->importData(Gallery::class, 'galleries.csv');
        $this->importData(Image::class, 'images.csv');
        $this->importData(Blog::class, 'blogs.csv');
        $this->importData(Content::class, 'contents.csv');
    }

    private function importData($modelClass, $filename)
    {
        $csvFile = fopen(storage_path("app/backup/$filename"), 'r');

        if ($csvFile !== false) {
            $headers = fgetcsv($csvFile);

            while ($row = fgetcsv($csvFile)) {
                $data = array_combine($headers, $row);
                $modelClass::create($data);
            }

            fclose($csvFile);

            $this->info("Data imported from $filename");
        } else {
            $this->error("Failed to open $filename");
        }
    }
}

