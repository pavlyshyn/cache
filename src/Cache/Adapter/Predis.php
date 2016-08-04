<?php

/*
 * This file is part of the pavlyshyn/cache package
 * 
 * @author Roman Pavlyshyn <roman@pavlyshyn.com>
 */

namespace Pavlyshyn\Cache\Adapter;

class Predis extends \Pavlyshyn\Cache\AbstractCache {

    private $client = null;

    public function __construct($config = null) {
        try {
            if ($config === null) {
                $this->client = $client = new \Predis\Client();
            } else {
                $this->client = $client = new \Predis\Client($config);
            }
        } catch (\Exception $e) {
            echo 'Error Predis connection (' . $e->getCode() . '): ', $e->getMessage(), "\n";
        }
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

    public function exists($key) {
        $cmd = $this->client->createCommand('EXISTS');
        $cmd->setArguments([$key]);
        return $this->client->executeCommand($cmd);
    }

    public function remove($key) {
        $cmd = $this->client->createCommand('DEL');
        $cmd->setArguments([$key]);
        $this->client->executeCommand($cmd);
    }

    public function clear() {
        $cmd = $this->client->createCommand('FLUSHALL');
        $this->client->executeCommand($cmd);
    }

}
