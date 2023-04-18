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
        $user = new User();

        if ($data->action == "editProfile") {

            $user
                    ->setName($data->name)
                    ->setMail($data->mail)
                    ->setPhone($data->phone)
                    ->setUpdatedBy($_SESSION['username'])
                    ->setUserId($_SESSION['userId']);

            if (Update::Update($user))
                echo "Update profile successfully!";
            
        } else if ($data->action == "editPwd") {

            $user
                    ->setPassword($data->password)
                    ->setUserId($_SESSION['userId']);

            if (Update::Update($user))
                echo "Password changed successfully!";
            
        } else if ($data->action == "resetPwd") {

            $user
                    ->setPassword($data->password)
                    ->setUserId($_SESSION['userId'])
                    ->setUserOtp(null);
            
            if (Update::Update($user))
                echo "Password reset successfully! You may now login with new password!";
            
            session_destroy();  
            
        } else {
            $user
                    ->setStatus(UserStatusConstant::INACTIVE)
                    ->setUserId($_SESSION['userId']);

            if (Update::Update($user))
                echo "Thank you for booking event with us!";

            session_destroy();
        } 
        
    } catch (\Throwable $e) {
        header($_SERVER["SERVER_PROTOCOL"] . ' 500 Internal Server Error', true, 500);
        echo $e->getMessage();
//        echo $e;
    }
}
