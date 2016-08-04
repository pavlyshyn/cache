## Usage

```
composer require pavlyshyn/cache
```


```php
use Pavlyshyn\Cache;
use Pavlyshyn\Cache\Adapter\File;

$adapter = new File(__DIR__ . '/tmp');
$cache = new Cache($adapter);

$cache->set('key', 'value');
echo $cache->get('key');
```


### Methods
```php
$cache->set($key, $value);

$cache->get($key);

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


### Tests
```
phpunit --bootstrap vendor/autoload.php  tests/ApcuTest.php
phpunit --bootstrap vendor/autoload.php  tests/MemcacheTest
phpunit --bootstrap vendor/autoload.php  tests/FileTest
```