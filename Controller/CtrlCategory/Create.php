<?php

#  Author: Ong Yi Chween
// collect value from front end
// validation without database

//require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllCategory/Create.php";
//require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Category.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        if (!isset($_POST['category'])) {
            throw new Exception("Category information is not complete.");
        }

        
        $data = json_decode($_POST['category']);
//        todo: rm hardcode
        $data->createdBy = "cc";
        
//        $category = new Category();
//        $category
//            ->setName($data->name)
//            ->setDescription($data->description)
//            ->setCreatedBy($data->createdBy);
//
//        $name = Create::Create($category);
//        echo "Category $name is added.";
        
        $apiURL = "http://localhost/TARUMT_Event_Ticketing/Controller/CtrlCategory/Handler.php?action=Create";

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
        header($_SERVER["SERVER_PROTOCOL"] . ' 500 Internal Server Error', true, 500);
        // echo $e->getMessage();
        echo $e;
    }
}

