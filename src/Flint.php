<?php

namespace Flint;

use Illuminate\Support\Facades\Facade;

class Flint extends Facade
{
    /**
     * Get the binding in the IoC container
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'flint'; // the IoC binding.
    }
}
