<?php

namespace App\Filament\Resources\FamilyAbsenceResource\Pages;

use App\Filament\Resources\FamilyAbsenceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFamilyAbsences extends ListRecords
{
    protected static string $resource = FamilyAbsenceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
