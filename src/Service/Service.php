<?php

namespace Mariia\Iab\Service;

use Mariia\Iab\App;

abstract class Service
{
    public function __construct(protected App $app)
    {
    }
}
