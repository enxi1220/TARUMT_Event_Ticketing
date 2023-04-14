<?php

#  Author: Ong Yi Chween
// collect value from front end
// validation without database

require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllCategory/Create.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Category.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        if (!isset($_POST['category'])) {
            throw new Exception("Category information is not complete.");
        }

        
        $data = json_decode($_POST['category']);
//        todo: rm hardcode
        $data->createdBy = "cc";
        
        $category = new Category();
        $category
            ->setName($data->name)
            ->setDescription($data->description)
            ->setCreatedBy($data->createdBy);

        $name = Create::Create($category);
        echo "Category $name is added.";
    } catch (\Throwable $e) {
        header($_SERVER["SERVER_PROTOCOL"] . ' 500 Internal Server Error', true, 500);
        // echo $e->getMessage();
        echo $e;
    }
}

