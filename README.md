## Usage


```php
use Pavlyshyn\Cache;
use Pavlyshyn\Cache\Adapter\File;

$cache = new Cache(new File(__DIR__ . '/tmp'));

$cache->set('key', 'value');
echo $cache->get('key');


```php
