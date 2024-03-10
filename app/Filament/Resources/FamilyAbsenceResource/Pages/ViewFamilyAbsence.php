<?php

namespace App\Filament\Resources\FamilyAbsenceResource\Pages;

use App\Filament\Resources\FamilyAbsenceResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewFamilyAbsence extends ViewRecord
{
    protected static string $resource = FamilyAbsenceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
