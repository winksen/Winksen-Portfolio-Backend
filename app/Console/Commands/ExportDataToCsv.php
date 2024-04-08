<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Gallery;
use App\Models\Image;
use App\Models\Blog;
use App\Models\Content;
use App\Models\Changelog;
use App\Models\Contact;
use App\Models\Newsletter;

class ExportDataToCsv extends Command
{
    protected $signature = 'export:data:csv';

    protected $description = 'Export data to CSV files';

    public function handle()
    {
        $this->exportData(User::class, 'users.csv');
        $this->exportData(Gallery::class, 'galleries.csv');
        $this->exportData(Image::class, 'images.csv');
        $this->exportData(Blog::class, 'blogs.csv');
        $this->exportData(Content::class, 'contents.csv');
        $this->exportData(Changelog::class, 'changelogs.csv');
        $this->exportData(Contact::class, 'contacts.csv');
        $this->exportData(Newsletter::class, 'newsletters.csv');
    }

    private function exportData($modelClass, $filename)
    {
        $data = $modelClass::all()->toArray();

        if (!empty($data)) {
            $csvFile = fopen(storage_path("app/backup/$filename"), 'w');

            fputcsv($csvFile, array_keys($data[0]));

            foreach ($data as $row) {
                fputcsv($csvFile, $row);
            }

            fclose($csvFile);

            $this->info("Data exported to $filename");
        } else {
            $this->info("No data found for $filename");
        }
    }
}
