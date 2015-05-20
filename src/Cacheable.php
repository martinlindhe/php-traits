<?php namespace MartinLindhe\Traits;

/**
 * Defines that a extending class uses a caching trait (eg DiskCacheTrait)
 */
abstract class Cacheable
{
    protected $cacheTtlSeconds;

    /**
     * @param int $n
     * @return $this
     */
    public function cacheTtlSeconds($n)
    {
        $this->cacheTtlSeconds = $n;
        return $this;
    }

    abstract function store($url, $data);

    abstract function load($url);
}
