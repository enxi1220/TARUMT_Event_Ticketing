<?php

#  Author: Vinnie Chin Loh Xin
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Booking.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllBooking/Read.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    
     try {
         if (!isset($_GET['bookingId'])) {
            throw new Exception("Booking not found.");
        }
        $bookingId = json_decode($_GET['bookingId']);

        $apiURL = "http://localhost/TARUMT_Event_Ticketing/Controller/CtrlBooking/Handler.php?action=Read&bookingId=$bookingId";
        
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
        header($_SERVER["SERVER_PROTOCOL"] . ' 500 Internal Server Error', true, 500);
        // echo $e->getMessage();
        echo $e;
    }
}


