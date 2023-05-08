<?php

#  Author: Ong Yi Chween

require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllCategory/Update.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllCategory/Read.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Category.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        if (!isset($_POST['category'])) {
            throw new Exception("Category information is not complete.");
        }

        
        $data = json_decode($_POST['category']);
//        todo: rm hardcode
        $data->updatedBy = "cc";
        
        $category = new Category();
        $category
            ->setCategoryId($data->categoryId)
            ->setName($data->name)
            ->setDescription($data->description)
            ->setUpdatedBy($data->updatedBy);

        $name = Update::Update($category);
        echo "Category $name is updated.";
    } catch (\Throwable $e) {
        header($_SERVER["SERVER_PROTOCOL"] . ' 500 Internal Server Error', true, 500);
        // echo $e->getMessage();
        echo $e;
    }
}

