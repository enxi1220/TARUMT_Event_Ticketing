<?php

#  Author: Lim En Xi

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {

        $adminName = ""; 
        if(isset($_SESSION['adminInfo'])) {
            $adminName = $_SESSION['adminInfo']['name'];
        }else{
            header('Location: ../Web/View/BackOffice/Admin/AdminLogin.php');
            exit;
        }

        if (!isset($_POST['event'])) {
            throw new Exception("No event is selected.");
        }

        $data = json_decode($_POST['event']);
        
        // todo: rm hard code
        $data->updatedBy = $adminName;

        $apiURL = "http://localhost/TARUMT_Event_Ticketing/Controller/CtrlEvent/Handler.php?action=Activate";

        $client = curl_init();

        curl_setopt($client, CURLOPT_URL, $apiURL);
        curl_setopt($client, CURLOPT_POST, true);
        curl_setopt($client, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($client, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        $response = curl_exec($client);

        $result = json_decode($response);

        if ($result->status === 200) {
            // msg is string, no need encode
            echo $result->message;
            exit;
        }

        if ($result->status == 404) {
            throw new Exception($result->message, 404);
        }

    } catch (\Throwable $e) {
        header($_SERVER["SERVER_PROTOCOL"] . $e->getMessage(), true, $e->getCode());
        // echo $e->getMessage();
        echo $e->getCode() . " " . $e->getMessage();
    }
}