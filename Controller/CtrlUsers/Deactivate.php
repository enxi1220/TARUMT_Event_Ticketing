<?php

#  Author: Ong Yi Chween

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        if (!isset($_POST['user'])) {
            throw new Exception("No user is selected.");
        }

        $data = json_decode($_POST['user']);
        // todo: rm hard code
        $data->updatedBy = "Kai";
        
        $apiURL = "http://localhost/TARUMT_Event_Ticketing/Controller/CtrlUsers/Handler.php?action=Deactivate";

        $client = curl_init();

        curl_setopt($client, CURLOPT_URL, $apiURL);
        curl_setopt($client, CURLOPT_POST, true);
        curl_setopt($client, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($client, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        $response = curl_exec($client);

        $result = json_decode($response);

        if ($result->status === 200) {
            // msg is string, no need encode
            echo $result->message;
            exit;
        }

        if ($result->status == 404) {
            throw new Exception($result->message, 404);
        }
        
    } catch (\Throwable $e) {
        header($_SERVER["SERVER_PROTOCOL"] . $e->getMessage(), true, $e->getCode());
        // echo $e->getMessage();
        echo $e->getCode() . " " . $e->getMessage();
    }
}
