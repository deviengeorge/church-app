<?php

namespace App\Filament\Resources;

use App\Enums\UserRole;
use App\Filament\Common\CommonFields;
use App\Filament\CommonFieldFilament;
use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Filament\Traits\CreatedAtField;
use App\Filament\Traits\UpdatedAtField;
use App\Models\User;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?int $navigationSort = 1;

    // public static function getNavigationGroup(): string
    // {
    //     return __("common.groups");
    // }

    public static function getModelLabel(): string
    {
        return __("common.user.user");
    }

    public static function getPluralModelLabel(): string
    {
        return __("common.user.users");
    }

    public static function getNavigationLabel(): string
    {
        return __("common.user.users");
    }

    public static function form_create()
    {
        return [
            Forms\Components\TextInput::make('name')
                ->label("common.user.name")
                ->translateLabel()
                ->required(),
            Forms\Components\TextInput::make('email')
                ->label("common.user.email")
                ->translateLabel()
                ->email()
                ->required(),
            Forms\Components\TextInput::make('password')
                ->label("common.user.password")
                ->translateLabel()
                ->password()
                ->dehydrateStateUsing(fn ($state) => \Hash::make($state))
                ->dehydrated(fn ($state) => filled($state))
                ->required(fn (string $context): bool => $context === 'create'),
            Forms\Components\Select::make('role')
                ->label("common.user.role")
                ->translateLabel()
                ->options(UserRole::class)
                ->default(UserRole::USER)
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
                    ->label("common.user.name")
                    ->translateLabel()
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label("common.user.email")
                    ->translateLabel()
                    ->searchable(),
                Tables\Columns\TextColumn::make('role')
                    ->label("common.user.role")
                    ->translateLabel()
                    ->searchable()
                    ->badge(),


                // Dates
                CommonFields::createdAtField(),
                CommonFields::updatedAtField(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
