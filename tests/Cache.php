<?php

/*
 * This file is part of the pavlyshyn/cache package
 * 
 * @author Roman Pavlyshyn <roman@pavlyshyn.com>
 */

namespace Pavlyshyn\Tests;

trait Cache {

    protected $cache = null;
    protected $data = [
        'name' => 'user 2',
        'email' => 'user@mail.com',
    ];

    public function testSetAndGetData() {
        $startTime = microtime();

        $this->cache->set('testArray', $this->data);
        $data = $this->cache->get('testArray');

        $endTime = microtime();
        echo 'execution time: ' . ($endTime - $startTime);

        $this->assertEquals($data, $this->data);
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

    public function testExpiration() {
        $this->cache->set('testArray', $this->data, 1);
        
        sleep(2);
        
        $this->assertEquals($this->cache->get('testArray'), false);
    }

}
