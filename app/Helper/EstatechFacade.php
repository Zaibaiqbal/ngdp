<?php

namespace App\Helper;

use Illuminate\Support\Facades\Facade;

class EstatechFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'ef';
    }
} 