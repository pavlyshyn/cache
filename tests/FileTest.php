<?php

use PHPUnit\Framework\TestCase;
use Pavlyshyn\Cache;
use Pavlyshyn\Cache\Driver\File;

class FileTest extends TestCase {

    public function testFile() {
        $cache = new Cache(new File(__DIR__ . '/tmp'));
        
        $data = [
            'name' => 'user 2',
            'email' => 'user@mail.com',
        ];
        
        $cache->set('testArray', $data);
        $this->assertEquals($cache->get('testArray'), $data);
    }

}
