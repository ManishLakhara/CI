<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //City::truncate();
        $csvFile = fopen(base_path("database/data/cities.csv"),'r');

        $firstline = true;

        while (($data = fgetcsv($csvFile,2000,',')) !== FALSE) {
            if (!$firstline) {
                City::create([
                    "country_id" => $data['5'],
                    "name" => $data['1']
                ]);
            }
            $firstline = false;
        }
        fclose($csvFile);
    }
}
