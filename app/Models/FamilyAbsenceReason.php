<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyAbsenceReason extends Model
{
    protected $table = "family_absence_reasons";

    use HasFactory;

    protected $fillable = [
        "name",
    ];
}
