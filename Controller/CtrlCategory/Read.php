<?php

#  Author: Vinnie Chin Loh Xin
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllCategory/Read.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Category.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    try {
        if (!isset($_GET['categoryId'])) {
            throw new Exception("Category is not set.");
        } $categoryId = json_decode($_GET['categoryId']);
        $category = new Category();
        $category->setCategoryId($categoryId);

        $result = Read::Read($category);
        $result = $result[0];
        $output = array(
            'categoryId' => $result->getCategoryId(),
            'name' => $result->getName(),
            'description' => $result->getDescription(),
            'status' => $result->getStatus(),
            'createdDate' => $result->getCreatedDate(),
            'createdBy' => $result->getCreatedBy(),
            'updatedDate' => $result->getUpdatedDate(),
            'updatedBy' => $result->getUpdatedBy(),
        );

        echo json_encode($output);
    } catch (\Throwable $e) {
        header($_SERVER["SERVER_PROTOCOL"] . ' 500 Internal Server Error', true, 500);
        echo $e;
    }
}