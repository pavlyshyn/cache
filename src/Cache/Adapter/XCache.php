<?php

/*
 * This file is part of the pavlyshyn/cache package
 * 
 * @author Roman Pavlyshyn <roman@pavlyshyn.com>
 */

namespace Pavlyshyn\Cache\Adapter;

class XCache extends \Pavlyshyn\Cache\AbstractCache {

    private $client = null;
    private $config = [
        'username' => 'admin',
        'pass' => ''
    ];

    public function __construct($config = null) {
        $this->config = $config;
    }

    public function set($key, $value, $expire = null) {
        $expire = ($expire) ? : $this->expire;

        xcache_set($key, $this->pack($value), $expire);
    }

    public function get($key) {
        return $this->unPack(xcache_get($key));
    }

    public function exists($key) {
        return xcache_isset($key);
    }

    public function remove($key) {
        xcache_unset($key);
    }

    public function clear() {
        $admin = (ini_get('xcache.admin.enable_auth') === "On");
        if ($admin && (!isset($this->config['username']) || !isset($this->config['password']))) {
            return false;
        }
        $credentials = array();

        if (isset($_SERVER['PHP_AUTH_USER'])) {
            $credentials['username'] = $_SERVER['PHP_AUTH_USER'];
            $_SERVER['PHP_AUTH_USER'] = $this->config['username'];
        }
        if (isset($_SERVER['PHP_AUTH_PW'])) {
            $credentials['password'] = $_SERVER['PHP_AUTH_PW'];
            $_SERVER['PHP_AUTH_PW'] = $this->config['pass'];
        }

        for ($i = 0, $max = xcache_count(XC_TYPE_VAR); $i < $max; $i++) {
            if (xcache_clear_cache(XC_TYPE_VAR, $i) === false) {
                return false;
            }
        }

        if (isset($_SERVER['PHP_AUTH_USER'])) {
            $_SERVER['PHP_AUTH_USER'] = $credentials['username'];
        }
        if (isset($_SERVER['PHP_AUTH_PW'])) {
            $_SERVER['PHP_AUTH_PW'] = $credentials['password'];
        }
        return true;
    }

}
