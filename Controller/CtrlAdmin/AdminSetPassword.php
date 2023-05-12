<?php

#  Author: Ong Wi Lin
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Constant/AdminConstant.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllAdmin/AdminUpdate.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Admin.php";

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
            header('Location: ../Admin/AdminLogin.php');
            exit;
        }
                
        $admin
            ->setStatus(AdminConstant::ACTIVE)
            ->setMail($data->mail)
            ->setPassword(password_hash($data->password, PASSWORD_DEFAULT));

        $isMailFound= AdminUpdate::SetPassword($admin);
        
        if ($isMailFound) {
            echo "Password is set.";
//            header('Refresh: 1; url=AdminLogin.php');
//            header('Location: AdminLogin.php');
        } else {
            header($_SERVER["SERVER_PROTOCOL"] . ' 500 Internal Server Error', true, 500);
//            echo "Email " . $admin->getMail() . " is not allowed in database.<br>";
            echo "Sorry, you are not authorized to set your password.<br>";

        }
    } catch (\Throwable $e) {
        header($_SERVER["SERVER_PROTOCOL"] . ' 500 Internal Server Error', true, 500);
        echo $e->getMessage();
    }
}
