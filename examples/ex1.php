<?php

require_once __DIR__.'/../vendor/autoload.php';

use MartinLindhe\Traits\DiskCacheTrait;

class Brain
{
    use DiskCacheTrait;

    public function __construct()
    {
        $this->cacheTtlSeconds(1);

        $this->store('name', 'mr cool');
    }
}


$brain = new Brain;
$res = $brain->load('name');
nfo("got ".$res);


sleep(2);
$res = $brain->load('name');
nfo("got ".$res);
