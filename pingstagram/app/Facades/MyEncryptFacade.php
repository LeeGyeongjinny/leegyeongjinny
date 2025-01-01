<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class MyEncryptFacade extends Facade {
    protected static function getFacadeAccessor() 
    {
        return 'MyEncrypt';
    }
}