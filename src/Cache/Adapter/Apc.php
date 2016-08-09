<?php

/*
 * This file is part of the pavlyshyn/cache package
 * 
 * @author Roman Pavlyshyn <roman@pavlyshyn.com>
 */

namespace Pavlyshyn\Cache\Adapter;

class Apc extends \Pavlyshyn\Cache\AbstractCache {

    public function set($key, $value, $expire = null) {
        if (!$expire) {
            $expire = $this->expire;
        }
        $data = [
            'value' => $value,
            'expire' => (int) $expire + time(),
        ];
        if (!apc_store($key, $this->pack($data), $expire)) {
            throw new \Exception('Error saving data with key "' . $key . '" to the apcu cache.');
        }
    }

    public function get($key) {
        $data = $this->unPack(apc_fetch($key));
        if (!$this->validateData($data, $key)) {
            $this->remove($key);
            return;
        }
        if ($this->hasExpired($data['expire'])) {
            $this->remove($key);
            return;
        }
        return $data['value'];
    }

    public function exists($key) {
        return apc_exists($key);
    }

    public function remove($key) {
        apc_delete($key);
    }

    public function clear() {
        apc_clear_cache();
    }

}
