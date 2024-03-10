<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AreaResource\Pages;
use App\Filament\Resources\AreaResource\RelationManagers;
use App\Models\Area;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AreaResource extends Resource
{
    protected static ?string $model = Area::class;
    protected static ?string $navigationIcon = 'heroicon-o-map';
    protected static ?int $navigationSort = 1;

    public static function getNavigationGroup(): string
    {
        return __("common.groups.location");
    }

    public static function getModelLabel(): string
    {
        return __("common.area.area");
    }

    public static function getPluralModelLabel(): string
    {
        return __("common.area.areas");
    }

    public static function getNavigationLabel(): string
    {
        return __("common.area.areas");
    }

    public static function form_create()
    {
        return [
            Forms\Components\TextInput::make('name')
                ->label("common.area.name")
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
                    ->label("common.area.name")
                    ->translateLabel()
                    ->searchable(),
                Tables\Columns\TextColumn::make('streets_count')
                    ->label("common.area.streets_count")
                    ->translateLabel()
                    ->counts("streets")
                    ->sortable(),
                Tables\Columns\TextColumn::make('families_count')
                    ->label("common.area.families_count")
                    ->translateLabel()
                    ->counts("families")
                    ->sortable(),
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
            RelationManagers\StreetsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAreas::route('/'),
            'create' => Pages\CreateArea::route('/create'),
            'edit' => Pages\EditArea::route('/{record}/edit'),
        ];
    }
}
