<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UniversityResource\Pages;
use App\Filament\Resources\UniversityResource\RelationManagers;
use App\Models\University;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class UniversityResource extends Resource
{
    protected static ?string $model = University::class;
    public static function getNavigationIcon(): ?string
    {
        return match (app()->getLocale()) {
            'en' => 'heroicon-o-arrow-small-right',
            'ar' => 'heroicon-o-arrow-small-left'
        };
    }
    protected static ?int $navigationSort = 3;

    public static function getNavigationGroup(): string
    {
        return __("common.groups.education");
    }

    public static function getModelLabel(): string
    {
        return __("common.university.university");
    }

    public static function getPluralModelLabel(): string
    {
        return __("common.university.universities");
    }

    public static function getNavigationLabel(): string
    {
        return __("common.university.universities");
    }

    public static function form_create()
    {
        return [
            Forms\Components\TextInput::make('name')
                ->label("common.university.name")
                ->translateLabel()
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
                    ->label("common.university.name")
                    ->translateLabel()
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label("common.common_fields.created_at")
                    ->translateLabel()
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label("common.common_fields.updated_at")
                    ->translateLabel()
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
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
            'index' => Pages\ListUniversities::route('/'),
            'create' => Pages\CreateUniversity::route('/create'),
            // 'edit' => Pages\EditUniversity::route('/{record}/edit'),
        ];
    }
}
