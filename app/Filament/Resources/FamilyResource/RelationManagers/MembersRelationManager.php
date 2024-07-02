<?php

namespace App\Filament\Resources\FamilyResource\RelationManagers;

use App\Enums\PersonFamilyRole;
use App\Filament\Resources\PersonResource;
use App\Models\Person;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Table;

class MembersRelationManager extends RelationManager
{
    protected static string $relationship = 'members';

    // public static function getModelLabel(): string
    // {
    //     return __("common.family.family");
    // }

    // public static function getPluralModelLabel(): string
    // {
    //     return __("common.family.families");
    // }

    public function form(Form $form): Form
    {
        return $form
            ->schema(PersonResource::form_create());
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute("name")
            ->inverseRelationship("family")
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label("common.person.name")
                    ->translateLabel()
                    ->words(3, ""),

                Tables\Columns\SelectColumn::make('family_role')
                    ->label("common.person.family_role")
                    ->translateLabel()
                    ->options(PersonFamilyRole::class),

                Tables\Columns\TextColumn::make("is_died")
                    ->label("common.person.died")
                    ->translateLabel()
                    ->getStateUsing(fn (Person $record) => $record->date_of_death == null)
                    ->formatStateUsing(function (bool $state): string {
                        return $state ? __("common.person.alive") : __("common.person.dead");
                    })
                    ->badge()
                    ->color(function (bool $state) {
                        return $state ? "success" : "danger";
                    }),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
                Tables\Actions\AssociateAction::make()
                    ->preloadRecordSelect(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                ActionGroup::make([
                    Action::make("change family name")
                        ->label("relation-manager.members.make_family_name")
                        ->translateLabel()
                        ->icon("heroicon-o-pencil-square")
                        ->requiresConfirmation()
                        ->action(function ($record) {
                            $record->family->update(["name" => $record->name]);
                        }),
                    Tables\Actions\DissociateAction::make(),
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DissociateBulkAction::make(),
                ]),
            ]);
    }
}
