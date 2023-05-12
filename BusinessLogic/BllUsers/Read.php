<?php

#  Author: Ong Yi Chween
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/DataAccess/DataAccess.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Constant/PosterPathConstant.php";

class UsersRead
{

    public static function Read(User $user)
    {
        $dataAccess = DataAccess::getInstance();
        $result = $dataAccess->BeginDatabase(
            function (DataAccess $dataAccess) use ($user) {
                return self::ReadUsers($dataAccess, $user);
            }
        );

        return $result;
    }

    private static function ReadUsers(DataAccess $dataAccess, $user)
    {
        return $dataAccess->Reader(
             "SELECT 
                    u.user_id,
                    u.username,
                    u.password,
                    u.name,
                    u.phone,
                    u.mail,
                    u.status,
                    u.created_by,
                    u.created_date, 
                    u.updated_by,
                    u.updated_date
                    FROM user u
                    WHERE u.user_id = IF(:user_id IS NULL, u.user_id, :user_id)
                    AND u.status = IF(:status IS NULL, u.status, :status)
                    ORDER BY u.user_id DESC",
                
            function (PDOStatement $pstmt) use ($user) {
                $pstmt->bindValue(":user_id", $user->getUserId(), PDO::PARAM_INT);
                $pstmt->bindValue(":status", $user->getStatus(), PDO::PARAM_STR);
            },
            function ($row) {
                $user = new User();
                return $user
                    ->setUserId($row['user_id'])
                    ->setMail($row['mail'])
                    ->setUsername($row['username'])
                    ->setName($row['name'])
                    ->setPhone($row['phone'])
                    ->setStatus($row['status'])
                    ->setCreatedBy($row['created_by'])
                    ->setCreatedDate($row['created_date'])
                    ->setUpdatedBy($row['updated_by'])
                    ->setUpdatedDate($row['updated_date']);
            }
        );
    }
}
