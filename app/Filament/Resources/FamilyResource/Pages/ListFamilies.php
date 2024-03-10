<?php

namespace App\Filament\Resources\FamilyResource\Pages;

use App\Enums\UserRole;
use App\Filament\Resources\FamilyResource;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;

class ListFamilies extends ListRecords
{
    protected static string $resource = FamilyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        $tabs = ['all' => Tab::make('All')->badge($this->getModel()::count())];

        $users = User::where('role', UserRole::PRIEST)
            ->withCount('families')
            ->get();

        foreach ($users as $user) {
            $name = $user->name;
            $slug = str($name)->slug()->toString();

            $tabs[$slug] = Tab::make($name)
                ->badge($user->families_count)
                ->modifyQueryUsing(function ($query) use ($user) {
                    return $query->where('priest_id', $user->id);
                });
        }

        return $tabs;
    }

}
