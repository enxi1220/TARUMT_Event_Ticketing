<?php

#  Author: Tan Lin Yi

// collect value from front end
// validation without database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        if (!isset($_POST['wishlist'])) {
            throw new Exception("WishList information is not complete.");
        }

        $data = json_decode($_POST['wishlist']);
   

        $apiURL = "http://localhost/TARUMT_Event_Ticketing/Controller/CtrlWishList/Handler.php?action=Delete";

        $client = curl_init();

        curl_setopt($client, CURLOPT_URL, $apiURL);
        curl_setopt($client, CURLOPT_POST, true);
        curl_setopt($client, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($client, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        $response = curl_exec($client);

        $result = json_decode($response);
//             var_dump($response);

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
        header($_SERVER["SERVER_PROTOCOL"] . $e->getMessage(), true, $e->getCode());
        // echo $e->getMessage();
        echo $e->getCode() . " " . $e->getMessage();
    }
}