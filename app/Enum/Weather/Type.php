<?php

namespace App\Enum\Weather;

enum Type: string
{
    case SUNNY = 'sunny';
    case CLOUDY = 'cloudy';
    case WINDY = 'windy';

    public function name(): string
    {
        return match($this)
        {
            Type::SUNNY => 'Sunny',
            Type::CLOUDY => 'Cloudy',
            Type::WINDY => 'Windy',
        };
    }

    public function icon(): string
    {
        return match($this)
        {
            Type::SUNNY => 'sun-light.svg',
            Type::CLOUDY => 'cloud.svg',
            Type::WINDY => 'wind.svg',
        };
    }

    public static function values(): array
    {
        $arr = [];
        foreach(Type::cases() as $tier)
        {
            $arr[$tier->value] =  $tier->name();
        }
        return $arr;
    }
}
