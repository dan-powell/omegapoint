<?php

namespace App\Models\Weather;

use App\Enum\Weather\Type;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Prediction extends Model
{

    use HasFactory;

    protected $table = 'weather_prediction';

    public $timestamps = false;

    protected $fillable = [
        'start',
        'end',
        'type',
        'temperature_min',
        'temperature_max',
        'windspeed_min',
        'windspeed_max',
        'radiation_min',
        'radiation_max',
        'pressure_min',
        'pressure_max',
        'humidity_min',
        'humidity_max',
        'precipitation_min',
        'precipitation_max',
    ];

    protected function casts(): array
    {
        return [
            'start' => 'datetime',
            'end' => 'datetime',
        ];
    }

    protected function typeIcon(): Attribute
    {
        return Attribute::make(
            get: fn () => Type::from($this->type)->icon(),
        );
    }

}
