<?php

namespace Pavlyshyn\Cache\Driver;

class File implements Pavlyshyn\Cache\Driver {

    private $path;
    private $expire = 86400;

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
            return;
        }
        $data = $this->unPack(file_get_contents($path));
        if (!$data || !$this->validateData($data) || $this->hasExpired($data['expire'])) {
            return;
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

    private function getFileName($key) {
        return $this->path . '/' . $key;
    }

    protected function pack($value) {
        return serialize($value);
    }

    protected function unPack($value) {
        return unserialize($value);
    }

    protected function validateData($data) {
        if (!is_array($data)) {
            return false;
        }
        foreach (['value', 'expire'] as $missing) {
            if (!array_key_exists($missing, $data)) {
                return false;
            }
        }
        return true;
    }

    protected function hasExpired($expire) {
        return (time() > $expire);
    }

}
