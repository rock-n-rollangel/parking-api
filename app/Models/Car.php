<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'entered_at',
        'left_at',
    ];

    protected function casts()
    {
        return [
            'entered_at' => 'timestamp',
            'left_at' => 'timestamp',
        ];
    }
}
