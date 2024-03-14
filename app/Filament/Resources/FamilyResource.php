<?php

namespace App\Filament\Resources;

use App\Enums\FamilyStatus;
use App\Enums\UserRole;
use App\Filament\Common\CommonFields;
use App\Filament\Resources\FamilyResource\Pages;
use App\Filament\Resources\FamilyResource\RelationManagers;
use App\Filament\Traits\CreatedAtField;
use App\Filament\Traits\UpdatedAtField;
use App\Models\Area;
use App\Models\Family;
use App\Models\Street;
use App\Models\User;
use Filament\Forms;
use Filament\Infolists;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Form;
use Filament\Infolists\Components\Section as ComponentsSection;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Support\Enums\IconPosition;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Collection;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class FamilyResource extends Resource
{
    protected static ?string $model = Family::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?int $navigationSort = 2;

    // public static function getNavigationGroup(): string
    // {
    //     return __("common.groups.location");
    // }

    public static function getModelLabel(): string
    {
        return __("common.family.family");
    }

    public static function getPluralModelLabel(): string
    {
        return __("common.family.families");
    }

    public static function getNavigationLabel(): string
    {
        return __("common.family.families");
    }
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make()->schema([
                Tabs::make("Tabs")
                    ->tabs([
                        Tabs\Tab::make(__('common.family.tabs.location'))->schema([
                            TextInput::make('google_map_link')
                                ->label("common.family.google_map_link")
                                ->translateLabel()
                                ->columnSpanFull(),
                            Select::make('area_id')
                                ->label("common.family.area")
                                ->translateLabel()
                                ->relationship('area', 'name')
                                ->preload()
                                ->searchable()
                                ->live()
                                ->createOptionForm(AreaResource::form_create()),
                            Select::make('street_id')
                                ->label("common.family.street")
                                ->translateLabel()
                                ->placeholder(fn (Forms\Get $get): string => empty($get('area_id')) ? __("common.family.validation.select_area_first") : "")
                                ->options(function (Forms\Get $get): Collection {
                                    return Street::where('area_id', $get('area_id'))->pluck('name', 'id');
                                })
                                ->searchable()
                                ->live()
                                ->createOptionForm(fn (Forms\Get $get) => StreetResource::form_create($get('area_id'))),
                        ])->columns(2),
                        Tabs\Tab::make(__('common.family.tabs.apartment_info'))->schema([
                            TextInput::make('building_num')
                                ->label("common.family.building_num")
                                ->translateLabel(),
                            TextInput::make('floor_num')
                                ->label("common.family.floor_num")
                                ->translateLabel(),
                            TextInput::make('apartment_num')
                                ->label("common.family.apartment_num")
                                ->translateLabel(),
                            Textarea::make('more_location_info')
                                ->label("common.family.more_location_info")
                                ->translateLabel()
                                ->columnSpanFull()
                                ->rows(5),
                        ])->columns(3),
                        Tabs\Tab::make(__('common.family.tabs.additional_info'))->schema([
                            Select::make("priest_id")
                                ->label("common.family.priest")
                                ->translateLabel()
                                ->options(User::where('role', UserRole::PRIEST)->pluck('name', 'id')),

                            Select::make('status')
                                ->label("common.family.status")
                                ->translateLabel()
                                ->required()
                                ->options(FamilyStatus::class)
                                ->default(FamilyStatus::IN_SERVICE),
                        ])->columns(2),
                    ])->columnSpanFull(),
            ])
                ->columnSpan([
                    'md' => 1,
                    'lg' => 2,
                ]),
            Section::make(__("common.family.tabs.info"))
                ->hidden(fn (string $operation): bool => $operation === 'create')
                ->schema([
                    Placeholder::make("created_at")
                        ->label("common.common_fields.created_at")
                        ->translateLabel()
                        ->content(fn (Family $family): ?string => $family->created_at?->diffForHumans()),
                    Placeholder::make("updated_at")
                        ->label("common.common_fields.updated_at")
                        ->translateLabel()
                        ->content(fn (Family $family): ?string => $family->updated_at?->diffForHumans()),

                    Placeholder::make("Created By")
                        ->label("common.common_fields.created_by")
                        ->translateLabel()
                        ->content(fn (Family $family): ?string => User::find($family->created_by)?->name),
                    Placeholder::make("Updated By")
                        ->label("common.common_fields.updated_by")
                        ->translateLabel()
                        ->content(fn (Family $family): ?string => User::find($family->updated_by)?->name),
                ])
                ->columnSpan([
                    'lg' => 1,
                ]),
        ])->columns([
            'md' => 1,
            'lg' => 3,
        ]);;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->striped()
            ->recordClasses(fn (Family $record) => match ($record->status) {
                FamilyStatus::IN_SERVICE => null,
                FamilyStatus::OUT_OF_SERVICE => '!bg-success',
                FamilyStatus::OUT_OFF_SERVICE_FOR_DYING => '!bg-success',
                default => null,
            })
            ->columns([
                TextColumn::make('name')
                    ->prefix("عائلة ")
                    ->label("common.family.name")
                    ->translateLabel()
                    ->icon(function (Family $record) {
                        return in_array(
                            $record->status,
                            [FamilyStatus::OUT_OF_SERVICE, FamilyStatus::OUT_OFF_SERVICE_FOR_DYING]
                        )
                            ? "heroicon-m-lock-closed"
                            : null;
                    })
                    ->iconPosition(IconPosition::Before)
                    ->searchable(),

                TextColumn::make('members_count')
                    ->label("common.family.members_count")
                    ->translateLabel()
                    ->suffix(" أفراد")
                    ->counts('members')
                    ->sortable(),

                TextColumn::make('area.name')
                    ->label("common.family.area")
                    ->translateLabel()
                    ->searchable()
                    ->sortable(),

                TextColumn::make('street.name')
                    ->label("common.family.street")
                    ->translateLabel()
                    ->searchable()
                    ->sortable(),

                TextColumn::make('priest.name')
                    ->label("common.family.priest")
                    ->translateLabel()
                    ->searchable()
                    ->sortable(),

                TextColumn::make('status')
                    ->label("common.family.status")
                    ->translateLabel()
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->toggleable(isToggledHiddenByDefault: false),

                TextColumn::make('building_num')
                    ->label("common.family.building_num")
                    ->translateLabel()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('floor_num')
                    ->label("common.family.floor_num")
                    ->translateLabel()
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('apartment_num')
                    ->label("common.family.apartment_num")
                    ->translateLabel()
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('more_location_info')
                    ->label("common.family.more_location_info")
                    ->translateLabel()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),


                // Dates
                CommonFields::createdAtField(),
                CommonFields::updatedAtField()
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    BulkAction::make('change_priest')
                        ->label("common.family.actions.change_priest")
                        ->translateLabel()
                        ->form([
                            Forms\Components\Select::make('priest_id')
                                ->label('Priest')
                                ->options(fn () => User::where('role', UserRole::PRIEST)->pluck('name', 'id')),
                        ])
                        ->action(function (Collection $records, array $data) {
                            $records->each(function ($record) use ($data) {
                                $record->priest_id = $data['priest_id'];
                                $record->save();
                            });
                        })
                        ->deselectRecordsAfterCompletion(),
                    ExportBulkAction::make()->exports([
                        ExcelExport::make("Export as CSV")
                            ->fromTable()
                            ->withWriterType(\Maatwebsite\Excel\Excel::CSV)
                            ->withFilename(date('Y-m-d') . ' - Families Export'),
                        ExcelExport::make("Export as XLSX")
                            ->fromTable()
                            ->withWriterType(\Maatwebsite\Excel\Excel::XLSX)
                            ->withFilename(date('Y-m-d') . ' - Families Export'),
                    ]),
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make(__("common.family.tabs.info"))
                    ->schema([
                        Infolists\Components\TextEntry::make('name')
                            ->label("common.family.name")
                            ->translateLabel()
                            ->prefix("عائلة ")
                            ->copyable(),
                        Infolists\Components\TextEntry::make('status')
                            ->label("common.family.status")
                            ->translateLabel()
                            ->badge(),
                        Infolists\Components\TextEntry::make('priest.name')
                            ->label("common.family.priest")
                            ->translateLabel()
                            ->placeholder(__("common.common_fields.empty")),
                    ])
                    ->columns(3),
                Infolists\Components\Section::make(__("common.family.tabs.location"))
                    ->schema([
                        Infolists\Components\TextEntry::make('area.name')
                            ->label("common.family.area")
                            ->translateLabel()
                            ->placeholder(__("common.common_fields.empty"))
                            ->url(function (Family $record): string | null {
                                return !$record->area_id ? null : AreaResource::getUrl("view", ["record" => $record->area_id]);
                            }),
                        Infolists\Components\TextEntry::make('street.name')
                            ->label("common.family.street")
                            ->translateLabel()
                            ->placeholder(__("common.common_fields.empty"))
                            ->url(function (Family $record): string | null {
                                return !$record->street_id ? null : StreetResource::getUrl("view", ["record" => $record->street_id]);
                            }),
                        Infolists\Components\TextEntry::make('google_map_link')
                            ->label("common.family.google_map_link")
                            ->translateLabel()
                            ->placeholder(__("common.common_fields.empty"))
                            ->url(fn (Family $record) => $record->google_map_link)
                            ->openUrlInNewTab(),
                        Infolists\Components\TextEntry::make('building_num')
                            ->label("common.family.building_num")
                            ->translateLabel()
                            ->placeholder(__("common.common_fields.empty")),
                        Infolists\Components\TextEntry::make('floor_num')
                            ->label("common.family.floor_num")
                            ->translateLabel()
                            ->placeholder(__("common.common_fields.empty")),
                        Infolists\Components\TextEntry::make('apartment_num')
                            ->label("common.family.apartment_num")
                            ->translateLabel()
                            ->placeholder(__("common.common_fields.empty")),
                        Infolists\Components\TextEntry::make('more_location_info')
                            ->label("common.family.more_location_info")
                            ->translateLabel()
                            ->placeholder(__("common.common_fields.empty"))
                            ->columnSpanFull(),

                    ])
                    ->columns(3)
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\MembersRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFamilies::route('/'),
            'create' => Pages\CreateFamily::route('/create'),
            'view' => Pages\ViewFamily::route('/{record}'),
            'edit' => Pages\EditFamily::route('/{record}/edit'),
        ];
    }
}
