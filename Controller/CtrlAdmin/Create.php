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
        
        // todo: rm hard code
//        $data->createdBy = "sth";
        if ($data->role == 1) {
            $role = "Staff";
        } else if ($data->role == 2) {
            $role = "Admin";
        } else {
            throw new Exception("Invalid role value: " . $data->role);
        }


        $admin
            ->setName($data->name)
            ->setPhone($data->phone)
            ->setMail($data->mail)
//            ->setCreatedBy($data->createdBy)
            ->setCreatedBy("sth")
            ->setRole($role);
        

        Create::Create($admin);

        if (sendEmail::sendEmail($data->mail, $data->name)) {
            echo "Admin is added.";
        } else {
           header($_SERVER["SERVER_PROTOCOL"] . ' Failed to send email', true, 500);

        }
        
        
        
    } catch (\Throwable $e) {
        header($_SERVER["SERVER_PROTOCOL"] . ' 500 Internal Server Error', true, 500);
        // echo $e->getMessage();
//        echo $e;
        echo 'Error, Please try again.<br>';
    }
}
