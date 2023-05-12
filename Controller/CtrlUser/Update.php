<?php

session_start();
#  Author: Vinnie Chin Loh Xin
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllUser/Update.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/User.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {


        if (!isset($_POST['user'])) {
            throw new Exception("User information is not complete.");
        }

        $data = json_decode($_POST['user']);
        if(isset($_SESSION['username'])) {
    $data->username = $_SESSION['username'];
}
if(isset($_SESSION['userId'])) {
    $data->userId = $_SESSION['userId'];
}

        $apiURL = "http://localhost/TARUMT_Event_Ticketing/Controller/CtrlUser/Handler.php?action=Update";

        $client = curl_init();

        curl_setopt($client, CURLOPT_URL, $apiURL);
        curl_setopt($client, CURLOPT_POST, true);
        curl_setopt($client, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($client, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        $response = curl_exec($client);

        $result = json_decode($response);

        if ($result->status === 200) {
            // msg is string, no need to encode
            switch ($data->action) {
                case "resetPwd":
                case "deactivate":
                    echo $result->message;
                    session_destroy();
                    exit;

                default:
                    echo $result->message;
                    exit;
            }
        }


        if ($result->status == 404) {
            throw new Exception($result->message, 404);
        }

        if ($result->status == 500) {
            throw new Exception($result->message, 404);
        }

//
//        if ($data->action == "editProfile") {
//
//            $user
//                    ->setName($data->name)
//                    ->setMail($data->mail)
//                    ->setPhone($data->phone)
//                    ->setUpdatedBy($_SESSION['username'])
//                    ->setUserId($_SESSION['userId']);
//
//            if (UserUpdate::Update($user))
//                echo "Update profile successfully!";
//            
//        } else if ($data->action == "editPwd") {
//
//            $user
//                    ->setPassword($data->password)
//                    ->setUserId($_SESSION['userId']);
//
//            if (UserUpdate::Update($user))
//                echo "Password changed successfully!";
//            
//        } else if ($data->action == "resetPwd") {
//
//            $user
//                    ->setPassword($data->password)
//                    ->setUserId($_SESSION['userId'])
//                    ->setUserOtp(null);
//            
//            if (UserUpdate::Update($user))
//                echo "Password reset successfully! You may now login with new password!";
//            
//            session_destroy();  
//            
//        } else {
//            $user
//                    ->setStatus(UserStatusConstant::INACTIVE)
//                    ->setUserId($_SESSION['userId']);
//
//            if (UserUpdate::Update($user))
//                echo "Thank you for booking event with us!";
//
//            session_destroy();
//        } 
//        
    } catch (\Throwable $e) {
        header($_SERVER["SERVER_PROTOCOL"] . ' 500 Internal Server Error', true, 500);
        echo $e->getMessage();
//        echo $e;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    try {
//// Include the Event class file
//include $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Event.php"; 
//
//// Retrieve the serialized event object from the session
//$event = unserialize($_SESSION['event']);
//
//// Call the notify() method on the event object
//$event->notify();
        include $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Event.php";
// Retrieve the serialized event from the session
        $serializedEvent = $_SESSION['event'];

// Unserialize the event object
        $event = unserialize($serializedEvent);

// Use the event object as normal
        $event->notify();

        unset($_SESSION['event']);
    } catch (\Throwable $e) {
        header($_SERVER["SERVER_PROTOCOL"] . ' 500 Internal Server Error', true, 500);
        echo $e->getMessage();
//        echo $e;
    }
}

