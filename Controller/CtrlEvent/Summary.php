<?php

#  Author: Lim En Xi

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    try {

        $adminName = ""; 
        $adminRole = "";
        if(isset($_SESSION['adminInfo'])) {
            $adminName = $_SESSION['adminInfo']['name'];
            $adminRole = $_SESSION['adminInfo']['role'];
        }else{
            header('Location: ../Web/View/BackOffice/Admin/AdminLogin.php');
            exit;
        }

        $apiURL = "http://localhost/TARUMT_Event_Ticketing/Controller/CtrlEvent/Handler.php?action=Summary";
        
        $client = curl_init($apiURL);

        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($client);

        $result = json_decode($response);
        // var_dump($response);

        foreach ($result->data as $data) {
            $data->role = $adminRole;
        }
        
        if ($result->status === 200) {
            echo json_encode($result->data);
            exit;
        }

        if($result->status == 404){
            throw new Exception($result->message, 404);
        }

    } catch (\Throwable $e) {
        header($_SERVER["SERVER_PROTOCOL"] . $e->getMessage(), true, $e->getCode());
        // echo $e->getMessage();
        echo $e->getCode(). " " . $e->getMessage();
    }
}
