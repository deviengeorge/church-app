<?php

namespace App\Enums;

use Filament\Support\Contracts\{HasLabel, HasColor, HasIcon};

enum PersonGender: string implements HasLabel, HasColor
{
    case MALE = "male";
    case FEMALE = "female";

    public function getLabel(): ?string
    {
        return match ($this) {
            self::MALE => __("enums.person_gender.male"),
            self::FEMALE => __("enums.person_gender.female"),
        };
    }

    public function getColor(): ?string
    {
        return match ($this) {
            self::MALE => 'primary',
            self::FEMALE => 'pink',
        };
    }
}
