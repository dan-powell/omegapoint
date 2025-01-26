<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;
use App\Services\ImageService;

class Image extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return ImageService::class;
    }
}
