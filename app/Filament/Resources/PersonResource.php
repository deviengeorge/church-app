<?php

namespace App\Filament\Resources;

use App\Enums\PersonGender;
use App\Enums\PersonStatus;
use App\Enums\PersonTitle;
use App\Enums\StudentGrade;
use App\Enums\WeekDay;
use App\Filament\Common\CommonFields;
use App\Filament\Resources\PersonResource\Pages;
use App\Filament\Traits\CreatedAtField;
use App\Filament\Traits\UpdatedAtField;
use App\Models\Family;
use App\Models\Person;
use App\Models\Faculty;
use App\Models\School;
use App\Models\University;
use Filament\Forms;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Infolists\Infolist;
use Filament\Infolists;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Table;
use Illuminate\Support\Collection;

use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class PersonResource extends Resource
{
    protected static ?string $model = Person::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?int $navigationSort = 2;

    // public static function getNavigationGroup(): string
    // {
    //     return __("common.groups.location");
    // }

    public static function getModelLabel(): string
    {
        return __("common.person.person");
    }

    public static function getPluralModelLabel(): string
    {
        return __("common.person.people");
    }

    public static function getNavigationLabel(): string
    {
        return __("common.person.people");
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form_create()
    {
        return [
            Section::make(__("common.person.sections.personal_info"))
                ->collapsible()
                ->schema([
                    Select::make('title')
                        ->label("common.person.title")
                        ->translateLabel()
                        ->options(PersonTitle::class)
                        ->default(PersonTitle::MASTER)
                        ->columnSpanFull(),


                    TextInput::make("names.0")
                        ->label("common.person.name_1")
                        ->translateLabel()
                        ->autofocus(fn (string $operation): bool => $operation === 'create')
                        ->required(),
                    TextInput::make("names.1")
                        ->label("common.person.name_2")
                        ->translateLabel()
                        ->required(),
                    TextInput::make("names.2")
                        ->label("common.person.name_3")
                        ->translateLabel(),
                    TextInput::make("names.3")
                        ->label("common.person.name_4")
                        ->translateLabel(),
                    TextInput::make("names.4")
                        ->label("common.person.name_5")
                        ->translateLabel(),

                    TextInput::make('alias_name')
                        ->label("common.person.alias_name")
                        ->translateLabel()
                        ->suffixAction(
                            Action::make('change_alias_name')
                                ->icon('heroicon-o-pencil')
                                ->label("common.person.actions.change_alias_name")
                                ->translateLabel()
                                ->action(function (Forms\Set $set, Forms\Get $get) {
                                    $first_name = $get('names.0');
                                    $second_name = $get('names.1');
                                    $set('alias_name', $first_name . " " . $second_name);
                                })
                        )
                        ->columnSpan(2),

                    Select::make('gender')
                        ->label("common.person.gender")
                        ->translateLabel()
                        ->options(PersonGender::class),

                    Select::make("status")
                        ->live()
                        ->label("common.person.status")
                        ->translateLabel()
                        ->selectablePlaceholder(false)
                        ->options(PersonStatus::class)
                        // ->suffixAction(
                        //     Action::make('delete')
                        //         ->icon('heroicon-o-pencil')
                        //         ->translateLabel()
                        //         ->action(function (Forms\Set $set, Person $record) {
                        //             $record->status = null;
                        //             $record->school_student_info?->delete();
                        //             $record->university_student_info?->delete();
                        //             $record->worker_info?->delete();
                        //             $record->save();
                        //         })
                        // )
                        ->default(PersonStatus::UNKNOWN),

                    Textarea::make('note')
                        ->label("common.person.note")
                        ->translateLabel()
                        ->rows(5)
                        ->columnSpanFull()
                        ->hidden(fn (string $operation): bool => $operation === 'create'),

                    Grid::make(2)
                        ->live()
                        ->schema(fn (Forms\Get $get): array => match ($get('status')) {
                            PersonStatus::SCHOOL_STUDENT => [
                                Fieldset::make()
                                    ->label("School Student")
                                    ->relationship('school_student_info')
                                    ->schema([
                                        Select::make("school_id")
                                            ->label("common.person.school_student_info.school")
                                            ->translateLabel()
                                            ->options(School::pluck("name", "id"))
                                            ->createOptionForm(SchoolResource::form_create())
                                            ->createOptionUsing(function (array $data): int {
                                                return School::create($data)->getKey();
                                            }),
                                        Select::make("grade")
                                            ->label("common.person.school_student_info.grade")
                                            ->translateLabel()
                                            ->options(StudentGrade::class),
                                    ]),
                            ],
                            PersonStatus::UNIVERSITY_STUDENT => [
                                Fieldset::make()
                                    ->label("University Student")
                                    ->relationship('university_student_info')
                                    ->schema([
                                        Select::make("university")
                                            ->label("common.person.university_student_info.university")
                                            ->translateLabel()
                                            ->searchable()
                                            ->options(University::pluck("name", "id"))
                                            ->createOptionForm(UniversityResource::form_create())
                                            ->createOptionUsing(function (array $data): int {
                                                return University::create($data)->getKey();
                                            }),

                                        Select::make("faculty")
                                            ->label("common.person.university_student_info.faculty")
                                            ->translateLabel()
                                            ->searchable()
                                            ->options(Faculty::pluck("name", "id"))
                                            ->createOptionForm(FacultyResource::form_create())
                                            ->createOptionUsing(function (array $data): int {
                                                return Faculty::create($data)->getKey();
                                            }),

                                        TextInput::make("start")
                                            ->label("common.person.university_student_info.start_year")
                                            ->translateLabel()
                                            ->numeric()
                                            ->minValue(1000)
                                            ->maxValue(3000),

                                        TextInput::make("end")
                                            ->label("common.person.university_student_info.end_year")
                                            ->translateLabel()
                                            ->numeric()
                                            ->minValue(1000)
                                            ->maxValue(3000),
                                    ]),
                            ],
                            PersonStatus::WORKER => [
                                Fieldset::make()
                                    ->label("Worker")
                                    ->relationship('worker_info')
                                    ->schema([
                                        TextInput::make("organization")
                                            ->label("common.person.worker_info.organization")
                                            ->translateLabel(),

                                        TextInput::make("position")
                                            ->label("common.person.worker_info.position")
                                            ->translateLabel(),

                                        Select::make("holidays")
                                            ->label("common.person.worker_info.holidays")
                                            ->translateLabel()
                                            ->options(WeekDay::class)
                                            ->multiple(),
                                    ]),
                            ],
                            default => [],
                        })
                        ->key('person_status_sections'),
                ])->columns(5),

            Section::make(__("common.person.sections.contact_info"))
                ->collapsible()
                ->collapsed()
                ->schema([
                    Repeater::make('phones')->simple(
                        TextInput::make('phones')
                    )
                        ->label("common.person.phones")
                        ->translateLabel()
                        ->default(['']),

                    Repeater::make('whatsapp_phones')->simple(
                        TextInput::make('whatsapp_phones')
                    )
                        ->label("common.person.whatsapp_phones")
                        ->translateLabel()
                        ->default(['']),
                ])->columns(2),




            // Person Status
            // Section::make(__("common.person.sections.school_student_info"))
            //     ->schema([

            //     ])
            //     ->columns(2)
            //     ->live()
            //     ->visible(function (Forms\Get $get, ?Person $record) {
            //         return $get('status') == PersonStatus::SCHOOL_STUDENT;
            //     }),


            // university student inputs
            // Section::make(__('common.person.sections.university_student_info'))
            //     ->schema([
            //     ])
            //     ->columns(2)
            //     ->live()
            //     ->visible(function (Forms\Get $get, ?Person $record) {
            //         return $get('status') == PersonStatus::UNIVERSITY_STUDENT;
            //     }),

            // worker inputs
            // Section::make(__('common.person.sections.worker_info'))
            //     ->schema([

            //     ])
            //     ->columns(3)
            //     ->live()
            //     ->visible(function (Forms\Get $get, Person $record) {
            //         return $get('status') == PersonStatus::WORKER;
            //     }),

            Section::make(__("common.person.sections.additional_info"))
                ->label("Additional Info")
                ->collapsible()
                ->collapsed()
                ->schema([
                    TextInput::make('confession_priest')
                        ->label("common.person.confession_priest")
                        ->translateLabel(),
                    DatePicker::make('birthday')
                        ->label("common.person.birthday")
                        ->translateLabel(),
                ])
                ->columns(3),

            Section::make(__("common.person.sections.dead_info"))
                ->collapsible()
                ->collapsed()
                ->schema([
                    DatePicker::make('date_of_death')
                        ->label("common.person.date_of_death")
                        ->translateLabel()
                        ->closeOnDateSelection(),
                ]),
        ];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema(self::form_create())
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->striped()
            ->columns([
                Tables\Columns\TextColumn::make('index')
                    ->badge()
                    ->color("danger")
                    ->rowIndex(),
                Tables\Columns\TextColumn::make('name')
                    ->label("common.person.name")
                    ->translateLabel()
                    // To limit the name to 3 words instead of displaying the whole name ( 5 words )
                    ->words(3, "")
                    ->searchable(),

                Tables\Columns\TextColumn::make('alias_name')
                    ->label("common.person.alias_name")
                    ->translateLabel()
                    ->searchable(),

                Tables\Columns\TextColumn::make('status')
                    ->label("common.person.status")
                    ->translateLabel()
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('family.name')
                    ->label("common.person.family")
                    ->translateLabel()
                    ->prefix("عائلة ")
                    ->badge()
                    ->color("info")
                    ->url(function (Person $record) {
                        return FamilyResource::getUrl('view', ["record" => $record->family]);
                    })
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('phones')
                    ->label("common.person.phones")
                    ->translateLabel()
                    ->searchable()
                    ->badge()
                    ->color("danger")
                    ->copyable(),

                Tables\Columns\TextColumn::make('whatsapp_phones')
                    ->label("common.person.whatsapp_phones")
                    ->translateLabel()
                    ->searchable()
                    ->badge()
                    ->color("success")
                    ->copyable()
                    ->toggleable(isToggledHiddenByDefault: true),


                Tables\Columns\TextColumn::make('gender')
                    ->label("common.person.gender")
                    ->translateLabel()
                    ->searchable()
                    ->badge(),

                Tables\Columns\TextColumn::make('confession_priest')
                    ->label("common.person.confession_priest")
                    ->translateLabel()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                // Dates
                Tables\Columns\TextColumn::make('birthday')
                    ->label("common.person.birthday")
                    ->translateLabel()
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('date_of_death')
                    ->label("common.person.date_of_death")
                    ->translateLabel()
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                // Dates
                CommonFields::createdAtField(),
                CommonFields::updatedAtField()
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    BulkAction::make('re_assign_family')
                        ->label("Re-assign to Family")
                        ->form([
                            Forms\Components\Select::make('family_id')
                                ->label('Family')
                                ->options(fn () => Family::whereNotNull('name')->pluck('name', 'id')),
                        ])
                        ->action(function (Collection $records, array $data) {
                            $records->each(function ($record) use ($data) {
                                $record->family_id = $data['family_id'];
                                $record->save();
                            });
                        })
                        ->deselectRecordsAfterCompletion(),
                    ExportBulkAction::make()->exports([
                        ExcelExport::make("Export as CSV")
                            ->fromTable()
                            ->withWriterType(\Maatwebsite\Excel\Excel::CSV)
                            ->withFilename(date('Y-m-d') . ' - People Export'),
                        ExcelExport::make("Export as XLSX")
                            ->fromTable()
                            ->withWriterType(\Maatwebsite\Excel\Excel::XLSX)
                            ->withFilename(date('Y-m-d') . ' - People Export'),
                    ]),
                    Tables\Actions\DeleteBulkAction::make()->keyBindings(['ctrl+shift+d']),
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make(__("common.person.sections.personal_info"))
                    ->schema([
                        Infolists\Components\TextEntry::make('name')
                            ->label("common.person.name")
                            ->translateLabel()
                            ->copyable(),
                        Infolists\Components\TextEntry::make('title')
                            ->label("common.person.title")
                            ->translateLabel()
                            ->badge()
                            ->placeholder(__("common.common_fields.empty")),
                        Infolists\Components\TextEntry::make('gender')
                            ->label("common.person.gender")
                            ->translateLabel()
                            ->badge()
                            ->placeholder(__("common.common_fields.empty")),

                        Infolists\Components\TextEntry::make("phones")
                            ->label("common.person.phones")
                            ->translateLabel()
                            ->listWithLineBreaks()
                            ->bulleted()
                            ->placeholder(__("common.common_fields.empty")),

                        Infolists\Components\TextEntry::make("whatsapp_phones")
                            ->label("common.person.whatsapp_phones")
                            ->translateLabel()
                            ->listWithLineBreaks()
                            ->bulleted()
                            ->placeholder(__("common.common_fields.empty")),
                        Infolists\Components\TextEntry::make("birthday")
                            ->label("common.person.birthday")
                            ->translateLabel()
                            ->date()
                            ->placeholder(__("common.common_fields.empty")),
                        Infolists\Components\TextEntry::make("note")
                            ->label("common.person.note")
                            ->translateLabel()
                            ->columnSpanFull()
                            ->placeholder(__("common.common_fields.empty")),
                        Infolists\Components\TextEntry::make("confession_priest")
                            ->label("common.person.confession_priest")
                            ->translateLabel()
                            ->placeholder(__("common.common_fields.empty")),
                    ])
                    ->columns(3),
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
            'index' => Pages\ListPeople::route('/'),
            'create' => Pages\CreatePerson::route('/create'),
            'view' => Pages\ViewPerson::route('/{record}'),
            'edit' => Pages\EditPerson::route('/{record}/edit'),
        ];
    }
}
