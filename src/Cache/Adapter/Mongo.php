<?php

namespace Pavlyshyn\Cache\Adapter;

class Mongo  extends \Pavlyshyn\Cache\AbstractCache {

    private $collection = '';
    private $options = array(
        'connect' => true,
        'replicaSet' => ''
    );

    public function __construct($host, $dbName, $user = '', $password = '', $options = [], $collection = 'cache') {
        try {
            $this->collection = $collection;

            if (sizeof($options) > 0) {
                array_merge($this->options, $options);
            }

            $dsn = 'mongodb://';

            if ($user != '') {
                $dsn .= $user . ':' . $password . '@' . $host . '/' . $dbName;
            } else {
                $dsn .= $host;
            }

            $db = new \MongoClient($dsn, $this->options);
            $this->connection = $db->selectDB($db);
            return $this->connection;
        } catch (Pavlyshyn\Exception $e) {
            echo 'Error MongoDB connection (' . $e->getCode() . '): ', $e->getMessage(), "\n";
        }
    }

    public function set($key, $value) {
        $item = array(
            '_id' => $key,
            'value' => $this->pack($value),
        );
        $this->selectCollection($this->collection)->update(array('_id' => $key), $item, array('upsert' => true));
    }

    public function get($key) {
        $data = $this->selectCollection($this->collection)->findOne(array('_id' => $key));
        if (isset($data)) {
            return $this->unPack($data['value']);
        }
        return false;
    }

    public function remove($key) {
        $this->selectCollection($this->collection)->remove(array('_id' => $key));
    }

    public function clear() {
        $this->selectCollection($this->collection)->drop();
    }

    public function selectCollection($collection) {
        if ($this->connection) {
            $c = $this->connection->selectCollection($collection);
            return $c;
        }
    }

}
