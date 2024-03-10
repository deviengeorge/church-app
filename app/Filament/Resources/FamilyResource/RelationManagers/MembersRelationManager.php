<?php

namespace App\Filament\Resources\FamilyResource\RelationManagers;

use App\Enums\PersonFamilyRole;
use App\Filament\Resources\PersonResource;
use App\Models\Family;
use App\Models\Person;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MembersRelationManager extends RelationManager
{
    protected static string $relationship = 'members';

    public function form(Form $form): Form
    {
        return $form
            ->schema(PersonResource::form_create());
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name')->words(3, ""),
                Tables\Columns\SelectColumn::make('family_role')
                    ->options(PersonFamilyRole::class)
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
                // Tables\Actions\AssociateAction::make()
                //     ->recordSelectOptionsQuery(
                //         fn () => Person::where('family_id', '=', 'null')
                //     ),
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
                    Tables\Actions\DeleteAction::make(),
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
