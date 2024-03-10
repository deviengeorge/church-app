<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contents = \File::get(base_path('storage/app/areas.json'));
        $json = json_decode($contents, true);

        foreach ($json as $area) {
            $name = $area['name'];

            \App\Models\Area::create([
                "name" => $name,
            ]);
        }
    }
}
