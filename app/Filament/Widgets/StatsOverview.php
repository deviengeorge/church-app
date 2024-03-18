<?php

namespace App\Filament\Widgets;

use App\Models\Family;
use App\Models\Person;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $people_count = Person::all()->count();
        $family_count = Family::all()->count();
        $users_count = User::all()->count();

        return [
            Stat::make(__("widgets.stats.people_count"), $people_count . " شخص"),
            Stat::make(__("widgets.stats.families_count"), $family_count . " عائلة"),
            Stat::make(__("widgets.stats.users_count"), $users_count . " مستخدمين"),
        ];
    }
    protected static ?int $sort = 1;
}
