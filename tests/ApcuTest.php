<?php

namespace Pavlyshyn\Tests;

use PHPUnit\Framework\TestCase;
use Pavlyshyn\Cache;
use Pavlyshyn\Cache\Adapter\Apcu;

class ApcuTest extends TestCase {

    use \Pavlyshyn\Tests\Cache;

    public function __construct() {
        $this->cache = new Cache(new Apcu());
    }

}
