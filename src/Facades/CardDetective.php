<?php

namespace CardDetective\CardProviderDetector\Facades;

use Illuminate\Support\Facades\Facade;

class CardDetective extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'carddetective';
    }
}
