<?php

#  Author: Ong Wi Lin

require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllAdmin/AdminUpdate.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllAdmin/AdminRead.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Admin.php";

if (session_status() == PHP_SESSION_NONE) {
            session_start();
}

$adminName = ""; 
if(isset($_SESSION['adminInfo'])) {
    $adminName = $_SESSION['adminInfo']['name'];
//    $loginUser = new LoginUser();
//    $loginUser->attach(new Event());
//    $loginUser->setLoginUser($adminName);
    
}else{
    header('Location: ../Admin/AdminLogin.php');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {

        
        if (!isset($_POST['admin'])) {
            throw new Exception("Admin information is not complete.");
        }

        $data = json_decode($_POST['admin']);
        

        //get adminName from session
//        session_start();
//        $adminName = ""; 
//        if(isset($_SESSION['adminInfo'])) {
//            $adminName = $_SESSION['adminInfo']['name'];
//        }else{
//            header('Location: ../Admin/AdminLogin.php');
//            exit;
//        }
        
        // todo: rm hard code
        $data->updated_by = $adminName;

        $apiURL = "http://localhost/TARUMT_Event_Ticketing/Controller/CtrlAdmin/Handler.php?action=Update";

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
