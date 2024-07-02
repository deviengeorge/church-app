<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 *
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Family> $families
 * @property-read int|null $families_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Street> $streets
 * @property-read int|null $streets_count
 * @method static \Illuminate\Database\Eloquent\Builder|Area newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Area newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Area query()
 * @method static \Illuminate\Database\Eloquent\Builder|Area whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Area whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Area whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Area whereUpdatedAt($value)
 */
	class Area extends \Eloquent {}
}

namespace App\Models{
/**
 *
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Faculty newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Faculty newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Faculty query()
 * @method static \Illuminate\Database\Eloquent\Builder|Faculty whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Faculty whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Faculty whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Faculty whereUpdatedAt($value)
 */
	class Faculty extends \Eloquent {}
}

namespace App\Models{
/**
 *
 *
 * @method static \Illuminate\Database\Eloquent\Builder|FacultyStudent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FacultyStudent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FacultyStudent query()
 */
	class FacultyStudent extends \Eloquent {}
}

namespace App\Models{
/**
 *
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $google_map_link
 * @property int|null $area_id
 * @property int|null $street_id
 * @property int|null $family_id
 * @property string|null $building_num
 * @property string|null $floor_num
 * @property string|null $apartment_num
 * @property string|null $more_location_info
 * @property \App\Enums\FamilyStatus $status
 * @property int|null $priest_id
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Area|null $area
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Person> $members
 * @property-read int|null $members_count
 * @property-read \App\Models\User|null $priest
 * @property-read \App\Models\Street|null $street
 * @method static \Illuminate\Database\Eloquent\Builder|Family newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Family newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Family query()
 * @method static \Illuminate\Database\Eloquent\Builder|Family whereApartmentNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Family whereAreaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Family whereBuildingNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Family whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Family whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Family whereFamilyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Family whereFloorNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Family whereGoogleMapLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Family whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Family whereMoreLocationInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Family whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Family wherePriestId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Family whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Family whereStreetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Family whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Family whereUpdatedBy($value)
 */
	class Family extends \Eloquent {}
}

namespace App\Models{
/**
 *
 *
 * @property int $id
 * @property string $details
 * @property int $family_id
 * @property int $reason_id
 * @property string $visited_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Family $family
 * @property-read \App\Models\FamilyAbsenceReason $reason
 * @method static \Illuminate\Database\Eloquent\Builder|FamilyAbsence newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FamilyAbsence newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FamilyAbsence query()
 * @method static \Illuminate\Database\Eloquent\Builder|FamilyAbsence whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FamilyAbsence whereDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FamilyAbsence whereFamilyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FamilyAbsence whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FamilyAbsence whereReasonId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FamilyAbsence whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FamilyAbsence whereVisitedAt($value)
 */
	class FamilyAbsence extends \Eloquent {}
}

namespace App\Models{
/**
 *
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|FamilyAbsenceReason newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FamilyAbsenceReason newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FamilyAbsenceReason query()
 * @method static \Illuminate\Database\Eloquent\Builder|FamilyAbsenceReason whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FamilyAbsenceReason whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FamilyAbsenceReason whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FamilyAbsenceReason whereUpdatedAt($value)
 */
	class FamilyAbsenceReason extends \Eloquent {}
}

namespace App\Models{
/**
 *
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Person> $members
 * @property-read int|null $members_count
 * @method static \Illuminate\Database\Eloquent\Builder|Gathering newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Gathering newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Gathering query()
 * @method static \Illuminate\Database\Eloquent\Builder|Gathering whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Gathering whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Gathering whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Gathering whereUpdatedAt($value)
 */
	class Gathering extends \Eloquent {}
}

