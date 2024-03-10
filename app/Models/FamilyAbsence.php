<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FamilyAbsence extends Model
{
    use HasFactory;

    protected $fillable = [
        'details',
        'family_id',
        'reason_id',
        'visited_at'
    ];

    public function family(): BelongsTo
    {
        return $this->belongsTo(Family::class);
    }

    public function reason(): BelongsTo
    {
        return $this->belongsTo(FamilyAbsenceReason::class);
    }
}
