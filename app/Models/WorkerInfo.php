<?php

namespace App\Models;

use App\Enums\WeekDay;
use Illuminate\Database\Eloquent\Casts\AsEnumCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class WorkerInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        "organization",
        "position",
        "holidays"
    ];

    protected $casts = [
        "holidays" => AsEnumCollection::class . ':' . WeekDay::class
    ];

    public function person(): HasOne
    {
        return $this->hasOne(Person::class);
    }
}
