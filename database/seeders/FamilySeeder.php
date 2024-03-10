<?php

namespace Database\Seeders;

use App\Enums\PersonFamilyRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FamilySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contents = \File::get(base_path('storage/app/families.json'));
        $json = json_decode($contents, true);

        foreach ($json as $family) {
            $id = $family['id'];
            $husband_id = $family['husband_id'];
            $wife_id = $family['wife_id'];
            $in_service = $family['in_service'];
            $wife = null;

            $family = \App\Models\Family::create([
                'id' => $id,
                'status' => $in_service,
            ]);

            if ($husband_id != "") {
                $husband = \App\Models\Person::find($husband_id);
                if ($husband) {
                    $husband->update([
                        "family_id" => $family->id,
                        "family_role" => PersonFamilyRole::HUSBAND,
                    ]);
                }
            }

            if ($wife_id != "") {
                $wife = \App\Models\Person::find($wife_id);
                if ($wife) {
                    $wife->update([
                        "family_id" => $family->id,
                        "family_role" => PersonFamilyRole::WIFE,
                    ]);
                }
            }

            if ($husband_id == "" && $wife != null) {
                $family->update([
                    'name' => $wife->name
                ]);
            }

            if ($husband == null && $wife == null) {
                $family->delete();
            }
        }
    }
}
