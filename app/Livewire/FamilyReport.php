<?php

namespace App\Livewire;

use App\Enums\PersonStatus;
use App\Filament\Resources\FamilyResource;
use App\Models\Faculty;
use App\Models\Family;
use App\Models\Person;
use App\Models\School;
use App\Models\University;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Infolists\Concerns\InteractsWithInfolists;
use Filament\Infolists\Contracts\HasInfolists;
use Filament\Infolists;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Infolists\Infolist;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use Illuminate\Contracts\View\View;
use Livewire\Component;


class FamilyReport extends Component implements HasInfolists, HasForms, HasTable
{
    use InteractsWithInfolists;
    use InteractsWithTable;
    use InteractsWithForms;

    public $family;

    public function mount(Family $family)
    {
        info("Family Name:" . $family->name);

        $this->family = $family;
        app()->setLocale("ar");
    }

    public function render()
    {
        return view('livewire.family-report');
    }

    public function table(Table $table): Table
    {
        $family_id = $this->family->id;
        $members = Person::query()->where('family_id', $family_id)->orderBy("birthday");
        return $table
            ->striped()
            ->paginated(false)
            ->query($members)
            ->columns([
                TextColumn::make('family_role')
                    ->label("القرابة"),
                TextColumn::make('alias_name')
                    ->label("الاسم")
                    ->html()
                    ->formatStateUsing(function (string $state, Person $record) {
                        $name = $record->title->getLabel() . "/ <br/>" . $state;
                        $isDead = $record->date_of_death != null;
                        return match ($isDead) {
                            true => $name . " ( متوفي )",
                            false => $name,
                        };
                    }),
                TextColumn::make('phones')
                    ->label("تليفون")
                    ->placeholder("غير معروف")
                    ->listWithLineBreaks(),
                TextColumn::make('status')
                    ->label("الحالة")
                    ->formatStateUsing(function (Person $record) {
                        return match ($record->status) {
                            PersonStatus::WORKER => "عامل \n " . "( شركة " . $record->worker_info->organization . " )",
                            PersonStatus::SCHOOL_STUDENT => "طالب ( مدرسة " . School::find($record->school_student_info->school_id)->name .  " )",
                            PersonStatus::UNIVERSITY_STUDENT => "جامعة " . University::find($record->university_student_info->university_id)?->name . " ( كلية" . Faculty::find($record->university_student_info->faculty_id)?->name . " )",
                            PersonStatus::UNKNOWN => "غير معروف",
                            PersonStatus::UNEMPLOYED => "بدون عمل",
                            PersonStatus::KID => "طفل",
                            default => null
                        };
                    }),
                TextColumn::make('confession_priest')
                    ->label("أب الاعتراف")
                    ->placeholder("غير معروف"),

                TextColumn::make('birthday')
                    ->label("عيد الميلاد")
                    ->placeholder("غير معروف"),

            ]);
    }

    public function familyInfolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->record($this->family)
            ->schema([
                Infolists\Components\Section::make("معلومات")
                    ->schema([
                        Infolists\Components\TextEntry::make('name')
                            ->label("الاسم")
                            ->translateLabel()
                            ->prefix("عائلة ")
                            ->copyable(),
                        Infolists\Components\TextEntry::make('status')
                            ->label("الحالة")
                            ->translateLabel()
                            ->badge(),
                        Infolists\Components\TextEntry::make('priest.name')
                            ->label("الاب الكاهن المسؤول")
                            ->translateLabel()
                            ->placeholder("غير معروف"),

                        Infolists\Components\TextEntry::make('area.name')
                            ->label("المنطقة")
                            ->translateLabel()
                            ->placeholder("غير معروف"),
                        Infolists\Components\TextEntry::make('street.name')
                            ->label("الشارع")
                            ->translateLabel()
                            ->placeholder("غير معروف"),
                        Infolists\Components\TextEntry::make('building_num')
                            ->label("رقم المبني")
                            ->translateLabel()
                            ->placeholder("غير معروف"),
                        Infolists\Components\TextEntry::make('floor_num')
                            ->label("رقم الدور")
                            ->translateLabel()
                            ->placeholder("غير معروف"),
                        Infolists\Components\TextEntry::make('apartment_num')
                            ->label("رقم الشقة")
                            ->translateLabel()
                            ->placeholder("غير معروف"),
                        Infolists\Components\TextEntry::make('more_location_info')
                            ->label("معلومات اكثر عن المكان")
                            ->translateLabel()
                            ->placeholder("غير معروف"),

                    ])
                    ->columns(["sm" => 3])
            ]);
    }
}
