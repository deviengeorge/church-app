<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum PersonStatus: string implements HasLabel
{
    case KID = "kid";
    case UNEMPLOYED = "unemployed";
    case SCHOOL_STUDENT = "school_student";
    case UNIVERSITY_STUDENT = "university_student";
    case WORKER = "worker";
    case UNKNOWN = "unknown";

    public function getLabel(): ?string
    {
        return match ($this) {
            self::KID => __("enums.person_status.kid"),
            self::UNEMPLOYED => __("enums.person_status.unemployed"),
            self::SCHOOL_STUDENT => __("enums.person_status.school_student"),
            self::UNIVERSITY_STUDENT => __("enums.person_status.university_student"),
            self::WORKER => __("enums.person_status.worker"),
            self::UNKNOWN => __("enums.person_status.unknown")
        };
    }

    // public function getColor(): ?string
    // {
    //     return match ($this) {
    //         self::MALE => 'warning',
    //         self::FEMALE => 'danger',
    //     };
    // }
}
