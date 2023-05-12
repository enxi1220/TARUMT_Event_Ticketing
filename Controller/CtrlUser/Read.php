<?php

//if (session_status() == PHP_SESSION_NONE) {
//    session_start();
//}
session_start();
#  Author: Vinnie Chin Loh Xin
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllUser/Read.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllUser/Update.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/User.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Helper/MailSenderHelper.php";

//if ($_SERVER["REQUEST_METHOD"] == "POST") {
//    try {
//        if (!isset($_POST['user'])) {
//            throw new Exception("Please enter credentials to login.");
//        }
//
//        $data = json_decode($_POST['user']);
//        $data->method = "POST";
//
//        $user = new User();
//
//        if ($data->action == "existingMail") {
//            $user->setMail($data->mail);
//
//            $result = UserRead::Read($user);
//
//            if ($result != null) {
//                $_SESSION['userId'] = $result[0]->getUserId();
//                $userOtp = MailSenderHelper::sendMail(
//                                $data->mail,
//                                "Reset Password",
//                                "Hi! You may use the OTP below to reset you password",
//                                "resetPwd");
//                
//                $user
//                        ->setUserOtp($userOtp)
//                        ->setUserId($_SESSION['userId']);
//                Update::Update($user);
//
//                echo true;
//            } else {
//                throw new Exception("Email not registered. Please try again.");
//            }
//        } else if ($data->action == "checkOTP") {
//
//            $user->setUserOtp($data->otpNum)
//                    ->setUserId($_SESSION['userId']);
//
//            $result = UserRead::Read($user);
//
//            if ($result != null) {
//
//                echo true;
//            } else {
//                throw new Exception("Email not registered. Please try again.");
//            }
//        } else if ($data->action == "validPwd") {
//
//            $user
//                    ->setPassword($data->password)
//                    ->setUserId($_SESSION['userId']);
//
//            $result = UserRead::Read($user);
//
//            if ($result != null) {
//                echo true;
//            } else {
//                throw new Exception("Password incorrect.");
//            }
//        } else {
//            $user
//                    ->setMail($data->mail)
//                    ->setPassword($data->password);
//
//            $result = UserRead::Read($user);
//
//            if ($result != null) {
//
//                $_SESSION['username'] = $result[0]->getUsername();
//                $_SESSION['userId'] = $result[0]->getUserId();
//            } else {
//                throw new Exception("Email and password not match.");
//            }
//        }
//    try {
//        if (!isset($_POST['user'])) {
//            throw new Exception("Please enter credentials to login.");
//        }
//
//        $data = json_decode($_POST['user']);
//        $data->method = "POST";
//
//        $apiURL = "http://localhost/TARUMT_Event_Ticketing/Controller/CtrlBooking/Handler.php?action=Read";
//
//        $client = curl_init($apiURL);
//
//        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
//
//        $response = curl_exec($client);
//
//        $result = json_decode($response);
//
//        if ($result->status === 200) {
//            echo json_encode($result->data);
//            exit;
//        }
//
//        if ($result->status == 404) {
//            throw new Exception($result->message, 404);
//        }
//    } catch (\Throwable $e) {
//        header($_SERVER["SERVER_PROTOCOL"] . ' 500 Internal Server Error', true, 500);
//        echo $e->getMessage();
////        echo $e;
//    }
//}
//if ($_SERVER["REQUEST_METHOD"] == "GET") {
//    try {
//
//        if (isset($_GET['data'])) {
//            $data = json_decode($_GET['data']);
//
//            if ($data->action == "checkLogin") {
//                if (isset($_SESSION['userId']))
//                    echo true;
//                else
//                    echo false;
//            } else if ($data->action == "needLogin") {
//                if (isset($_SESSION['userId'])) {
//                    echo true;
//                } else {
//                    throw new Exception("Please login to proceed.");
//                }
//            } else if ($data->action == "signOut") {
//                session_destroy();
//            }
//        } else {
//
//            if (isset($_SESSION['userId'])) {
//                $user = new User();
//
//                $user->setUserId($_SESSION['userId']);
//
//                $result = UserRead::Read($user);
//                $result = $result[0];
//                $output = array(
//                    'userId' => $result->getUserId(),
//                    'username' => $result->getUsername(),
//                    'name' => $result->getName(),
//                    'mail' => $result->getMail(),
//                    'phone' => $result->getPhone(),
//                    'createdDate' => $result->getCreatedDate(),
//                    'updatedDate' => $result->getUpdatedDate(),
//                );
//                echo json_encode($output);
//            }
//        }
//    } catch (\Throwable $e) {
//        header($_SERVER["SERVER_PROTOCOL"] . ' 500 Internal Server Error', true, 500);
//        echo $e->getMessage();
////        echo $e;
//    }
//}


