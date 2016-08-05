<?php

/*
 * This file is part of the pavlyshyn/cache package
 * 
 * @author Roman Pavlyshyn <roman@pavlyshyn.com>
 */

namespace Pavlyshyn\Cache\Adapter;

class Couchbase extends \Pavlyshyn\Cache\AbstractCache {

    private $client = null;

    public function __construct($config = null) {
        if (!extension_loaded('couchbase') || !class_exists('CouchbaseCluster')) {
            $this->client = null;
            return false;
        }
    }

    public function set($key, $value, $expire = null) {
        
    }

    public function get($key) {
        
    }

    public function exists($key) {
        
    }

    public function remove($key) {
        
    }

    public function clear() {
        
    }

}
