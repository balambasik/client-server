# Use Server

```php
<?php

include_once 'ApiServer.php';

$ApiServer = new ApiServer("cdd9ea63ace1f9873f3b510c2f613ab7c5538337"); // set secret key

$ApiServer->on("actionName", function($requestdata) {
    $this->exitJson($requestdata);
});
```



# Use Client

```php

include_once 'ApiClient.php';

$ApiClient = new ApiClient([
    "api_url" => "http://client-server/ApiServer.php", // set api server url
    "secret" => "cdd9ea63ace1f9873f3b510c2f613ab7c5538337" // set secret key
]);

$res = $ApiClient->request("actionName", [
    "foo" => "foo",
    "bar" => "bar",
    "baz" => "baz"
]);
```
