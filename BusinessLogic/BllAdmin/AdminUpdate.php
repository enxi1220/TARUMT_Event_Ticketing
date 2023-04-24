<?php

#  Author: Ong Wi Lin

require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Admin.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/DataAccess/DataAccess.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Helper/FileUploadHelper.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Constant/AdminConstant.php";

class AdminUpdate
{
    public static function SetPassword($admin)
    {
        $admin->setUpdatedDate();

        $dataAccess = DataAccess::getInstance();
        $isMailFound = false;
        $dataAccess->BeginDatabase(function ($dataAccess) use ($admin, &$isMailFound) {
            $isMailFound = AdminUpdate::SetPasswordAdmin($dataAccess, $admin);
        });
        return $isMailFound;
    }
    
    public static function Update($admin)
    {
        $admin->setUpdatedDate();

        $dataAccess = DataAccess::getInstance();
        $dataAccess->BeginDatabase(function ($dataAccess) use ($admin) {
            AdminUpdate::UpdateAdmin($dataAccess, $admin);
        });

    }

    private static function SetPasswordAdmin(DataAccess $dataAccess, $admin)
    {

        $isMailFound = false;
        $dataAccess->Reader(
        "SELECT 1 FROM admin WHERE mail = ? AND status = ?;",
        function (PDOStatement $pstmt) use ($admin) {
            $pstmt->bindValue(1, $admin->getMail(), PDO::PARAM_STR);
            $pstmt->bindValue(2, AdminConstant::PENDING, PDO::PARAM_STR);
        }, 
        function ($row) use (&$isMailFound) {
            $isMailFound = true;
        }
    );

    if (!$isMailFound) {
        return false;
    }else {

    //        update Pw
            $dataAccess->NonQuery(
             "UPDATE admin
                    SET 
                        password = ?,
                        updated_date = ?,
                        updated_by = ?,
                        status = ?
                    WHERE mail = ?",
                function (PDOStatement $pstmt) use ($admin, &$rowCount) {
                    $pstmt->bindValue(1, $admin->getPassword(), PDO::PARAM_STR);
                    $pstmt->bindValue(2, $admin->getUpdatedDate(), PDO::PARAM_STR);
                    $pstmt->bindValue(3, $admin->getUpdatedBy(), PDO::PARAM_STR);
                    $pstmt->bindValue(4, $admin->getStatus(), PDO::PARAM_STR);
                    $pstmt->bindValue(5, $admin->getMail(), PDO::PARAM_STR);
                }
            );
        }

        return $isMailFound;

    }

    private static function UpdateAdmin(DataAccess $dataAccess, $admin)
    {
        $dataAccess->NonQuery(
            "UPDATE admin
                SET 
                    name = ?, 
                    username = ?, 
                    phone = ?, 
                    role = ?, 
                    status = ?, 
                    mail = ?,
                    updated_date = ?
                WHERE admin_id = ?",
            function (PDOStatement $pstmt) use ($admin) {
                $pstmt->bindValue(1, $admin->getName(), PDO::PARAM_STR);
                $pstmt->bindValue(2, $admin->getUsername(), PDO::PARAM_STR);
                $pstmt->bindValue(3, $admin->getPhone(), PDO::PARAM_STR);
                $pstmt->bindValue(4, $admin->getRole(), PDO::PARAM_STR);
                $pstmt->bindValue(5, $admin->getStatus(), PDO::PARAM_STR);
                $pstmt->bindValue(6, $admin->getMail(), PDO::PARAM_STR);
                $pstmt->bindValue(7, $admin->getUpdatedDate(), PDO::PARAM_STR);
                $pstmt->bindValue(8, $admin->getAdminId(), PDO::PARAM_INT);

            }
        );
    }
}
