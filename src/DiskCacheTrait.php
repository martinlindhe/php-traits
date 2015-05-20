<?php namespace MartinLindhe\Traits;

trait DiskCacheTrait
{
    protected $resultFileNamePrefix;

    /**
     * @param string $id
     * @param string $data
     */
    public function store($id, $data)
    {
        $cacheFile = $this->getCacheFileName($id);
        dbg('CACHE STORE '.$cacheFile);
        file_put_contents($cacheFile, $data);
    }

    /**
     * @param string $id
     * @return string|null
     */
    public function load($id)
    {
        $cacheFile = $this->getCacheFileName($id);

        if (file_exists($cacheFile)
            && Carbon::createFromTimestamp(filemtime($cacheFile))->diffInSeconds(Carbon::now()) < $this->cacheTtlSeconds)
        {
            dbg('CACHE LOAD: '.$cacheFile.', cache ttl '.$this->cacheTtlSeconds.' ('.$id.')');
            return file_get_contents($cacheFile);
        }
        dbg('CACHE NOT FOUND: '.$cacheFile.', cache ttl '.$this->cacheTtlSeconds.' ('.$id.')');
        return null;
    }

    /**
     * @param string $id
     * @return string
     */
    private function getCacheFileName($id)
    {
        return sys_get_temp_dir() . '/cache-' . str_replace('\\', '-',__CLASS__) . '.' . sha1($id);
    }
}

