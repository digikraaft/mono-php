<?php

namespace Digikraaft\Mono\Tests;

use Digikraaft\Mono\Mono;

class TestHelper
{
    public static function setup()
    {
        Mono::$apiBaseUrl = 'https://api.withmono.com';
        Mono::setSecretKey('sec-sdddsje');
    }
}
