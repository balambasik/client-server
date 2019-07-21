<?php

include_once 'ApiServer.php';

$ApiServer = new ApiServer([
    "secret" => "cdd9ea63ace1f9873f3b510c2f613ab7c5538337",
    "enable_logs" => true,
]);


$ApiServer->on("actionName", function($requestdata){
    $this->echoJson($requestdata);
});


$ApiServer->on("actionName2", function($requestdata) {
    $this->echoJson($requestdata);
});