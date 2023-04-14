<?php

#  Author: Vinnie Chin Loh Xin
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllUser/Update.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/User.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        if (!isset($_POST['user'])) {
            throw new Exception("User information is not complete.");
        }

        $data = json_decode($_POST['user']);
     
        // TODO: rmb to change to session
        $data->updatedBy = "Vinnie";
        
        $user
            ->setUsername($data->username)
            ->setName($data->name)
            ->setMail($data->email)
            ->setPhone($data->phone)
            ->setPassword($data->password)
            ->setCreatedBy($data->createdBy);
        
        if(Create::Create($user))
            echo "Update profile successfully!";
        
    } catch (\Throwable $e) {
        header($_SERVER["SERVER_PROTOCOL"] . ' 500 Internal Server Error', true, 500);
        // echo $e->getMessage();
        echo $e;
    }
}
