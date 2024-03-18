<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\PersonResource;
use App\Models\Person;
use Carbon\Carbon;
use Filament\Forms\Components\Builder;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class DiedToday extends BaseWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->striped()
            ->query(
                function () {
                    $now = Carbon::now();
                    return Person::query()
                        ->whereMonth('date_of_death', $now->month)
                        ->whereDay('date_of_death', $now->day);
                }
            )
            ->recordUrl(function (Person $record) {
                return PersonResource::getUrl("view", ["record" => $record]);
            })
            ->columns([
                Tables\Columns\TextColumn::make("name"),
                Tables\Columns\TextColumn::make("date_of_death"),
            ]);
    }

    protected static ?int $sort = 2;
    protected int | string | array $columnSpan = 'full';

    public static function canView(): bool
    {
        return true;
    }
}
