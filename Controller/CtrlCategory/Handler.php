<?php

#  Author: Ong Yi Chween

require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllCategory/Read.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllCategory/Create.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllCategory/Update.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Category.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Controller/RESTfulAPI.php";

require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/LoginUser.php";


$action = $_GET["action"] ?? "";
if ($action !== "Summary" && $action !== "Read"){
    $request_body = file_get_contents('php://input');
    $data = json_decode($request_body);
    if (empty($data)) {
        RESTfulAPI::response(404, "No data is submitted");
        exit;
    }
}

switch ($action) {
    case "Summary":
        summary();
        break;
    case "Read":
        read();
        break;
    case "Create":
        create($data);
        break;
    case "Update":
        update($data);
        break;
    default:
        RESTfulAPI::response(400, "Bad Request");
        break;
}

function update($data)
{
    $category = new Category();
    $category
        ->setCategoryId($data->categoryId)
        ->setName($data->name)
        ->setDescription($data->description)
        ->setUpdatedBy($data->updatedBy);

    try {
        $name = Update::Update($category);
        RESTfulAPI::response(200, "Category $name is updated.");
    } catch (\Throwable $e) {
        RESTfulAPI::response($e->getCode(), $e->getMessage());
    }
}

function create($data)
{
    $category = new Category();
        $category
            ->setName($data->name)
            ->setDescription($data->description)
            ->setCreatedBy($data->createdBy);
    try {
        $name = Create::Create($category);
        RESTfulAPI::response(200, "Category $name is added.");
    } catch (\Throwable $e) {
        RESTfulAPI::response($e->getCode(), $e->getMessage());
    }
}

function read()
{
    $categoryId = $_GET['categoryId'] ?? 0;
    $category = new Category();
    $category->setCategoryId($categoryId);
    $result = Read::Read($category);
    if (empty($result)) {
        RESTfulAPI::response(404, "Data Not Found", null);
        return;
    }

    $result = $result[0];
    $output = array(
        'categoryId' => $result->getCategoryId(),
        'name' => $result->getName(),
        'description' => $result->getDescription(),
        'createdDate' => $result->getCreatedDate(),
        'createdBy' => $result->getCreatedBy(),
        'updatedDate' => $result->getUpdatedDate(),
        'updatedBy' => $result->getUpdatedBy(),
    );

    RESTfulAPI::response(200, "Data Found", $output);
}

function summary()
{   
    
    $category = new Category();
    $result = CategoryRead::Read($category);
    $output = array_map(
        function ($category) {
            return array(
                'categoryId' => $category->getCategoryId(),
                'name' => $category->getName(),
                'description' => $category->getDescription(),
                'createdDate' => $category->getCreatedDate(),
                'createdBy' => $category->getCreatedBy(),
                'updatedDate' => $category->getUpdatedDate(),
                'updatedBy' => $category->getUpdatedBy(),
            );
        },
        $result
    );

    RESTfulAPI::response(200, "Data Found", $output);
}
