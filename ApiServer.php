<?php

class ApiServer {

    private $secret      = "";
    private $enable_logs = "";
    private $log_file    = "";
    private $handlers    = [];

    public function __construct($params)
    {
        $this->secret      = $params['secret'];
        $this->enable_logs = isset($params['enable_logs']) ? $params['enable_logs'] : false;
        $this->log_file    = isset($params['log_file']) ? $params['log_file'] : false;

        if ($this->enable_logs) {
            $this->requestLog($this->log_file);
        }
    }


    public function on($action, $callback)
    {
        $this->handlers[] = [
            "action"  => $action,
            "handler" => $callback->bindTo($this),
        ];
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
                $handler["handler"]($_REQUEST);
            }
        }
    }


    public static function getRequestParam($key)
    {
        return isset($_REQUEST[$key]) ? $_REQUEST[$key] : null;
    }


    public function echoJson($array)
    {
        echo json_encode($array, JSON_PRETTY_PRINT);
    }


    public function exitJson($array)
    {
        $this->echoJson($array);
        exit;
    }


    public function requestLog($filename)
    {
        $filename = $filename ? $filename : 'log.txt';

        $data = "--------------------" . date("Y-m-d H:i:s") . "-----------------------" . PHP_EOL;
        $data .= var_export($_REQUEST, true) . PHP_EOL;

        file_put_contents($filename, $data, FILE_APPEND);
    }


    public function __destruct()
    {
        $this->runHandlers();
    }


}
