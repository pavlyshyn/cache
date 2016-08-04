<?php

namespace Pavlyshyn\Tests;

use PHPUnit\Framework\TestCase;
use Pavlyshyn\Cache;
use Pavlyshyn\Cache\Adapter\Memcache;

class MemcacheTest extends TestCase {

    use \Pavlyshyn\Tests\Cache;

    public function __construct() {
        $this->cache = new Cache(new Memcache());
    }

}
