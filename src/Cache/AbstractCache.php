<?php

namespace Pavlyshyn\Cache;

abstract class AbstractCache implements \Pavlyshyn\Cache\Driver {

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
