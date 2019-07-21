<?php

namespace Balambasik\ClientServer;

class ApiClient {

    private $secret  = "";
    private $api_url = "";
    private $response = null;

    public function __construct(array $params)
    {
        $this->secret = $params["secret"];
        $this->api_url = $params["api_url"];
    }


    public function request($action, $params = array())
    {
        $postdata = http_build_query([
            '_secret' => $this->secret,
            '_action' => $action,
            'params' => $params
        ]);

        $context = stream_context_create([
            'http' => [
                'method'  => 'POST',
                'header'  => 'Content-Type: application/x-www-form-urlencoded',
                'timeout' => 30,
                'content' => $postdata
            ]
        ]);

        $this->response = file_get_contents($this->api_url, false, $context);
        
        return $this;
    }

    public function get()
    {
        return $this->response;
    }
    
    
    public function getArray()
    {
        return json_decode($this->response, JSON_PRETTY_PRINT);
    }

    public function toFile($filename)
    {
        file_put_contents($filename, var_export($this->response, true) . PHP_EOL, FILE_APPEND);
    }    
    
    
}
