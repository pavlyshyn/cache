<?php

/*
 * This file is part of the pavlyshyn/cache package
 * 
 * @author Roman Pavlyshyn <roman@pavlyshyn.com>
 */

namespace Pavlyshyn\Cache;

abstract class AbstractCache implements \Pavlyshyn\Cache\Adapter {

    protected $expire = 86400;

    protected function pack($value) {
        return serialize($value);
    }

    protected function unPack($value) {
        return unserialize($value);
    }

    protected function validateData($data) {
        if (!is_array($data)) {
            return false;
        }
        foreach (['value', 'expire'] as $missing) {
            if (!array_key_exists($missing, $data)) {
                return false;
            }
        }
        return true;
    }

    protected function hasExpired($expire) {
        return (time() > $expire);
    }

}
