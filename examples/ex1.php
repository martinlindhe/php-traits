<?php

require_once __DIR__.'/../vendor/autoload.php';

use MartinLindhe\Traits\Cacheable;
use MartinLindhe\Traits\DiskCacheTrait;

class Stuff
{
    use DiskCacheTrait;
}


$x = (new Stuff)
    ->cacheTtlSeconds(2);

$x->store('hej', 'abc');

if ($res = $x->load('hej')) {
    echo "got ".$res;
}
