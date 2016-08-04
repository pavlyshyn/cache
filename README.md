
### Install
```
composer require pavlyshyn/cache
```


### Usage
```php
use Pavlyshyn\Cache;
use Pavlyshyn\Cache\Adapter\File;

$adapter = new File(__DIR__ . '/tmp');
$cache = new Cache($adapter);

$cache->set('key', 'value');
var_dump($cache->get('key'));
```


### Methods
```php
$cache->set($key, $value);

$cache->get($key);

$cache->exists($key);

$cache->remove($key);

$cache->clear();
```


### Memcache adapter
```php
use Pavlyshyn\Cache\Adapter\Memcache;

$adapter = new Memcache('127.0.0.1', 11211);
```


### Apcu adapter
```php
use Pavlyshyn\Cache\Adapter\Apcu;

$adapter = new Apcu();
```


### [Predis](https://github.com/nrk/predis) adapter
```php
use Pavlyshyn\Cache\Adapter\Predis;

$adapter = new Predis();

OR

$adapter = new Predis([
    'scheme' => 'tcp',
    'host'   => '10.0.0.1',
    'port'   => 6379,
]);

OR

$adapter = new Predis('tcp://10.0.0.1:6379');
```


### XCache adapter
```php
use Pavlyshyn\Cache\Adapter\XCache;

$adapter = new XCache('admin', '');
```


### Memory adapter
```php
use Pavlyshyn\Cache\Adapter\Memory;

$adapter = new Memory();
```


### Tests
```
phpunit --bootstrap vendor/autoload.php  tests/Adapter/ApcuTest
phpunit --bootstrap vendor/autoload.php  tests/Adapter/MemcacheTest
phpunit --bootstrap vendor/autoload.php  tests/Adapter/XCacheTest
phpunit --bootstrap vendor/autoload.php  tests/Adapter/PredisTest
phpunit --bootstrap vendor/autoload.php  tests/Adapter/MemoryTest
phpunit --bootstrap vendor/autoload.php  tests/Adapter/FileTest
```