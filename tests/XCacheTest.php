<?php

/*
 * This file is part of the pavlyshyn/cache package
 * 
 * @author Roman Pavlyshyn <roman@pavlyshyn.com>
 */

namespace Pavlyshyn\Tests;

use PHPUnit\Framework\TestCase;
use Pavlyshyn\Cache;
use Pavlyshyn\Cache\Adapter\XCache;

class XCacheTest extends TestCase {

    use \Pavlyshyn\Tests\Cache;

    public function __construct() {
        $this->cache = new Cache(new XCache('admin', ''));
    }

}
