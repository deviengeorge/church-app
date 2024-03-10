<?php

namespace App\Filament\Resources\FamilyAbsenceResource\Pages;

use App\Filament\Resources\FamilyAbsenceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFamilyAbsence extends EditRecord
{
    protected static string $resource = FamilyAbsenceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
