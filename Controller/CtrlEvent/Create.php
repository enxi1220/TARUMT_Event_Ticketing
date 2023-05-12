<?php

#  Author: Lim En Xi

// collect value from front end
// validation without database
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
            throw new Exception("Event information is not complete.");
        }

        if (!isset($_FILES['poster'])) {
            throw new Exception("Please upload event poster");
        }

        $poster = $_FILES['poster'];
        $validExtensions = '/\.(jpg|jpeg|gif|png)$/i';
        $validMimeTypes = ['image/jpeg', 'image/gif', 'image/png'];

        if (!preg_match($validExtensions, $poster['name']) || !in_array($poster['type'], $validMimeTypes)) {
            throw new Exception("Image with jpg, gif, and png format only.");
        }

        $data = json_decode($_POST['event']);
        $data->poster = $poster;
        // todo: rm hard code
        $data->createdBy = $adminName;

        // $fileContents = file_get_contents($_FILES['poster']['tmp_name']);
        // $data->poster = $fileContents;

        // todo: date from date to validation
        // if($data->registerStartDate > $data->registerEndDate){
        //     throw new Exception("Register start date should be earlier than register end date.");
        // }
        // if($data->registerStartDate > $data->eventStartDate){
        //     throw new Exception("Register start date should be earlier than event start date.");
        // }
        // if($data->eventStartDate > $data->eventEndDate){
        //     throw new Exception("Event start date should be earlier than event end date.");
        // }
        // if($data->registerStartDate < DateHelper::GetMalaysiaDateTime()){
        //     throw new Exception("Back date for is not allowed to select on register start date.");
        // }
        // if($data->eventStartDate < DateHelper::GetMalaysiaDateTime()){
        //     throw new Exception("Back date is not allowed to select on event start date.");
        // }

        $apiURL = "http://localhost/TARUMT_Event_Ticketing/Controller/CtrlEvent/Handler.php?action=Create";

        $client = curl_init();

        curl_setopt($client, CURLOPT_URL, $apiURL);
        curl_setopt($client, CURLOPT_POST, true);
        curl_setopt($client, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($client, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        $response = curl_exec($client);

        $result = json_decode($response);
            // var_dump($response);

        if ($result->status === 200) {
            // msg is string, no need encode
            echo $result->message;
            exit;
        }

        if ($result->status == 404) {
            throw new Exception($result->message, 404);
        }

        if ($result->status == 500) {
            throw new Exception($result->message, 404);
        }
        
    } catch (\Throwable $e) {
        header($_SERVER["SERVER_PROTOCOL"] . $e->getMessage(), true, $e->getCode());
        // echo $e->getMessage();
        echo $e->getCode() . " " . $e->getMessage();
    }
}