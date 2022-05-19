<?php

namespace App\Traits;

use App\Observers\ManifestoObserver;

trait ManifestoTrait
{
    public static function boot()
    {
        parent::boot();
        //static::addGlobalScope()
        static::observe(new ManifestoObserver);
    }
}
