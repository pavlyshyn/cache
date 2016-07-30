<?php

namespace Pavlyshyn\Cache\Driver;

class Memcache implements \Pavlyshyn\Cache\Driver {

    private $client = null;
    private $flag = 0;
    private $expire = 86400;

    public function __construct($client) {
        $this->client = $client;
    }

    public function set($key, $value) {
        $this->client->set($key, $value, $this->flag, $this->expire);
    }

    public function get($key) {
        return $this->client->get($key);
    }

    public function remove($key) {
        $this->client->set($key, NULL);
    }
    
    public function clear() {
        
    }

}
