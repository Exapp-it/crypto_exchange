<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class TelegramBotFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'telegram-bot';
    }
}
