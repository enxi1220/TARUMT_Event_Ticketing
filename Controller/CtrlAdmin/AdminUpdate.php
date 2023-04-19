<?php

#  Author: Ong Wi Lin

require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllAdmin/AdminUpdate.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllAdmin/AdminRead.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Admin.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        if (!isset($_POST['admin'])) {
            throw new Exception("Admin information is not complete.");
        }

//        if (!isset($_FILES['poster'])) {
//            throw new Exception("Please upload event poster");
//        }

//        $poster = $_FILES['poster'];
//        $validExtensions = '/\.(jpg|jpeg|gif|png)$/i';
//        $validMimeTypes = ['image/jpeg', 'image/gif', 'image/png'];

//        if (!preg_match($validExtensions, $poster['name']) || !in_array($poster['type'], $validMimeTypes)) {
//            throw new Exception("Image with jpg, gif, and png format only.");
//        }

        $data = json_decode($_POST['admin']);
//        $data->poster = $poster;

        // todo: rm hard code
        $data->updated_by = "Kuma";

        $admin = new Admin();
                    
        if (is_null($admin)) {
            throw new Exception("Failed to instantiate Admin object.");
        }
        
        $admin
            ->setName($data->name)
            ->setUsername2($data->username)
            ->setPhone($data->phone)
            ->setMail($data->mail)
//            ->setCreatedBy($data->createdBy)
//            ->setCreatedBy("sth")
            ->setStatus($data->status)
            ->setRole($data->role)        
            ->setAdminId($data->admin_id);        
       

//        $adminNo= AdminUpdate::Update($admin);
        $adminNo= AdminUpdate::Update($admin);
        echo "Account is updated.";
    } catch (\Throwable $e) {
        header($_SERVER["SERVER_PROTOCOL"] . ' 500 Internal Server Error', true, 500);
        echo $e->getMessage();
        // echo $e;
    }
}
