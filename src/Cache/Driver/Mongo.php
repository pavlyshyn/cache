<?php

namespace Pavlyshyn\Cache\Driver;

class Mongo implements Pavlyshyn\Cache\Driver {

    public $collection = 'cache';

    public function __construct($collection) {
        $this->collection = $collection;
    }

    public function set($key, $value) {
        
    }

    public function get($key) {
        
    }

    public function remove($key) {
        
    }

}
