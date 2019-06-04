<?php

class ApiServer {

    private $secret   = "";
    private $handlers = [];

    public function __construct($secret)
    {
        $this->secret = $secret;
    }


    public function on($action, $callback)
    {
        $this->handlers[] = [
            "action"  => $action,
            "handler" => $callback->bindTo($this),
        ];

        $this->runHandlers();
    }


    public function runHandlers()
    {
        if (self::getRequestParam("_secret") != $this->secret) {

            $this->exitJson([
                "error"         => 1,
                "error_message" => "Error secret key"
            ]);
        }

        foreach ($this->handlers as $handler) {
            if ($handler["action"] == self::getRequestParam("_action")) {
                return $handler["handler"]($_REQUEST);
            }
        }
    }


    public static function getRequestParam($key)
    {
        return isset($_REQUEST[$key]) ? $_REQUEST[$key] : null;
    }


    public function exitJson($array)
    {
        exit(json_encode($array, JSON_PRETTY_PRINT));
    }


}