try {

    $data = "";
    $apiURL = "";
    //login credential post to check
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!isset($_POST['user'])) {
            throw new Exception("Please enter credentials to login.");
        }
        $data = json_decode($_POST['user']);
        
        postMethod($data);
    } else {

        if (!isset($_GET['action'])) {
            
            //get user read
            $userId = $_SESSION['userId'];
            
            $apiURL = "http://localhost/TARUMT_Event_Ticketing/Controller/CtrlUser/Handler.php?action=Read&userId=$userId";
            $client = curl_init($apiURL);

            curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($client);

            $result = json_decode($response);

            if ($result->status === 200) {
                echo json_encode($result->data);
                exit;
            }
            if ($result->status == 404) {
                throw new Exception($result->message, 404);
            }

            if ($result->status == 500) {
                throw new Exception($result->message, 500);
            }
        }
        
 
        loginManage($_GET['action']);
    }



} catch (\Throwable $e) {
    header($_SERVER["SERVER_PROTOCOL"] . ' 500 Internal Server Error', true, 500);
    echo $e->getMessage();
//        echo $e;
}

function loginManage($data) {
    switch ($data) {
        case "checkLogin":
            if (isset($_SESSION['userId'])) {
                echo true;
            } else {
                echo false;
            }
            break;
        case "needLogin":
            if (isset($_SESSION['userId'])) {
                echo true;
            } else {
                throw new Exception("Please login to proceed.");
            }
            break;
        case "signOut":
            session_destroy();
            break;
    }
}

function postMethod($data) {

    $user = new User();
    switch ($data->action) {
        case "existingMail":
            $user->setMail($data->mail);
            $result = UserRead::Read($user) ?? throw new Exception("Email not registered. Please try again.");
            $_SESSION['userId'] = $result[0]->getUserId();

            $user->setUserOtp(MailSenderHelper::sendMail($data->mail, "Reset Password", "Hi! You may use the OTP below to reset you password", "resetPwd"))
                    ->setUserId($_SESSION['userId']);

            UserUpdate::Update($user);
            echo true;
            break;
        case "checkOTP":
            $user->setUserOtp($data->otpNum)->setUserId($_SESSION['userId']);
            echo true;
            break;
        case "validPwd":
            $user->setPassword($data->password)->setUserId($_SESSION['userId']);
            UserRead::Read($user)[0] ?? throw new Exception("Password incorrect.");
            echo true;
            break;

        default: //login
            $user->setMail($data->mail)->setPassword($data->password);
            $result = UserRead::ReadLogin($user)[0]?? throw new Exception("Email and password not match.");;
            
         
                $_SESSION['username'] = $result->getUsername();
                $_SESSION['userId'] = $result->getUserId();
            



            break;
    }
}



//    $client = curl_init();
//
//    curl_setopt($client, CURLOPT_URL, $apiURL);
//    curl_setopt($client, CURLOPT_POST, true);
//    curl_setopt($client, CURLOPT_POSTFIELDS, json_encode($data));
//    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
//    curl_setopt($client, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
//
//    $response = curl_exec($client);
//
//    $result = json_decode($response);
//    if ($result->status === 200) {
//
//        switch ($data->method) {
//            case $_SERVER["REQUEST_METHOD"] == "POST":
//                echo $result->message;
//                exit;
//            case $_SERVER["REQUEST_METHOD"] == "GET":
//                if (isset($_GET['data'])) {
//                    echo $result->message;
//                } else {
//
//                    echo json_encode($result->data);
//                }
//                exit;
//        }
//    }