<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum FamilyStatus: string implements HasLabel, HasColor, HasIcon
{
    case IN_SERVICE = 'in_service';
    case OUT_OF_SERVICE = 'out_of_service';
    case OUT_OFF_SERVICE_FOR_DYING = 'out_off_service_for_dying';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::IN_SERVICE => __('enums.family_status.in_service'),
            self::OUT_OF_SERVICE => __("enums.family_status.out_off_service"),
            self::OUT_OFF_SERVICE_FOR_DYING => __("enums.family_status.out_off_service_for_dying"),
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::IN_SERVICE => "success",
            self::OUT_OF_SERVICE => "danger",
            self::OUT_OFF_SERVICE_FOR_DYING => "gray",
        };
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::IN_SERVICE => "heroicon-m-check",
            self::OUT_OF_SERVICE => "heroicon-m-x-mark",
            self::OUT_OFF_SERVICE_FOR_DYING => "heroicon-m-x-mark"
        };
    }
}
