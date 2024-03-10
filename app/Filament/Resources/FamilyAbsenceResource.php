<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FamilyAbsenceResource\Pages;
use App\Filament\Resources\FamilyAbsenceResource\RelationManagers;
use App\Models\Family;
use App\Models\FamilyAbsence;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FamilyAbsenceResource extends Resource
{
    protected static ?string $model = FamilyAbsence::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 1;

    public static function getNavigationGroup(): string
    {
        return __("common.groups.absence");
    }

    public static function getModelLabel(): string
    {
        return __("common.family_absence.family_absence");
    }

    public static function getPluralModelLabel(): string
    {
        return __("common.family_absence.family_absences");
    }

    public static function getNavigationLabel(): string
    {
        return __("common.family_absence.family_absences");
    }

    public static function form_create()
    {
        return [
            Forms\Components\Select::make('family_id')
                ->relationship('family', 'name')
                ->searchable()
                ->required(),
            Forms\Components\Select::make('reason_id')
                ->relationship('reason', 'name')
                ->preload()
                ->required(),
            Forms\Components\Textarea::make('details'),
            Forms\Components\DateTimePicker::make('visited_at')
                ->required(),
        ];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema(self::form_create());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->striped()
            ->columns([
                Tables\Columns\TextColumn::make('family_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('reason_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('details')
                    ->searchable(),
                Tables\Columns\TextColumn::make('visited_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFamilyAbsences::route('/'),
            'create' => Pages\CreateFamilyAbsence::route('/create'),
            'view' => Pages\ViewFamilyAbsence::route('/{record}'),
            'edit' => Pages\EditFamilyAbsence::route('/{record}/edit'),
        ];
    }
}
