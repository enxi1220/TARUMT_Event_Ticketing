<?php

#  Author: Lim En Xi

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        if (!isset($_POST['event'])) {
            throw new Exception("Event information is not complete.");
        }

        if (!isset($_FILES['poster'])) {
            throw new Exception("Please upload event poster");
        }

        $poster = $_FILES['poster'];
        $validExtensions = '/\.(jpg|jpeg|gif|png)$/i';
        $validMimeTypes = ['image/jpeg', 'image/gif', 'image/png'];

        if (!preg_match($validExtensions, $poster['name']) || !in_array($poster['type'], $validMimeTypes)) {
            throw new Exception("Image with jpg, gif, and png format only.");
        }

        $data = json_decode($_POST['event']);
        $data->poster = $poster;

        // todo: rm hard code
        $data->updatedBy = "Kuma";

        $apiURL = "http://localhost/TARUMT_Event_Ticketing/Controller/CtrlEvent/Handler.php?action=Update";

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

        if ($result->status == 500) {
            throw new Exception($result->message, 404);
        }
        
    } catch (\Throwable $e) {
        header($_SERVER["SERVER_PROTOCOL"] . ' 500 Internal Server Error', true, 500);
        echo $e->getMessage();
        // echo $e;
    }
}