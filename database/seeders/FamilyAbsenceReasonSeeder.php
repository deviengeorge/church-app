<?php

namespace Database\Seeders;

use App\Models\FamilyAbsenceReason;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FamilyAbsenceReasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reasons = [
            "مرضي",
            "عزاء",
            "تناول",
            "صلاة طشت",
            "صلاة ثالث",
            "صلاة تبريك",
            "افتقاد دوري",
            "أخري",
        ];

        foreach ($reasons as $reason) {
            FamilyAbsenceReason::create([
                "name" => $reason,
            ]);
        }
    }
}
