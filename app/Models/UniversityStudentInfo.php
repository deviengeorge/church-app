<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UniversityStudentInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        "university_id",
        "faculty_id",
        "start",
        "end"
    ];

    public function university()
    {
        return $this->hasOne(University::class);
    }

    public function faculty()
    {
        return $this->hasOne(Faculty::class);
    }

    public function person(): HasOne
    {
        return $this->hasOne(Person::class);
    }
}
