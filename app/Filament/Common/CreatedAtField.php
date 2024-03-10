<?php

namespace App\Filament\Traits;

use Filament\Tables;
use \Illuminate\Support\Carbon;

trait CreatedAtField
{
    public static function createdAtField()
    {
        return Tables\Columns\TextColumn::make('created_at')
            ->label("common.common_fields.created_at")
            ->translateLabel()
            ->dateTime()
            ->sortable()
            ->formatStateUsing(fn($record) => Carbon::parse($record->created_at)->diffForHumans())
            ->toggleable(isToggledHiddenByDefault: true);
    }
}
