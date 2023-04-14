<?php

#  Author: Vinnie Chin Loh Xin
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllUser/Create.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/User.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        if (!isset($_POST['user'])) {
            throw new Exception("User information is not complete.");
        }

        $data = json_decode($_POST['user']);
      
        var_dump($data);
        
        print($data->email);
        

        $data->createdBy = "Vinnie";

     echo "Creating new user object...<br>";
$user = new User();

        
        $user
            ->setUsername($data->username)
            ->setName($data->name)
            ->setMail($data->email)
            ->setPhone($data->phone)
            ->setPassword($data->password)
            ->setCreatedBy($data->createdBy);
        
        if(Create::Create($user))
            echo "Register Successfully";
        
    } catch (\Throwable $e) {
        header($_SERVER["SERVER_PROTOCOL"] . ' 500 Internal Server Error', true, 500);
        // echo $e->getMessage();
        echo $e;
    }
}
