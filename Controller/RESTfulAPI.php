<?php

#  Author: Lim En Xi

class RESTfulAPI
{
    public static function response($status, $message, $data = null)
    {
        header($_SERVER["SERVER_PROTOCOL"] . $status);

        $response['status'] = $status;
        $response['message'] = $message;
        $response['data'] = $data;

        $jsonResponse = json_encode($response);
        echo $jsonResponse;
    }
}
