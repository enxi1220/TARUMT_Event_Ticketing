<?php

#  Author: Ong Yi Chween

//require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllCategory/Read.php";
//require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Category.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    try {
        if (!isset($_GET['categoryId'])) {
            throw new Exception("Category is not set.");
        } 
        
//        $categoryId = json_decode($_GET['categoryId']);
//        $category = new Category();
//        $category->setCategoryId($categoryId);
//
//        $result = Read::Read($category);
//        $result = $result[0];
//        
//        $output = array(
//            'categoryId' => $result->getCategoryId(),
//            'name' => $result->getName(),
//            'description' => $result->getDescription(),
//            'createdDate' => $result->getCreatedDate(),
//            'createdBy' => $result->getCreatedBy(),
//            'updatedDate' => $result->getUpdatedDate(),
//            'updatedBy' => $result->getUpdatedBy(),
//        );
//
//        echo json_encode($output);
        
        $categoryId = json_decode($_GET['categoryId']);

        $apiURL = "http://localhost/TARUMT_Event_Ticketing/Controller/CtrlCategory/Handler.php?action=Read&categoryId=$categoryId";
        
        $client = curl_init($apiURL);

        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($client);

        $result = json_decode($response);
        
if ($result) {
    echo json_encode($result->data);
    exit;
}
        
    } catch (\Throwable $e) {
        header($_SERVER["SERVER_PROTOCOL"] . $e->getMessage(), true, $e->getCode());
        // echo $e->getMessage();
        echo $e->getCode(). " " . $e->getMessage();
    }
}