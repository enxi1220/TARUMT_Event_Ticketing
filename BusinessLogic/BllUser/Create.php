<?php

#  Author: Vinnie Chin Loh Xin

require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/DataAccess/DataAccess.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Constant/UserStatusConstant.php";

class Create {

    public static function Create(User $user) {
        // set default values
        $user->setStatus(UserStatusConstant::ACTIVE);
        $user->setCreatedDate();

        // start DB transaction
        $dataAccess = DataAccess::getInstance();
        $dataAccess->BeginDatabase(function ($dataAccess) use ($user) {
    
            self::CreateUser($dataAccess, $user);
        });

        return true;
    }

    private static function CreateUser(DataAccess $dataAccess, $user) {
     $dataAccess->NonQuery(
                "INSERT INTO user (
            username,
            password,
            name,
            phone,
            mail,
            status,
            created_by,
            created_date,
        ) VALUES (?,?,?,?,?,?,?,?)",
                function (PDOStatement $pstmt) use ($user) {
                    $pstmt->bindValue(1, $user->getUsername(), PDO::PARAM_STR);
                    $pstmt->bindValue(2, $user->getPassword(), PDO::PARAM_STR);
                    $pstmt->bindValue(3, $user->getName(), PDO::PARAM_STR);
                    $pstmt->bindValue(4, $user->getPhone(), PDO::PARAM_STR);
                    $pstmt->bindValue(5, $user->getMail(), PDO::PARAM_STR);
                    $pstmt->bindValue(6, $user->getStatus(), PDO::PARAM_STR);
                    $pstmt->bindValue(7, $user->getCreatedBy(), PDO::PARAM_STR);
                    $pstmt->bindValue(8, $user->getCreatedDate(), PDO::PARAM_STR);
                },
                function (Exception $ex) {
                    if (str_contains($ex, 'Duplicate entry') && str_contains($ex, 'mail_UNIQUE')) {
                        echo "This email has been signed up. Please try again.";
                    }
                    echo $ex;
                }
        );
    }

}
