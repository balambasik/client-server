<?php

include_once 'ApiClient.php';


$ApiClient = new ApiClient([
    "api_url" => "http://client-server/example-server.php",
    "secret" => "cdd9ea63ace1f9873f3b510c2f613ab7c5538337"
]);


$res = $ApiClient->request("actionName", [
    "phone" => "234534563473",
    "params" => rand(0,1000000)
]);

var_dump($res);