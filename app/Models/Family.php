<?php

namespace App\Models;

use App\Enums\FamilyStatus;
use App\Traits\CreatedUpdatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Family extends Model
{
    use HasFactory;
    use CreatedUpdatedBy;

    protected $fillable = [
        "id",
        "name",
        "google_map_link",
        "area_id",
        "street_id",
        "building_num",
        "floor_num",
        "apartment_num",
        "more_location_info",
        "status",
        "priest_id",
        "created_by",
        "updated_by"
    ];

    protected $casts = [
        "status" => FamilyStatus::class,
    ];

    public function area()
    {
        return $this->belongsTo(Area::class, "area_id");
    }

    public function street()
    {
        return $this->belongsTo(Street::class, "street_id");
    }

    public function members()
    {
        return $this->hasMany(Person::class, "family_id");
    }

    public function priest(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
