<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tariffication extends Model
{
    use HasFactory;

    protected $fillable = [
        'active_from',
        'active_to',
        'price',
        'default',
    ];
}
