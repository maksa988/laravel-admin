<?php

namespace Maksa988\LaravelAdmin\Facades;

use Illuminate\Support\Facades\Facade;

class LaravelAdmin extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return \Maksa988\LaravelAdmin\LaravelAdmin::class;
    }
}