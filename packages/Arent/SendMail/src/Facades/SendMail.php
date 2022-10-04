<?php

namespace Arent\SendMail\Facades;

use Illuminate\Support\Facades\Facade;

class SendMail extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'sendmail';
    }
}
