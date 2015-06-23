<?php

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

class DiskCacheTraitTest extends \PHPUnit_Framework_TestCase
{
    function test1()
    {
        $brain = new Brain;
        $this->assertEquals('mr cool', $brain->load('name'));
    }
}
