<?php

namespace Pavlyshyn\Cache\Driver;

class Predis implements Pavlyshyn\Cache\Driver {

    private $client = null;

    public function __construct($client) {
        $this->client = $client;
    }

    public function set($key, $value) {
        return $this->client->set($key, $value);
    }

    public function get($key) {
        return $this->client->get($key);
    }

    public function remove($key) {
        return $this->client->del($key);
    }

}
