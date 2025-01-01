<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class MyAuthExceptionFacade extends Facade {
    protected static function getFacadeAccessor()
    {
        return 'MyAuthException';
    }
}