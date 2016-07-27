<?php

namespace Pavlyshyn\Cache\Driver;

class File implements Pavlyshyn\Cache\Driver {

    public function set($key, $value);

    public function get($key);
}
