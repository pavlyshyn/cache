<?php

namespace Pavlyshyn\Cache\Adapter;

class Memcache extends \Pavlyshyn\Cache\AbstractCache {

    private $client = null;
    private $flag = 0;

    public function __construct($host = "127.0.0.1", $port = 11211) {
        try {
            $this->client = $memcache = new \Memcache;
            $this->client->pconnect($host, $port, 30);
        } catch (\Exception $e) {
            echo 'Error Memcache connection (' . $e->getCode() . '): ', $e->getMessage(), "\n";
        }
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
        $this->client->flush();
    }

}
