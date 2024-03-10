<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum WeekDay: string implements HasLabel
{
    case SATURDAY = "saturday";
    case SUNDAY = "sunday";
    case MONDAY = "monday";
    case TUESDAY = "tuesday";
    case WEDNESDAY = "wednesday";
    case THURSDAY = "thursday";
    case FRIDAY = "friday";

    public function getLabel(): ?string
    {
        return match ($this) {
            self::SATURDAY => __("enums.week_days.saturday"),
            self::SUNDAY => __("enums.week_days.sunday"),
            self::MONDAY => __("enums.week_days.monday"),
            self::TUESDAY => __("enums.week_days.tuesday"),
            self::WEDNESDAY => __("enums.week_days.wednesday"),
            self::THURSDAY => __("enums.week_days.thursday"),
            self::FRIDAY => __("enums.week_days.friday"),
        };
    }
}
