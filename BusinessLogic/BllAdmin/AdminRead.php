<?php

#  Author: Ong Wi Lin
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/DataAccess/DataAccess.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Admin.php";

class AdminRead
{

    public static function ReadLogin(Admin $admin)
    {
        $dataAccess = DataAccess::getInstance();
        $result = $dataAccess->BeginDatabase(
            function (DataAccess $dataAccess) use ($admin) {
                return AdminRead::LoginRead($dataAccess, $admin);
            }
        );

        return $result;
    }

    public static function Read(Admin $admin)
    {
        $dataAccess = DataAccess::getInstance();
        $result = $dataAccess->BeginDatabase(
            function (DataAccess $dataAccess) use ($admin) {
                return AdminRead::ReadAdmin($dataAccess, $admin);
            }
        );

        return $result;
    }

    private static function LoginRead(DataAccess $dataAccess, $admin)
    {
        $adminInfo;
        
        $userPassword = $admin->getPassword();
        $isValid = false;
        $passwordMatches = false;
        $rowCount = 0;
        $dataAccess->Reader(
            "SELECT 1 FROM admin WHERE mail = ? AND status = ?",
            function (PDOStatement $pstmt) use ($admin) {
                $pstmt->bindValue(1, $admin->getMail(), PDO::PARAM_STR);
                $pstmt->bindValue(2, $admin->getStatus(), PDO::PARAM_STR);
            }, 
            function ($row) use (&$isValid) {
                $isValid = true;
            }
        );

        if (!$isValid) {
            return false;
        }else {

            $dataAccess->Reader(
                "SELECT * FROM admin WHERE mail = ?",
                function (PDOStatement $pstmt) use ($admin) {
                    $pstmt->bindValue(1, $admin->getMail(), PDO::PARAM_STR);
                }, 
                function ($row) use (&$rowCount, $admin, &$adminInfo) {
//                    $isMailFound = true;
                    $storedPasswordHash = $row['password'];
//                    $passwordMatches = password_verify($admin->getPassword(), $storedPasswordHash);
                    $passwordMatches = password_verify($admin->getPassword(), $row['password']);
//                    $passwordMatches = password_verify($row['password'], $admin->getPassword());
                    $rowCount = $passwordMatches ? 1 : 0;
                    $isValid = $passwordMatches;
                    $adminInfo = $row;
                }
            );
            if ($isValid) {
                        $_SESSION['adminInfo']['admin_id'] = $adminInfo['admin_id'];
                        $_SESSION['adminInfo']['name'] = $adminInfo['name'];
                        $_SESSION['adminInfo']['username'] = $adminInfo['username'];
                        $_SESSION['adminInfo']['phone'] = $adminInfo['phone'];
                        $_SESSION['adminInfo']['mail'] = $adminInfo['mail'];
                        $_SESSION['adminInfo']['status'] = $adminInfo['status'];
                        $_SESSION['adminInfo']['role'] = $adminInfo['role'];
                    }
        }
        
        return $isValid;
    }        
            
            
    private static function ReadAdmin(DataAccess $dataAccess, $admin)
    {
        return $dataAccess->Reader(
            "SELECT 
                        a.admin_id, 
                        a.username, 
                        a.role, 
                        a.name, 
                        a.phone, 
                        a.mail, 
                        a.status, 
                        a.created_by, 
                        a.created_date, 
                        a.updated_by, 
                        a.updated_date
                    FROM admin a
                    WHERE a.admin_id = IF(:admin_id IS NULL, a.admin_id, :admin_id)
                    ORDER BY a.admin_id DESC",
            function (PDOStatement $pstmt) use ($admin) {
                $pstmt->bindValue(":admin_id", $admin->getAdminId(), PDO::PARAM_INT);
            },
            function ($row) {
                $admin = new Admin();
                return $admin
                    ->setAdminId($row['admin_id'])
                    ->setName($row['name'])
                    ->setUsername($row['username'])
                    ->setRole($row['role'])
                    ->setPhone($row['phone'])
                    ->setMail($row['mail'])
                    ->setStatus($row['status'])
                    ->setCreatedDate($row['created_date'])
                    ->setCreatedBy($row['created_by'])
                    ->setUpdatedDate($row['updated_date'])
                    ->setUpdatedBy($row['updated_by']);
            }
        );
    }
}