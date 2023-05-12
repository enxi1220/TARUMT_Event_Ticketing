
<?php

/* 
 * Author : Ong Wi Lin
 */


require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Helper/DateHelper.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Constant/AdminConstant.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/DataAccess/DataAccess.php";

class Activate
{
    public static function Activate(Admin $admin)
    {
        $admin->setUpdatedDate(DateHelper::GetMalaysiaDateTime());

        $dataAccess = DataAccess::getInstance();
        $dataAccess->BeginDatabase(function ($dataAccess) use ($admin) {
            Activate::ActivateAdmin($dataAccess, $admin);
        });
    }

    private static function ActivateAdmin(DataAccess $dataAccess, $admin)
    {
        $dataAccess->NonQuery(
            "UPDATE admin
                SET status = ?, 
                    updated_by = ?, 
                    updated_date = ?
                WHERE admin_id = ?",
            function (PDOStatement $pstmt) use ($admin) {
                $pstmt->bindValue(1, AdminConstant::ACTIVE, PDO::PARAM_STR);
                $pstmt->bindValue(2, $admin->getUpdatedBy(), PDO::PARAM_STR);
                $pstmt->bindValue(3, $admin->getUpdatedDate(), PDO::PARAM_STR);
//                $pstmt->bindValue(3, $admin->getUpdatedDate()->format('Y-m-d H:i:s'), PDO::PARAM_STR);
                $pstmt->bindValue(4, $admin->getAdminId(), PDO::PARAM_INT);
            }
        );
    }
}
