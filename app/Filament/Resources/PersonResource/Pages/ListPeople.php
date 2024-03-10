<?php

namespace App\Filament\Resources\PersonResource\Pages;

use App\Filament\Resources\PersonResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListPeople extends ListRecords
{
    protected static string $resource = PersonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public ?string $activeTab = "all";
    public function getTabs(): array
    {
        return [
            'all' => Tab::make(__("common.person.tabs.all")),
            'dead' => Tab::make(__("common.person.tabs.dead"))
                ->modifyQueryUsing(fn(Builder $query) => $query->where('date_of_death', "!=", null)),
        ];
    }
}
