<?php
/* 
 Author : ONG WI LIN
 */
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Constant/AdminConstant.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/DataAccess/DataAccess.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Admin.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/IPerson.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Person.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Helper/FileUploadHelper.php";

class Create{
    
    public static function Create(Admin $admin)
    {
        $admin->setRandomUsername($admin->getName(), $admin->getRole());
        $admin->setStatus(AdminConstant::PENDING);
        $admin->setCreatedDate();

        // start database
        $dataAccess = DataAccess::getInstance();
        $dataAccess->BeginDatabase(function ($dataAccess) use ($admin) {
            Create::CreateAdmin($dataAccess, $admin);
        });
    }
    
    //private func for database
    private static function CreateAdmin(DataAccess $dataAccess, $admin)
    {
        $adminId = $dataAccess->NonQuery(
            "INSERT INTO admin (
                username,
                name , 
                phone, 
                mail, 
                status, 
                created_date, 
                created_by,
                role                
              
            ) VALUES (?,?,?,?,?,?,?,?)",
            function (PDOStatement $pstmt) use ($admin) {
            
                $pstmt->bindValue(1, $admin->getUsername(), PDO::PARAM_STR);
                $pstmt->bindValue(2, $admin->getName(), PDO::PARAM_STR);
                $pstmt->bindValue(3, $admin->getPhone(), PDO::PARAM_STR);
                $pstmt->bindValue(4, $admin->getMail(), PDO::PARAM_STR);
                $pstmt->bindValue(5, $admin->getStatus(), PDO::PARAM_STR);
                $pstmt->bindValue(6, $admin->getCreatedDate(), PDO::PARAM_STR);
                $pstmt->bindValue(7, $admin->getCreatedBy(), PDO::PARAM_STR);
                $pstmt->bindValue(8, $admin->getRole(), PDO::PARAM_STR);
            },
            function (Throwable $ex) {
                if (str_contains($ex, 'Duplicate entry')) {
                    echo "The email has been taken.";
//                    echo "Duplicate admin no is generated. Please try again.";
                }
//                echo $ex;
                header($_SERVER["SERVER_PROTOCOL"] . ' 500 Internal Server Error', true, 500);
                echo 'Add account unsuccessful.<br>';

            }
        );
    }   
}