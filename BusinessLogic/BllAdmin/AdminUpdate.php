<?php

#  Author: Ong Wi Lin

require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Admin.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/DataAccess/DataAccess.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Helper/FileUploadHelper.php";

class AdminUpdate
{
    public static function Update($admin)
    {
        $admin->setUpdatedDate();

//        $fileName = FileUploadHelper::UploadImage($event->getPoster(), $event->posterPath());
//        $event->setPoster($fileName);

        $dataAccess = DataAccess::getInstance();
        $dataAccess->BeginDatabase(function ($dataAccess) use ($admin) {
            AdminUpdate::UpdateAdmin($dataAccess, $admin);
        });

//        return $admin->getAdminNo();
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
//                $pstmt->bindValue(7, $admin->getUpdatedDate(), PDO::PARAM_STR);
                $pstmt->bindValue(7, $admin->getUpdatedDate()->format('Y-m-d H:i:s'), PDO::PARAM_STR);

                $pstmt->bindValue(8, $admin->getAdminId(), PDO::PARAM_INT);

            }
        );
    }
}
