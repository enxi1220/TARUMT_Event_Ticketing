<?php

#  Author: Vinnie Chin Loh Xin

require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/DataAccess/DataAccess.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Constant/UserStatusConstant.php";

class UserUpdate {

    public static function Update(User $user) {
        // set default values
        $user->setStatus(UserStatusConstant::ACTIVE);
        $user->setUpdatedDate();

        // start DB transaction
        $dataAccess = DataAccess::getInstance();
        $dataAccess->BeginDatabase(function ($dataAccess) use ($user) {
            self::UpdateUser($dataAccess, $user);
        });

        return true;
    }

    private static function UpdateUser(DataAccess $dataAccess, $user) {
        $dataAccess->NonQuery(
                "UPDATE user SET
        name = IF(:name IS NULL, name, :name),
        phone = IF(:phone IS NULL, phone, :phone),
        mail = IF(:mail IS NULL, mail, :mail),
        updated_by = IF(:updated_by IS NULL, updated_by, :updated_by),
        updated_date = IF(:updated_date IS NULL, updated_date, :updated_date),
        password = IF(:password IS NULL, password, :password),
        status = IF(:status IS NULL, status, :status),
        otp = IF(:otp IS NULL, otp, :otp)
        WHERE user_id = :user_id",
                function (PDOStatement $pstmt) use ($user) {
                    $pstmt->bindValue(':name', $user->getName(), PDO::PARAM_STR);
                    $pstmt->bindValue(':phone', $user->getPhone(), PDO::PARAM_STR);
                    $pstmt->bindValue(':mail', $user->getMail(), PDO::PARAM_STR);
                    $pstmt->bindValue(':updated_by', $user->getUpdatedBy(), PDO::PARAM_STR);
                    $pstmt->bindValue(':updated_date', $user->getUpdatedDate(), PDO::PARAM_STR);
                    $pstmt->bindValue(':password', $user->getPassword(), PDO::PARAM_STR);
                    $pstmt->bindValue(':status', $user->getStatus(), PDO::PARAM_STR);
                    $pstmt->bindValue(':otp', $user->getUserOtp(), PDO::PARAM_STR);
                    $pstmt->bindValue(':user_id', $user->getUserId(), PDO::PARAM_STR);
                },
                function (\Throwable $ex) {
                    
                    if (str_contains($ex, 'Duplicate entry') && str_contains($ex, 'mail_UNIQUE')) {
                        throw new Exception("Email or username has been taken. Please try again.");
                    }
//                    echo $ex;
                }
        );
    }

}
