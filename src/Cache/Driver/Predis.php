<?php

namespace Pavlyshyn\Cache\Driver;

class Predis implements Pavlyshyn\Cache\Driver {

    private $client = null;
    private $expire = 86400;

    public function __construct($client) {
        $this->client = $client;
    }

    public function __destruct() {
        $this->client->disconnect();
    }

    public function set($key, $value, $expire = null) {
        $this->client->set($key, $this->pack($value));
        if (!$expire) {
            $expire = $this->expire;
        }
        $cmd = $this->client->createCommand('EXPIRE');
        $cmd->setArguments([$key, $expire]);
        $this->client->executeCommand($cmd);
    }

    public function get($key) {
        return $this->unPack($this->client->get($key));
    }

    public function remove($key) {
        $cmd = $this->client->createCommand('DEL');
        $cmd->setArguments([$key]);
        $this->client->executeCommand($cmd);
    }

    protected function pack($value) {
        return serialize($value);
    }

    protected function unPack($value) {
        return unserialize($value);
    }

}
