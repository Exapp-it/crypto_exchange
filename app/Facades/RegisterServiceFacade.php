<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class RegisterServiceFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'register-service';
    }
}
