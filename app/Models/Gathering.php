<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Gathering extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
    ];

    public function members(): HasMany
    {
        return $this->hasMany(Person::class);
    }
}
