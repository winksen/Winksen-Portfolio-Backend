<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Gallery;
use App\Models\Image;
use App\Models\Blog;
use App\Models\Content;
use App\Models\ChangeLog;
use App\Models\Contact;
use App\Models\Newsletter;

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
        $this->importData(ChangeLog::class, 'changelogs.csv');
        $this->importData(Contact::class, 'contacts.csv');
        $this->importData(Newsletter::class, 'newsletters.csv');
    }

    private function importData($modelClass, $filename)
    {
        $csvFile = fopen(storage_path("app/backup/$filename"), 'r');

        if ($csvFile !== false) {
            $headers = fgetcsv($csvFile);

            while ($row = fgetcsv($csvFile)) {
                $data = array_combine($headers, $row);
                
                // Check if the 'date' column exists and needs to be converted
                if (isset($data['date'])) {
                    $data['date'] = Carbon::parse($data['date'])->toDateTimeString();
                }

                $modelClass::create($data);
            }

            fclose($csvFile);

            $this->info("Data imported from $filename");
        } else {
            $this->error("Failed to open $filename");
        }
    }

}

