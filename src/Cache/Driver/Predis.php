<?php

namespace Pavlyshyn\Cache\Driver;

class Predis implements Pavlyshyn\Cache\Driver {

    public function set($key, $value);

    public function get($key);
}
