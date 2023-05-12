<?php

#  Author: Ong Wi Lin

//require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllAdmin/AdminUpdate.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllAdmin/AdminRead.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Admin.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Constant/AdminConstant.php";


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
           
        $admin
            ->setStatus(AdminConstant::ACTIVE)
            ->setMail($data->mail)
            ->setPassword($data->password);

        $isValid= AdminRead::ReadLogin($admin);
        
        if ($isValid) {
            echo "Welcome.";
        } else {
            header($_SERVER["SERVER_PROTOCOL"] . ' 500 Internal Server Error', true, 500);
            echo "Invalid Email or Password. <br>";
        }
    } catch (\Throwable $e) {
        header($_SERVER["SERVER_PROTOCOL"] . ' 500 Internal Server Error', true, 500);
        echo $e->getMessage();
    }
}
