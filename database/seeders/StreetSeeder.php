<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StreetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contents = \File::get(base_path('storage/app/streets.json'));
        $json = json_decode($contents, true);

        foreach ($json as $street) {
            $name = $street['name'];
            $area_id = $street['area_id'];
            $in_church_service = $street['in_church_service'];

            \App\Models\Street::create([
                "name" => $name,
                "area_id" => $area_id,
                "in_church_service" => $in_church_service
            ]);
        }

    }
}
