<?php

/* 
 Author : ONG WI LIN
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllAdmin/Create.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Admin.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Helper/DateHelper.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        if (!isset($_POST['admin'])) {
            throw new Exception("Admin information is not complete.");
        }
//
//        if (!isset($_FILES['poster'])) {
//            throw new Exception("Please upload event poster");
//        }

//        $poster = $_FILES['poster'];
//        $ext = pathinfo($poster['name'], PATHINFO_EXTENSION);
//
//        if ($ext != 'jpg' && $ext != 'jpeg' && $ext != 'gif' && $ext != 'png') {
//            throw new Exception("Image with jpg, gif and png format only.");
//        }
        $data = json_decode($_POST['admin']);
//        $data->poster = $poster;

        $admin = new Admin();
             
        if (is_null($admin)) {
            throw new Exception("Failed to instantiate Admin object.");
        }

        
        // todo: rm hard code
        $data->createdBy = "sth";

        $admin
            ->setName($data->name)
//            ->setUsername($data->name, $data->role)
            ->setPhone($data->phone)
            ->setMail($data->mail)
            ->setCreatedBy($data->createdBy)
            ->setRole($data->role);
        

        $adminNo = Create::Create($admin);
        echo "Admin $adminNo is added.";
    } catch (\Throwable $e) {
        header($_SERVER["SERVER_PROTOCOL"] . ' 500 Internal Server Error', true, 500);
        // echo $e->getMessage();
        echo $e;
    }
}
