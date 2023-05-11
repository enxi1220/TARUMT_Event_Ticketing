<?php

#  Author: Ong Yi Chween

//require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllCategory/Update.php";
//require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllCategory/Read.php";
//require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Category.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        if (!isset($_POST['category'])) {
            throw new Exception("Category information is not complete.");
        }

        $data = json_decode($_POST['category']);
//        todo: rm hardcode
        $data->updatedBy = "cc";
        
//        $category = new Category();
//        $category
//            ->setCategoryId($data->categoryId)
//            ->setName($data->name)
//            ->setDescription($data->description)
//            ->setUpdatedBy($data->updatedBy);
//
//        $name = Update::Update($category);
//        echo "Category $name is updated.";
        
        $apiURL = "http://localhost/TARUMT_Event_Ticketing/Controller/CtrlCategory/Handler.php?action=Update";

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

        if ($result->status == 500) {
            throw new Exception($result->message, 404);
        }
    } catch (\Throwable $e) {
        header($_SERVER["SERVER_PROTOCOL"] . ' 500 Internal Server Error', true, 500);
        // echo $e->getMessage();
        echo $e;
    }
}

