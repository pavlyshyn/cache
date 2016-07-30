<?php

namespace Pavlyshyn;

use Pavlyshyn\Cache\Driver;

class Cache {

    private $driver = null;

    public function __construct(Driver $driver) {
        $this->driver = $driver;
    }

    public function set($key, $value) {
        return $this->driver->set($key, $value);
    }

    public function get($key) {
        return $this->driver->get($key);
    }

    public function remove($key) {
        return $this->driver->remove($key);
    }

    public function clear() {
        return $this->driver->clear();
    }

}
