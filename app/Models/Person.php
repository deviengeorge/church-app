<?php

namespace App\Models;

use App\Enums\PersonFamilyRole;
use App\Enums\PersonGender;
use App\Enums\PersonStatus;
use App\Enums\PersonTitle;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Person extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        "phones" => "array",
        "whatsapp_phones" => "array",
        "names" => "array",

        // Enums
        "title" => PersonTitle::class,
        "gender" => PersonGender::class,
        "family_role" => PersonFamilyRole::class,
        "status" => PersonStatus::class
    ];

    public function family(): BelongsTo
    {
        return $this->belongsTo(Family::class);
    }

    public function school_student_info(): BelongsTo
    {
        return $this->belongsTo(SchoolStudentInfo::class);
    }

    public function university_student_info(): BelongsTo
    {
        return $this->belongsTo(UniversityStudentInfo::class);
    }

    public function worker_info(): BelongsTo
    {
        return $this->belongsTo(WorkerInfo::class);
    }

    protected static function booted(): void
    {
        static::creating(function (Person $person) {
            $name = join(" ", $person->names);
            $person->name = $name;
        });

        static::updating(function (Person $person) {
            $name = join(" ", $person->names);
            $person->name = $name;

            if ($person->family_role == PersonFamilyRole::HUSBAND) {
                $person->family->update(["name" => $person->name]);
            }
        });
    }
}
