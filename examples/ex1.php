<?php

require_once __DIR__.'/../vendor/autoload.php';

use MartinLindhe\Traits\Cacheable;
use MartinLindhe\Traits\DiskCacheTrait;

class Stuff extends Cacheable
{
    use DiskCacheTrait;

}