namespace App\Models{
/**
 *
 *
 * @property int $id
 * @property string $name
 * @property array $names
 * @property string|null $alias_name
 * @property array|null $phones
 * @property array|null $whatsapp_phones
 * @property \App\Enums\PersonGender|null $gender
 * @property \App\Enums\PersonStatus|null $status
 * @property string|null $date_of_death
 * @property string|null $note
 * @property string|null $confession_priest
 * @property string|null $birthday
 * @property int|null $family_id
 * @property \App\Enums\PersonFamilyRole|null $family_role
 * @property \App\Enums\PersonTitle|null $title
 * @property int|null $worker_info_id
 * @property int|null $school_student_info_id
 * @property int|null $university_student_info_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Family|null $family
 * @property-read \App\Models\SchoolStudentInfo|null $school_student_info
 * @property-read \App\Models\UniversityStudentInfo|null $university_student_info
 * @property-read \App\Models\WorkerInfo|null $worker_info
 * @method static \Database\Factories\PersonFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Person newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Person newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Person query()
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereAliasName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereBirthday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereConfessionPriest($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereDateOfDeath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereFamilyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereFamilyRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereNames($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person wherePhones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereSchoolStudentInfoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereUniversityStudentInfoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereWhatsappPhones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereWorkerInfoId($value)
 */
	class Person extends \Eloquent {}
}

namespace App\Models{
/**
 *
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|School newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|School newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|School query()
 * @method static \Illuminate\Database\Eloquent\Builder|School whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|School whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|School whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|School whereUpdatedAt($value)
 */
	class School extends \Eloquent {}
}

namespace App\Models{
/**
 *
 *
 * @property int $id
 * @property int|null $school_id
 * @property string|null $grade
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Person|null $person
 * @property-read \App\Models\School|null $school
 * @method static \Illuminate\Database\Eloquent\Builder|SchoolStudentInfo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SchoolStudentInfo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SchoolStudentInfo query()
 * @method static \Illuminate\Database\Eloquent\Builder|SchoolStudentInfo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SchoolStudentInfo whereGrade($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SchoolStudentInfo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SchoolStudentInfo whereSchoolId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SchoolStudentInfo whereUpdatedAt($value)
 */
	class SchoolStudentInfo extends \Eloquent {}
}

namespace App\Models{
/**
 *
 *
 * @property int $id
 * @property string $name
 * @property int $in_church_service
 * @property int|null $area_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Area|null $area
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Family> $families
 * @property-read int|null $families_count
 * @method static \Illuminate\Database\Eloquent\Builder|Street newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Street newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Street query()
 * @method static \Illuminate\Database\Eloquent\Builder|Street whereAreaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Street whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Street whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Street whereInChurchService($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Street whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Street whereUpdatedAt($value)
 */
	class Street extends \Eloquent {}
}

namespace App\Models{
/**
 *
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|University newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|University newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|University query()
 * @method static \Illuminate\Database\Eloquent\Builder|University whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|University whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|University whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|University whereUpdatedAt($value)
 */
	class University extends \Eloquent {}
}

namespace App\Models{
/**
 *
 *
 * @property int $id
 * @property int|null $university_id
 * @property int|null $faculty_id
 * @property int|null $start
 * @property int|null $end
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Faculty|null $faculty
 * @property-read \App\Models\Person|null $person
 * @property-read \App\Models\University|null $university
 * @method static \Illuminate\Database\Eloquent\Builder|UniversityStudentInfo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UniversityStudentInfo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UniversityStudentInfo query()
 * @method static \Illuminate\Database\Eloquent\Builder|UniversityStudentInfo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UniversityStudentInfo whereEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UniversityStudentInfo whereFacultyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UniversityStudentInfo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UniversityStudentInfo whereStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UniversityStudentInfo whereUniversityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UniversityStudentInfo whereUpdatedAt($value)
 */
	class UniversityStudentInfo extends \Eloquent {}
}

namespace App\Models{
/**
 *
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property mixed $password
 * @property string $role
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Family> $families
 * @property-read int|null $families_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class UserHello extends \Eloquent implements \Filament\Models\Contracts\FilamentUser {}
}

namespace App\Models{
/**
 *
 *
 * @property int $id
 * @property string|null $organization
 * @property string|null $position
 * @property \Illuminate\Database\Eloquent\Casts\AsEnumCollection|null $holidays
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Person|null $person
 * @method static \Illuminate\Database\Eloquent\Builder|WorkerInfo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WorkerInfo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WorkerInfo query()
 * @method static \Illuminate\Database\Eloquent\Builder|WorkerInfo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkerInfo whereHolidays($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkerInfo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkerInfo whereOrganization($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkerInfo wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkerInfo whereUpdatedAt($value)
 */
	class WorkerInfo extends \Eloquent {}
}

