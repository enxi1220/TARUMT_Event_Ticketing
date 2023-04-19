<?php

#  Author: Ong Wi Lin
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/DataAccess/DataAccess.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Admin.php";

class AdminRead
{

    public static function Read(Admin $admin)
    {
        $dataAccess = DataAccess::getInstance();
        $result = $dataAccess->BeginDatabase(
            function (DataAccess $dataAccess) use ($admin) {
//                return Read::ReadAdmin($dataAccess, $admin);
                return AdminRead::ReadAdmin($dataAccess, $admin);
            }
        );

        return $result;
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
                    ->setUsername2($row['username'])
//                    ->setUsername($row['username'])
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