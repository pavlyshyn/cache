<?php

namespace Pavlyshyn;

use Pavlyshyn\Cache\Adapter;

class Cache {

    private $adapter = null;

    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
    }

    public function set($key, $value) {
        return $this->adapter->set($key, $value);
    }

    public function get($key) {
        return $this->adapter->get($key);
    }

    public function remove($key) {
        return $this->adapter->remove($key);
    }

    public function clear() {
        return $this->adapter->clear();
    }

}
