<?php

#  Author: Lim En Xi

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    try {
        if (!isset($_GET['eventId'])) {
            throw new Exception("Event is not set.");
        }

        $eventId = json_decode($_GET['eventId']);

        $apiURL = "http://localhost/TARUMT_Event_Ticketing/Controller/CtrlEvent/Handler.php?action=Read&eventId=$eventId";
        
        $client = curl_init($apiURL);

        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($client);

        $result = json_decode($response);
        
        if ($result->status === 200) {
            echo json_encode($result->data);
            exit;
        }

        if($result->status == 404){
            throw new Exception($result->message, 404);
        }
        
    } catch (\Throwable $e) {
        header($_SERVER["SERVER_PROTOCOL"] . $e->getMessage(), true, $e->getCode());
        // echo $e->getMessage();
        echo $e->getCode(). " " . $e->getMessage();
    }
}