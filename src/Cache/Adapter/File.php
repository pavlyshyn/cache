<?php

namespace Pavlyshyn\Cache\Adapter;

class File extends \Pavlyshyn\Cache\AbstractCache {

    private $path;
    private $fileExtension = '.cache';

    public function __construct($path = '') {
        $this->path = $path;
    }

    public function set($key, $value, $expire = null) {
        $cacheFile = $this->getFileName($key);
        if (!$expire) {
            $expire = $this->expire;
        }

        $item = $this->pack([
            'value' => $value,
            'expire' => (int) $expire + time(),
        ]);

        if (!file_put_contents($cacheFile, $item)) {
            throw new CacheException('Error saving data with the key "' . $key . '" to the cache file.');
        }
    }

    public function get($key) {
        $path = $this->getFileName($key);
        if (!file_exists($path)) {
            return false;
        }
        $data = $this->unPack(file_get_contents($path));
        if (!$data || !$this->validateData($data) || $this->hasExpired($data['expire'])) {
            return false;
        }
        return $data['value'];
    }

    public function remove($key) {
        $path = $this->getFileName($key);
        if (is_file($path)) {
            return unlink($path);
        }
        return false;
    }

    public function clear() {
        $files = glob($this->path . '/*');
        foreach ($files as $file) {
            if (is_file($file)) {
                unlink($file);
            }
        }
    }

    private function getFileName($key) {
        return $this->path . '/' . $key . $this->fileExtension;
    }

}
