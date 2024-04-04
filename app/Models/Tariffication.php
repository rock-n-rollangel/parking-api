<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
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

    public function scopeActive(Builder $builder)
    {
        $now = now()->secondOfDay();
        $builder->where('active_from', '<=', $now)
            ->where('active_to', '>=', $now);
    }

    public static function calcAmount(Car $car): int
    {
        $entered_at = $car->entered_at->secondOfDay;
        $left_at = $car->left_at->secondOfDay;
        $tariffs = self::where(function (Builder $query) use($car, $entered_at, $left_at) {
            $query->where('active_from', '>=', $entered_at)
                ->where('active_to', '<=', $left_at);
        })
            ->orWhere('default', '=', true)
            ->get();

        $amount = 0;
        $tariffs->each(function ($tariff) use(&$amount) {
            $amount += $tariff->price;
        });

        return $amount;
    }
}
