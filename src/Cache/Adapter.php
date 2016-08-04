<?php

/*
 * This file is part of the pavlyshyn/cache package
 * 
 * @author Roman Pavlyshyn <roman@pavlyshyn.com>
 */

namespace Pavlyshyn\Cache;

interface Adapter {

    public function set($key, $value);

    public function get($key);

    public function exists($key);

    public function remove($key);

    public function clear();
}
