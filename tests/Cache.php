<?php

namespace Pavlyshyn\Tests;

trait Cache {

    protected $cache = null;
    protected $data = [
        'name' => 'user 2',
        'email' => 'user@mail.com',
    ];

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
