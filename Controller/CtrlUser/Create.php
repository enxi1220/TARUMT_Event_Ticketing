<?php

#  Author: Vinnie Chin Loh Xin
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllUser/Create.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/User.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    try {


        if (!isset($_POST['user'])) {
            throw new Exception("User information is not complete.");
        }

        $data = json_decode($_POST['user']);

        $apiURL = "http://localhost/TARUMT_Event_Ticketing/Controller/CtrlUser/Handler.php?action=Create";

        $client = curl_init();

        curl_setopt($client, CURLOPT_URL, $apiURL);
        curl_setopt($client, CURLOPT_POST, true);
        curl_setopt($client, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($client, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        $response = curl_exec($client);

        $result = json_decode($response);
        
        switch($result->status){
            case 200:
                echo $result->message;
                break;
            case 404:
                throw new Exception($result->message, 404);
                break;
            case 500:
                throw new Exception($result->message, 500);
                break;
            default:
                throw new Exception($result->message);
                
        }
        
//              if ($result->status === 200) {
//              echo $result->message;
//                exit;
//            }
//
//            if ($result->status == 404) {
//                throw new Exception($result->message, 404);
//            }
//
//            if ($result->status == 500) {
//                throw new Exception($result->message, 404);
//            }
        
        
//        if (property_exists($result, 'status')) {
          
//        } else {
//            throw new Exception("Email or username have been taken! Please try again.", 500);
//        }
    } catch (\Throwable $e) {
//        header($_SERVER["SERVER_PROTOCOL"] . ' 500 Internal Server Error', true, 500);
//        // echo $e->getMessage();
//        echo $e;
        
        header($_SERVER["SERVER_PROTOCOL"] . $e->getMessage(), true, $e->getCode());
        // echo $e->getMessage();
        echo $e->getMessage();
    }
}
