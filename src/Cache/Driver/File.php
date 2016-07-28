<?php

namespace Pavlyshyn\Cache\Driver;

class File implements Pavlyshyn\Cache\Driver {

    private $path;

    public function __construct($path = '') {
        $this->path = $path;
    }

    public function set($key, $value) {
        return file_put_contents($this->getFilename($key), $value);
    }

    public function get($key) {
        return file_get_contents($this->getFilename($key));
    }

    public function remove($key) {
        
    }

    private function getFilename($key) {
        return $this->path . '/' . $key;
    }

}
