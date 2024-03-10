<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 
        $contents = \File::get(base_path('storage/app/addresses.json'));
        $json = json_decode($contents, true);

        foreach ($json as $address) {
            $id = $address['id'];
            $family_id = $address['family_id'];

            $area_id = $address['area_id'];
            $area = $address['area'];

            $street_id = $address['street_id'];
            $street = $address['street'];

            $building = $address['building'];
            $floor = $address['floor'];
            $notes = $address['notes'];

            if ($area_id == "#N/A") {
                if ($area != "") {
                    $notes = $notes . "\nالمنطقة: $area";
                } else {
                    $notes = $notes . "\nالمنطقة: غير معروف";
                }

                $area_id = null;
            }

            if ($street_id == "#N/A") {
                if ($street != "") {
                    $notes = $notes . "\nالشارع: $street";
                } else {
                    $notes = $notes . "\nالشارع: غير معروف";
                }

                $street_id = null;
            }

            $family = \App\Models\Family::find($family_id);

            if ($family != null) {
                $family->update([
                    "area_id" => $area_id,
                    "street_id" => $street_id,
                    "building_num" => $building,
                    "floor_num" => $floor,
                    "more_location_info" => $notes,
                ]);
            }
        }
    }
}
