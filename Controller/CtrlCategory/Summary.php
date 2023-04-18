<?php
#  Author: Vinnie Chin Loh Xin
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllCategory/Read.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Category.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    try {
        $category = new Category();
        $result = Read::Read($category);
        $output = array_map(function ($category) {
            return array(
        'categoryId' => $category->getCategoryId(),
        'name' => $category->getName(),
        'description' => $category->getDescription(),
        'createdDate' => $category->getCreatedDate(),
        'createdBy' => $category->getCreatedBy(),
        'updatedDate' => $category->getUpdatedDate(),
        'updatedBy' => $category->getUpdatedBy(),
            );
        }, $result);

        echo json_encode($output);
    } catch (\Throwable $e) {
        header($_SERVER["SERVER_PROTOCOL"] . ' 500 Internal Server Error', true, 500);
        // echo $e->getMessage();
        echo $e;
    }
}