<?php

include_once 'ApiServer.php';

$ApiServer = new ApiServer("cdd9ea63ace1f9873f3b510c2f613ab7c5538337");

$ApiServer->on("actionName", function($requestdata) {
    $this->exitJson($requestdata);
});
