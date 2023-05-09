<?php

session_start();
#  Author: Vinnie Chin Loh Xin
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllUser/UserRead.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllUser/Update.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/User.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Helper/MailSenderHelper.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        if (!isset($_POST['user'])) {
            throw new Exception("Please enter credentials to login.");
        }

        $data = json_decode($_POST['user']);

        $user = new User();

        if ($data->action == "existingMail") {
            $user->setMail($data->mail);

            $result = UserRead::Read($user);

            if ($result != null) {
                $_SESSION['userId'] = $result[0]->getUserId();
                $userOtp = MailSenderHelper::sendMail(
                                $data->mail,
                                "Reset Password",
                                "Hi! You may use the OTP below to reset you password",
                                "resetPwd");
                
                $user
                        ->setUserOtp($userOtp)
                        ->setUserId($_SESSION['userId']);
                Update::Update($user);

                echo true;
            } else {
                throw new Exception("Email not registered. Please try again.");
            }
        } else if ($data->action == "checkOTP") {

            $user->setUserOtp($data->otpNum)
                    ->setUserId($_SESSION['userId']);

            $result = UserRead::Read($user);

            if ($result != null) {

                echo true;
            } else {
                throw new Exception("Email not registered. Please try again.");
            }
        } else if ($data->action == "validPwd") {

            $user
                    ->setPassword($data->password)
                    ->setUserId($_SESSION['userId']);

            $result = UserRead::Read($user);

            if ($result != null) {
                echo true;
            } else {
                throw new Exception("Password incorrect.");
            }
        } else {
            $user
                    ->setMail($data->mail)
                    ->setPassword($data->password);

            $result = UserRead::Read($user);

            if ($result != null) {

                $_SESSION['username'] = $result[0]->getUsername();
                $_SESSION['userId'] = $result[0]->getUserId();
            } else {
                throw new Exception("Email and password not match.");
            }
        }
    } catch (\Throwable $e) {
        header($_SERVER["SERVER_PROTOCOL"] . ' 500 Internal Server Error', true, 500);
        echo $e->getMessage();
//        echo $e;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    try {

        if (isset($_GET['data'])) {
            $data = json_decode($_GET['data']);

            if ($data->action == "checkLogin") {
                if (isset($_SESSION['userId']))
                    echo true;
                else
                    echo false;
            } else if ($data->action == "needLogin") {
                if (isset($_SESSION['userId'])) {
                    echo true;
                } else {
                    throw new Exception("Please login to proceed.");
                }
            } else if ($data->action == "signOut") {
                session_destroy();
            }
        } else {

            if (isset($_SESSION['userId'])) {
                $user = new User();

                $user->setUserId($_SESSION['userId']);

                $result = UserRead::Read($user);
                $result = $result[0];
                $output = array(
                    'userId' => $result->getUserId(),
                    'username' => $result->getUsername(),
                    'name' => $result->getName(),
                    'mail' => $result->getMail(),
                    'phone' => $result->getPhone(),
                    'createdDate' => $result->getCreatedDate(),
                    'updatedDate' => $result->getUpdatedDate(),
                );
                echo json_encode($output);
            }
        }
    } catch (\Throwable $e) {
        header($_SERVER["SERVER_PROTOCOL"] . ' 500 Internal Server Error', true, 500);
        echo $e->getMessage();
//        echo $e;
    }
}
