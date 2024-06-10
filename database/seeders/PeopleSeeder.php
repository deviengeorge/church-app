<?php

namespace Database\Seeders;

use App\Enums\PersonStatus;
use App\Enums\PersonTitle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PeopleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contents = \File::get(base_path('storage/app/people.json'));
        $json = json_decode($contents, true);

        foreach ($json as $person) {
            $names = [];
            $id = $person['id'];
            $names[0] = $person['1'];
            $names[1] = $person['2'];
            $names[2] = $person['3'];
            $names[3] = $person['4'];
            $names[4] = $person['5'];
            $title = $person['role'];
            $alias_name = $person['alias_name'];
            $birthday = $person['birthday'];
            $confession_priest = $person['confession_prist'];

            // if ($birthday == "") {
            $birthday = null;
            // }

            $date_of_death = null;

            if ($title == "المرحوم" || $title == "المرحومة") {
                $date_of_death = "2000-01-01";
                $title = PersonTitle::MASTER;
            } else if ($title == "ابونا") {
                $title = PersonTitle::PRIEST;
            } else if ($title == "عم") {
                $title = PersonTitle::UNCLE;
            } else if ($title == "استاذ" || $title == "مدام") {
                $title = PersonTitle::MASTER;
            } else if ($title == "مهندس" || $title == "مهندسة") {
                $title = PersonTitle::ENGINEER;
            } else if ($title == "دكتور" || $title == "دكتورة") {
                $title = PersonTitle::DOCTOR;
            } else if ($title == "الابنة" || $title == "الابن") {
                $title = null;
            }

            \App\Models\Person::create([
                "id" => $id,
                "names" => $names,
                "alias_name" => $alias_name,
                "title" => $title,
                "confession_priest" => $confession_priest,
                "birthday" => $birthday,
                "date_of_death" => $date_of_death,
                "status" => PersonStatus::UNKNOWN,
            ]);
        }
    }
}
