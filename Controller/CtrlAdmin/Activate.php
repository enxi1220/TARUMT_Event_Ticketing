<?php

/* 
 * Author : Ong Wi Lin
 */


require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllAdmin/Activate.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Admin.php";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        if (!isset($_POST['admin'])) {
            throw new Exception("No admin is selected.");
        }

        
        //get adminName from session
//        session_start();
        $adminName = ""; 
        if(isset($_SESSION['adminInfo'])) {
            $adminName = $_SESSION['adminInfo']['name'];
        }else{
            header('Location: ../Web/View/BackOffice/Admin/AdminLogin.php');
            exit;
        }
        
        $data = json_decode($_POST['admin']);
        // todo: rm hard code
        $data->updated_by = $adminName;

        $apiURL = "http://localhost/TARUMT_Event_Ticketing/Controller/CtrlAdmin/Handler.php?action=Activate";

        $client = curl_init();

        curl_setopt($client, CURLOPT_URL, $apiURL);
        curl_setopt($client, CURLOPT_POST, true);
        curl_setopt($client, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($client, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        $response = curl_exec($client);

        $result = json_decode($response);

        if (property_exists($result, 'status')) {
        if ($result->status === 200) {
            echo $result->message;
            exit;
        }

        if ($result->status == 404) {
            throw new Exception("Error. Please try again.", 404);
//            throw new Exception($result->message, 404);
        }
        }else{
            throw new Exception("Error! Please try again.", 500);
        }
    } catch (\Throwable $e) {
        header($_SERVER["SERVER_PROTOCOL"] . $e->getMessage(), true, $e->getCode());
        // echo $e->getMessage();
        echo $e->getCode() . " " . $e->getMessage();
    }
}
