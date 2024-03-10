<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Area extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
    ];

    // public function families(): HasMany
    // {
    //     return $this->hasMany(Family::class);
    // }

    public function streets(): HasMany
    {
        return $this->hasMany(Street::class);
    }
}
