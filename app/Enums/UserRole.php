<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum UserRole: string implements HasLabel
{
    case PRIEST = "priest";
    case USER = "user";
    case SERVANT = "servant";

    public function getLabel(): ?string
    {
        return match ($this) {
            self::PRIEST => "Priest",
            self::SERVANT => "Servant",
            self::USER => "User",
        };
    }
}
