<?php

namespace App\Enum\Area;

enum Tier: string
{
    case TOPSIDE = 'topside';
    case CENTRAL = 'central';
    case UNDERSIDE = 'underside';

    public function name(): string
    {
        return match($this) 
        {
            Tier::TOPSIDE => 'Topside',   
            Tier::CENTRAL => 'Central',   
            Tier::UNDERSIDE => 'Underside',   
        };
    }

    public static function values(): array
    {
        $arr = [];
        foreach(Tier::cases() as $tier) 
        {
            $arr[$tier->value] =  $tier->name();
        }
        return $arr;
    }
}
