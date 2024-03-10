<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum PersonTitle: string implements HasLabel
{
    case ENGINEER = "engineer";
    case DOCTOR = "doctor";
    case MASTER = "MR";
    case PRIEST = "priest";
    case UNCLE = "uncle";
    public function getLabel(): ?string
    {
        return match ($this) {
            self::ENGINEER => __("enums.person_title.engineer"),
            self::DOCTOR => __("enums.person_title.doctor"),
            self::MASTER => __("enums.person_title.master"),
            self::PRIEST => __("enums.person_title.priest"),
            self::UNCLE => __("enums.person_title.uncle"),
        };
    }
}
