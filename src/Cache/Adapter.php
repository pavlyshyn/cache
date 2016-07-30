<?php

namespace Pavlyshyn\Cache;

interface Adapter {

    public function set($key, $value);

    public function get($key);
    
    public function remove($key);
    
    public function clear();
}
