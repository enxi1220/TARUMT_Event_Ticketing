<?php

/* 
 Author : ONG WI LIN
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllAdmin/sendEmail.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllAdmin/Create.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Admin.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Helper/DateHelper.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        if (!isset($_POST['admin'])) {
            throw new Exception("Admin information is not complete.");
        }

        $data = json_decode($_POST['admin']);
        $admin = new Admin();
             
        if (is_null($admin)) {
            throw new Exception("Failed to instantiate Admin object.");
        }
        
//get adminName from session
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
}
        $adminName = ""; 
        if(isset($_SESSION['adminInfo'])) {
            $adminName = $_SESSION['adminInfo']['name'];
        }else{
//            header('Location: ../Admin/AdminLogin.php');
            exit;
        }
        
        // todo: rm hard code
        if ($data->role == 1) {
            $role = "Staff";
        } else if ($data->role == 2) {
            $role = "Admin";
        } else {
            throw new Exception("Invalid role value: " . $data->role);
        }

        $data->created_by = $adminName;

        $apiURL = "http://localhost/TARUMT_Event_Ticketing/Controller/CtrlAdmin/Handler.php?action=Create";

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

            if (sendEmail::sendEmail($data->mail, $data->name)) {
//                echo "Admin :)+";
            } else {
               header($_SERVER["SERVER_PROTOCOL"] . ' Failed to send email', true, 500);
            }
            exit;
        }
        if ($result->status == 404) {
            throw new Exception("Error! Please try again.", 404);
//            throw new Exception($result->message, 404);
        }

        if ($result->status == 500) {
            throw new Exception("Error! Please try again.", 500);
//            throw new Exception($result->message, 500);
        }
        
        }else{
            throw new Exception("Error! Please try again.", 500);
        }
    } catch (\Throwable $e) {
        header($_SERVER["SERVER_PROTOCOL"] . $e->getMessage(), true, $e->getCode());
//        echo $e->getCode() . " " . $e->getMessage();
        echo "Error! Please try again.";
    }
}
