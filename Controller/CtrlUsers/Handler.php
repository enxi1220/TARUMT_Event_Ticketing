<?php

#  Author: Ong Yi Chween

require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllUsers/Read.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllUsers/Activate.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllUsers/Deactivate.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/User.php";
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
    case "Deactivate":
        deactivate($data);
        break;
    case "Activate":
        activate($data);
        break;
    default:
        RESTfulAPI::response(400, "Bad Request");
        break;
}

function activate($data)
{
    $user = new User();
    $user
        ->setUserId($data->userId)
        ->setUsername($data->username)
        ->setUpdatedBy($data->updatedBy);
    try {
        Activate::Activate($user);
        RESTfulAPI::response(200, "User {$user->getUsername()} is activated.");
    } catch (\Throwable $e) {
        RESTfulAPI::response($e->getCode(), $e->getMessage());
    }
}

function deactivate($data)
{
    $user = new User();
    $user
        ->setUserId($data->userId)
        ->setUsername($data->username)
        ->setUpdatedBy($data->updatedBy);
    try {
        Deactivate::Deactivate($user);
        RESTfulAPI::response(200, "User {$user->getUsername()} is deactivated.");
    } catch (\Throwable $e) {
        RESTfulAPI::response($e->getCode(), $e->getMessage());
    }
}

function read()
{
    $userId = $_GET['userId'] ?? 0;
    $user = new User();
    $user->setUserId($userId);
    $result = UsersRead::Read($user);

    if (empty($result)) {
        RESTfulAPI::response(404, "Data Not Found", null);
        return;
    }

    $result = $result[0];
    $output = array(
        'userId' => $result->getUserId(),
        'username' => $result->getUsername(),
        'name' => $result->getName(),
        'phone' => $result->getPhone(),
        'mail' => $result->getMail(),
        'status' => $result->getStatus(),
        'createdDate' => $result->getCreatedDate(),
        'createdBy' => $result->getCreatedBy(),
        'updatedDate' => $result->getUpdatedDate(),
        'updatedBy' => $result->getUpdatedBy()
    );

    RESTfulAPI::response(200, "Data Found", $output);
}

function summary()
{   
    // todo: move to login process
    // $loginUser = new LoginUser();
    // $loginUser->attach(new Event());
    // $loginUser->setLoginUser("enxi");
    // ----------

    $user = new User();
    $result = UsersRead::Read($user);

    $output = array_map(
        function ($user) {
            return array(
                'userId' => $user->getUserId(),
                'username' => $user->getUsername(),
                'name' => $user->getName(),
                'phone' => $user->getPhone(),
                'mail' => $user->getMail(),
                'status' => $user->getStatus(),
                'createdDate' => $user->getCreatedDate(),
                'createdBy' => $user->getCreatedBy(),
                'updatedDate' => $user->getUpdatedDate(),
                'updatedBy' => $user->getUpdatedBy()
            );
        },
        $result
    );

    RESTfulAPI::response(200, "Data Found", $output);
}
