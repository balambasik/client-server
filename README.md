# Install using composer

```text
composer require balambasik/client-server
```

# Using Server

```php
<?php

include_once 'vendor/autoload.php';

$ApiServer = new \Balambasik\ClientServer\ApiServer([
    "secret" => "cdd9ea63ace1f9873f3b510c2f613ab7c5538337",
    "enable_logs" => true,
]);

$ApiServer->on("actionName", function($requestdata){
    $this->exitJson($requestdata);
});

$array = [1, 2, 3, 4, 5];

$ApiServer->on("actionName2", function($requestdata) use ($array) {
    $this->exitJson($requestdata);
    print_r($array);
});
```

# Using Client

```php
<?php

include_once 'vendor/autoload.php';

$ApiClient = new \Balambasik\ClientServer\ApiClient([
    "api_url" => "http://client-server/example-server.php",
    "secret" => "cdd9ea63ace1f9873f3b510c2f613ab7c5538337"
]);

$response = $ApiClient->request("actionName", [
    "foo" => "foo",
    "bar" => "bar"
]);

var_export($response->get());
var_export($response->getArray());
var_export($response->getArray('key'));
```
