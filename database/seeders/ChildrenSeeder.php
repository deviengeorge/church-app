<?php

namespace Database\Seeders;

use App\Enums\PersonFamilyRole;
use App\Enums\PersonTitle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChildrenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contents = \File::get(base_path('storage/app/people.json'));
        $json = json_decode($contents, true);

        foreach ($json as $person) {
            $id = $person['id'];
            $title = $person['role'];
            $family_id = $person['family_id'];
            $family_role = null;

            if ($title == "الابنة" || $title == "الابن") {
                if ($title == "الابن") {
                    $family_role = PersonFamilyRole::SON;
                } else if ($title == "الابنة") {
                    $family_role = PersonFamilyRole::DAUGHTER;
                }
            } else {
                continue;
            }

            \App\Models\Person::find($id)->update([
                "family_id" => $family_id,
                "family_role" => $family_role
            ]);
        }
    }
}
