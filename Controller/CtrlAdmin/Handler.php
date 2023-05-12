<?php

#  Author: Ong Wi Lin

require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllAdmin/AdminRead.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllAdmin/Activate.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllAdmin/Deactivate.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllAdmin/Create.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllAdmin/AdminUpdate.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Admin.php";
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
    $admin = new Admin();
    $admin
        ->setUpdatedBy($data->updated_by)
        ->setName($data->name)
            ->setUsername($data->username)
            ->setPhone($data->phone)
            ->setMail($data->mail)
            ->setStatus($data->status)
            ->setRole($data->role)        
            ->setAdminId($data->admin_id); 

    try {
        $adminNo = AdminUpdate::Update($admin);
        RESTfulAPI::response(200, "Account is updated by $data->updated_by.");
    } catch (\Throwable $e) {
        RESTfulAPI::response($e->getCode(), $e->getMessage());
    }
}

function create($data)
{
        if ($data->role == 1) {
            $role = "Staff";
        } else if ($data->role == 2) {
            $role = "Admin";
        } else {
            throw new Exception("Invalid role value: " . $data->role);
        }
        
        //get adminName from session
//        session_start();
//        $adminName = ""; 
//        if(isset($_SESSION['adminInfo'])) {
//            $adminName = $_SESSION['adminInfo']['name'];
//        }else{
//            header('Location: ../Admin/AdminLogin.php');
//            exit;
//        }
//        
    $admin = new Admin();
    $admin
            ->setName($data->name)
            ->setPhone($data->phone)
            ->setMail($data->mail)
            ->setCreatedBy($data->created_by)
            ->setRole($role);
    
    try {
        Create::Create($admin);
        RESTfulAPI::response(200, "Admin is added.");
    } catch (\Throwable $e) {
//        RESTfulAPI::response($e->getCode(), $e->getMessage());
        RESTfulAPI::response(500, "Error!");
    }
}

function activate($data)
{
    $admin = new Admin();
        $admin
            ->setAdminId($data->admin_id)
            ->setUpdatedBy($data->updated_by);   
        
    try {
        Activate::Activate($admin);
        RESTfulAPI::response(200, "The account is activated.");
    } catch (\Throwable $e) {
        RESTfulAPI::response($e->getCode(), $e->getMessage());
    }
}

function deactivate($data)
{
        $admin = new Admin();
    $admin
            ->setAdminId($data->admin_id)
            ->setUpdatedBy($data->updated_by);
    try {
        Deactivate::Deactivate($admin);
        RESTfulAPI::response(200, "The account is deactivated.");
    } catch (\Throwable $e) {
        RESTfulAPI::response($e->getCode(), $e->getMessage());
    }
}

function read()
{
//      $admin_id = json_decode($_GET['admin_id']);
        $admin_id = $_GET['admin_id'] ?? 0;
        $admin = new Admin();
        $admin->setAdminId($admin_id);
        $result = AdminRead::Read($admin);

        if (empty($result)) {
        RESTfulAPI::response(404, "Data Not Found", null);
        return;
//            exit;
        }
        
        $output = array_map(
            function ($admin) {
                return array(
                    'admin_id' => $admin->getAdminId(),
                    'name' => $admin->getName(),
                    'username' => $admin->getUsername(),
                    'role' => $admin->getRole(),
                    'phone' => $admin->getPhone(),
                    'mail' => $admin->getMail(),
                    'status' => $admin->getStatus(),
                    'created_date' => $admin->getCreatedDate(),
                    'created_by' => $admin->getCreatedBy(),
                    'updated_date' => $admin->getUpdatedDate(),
                    'updated_by' => $admin->getUpdatedBy()                
                        );
            },
            $result
        );

        RESTfulAPI::response(200, "Data Found", $output);
}

function summary()
{   
    // todo: move to login process
//    $loginUser = new LoginUser();
//    $loginUser->attach(new Event());
//    $loginUser->setLoginUser("enxi");
    // ----------

    $admin = new Admin();
        $admin->setAdminId(null);
        $result = AdminRead::Read($admin);
        $output = array_map(
            function ($admin) {
                return array(
                    'admin_id' => $admin->getAdminId(),
                    'name' => $admin->getName(),
                    'username' => $admin->getUsername(),
                    'role' => $admin->getRole(),
                    'phone' => $admin->getPhone(),
                    'mail' => $admin->getMail(),
                    'status' => $admin->getStatus(),
                    'created_date' => $admin->getCreatedDate(),
                    'created_by' => $admin->getCreatedBy(),
                    'updated_date' => $admin->getUpdatedDate(),
                    'updated_by' => $admin->getUpdatedBy()                
                        );
            },
            $result
        );

    RESTfulAPI::response(200, "Data Found", $output);
}

function getRequestBody($data)
{
}
