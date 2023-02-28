<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Country::truncate();

        $csvFile = fopen(base_path("database/data/countries.csv"),'r');

        $firstline = true;

        while (($data = fgetcsv($csvFile,2000,',')) !== FALSE) {
            if (!$firstline) {
                Country::create([
                    "name" => $data['1'],
                    "ISO" => $data['2']
                ]);
            }
            $firstline = false;
        }
        fclose($csvFile);
    }
}
