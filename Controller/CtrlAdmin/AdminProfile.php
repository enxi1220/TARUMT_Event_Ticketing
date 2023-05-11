<?php

/* 
 * Author : Ong Wi Lin
 */


//require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllAdmin/AdminRead.php";
//require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Admin.php";

if (session_status() == PHP_SESSION_NONE) {
            session_start();
}

$admin_id = ""; 
if(isset($_SESSION['adminInfo'])) {
    $admin_id= $_SESSION['adminInfo']['admin_id'];
//    $loginUser = new LoginUser();
//    $loginUser->attach(new Event());
//    $loginUser->setLoginUser($adminName);
    
}else{
    header('Location: ../Admin/AdminLogin.php');
    exit;
}


if ($_SERVER["REQUEST_METHOD"] == "GET") {
    try {
//        if (!isset($_GET['admin_id'])) {
//            throw new Exception("Admin is not set.");
//        }

//        $admin_id = json_decode($_GET[$admin_id]);

        $apiURL = "http://localhost/TARUMT_Event_Ticketing/Controller/CtrlAdmin/Handler.php?action=Read&admin_id=$admin_id";
        
        $client = curl_init($apiURL);

        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($client);
        
//        $result = json_encode($response);
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
        echo $e->getCode(). " " . $e->getMessage();
    }
}
