<?php

namespace App\Filament\Resources\PersonResource\Pages;

use App\Filament\Resources\PersonResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePerson extends CreateRecord
{
    protected static string $resource = PersonResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    // protected function mutateFormDataBeforeCreate(array $data): array
    // {
    //     $data['names'] = [$data['name_1'], $data['name_2'], $data['name_3'], $data['name_4'], $data['name_5']];
    //     dd($data);
    //     $school_student_info = $data['school_student_info']

    //     // $name = join(" ", $data["names"]);
    //     // $data["name"] = $name;

    //     return $data;
    // }
}
