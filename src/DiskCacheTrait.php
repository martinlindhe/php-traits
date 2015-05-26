<?php namespace MartinLindhe\Traits;

use Carbon\Carbon;

trait DiskCacheTrait
{
    protected $resultFileNamePrefix;

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

    /**
     * @param string $id
     * @param string $data
     */
    public function store($id, $data)
    {
        $cacheFile = $this->getCacheFileName($id);
        dbg('CACHE STORE '.$cacheFile.', '.$id);
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
        $tmpFile = 'cache-' . str_replace('\\', '-',__CLASS__) . '.' . sha1($id);

        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            return getenv('TMP')."\\".str_replace("/", "\\", $tmpFile);
        }

        return '/tmp/'.$tmpFile;
    }
}

