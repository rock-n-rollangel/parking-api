<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ParkingSpace extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'state',
    ];

    public function car(): HasOne
    {
        return $this->hasOne(Car::class);
    }

    public function cars(): HasMany
    {
        return $this->hasMany(Car::class);
    }
}
