<?php

/*
 * This file is part of the pavlyshyn/cache package
 * 
 * @author Roman Pavlyshyn <roman@pavlyshyn.com>
 */

namespace Pavlyshyn\Cache\Adapter;

class Couchbase extends \Pavlyshyn\Cache\AbstractCache {

    private $client = null;

    public function __construct($host = 'localhost', $bucket = 'default') {
        if (!extension_loaded('couchbase') || !class_exists('CouchbaseCluster')) {
            $this->client = null;
            return false;
        }

        $cluster = new \CouchbaseCluster('couchbase://' . $host);
        $this->client = $cluster->openBucket($bucket);
    }

    public function set($key, $value, $expire = null) {
        $expireIn = ($expire) ? $expire : $this->expire;
        $this->client->set($key, $value, $expireIn);
    }

    public function get($key) {
        return $this->client->get($key);
    }

    public function exists($key) {
        return (bool) $this->client->get($key);
    }

    public function remove($key) {
        $this->client->delete($key);
    }

    public function clear() {
        $this->client->flush();
    }

}
