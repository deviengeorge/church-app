<?php

namespace App\Filament\Resources;

use App\Filament\Common\CommonFields;
use App\Filament\Resources\FamilyAbsenceReasonResource\Pages;
use App\Filament\Resources\FamilyAbsenceReasonResource\RelationManagers;
use App\Models\FamilyAbsenceReason;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FamilyAbsenceReasonResource extends Resource
{
    protected static ?string $model = FamilyAbsenceReason::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 2;

    public static function getNavigationGroup(): string
    {
        return __("common.groups.absence");
    }

    public static function getModelLabel(): string
    {
        return __("common.family_absence_reason.family_absence_reason");
    }

    public static function getPluralModelLabel(): string
    {
        return __("common.family_absence_reason.family_absence_reasons");
    }

    public static function getNavigationLabel(): string
    {
        return __("common.family_absence_reason.family_absence_reasons");
    }

    public static function form_create()
    {
        return [
            Forms\Components\TextInput::make('name')
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
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),

                // Dates
                CommonFields::createdAtField(),
                CommonFields::updatedAtField(),
            ])
            ->filters([])
            ->actions([
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
            'index' => Pages\ListFamilyAbsenceReasons::route('/'),
            'create' => Pages\CreateFamilyAbsenceReason::route('/create'),
            'edit' => Pages\EditFamilyAbsenceReason::route('/{record}/edit'),
        ];
    }
}
