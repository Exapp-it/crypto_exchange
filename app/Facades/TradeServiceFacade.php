<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class TradeServiceFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'trade-service';
    }
}
