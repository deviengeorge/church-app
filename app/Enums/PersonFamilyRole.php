<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum PersonFamilyRole: string implements HasLabel
{
    case HUSBAND = "husband";
    case WIFE = "wife";
    case SON = "son";
    case DAUGHTER = "daughter";

    public function getLabel(): ?string
    {
        return match ($this) {
            self::HUSBAND => __("enums.person_family_role.husband"),
            self::WIFE => __("enums.person_family_role.wife"),
            self::SON => __("enums.person_family_role.son"),
            self::DAUGHTER => __("enums.person_family_role.daughter"),
        };
    }
}
