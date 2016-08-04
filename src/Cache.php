<?php

/*
 * This file is part of the pavlyshyn/cache package
 * 
 * @author Roman Pavlyshyn <roman@pavlyshyn.com>
 */

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

    public function exists($key) {
        return $this->adapter->exists($key);
    }

    public function remove($key) {
        return $this->adapter->remove($key);
    }

    public function clear() {
        return $this->adapter->clear();
    }

}
