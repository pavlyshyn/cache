<?php

namespace Pavlyshyn\Cache\Adapter;

class Predis extends \Pavlyshyn\Cache\AbstractCache {

    private $client = null;

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

    public function clear() {
        
    }

}
