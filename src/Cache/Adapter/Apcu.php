<?php

namespace Pavlyshyn\Cache\Adapter;

class Apcu extends \Pavlyshyn\Cache\AbstractCache {

    public function __construct() {
        
    }

    public function set($key, $value, $expire = null) {
        if (!$expire) {
            $expire = $this->expire;
        }
        $data = [
            'value' => $value,
            'expire' => (int) $expire + time(),
        ];
        if (!apc_store($key, $this->pack($data), $expire)) {
            throw new CacheException('Error saving data with key "' . $key . '" to the apcu cache.');
        }
    }

    public function get($key) {
        $data = $this->unPack(apc_fetch($key));
        if (!$this->validateDataFromCache($data, $key)) {
            $this->del($key);
            return;
        }
        if ($this->hasExpired($data['expire'])) {
            $this->remove($key);
            return;
        }
        return $data['value'];
    }

    public function remove($key) {
        apc_delete($key);
    }

    public function clear() {
        
    }

}
