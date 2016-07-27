<?php

namespace Pavlyshyn;

use Pavlyshyn\Cache\Driver;

class Cache {

    private $driver = null;

    public function __construct(Driver $driver) {
        $this->driver = $driver;
    }
}
