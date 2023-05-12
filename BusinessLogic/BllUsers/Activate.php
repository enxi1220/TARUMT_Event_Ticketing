<?php

#  Author: Ong Yi Chween
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Helper/DateHelper.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Constant/UserStatusConstant.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/DataAccess/DataAccess.php";

class Activate
{
    public static function Activate(User $user)
    {
        $user->setUpdatedDate();

        $dataAccess = DataAccess::getInstance();
        $dataAccess->BeginDatabase(function ($dataAccess) use ($user) {
            Activate::ActivateUser($dataAccess, $user);
        });
    }

    private static function ActivateUser(DataAccess $dataAccess, $user)
    {
        $dataAccess->NonQuery(
            "UPDATE user
                SET status = ?, 
                    updated_by = ?, 
                    updated_date = ?
                WHERE user_id = ?",
            function (PDOStatement $pstmt) use ($user) {
                $pstmt->bindValue(1, UserStatusConstant::ACTIVE, PDO::PARAM_STR);
                $pstmt->bindValue(2, $user->getUpdatedBy(), PDO::PARAM_STR);
                $pstmt->bindValue(3, $user->getUpdatedDate(), PDO::PARAM_STR);
                $pstmt->bindValue(4, $user->getuserId(), PDO::PARAM_INT);
            }
        );
    }
}

