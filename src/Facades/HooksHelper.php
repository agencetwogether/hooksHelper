<?php

namespace Agencetwogether\HooksHelper\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Agencetwogether\HooksHelper\HooksHelper
 */
class HooksHelper extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Agencetwogether\HooksHelper\HooksHelper::class;
    }
}
