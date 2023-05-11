<?php

#  Author: Ong Yi Chween

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    try {
        if (!isset($_GET['userId'])) {
            throw new Exception("User is not found");
        }

        $userId = json_decode($_GET['userId']);

        $apiURL = "http://localhost/TARUMT_Event_Ticketing/Controller/CtrlUsers/Handler.php?action=Read&userId=$userId";
        
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