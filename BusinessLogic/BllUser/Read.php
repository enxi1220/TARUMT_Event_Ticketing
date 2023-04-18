<?php

#  Author: Vinnie Chin Loh Xin

require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/DataAccess/DataAccess.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Constant/UserStatusConstant.php";

class Read {

    public static function Read(User $user)
    {
        $user->setStatus(UserStatusConstant::ACTIVE);
        
        $dataAccess = DataAccess::getInstance();
        $result = $dataAccess->BeginDatabase(
            function (DataAccess $dataAccess) use ($user) {
                return Read::ReadUser($dataAccess, $user);
            }
        );

        return $result;
    }

    private static function ReadUser(DataAccess $dataAccess, $user) {
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
            WHERE u.mail = IF(:mail IS NULL, u.mail, :mail)  
            AND u.password = IF(:password IS NULL, u.password, :password)
            AND u.user_id = IF(:user_id IS NULL, u.user_id, :user_id)
            AND u.status = IF(:status IS NULL, u.status, :status)
            AND (u.otp = IFNULL(:otp, u.otp) OR u.otp IS NULL)
",
                function (PDOStatement $pstmt) use ($user) {
                    $pstmt->bindValue(":mail", $user->getMail(), PDO::PARAM_STR);
                    $pstmt->bindValue(":password", $user->getPassword(), PDO::PARAM_STR);
                    $pstmt->bindValue(":user_id", $user->getUserId(), PDO::PARAM_STR);
                    $pstmt->bindValue(":status", $user->getStatus(), PDO::PARAM_STR);
                    $pstmt->bindValue(":otp", $user->getUserOtp(), PDO::PARAM_STR);
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
