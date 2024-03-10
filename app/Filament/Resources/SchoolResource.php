<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SchoolResource\Pages;
use App\Filament\Resources\SchoolResource\RelationManagers;
use App\Models\School;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SchoolResource extends Resource
{
    protected static ?string $model = School::class;
    public static function getNavigationIcon(): ?string
    {
        return match (app()->getLocale()) {
            'en' => 'heroicon-o-arrow-small-right',
            'ar' => 'heroicon-o-arrow-small-left'
        };
    }
    public static function getNavigationGroup(): string
    {
        return __("common.groups.education");
    }

    public static function getModelLabel(): string
    {
        return __("common.school.school");
    }

    public static function getPluralModelLabel(): string
    {
        return __("common.school.schools");
    }

    public static function getNavigationLabel(): string
    {
        return __("common.school.schools");
    }

    protected static ?int $navigationSort = 1;

    public static function form_create()
    {
        return [
            TextInput::make('name')
                ->label("common.school.name")
                ->translateLabel()
                ->required()
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
                TextColumn::make('name')
                    ->label("common.school.name")
                    ->translateLabel(),
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
            'index' => Pages\ListSchools::route('/'),
            'create' => Pages\CreateSchool::route('/create'),
            // 'edit' => Pages\EditSchool::route('/{record}/edit'),
        ];
    }
}
