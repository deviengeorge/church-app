<?php

namespace App\Filament\Resources\StreetResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FamiliesRelationManager extends RelationManager
{
    protected static string $relationship = 'families';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name')->label("Family Name"),


                Tables\Columns\TextColumn::make('building_num')
                    ->searchable(),
                Tables\Columns\TextColumn::make('floor_num')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('apartment_num')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('members_count')
                    ->counts("members")
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('more_location_info')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
