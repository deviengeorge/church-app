<?php

namespace App\Filament\Traits;

use Filament\Tables;
use \Illuminate\Support\Carbon;

trait UpdatedAtField
{
    public static function updatedAtField()
    {
        return Tables\Columns\TextColumn::make('updated_at')
            ->label("common.common_fields.updated_at")
            ->translateLabel()
            ->dateTime()
            ->sortable()
            ->formatStateUsing(fn($record) => Carbon::parse($record->updated_at)->diffForHumans())
            ->toggleable(isToggledHiddenByDefault: true);
    }
}
