<?php

namespace App\Filament\Resources\FamilyAbsenceReasonResource\Pages;

use App\Filament\Resources\FamilyAbsenceReasonResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFamilyAbsenceReason extends EditRecord
{
    protected static string $resource = FamilyAbsenceReasonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
