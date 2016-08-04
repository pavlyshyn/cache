<?php

/*
 * This file is part of the pavlyshyn/cache package
 * 
 * @author Roman Pavlyshyn <roman@pavlyshyn.com>
 */

namespace Pavlyshyn\Cache\Adapter;

class Memory extends \Pavlyshyn\Cache\AbstractCache {

    protected $data = [];

    public function set($key, $value, $expire = null) {
        if (!$expire) {
            $expire = $this->expire;
        }
        $this->data[$key] = $this->pack([
            'value' => $value,
            'expire' => (int) $expire + time(),
        ]);
    }

    public function get($key) {
        if ($this->exists($key)) {
            $data = $this->unPack($this->data[$key]);
            return $data['value'];
        }
        return false;
    }

    public function exists($key) {
        if (isset($this->data[$key])) {
            $data = $this->unPack($this->data[$key]);

            if (time() < $data['expire']) {
                return true;
            }
            $this->remove($key);
        }
        return false;
    }

    public function remove($key) {
        unset($this->data[$key]);
    }

    public function clear() {
        unset($this->data);
    }

}
