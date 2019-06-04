<?php

class ApiClient {

    private $secret  = "";
    private $api_url = "";

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

        return file_get_contents($this->api_url, false, $context);
    }



}
