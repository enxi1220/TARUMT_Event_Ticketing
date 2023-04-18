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
        // complete admin object and tickets object 
//        $admin->setAdminNo();
        
//        $uniqueNoHelper = new UniqueNoHelper();
//        $admin->setUsername($uniqueNoHelper->generateUsername($admin->getName()));
        $admin->setUsername($admin->getName(), $admin->getRole());
        
//        $admin->setUsername(UniqueNoHelper::generateUsername($admin->getName(), $admin->getRole()));
        $admin->setStatus(AdminConstant::ACTIVATE);
        $admin->setCreatedDate();

//        $fileName = FileUploadHelper::UploadImage($admin->getPoster(), $admin->posterPath());
//        $admin->setPoster($fileName);

        // start database
        $dataAccess = DataAccess::getInstance();
        $dataAccess->BeginDatabase(function ($dataAccess) use ($admin) {
            // insert event & tickets 
            $adminId = Create::CreateAdmin($dataAccess, $admin);
        });

        return $admin->getAdminNo();
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
//                $pstmt->bindValue(6, $admin->getCreatedDate(), PDO::PARAM_STR);
                
                $pstmt->bindValue(6, $admin->getCreatedDate()->format('Y-m-d H:i:s'), PDO::PARAM_STR);

                $pstmt->bindValue(7, $admin->getCreatedBy(), PDO::PARAM_STR);
//                $pstmt->bindValue(8, $admin->getAdminNo(), PDO::PARAM_STR);
                $pstmt->bindValue(8, $admin->getRole(), PDO::PARAM_STR);
//                $pstmt->bindValue(9, $admin->getRole(), PDO::PARAM_STR);
            },
            function (Throwable $ex) {
                if (str_contains($ex, 'Duplicate entry') && str_contains($ex, 'admin_no_UNIQUE')) {
                    echo "Duplicate admin no is generated. Please try again.";
                }
                echo $ex;
            }
        );
        return $adminId;
    }   
}