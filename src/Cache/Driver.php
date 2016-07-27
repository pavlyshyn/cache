<?php

namespace Pavlyshyn\Cache;

interface Driver {

    public function set($key, $value);

    public function get($key);
}
