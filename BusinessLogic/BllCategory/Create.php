<?php
#  Author: Ong Yi Chween

require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Constant/CategoryStatusConstant.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/DataAccess/DataAccess.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Category.php";

class create
{
    public static function Create(Category $category)
    {
        $category->setCreatedDate();
        
        //database
        $dataAccess = DataAccess::getInstance();
        $dataAccess->BeginDatabase(function ($dataAccess) use ($category){
            //insert category
            Create::CreateCategory($dataAccess, $category);
        });
        
        return $category->getName();    
    }
    
    //private func for database
    private static function CreateCategory(DataAccess $dataAccess, $category)
    {
        $category = $dataAccess->NonQuery(
            "INSERT INTO category (
                name,
                description,
                created_by,
                created_date
            ) VALUES (?,?,?,?)",
            function (PDOStatement $pstmt) use ($category) {
                $pstmt->bindValue(1, $category->getName(), PDO::PARAM_STR);
                $pstmt->bindValue(2, $category->getDescription(), PDO::PARAM_STR);
                $pstmt->bindValue(3, $category->getCreatedBy(), PDO::PARAM_STR);
                $pstmt->bindValue(4, $category->getCreatedDate(), PDO::PARAM_STR);
            },
            function (Exception $ex) {
                if (str_contains($ex, 'Duplicate entry') && str_contains($ex, 'name_UNIQUE')) {
                    echo "Duplicate category name is added. Please try again.";
                }
                echo $ex;
            }
        );
    }
    
}


