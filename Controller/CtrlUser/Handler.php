<?php

#  Author: Vinnie Chin Loh Xin
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllUser/Create.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllUser/Read.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllUser/Update.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/User.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Controller/RESTfulAPI.php";

$action = $_GET["action"] ?? "";
if ($action !== "Summary" && $action !== "Read") {
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

function create($data) {
    $user = new User();
    $user
            ->setUsername($data->username)
            ->setName($data->name)
            ->setMail($data->mail)
            ->setPhone($data->phone)
            ->setPassword(password_hash($data->password, PASSWORD_DEFAULT))
            ->setCreatedBy($data->username);
    try {

        UserCreate::Create($user);
            RESTfulAPI::response(200, "Register Successfully");
        
    } catch (\Throwable $e) {
        RESTfulAPI::response($e->getCode(), $e->getMessage());
    }
}

function update($data) {
       $user = new User();
    try {
        switch ($data->action) {
            case "editProfile":
                $user
                        ->setName($data->name)
                        ->setMail($data->mail)
                        ->setPhone($data->phone)
                        ->setUpdatedBy($data->username)
                        ->setUserId($data->userId);

                UserUpdate::Update($user);
                RESTfulAPI::response(200, "Update profile successfully!");

                break;

            case "editPwd":
                $user
                        ->setPassword(password_hash($data->password, PASSWORD_DEFAULT))
                        ->setUserId($data->userId);

                UserUpdate::Update($user);
                RESTfulAPI::response(200, "Password changed successfully!");

                break;

            case "resetPwd":
                $user
                        ->setPassword(password_hash($data->password, PASSWORD_DEFAULT))
                        ->setUserId($data->userId)
                        ->setUserOtp(null);

                UserUpdate::Update($user);
                RESTfulAPI::response(200, "Password reset successfully! You may now login with new password!");

                break;

            default:
                $user
                        ->setStatus(UserStatusConstant::INACTIVE)
                        ->setUserId($data->userId);

                UserUpdate::Update($user);
                RESTfulAPI::response(200, "Thank you for booking event with us!");

                break;
        }
    } catch (\Throwable $e) {
        RESTfulAPI::response($e->getCode(), $e->getMessage());
    }
}

//function update($data) {
//
//    try {
//        if ($data->action == "editProfile") {
//
//            $user
//                    ->setName($data->name)
//                    ->setMail($data->mail)
//                    ->setPhone($data->phone)
//                    ->setUpdatedBy($data->username)
//                    ->setUserId($data->userId);
//
//            if (UserUpdate::Update($user)) {
//                RESTfulAPI::response(200, "Update profile successfully!");
//            }
//        } else if ($data->action == "editPwd") {
//
//            $user
//                    ->setPassword($data->password)
//                    ->setUserId($data->userId);
//
//            if (UserUpdate::Update($user)) {
//
//                RESTfulAPI::response(200, "Password changed successfully!");
//            }
//        } else if ($data->action == "resetPwd") {
//
//            $user
//                    ->setPassword($data->password)
//                    ->setUserId($data->userId)
//                    ->setUserOtp(null);
//
//            if (UserUpdate::Update($user)) {
//
//                RESTfulAPI::response(200, "Password reset successfully! You may now login with new password!");
//            }
//
////            session_destroy();  
//        } else {
//            $user
//                    ->setStatus(UserStatusConstant::INACTIVE)
//                    ->setUserId($data->userId);
//
//            if (UserUpdate::Update($user)) {
//
//                RESTfulAPI::response(200, "Thank you for booking event with us!");
//            }
//
//
////            session_destroy();
//        }
//    } catch (\Throwable $e) {
//        RESTfulAPI::response($e->getCode(), $e->getMessage());
//    }
//}

function read() {

    $user = new User();
    //get user profile
    $user->setUserId($userId = $_GET['userId'] ?? 0);
    $result = UserRead::Read($user)[0] ?? RESTfulAPI::response(500, "User Details not found.");

    $output = array(
        'userId' => $result->getUserId(),
        'username' => $result->getUsername(),
        'name' => $result->getName(),
        'mail' => $result->getMail(),
        'phone' => $result->getPhone(),
        'createdDate' => $result->getCreatedDate(),
        'updatedDate' => $result->getUpdatedDate(),
    );
    RESTfulAPI::response(200, "Data Found", $output);
}

//<?php
//session_start();
//#  Author: Vinnie Chin Loh Xin
//
//require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllUser/Create.php";
//require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllUser/Read.php";
//require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/User.php";
//require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Controller/RESTfulAPI.php";
//
//$action = $_GET["action"] ?? "";
//if ($action !== "Summary") {
//    $request_body = file_get_contents('php://input');
//    $data = json_decode($request_body);
//    if (empty($data)) {
//        RESTfulAPI::response(404, "No data is submitted");
//        exit;
//    }
//}
//
//
//switch ($action) {
//    case "Summary":
//        summary();
//        break;
//    case "Read":
//        read($data);
//        break;
//    case "Create":
//        create($data);
//        break;
//    default:
//        RESTfulAPI::response(400, "Bad Request");
//        break;
//}
//
//function create($data) {
//    $user = new User();
//    $user
//            ->setUsername($data->username)
//            ->setName($data->name)
//            ->setMail($data->mail)
//            ->setPhone($data->phone)
//            ->setPassword($data->password)
//            ->setCreatedBy($data->username);
//    try {
//
//        UserCreate::Create($user);
//        RESTfulAPI::response(200, "Register Successfully");
//    } catch (\Throwable $e) {
//        RESTfulAPI::response($e->getCode(), $e->getMessage());
//    }
//}
//
//function read($data) {
//    $user = new User();
//
//    switch ($data->method) {
//        case "POST":
//            postMethod($data, $user);
//            break;
//
//        case "GET":
//            if (isset($data->action)) {
//                getMethod($data, $user);
//            } else {
//
//                //get user profile
//                $user->setUserId($_SESSION['userId']);
//                $result = UserRead::Read($user)[0] ?? RESTfulAPI::response(500, "User Details not found.");
//
//                $output = array(
//                    'userId' => $result->getUserId(),
//                    'username' => $result->getUsername(),
//                    'name' => $result->getName(),
//                    'mail' => $result->getMail(),
//                    'phone' => $result->getPhone(),
//                    'createdDate' => $result->getCreatedDate(),
//                    'updatedDate' => $result->getUpdatedDate(),
//                );
//
//                RESTfulAPI::response(200, "Data Found", $output);
//            }
//
//            break;
//    }
//}
//
//function getMethod($data, $user) {
//
//    switch ($data->action) {
//        case "checkLogin":
//            if (isset($_SESSION['userId'])) {
//                RESTfulAPI::response(200, true);
//            } else {
//                RESTfulAPI::response(200, false);
//            }
//            break;
//        case "needLogin":
//            if (isset($_SESSION['userId'])) {
//                RESTfulAPI::response(200, true);
//            } else {
//                RESTfulAPI::response(500, "Please login to proceed.");
//            }
//            break;
//        case "signOut":
//            session_destroy();
//            break;
//    }
//}
//
//function postMethod($data, $user) {
//    switch ($data->action) {
//        case "existingMail":
//            $user->setMail($data->mail);
//            $result = UserRead::Read($user) ?? RESTfulAPI::response(500, "Email not registered. Please try again.");
//            $_SESSION['userId'] = $result[0]->getUserId();
//            $user->setUserOtp(MailSenderHelper::sendMail($data->mail, "Reset Password", "Hi! You may use the OTP below to reset you password", "resetPwd"))
//                    ->setUserId($_SESSION['userId']);
//            UserUpdate::Update($user);
//            RESTfulAPI::response(200, true);
//            break;
//        case "checkOTP":
//            $user->setUserOtp($data->otpNum)->setUserId($_SESSION['userId']);
//            RESTfulAPI::response(200, true);
//            break;
//        case "validPwd":
//            $user->setPassword($data->password)->setUserId($_SESSION['userId']);
//            UserRead::Read($user)[0] ?? RESTfulAPI::response(500, "Password incorrect.");
//            RESTfulAPI::response(200, true);
//            break;
//
//        default: //login
//            $user->setMail($data->mail)->setPassword($data->password);
//            $result = UserRead::Read($user)[0] ?? RESTfulAPI::response(500, "Email and password not match.");
//
//             $output = array(
//                    'username' => $result->getUsername(),
//                    'userId' => $result->getUserId(),
//                );
//            $_SESSION['username'] = $result->getUsername();
//            $_SESSION['userId'] = $result->getUserId();
//            session_id();
//            RESTfulAPI::response(200, "Welcome back!", $result);
//
//            break;
//    }
//}
//
//
