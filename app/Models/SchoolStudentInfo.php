<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SchoolStudentInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        "school_id",
        "grade",
    ];

    public function school(): HasOne
    {
        return $this->hasOne(School::class);
    }

    public function person(): HasOne
    {
        return $this->hasOne(Person::class);
    }
}
