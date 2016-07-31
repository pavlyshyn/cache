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
