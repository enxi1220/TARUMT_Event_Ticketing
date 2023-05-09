<?php
#  Author: Ong Yi Chween
//require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllCategory/Read.php";
//require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Category.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    try {
//        $category = new Category();
//        $result = Read::Read($category);
//        $output = array_map(function ($category) {
//            return array(
//        'categoryId' => $category->getCategoryId(),
//        'name' => $category->getName(),
//        'description' => $category->getDescription(),
//        'createdDate' => $category->getCreatedDate(),
//        'createdBy' => $category->getCreatedBy(),
//        'updatedDate' => $category->getUpdatedDate(),
//        'updatedBy' => $category->getUpdatedBy(),
//            );
//        }, $result);
        
//        echo json_encode($output);
        
        $apiURL = "http://localhost/TARUMT_Event_Ticketing/Controller/CtrlCategory/Handler.php?action=Summary";
        
        $client = curl_init($apiURL);

        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($client);

        $result = json_decode($response);
        
//        if ($result) {
//            echo json_encode($result);
//            exit;
//        }
//        
        
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