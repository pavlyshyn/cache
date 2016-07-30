<?php

use PHPUnit\Framework\TestCase;
use Pavlyshyn\Cache;
use Pavlyshyn\Cache\Driver\File;

class FileTest extends TestCase {

    private $cache = null;
    private $data = [
        'name' => 'user 2',
        'email' => 'user@mail.com',
    ];
    
    public function __construct() {
        $this->cache = new Cache(new File(__DIR__ . '/tmp'));
    }

    public function testSetAndGetData() {
        $this->cache->set('testArray', $this->data);
        $this->assertEquals($this->cache->get('testArray'), $this->data);
    }
    
    public function testRemoveData() {
        $this->cache->set('testArray', $this->data);
        $this->cache->remove('testArray');
        $this->assertEquals($this->cache->get('testArray'), false);
    }
    
    public function testClearAll() {
        $this->cache->set('testArray', $this->data);
        $this->cache->set('testArray1', $this->data);
        
        $this->cache->clear();
        
        $this->assertEquals($this->cache->get('testArray'), false);
        $this->assertEquals($this->cache->get('testArray1'), false);
    }
}
