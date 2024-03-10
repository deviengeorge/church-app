<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StreetResource\Pages;
use App\Filament\Resources\StreetResource\RelationManagers;
use App\Models\Area;
use App\Models\Street;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StreetResource extends Resource
{
    protected static ?string $model = Street::class;

    protected static ?string $navigationIcon = 'heroicon-o-map-pin';

    protected static ?string $navigationGroup = "Location";
    protected static ?int $navigationSort = 2;

    public static function getNavigationGroup(): string
    {
        return __("common.groups.location");
    }

    public static function getModelLabel(): string
    {
        return __("common.street.street");
    }

    public static function getPluralModelLabel(): string
    {
        return __("common.street.streets");
    }

    public static function getNavigationLabel(): string
    {
        return __("common.street.streets");
    }

    public static function form_create(int $area_id = null)
    {
        return [
            Forms\Components\TextInput::make('name')
                ->label("common.street.name")
                ->translateLabel()
                ->required(),
            Forms\Components\Select::make('area')
                ->label("common.street.area")
                ->translateLabel()
                ->options(Area::pluck('name', 'id'))
                ->default($area_id)
                ->preload()
                ->required(),
            Forms\Components\Toggle::make('in_church_service')
                ->label("common.street.in_church_service")
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
                    ->label("common.street.name")
                    ->translateLabel()
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('families_count')
                    ->label("common.street.families_count")
                    ->translateLabel()
                    ->counts("families")
                    ->sortable(),

                Tables\Columns\TextColumn::make('area.name')
                    ->label("common.street.area")
                    ->translateLabel()
                    ->searchable()
                    ->sortable(),

                Tables\Columns\IconColumn::make('in_church_service')
                    ->label("common.street.in_church_service")
                    ->translateLabel()
                    ->boolean()
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
            RelationManagers\FamiliesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStreets::route('/'),
            'create' => Pages\CreateStreet::route('/create'),
            'edit' => Pages\EditStreet::route('/{record}/edit'),
        ];
    }
}
