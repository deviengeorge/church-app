<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\{
    Faculty,
    Family,
    Person,
    University,
    User
};
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(AreaSeeder::class);
        $this->call(StreetSeeder::class);
        $this->call(PeopleSeeder::class);
        $this->call(FamilyAbsenceReasonSeeder::class);
        $this->call(FamilySeeder::class);
        $this->call(ChildrenSeeder::class);

        // Faculities
        Faculty::create([
            "name" => "Science",
        ]);
        Faculty::create([
            "name" => "Arts",
        ]);
        Faculty::create([
            "name" => "Medicine",
        ]);

        // Universities
        University::create([
            "name" => "Cairo",
        ]);
        University::create([
            "name" => "Ain Shams",
        ]);
        University::create([
            "name" => "Helwan",
        ]);

        $adminUser = User::where('role', UserRole::PRIEST)->first();

        // Families
        // $georgeFamily = Family::create([
        //     "name" => "جورج فرنسيس",
        //     "created_by" => $adminUser->id
        // ]);

        // Family::create([
        //     "name" => "مدحت فوزي",
        //     "created_by" => $adminUser->id
        // ]);

        // Persons
        // Person::create([
        //     "names" => [
        //         "ديفاين",
        //         "جورج",
        //         "فرنسيس",
        //         "مرقس",
        //         "محروس",
        //     ],
        //     "alias_name" => "ديفو جورج",
        //     "phones" => ["01281089983"],
        //     "whatsapp_phones" => ["01281089983"],
        //     "title" => \App\Enums\PersonTitle::ENGINEER,
        //     "gender" => \App\Enums\PersonGender::MALE,
        //     "family_id" => $georgeFamily->id
        // ]);

        // Person::create([
        //     "names" => [
        //         "مارتن",
        //         "جورج",
        //         "فرنسيس",
        //         "مرقس",
        //         "محروس",
        //     ],
        //     "alias_name" => "مارتن جورج",
        //     "gender" => \App\Enums\PersonGender::MALE,
        //     "family_id" => $georgeFamily->id
        // ]);

        // Person::create([
        //     "names" => [
        //         "جورج",
        //         "فرنسيس",
        //         "مرقس",
        //         "محروس",
        //     ],
        //     "alias_name" => "جورج فرنسيس",
        //     "phones" => ["01280818811"],
        //     "whatsapp_phones" => ["01280818811"],
        //     "title" => \App\Enums\PersonTitle::MASTER,
        //     "gender" => \App\Enums\PersonGender::MALE,
        //     "family_id" => $georgeFamily->id
        // ]);
    }
}
