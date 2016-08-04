<?php

namespace Pavlyshyn\Tests;

use PHPUnit\Framework\TestCase;
use Pavlyshyn\Cache;
use Pavlyshyn\Cache\Adapter\File;

class FileTest extends TestCase {

    use \Pavlyshyn\Tests\Cache;

    public function __construct() {
        $this->cache = new Cache(new File(__DIR__ . '/tmp'));
    }

}
