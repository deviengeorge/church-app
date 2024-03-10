<?php

namespace App\Filament\Common;

use Filament\Tables;
use \Illuminate\Support\Carbon;

class CommonFields
{
    public static function createdAtField()
    {
        return Tables\Columns\TextColumn::make('created_at')
            ->label("common.common_fields.created_at")
            ->translateLabel()
            ->dateTime()
            ->sortable()
            ->formatStateUsing(fn ($record) => Carbon::parse($record->created_at)->diffForHumans())
            ->toggleable(isToggledHiddenByDefault: true);
    }

    public static function updatedAtField()
    {
        return Tables\Columns\TextColumn::make('updated_at')
            ->label("common.common_fields.updated_at")
            ->translateLabel()
            ->dateTime()
            ->sortable()
            ->formatStateUsing(fn ($record) => Carbon::parse($record->updated_at)->diffForHumans())
            ->toggleable(isToggledHiddenByDefault: true);
    }
}
