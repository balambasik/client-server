# Use Server

```php
<?php

include_once 'ApiServer.php';

$ApiServer = new ApiServer([
    "secret" => "cdd9ea63ace1f9873f3b510c2f613ab7c5538337",
    "enable_logs" => true,
]);


$ApiServer->on("actionName", function($requestdata){
    $this->echoJson($requestdata);
});

$array = [1,2,3,4,5];

$ApiServer->on("actionName2", function($requestdata) use ($array) {
    $this->echoJson($requestdata);
    print_r($array);
});
```

# Use Client

```php
<?php

include_once 'ApiClient.php';

$ApiClient = new ApiClient([
    "api_url" => "http://client-server/example-server.php",
    "secret" => "cdd9ea63ace1f9873f3b510c2f613ab7c5538337"
]);

$response = $ApiClient->request("actionName", [
    "foo" => "foo",
    "bar" => "bar"
]);

var_export($response->get());
var_export($response->getArray());
```
