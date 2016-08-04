<?php

namespace Pavlyshyn\Tests;

use PHPUnit\Framework\TestCase;
use Pavlyshyn\Cache;
use Pavlyshyn\Cache\Adapter\Predis;

class PredisTest extends TestCase {

    use \Pavlyshyn\Tests\Cache;

    public function __construct() {
        $this->cache = new Cache(new Predis());
    }

}
